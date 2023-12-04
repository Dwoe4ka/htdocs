<?
$name_surname = trim(filter_var($_POST['name_surname'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
$err = '';

if ($name_surname == '')
 $err = 'Введіть ім\'я та прізвище';
else if ($password == '')
 $err = 'Введіть пароль';

 if ($err != '') {
     echo "$err";
     exit();
 }

require_once "../dbconnect.php";
$sql_salt = 'SELECT h_salt FROM users WHERE `name_surname` = ?';
$query_salt = $pdo->prepare($sql_salt);
$query_salt->execute([$name_surname]);
$salt = $query_salt->fetch(PDO::FETCH_OBJ);
$password = $password . $salt->h_salt;
$password = hash('sha256', $password);
$sql = 'SELECT id FROM users WHERE `name_surname` = ? AND `h_password` = ?';
$query = $pdo->prepare($sql);
$query->execute([$name_surname, $password]);
  if($query->rowCount() == 0) {
    echo 'Пароль неправильний або такого користувача не існує';
    exit();
    }
    else {
    setcookie('logged', $name_surname, time() + 604800, "/");
    echo 'Done';
    }
    