<?
$name_surname = trim(filter_var($_POST['name_surname'], FILTER_SANITIZE_SPECIAL_CHARS));
$password = trim(filter_var($_POST['password'], FILTER_SANITIZE_SPECIAL_CHARS));
$password_re = trim(filter_var($_POST['password_re'], FILTER_SANITIZE_SPECIAL_CHARS));

$err = '';

if (strlen($name_surname) < 2)
 $err = 'Ім\'я та прізвище замалі';
else if (strlen($name_surname)>255)
 $err = 'Ім\'я та прізвище завеликі';
else if (strlen($password)<8)
 $err = 'Пароль замалий';
else if ($password != $password_re)
 $err = 'Паролі не співпадають';

require_once "../dbconnect.php";

$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
$h_salt = '';
for ($i = 0; $i < 16; $i++) {
    $h_salt .= $characters[rand(0, strlen($characters) - 1)];
}
$code = '';
for ($i = 0; $i < 16; $i++) {
    $code .= $characters[rand(0, strlen($characters) - 1)];
}

$c_number = rand(10000000, 99999999);
$password = $password . $h_salt;
$password = hash('sha256', $password);

$sql_numb = 'SELECT id FROM users WHERE `c_number` = ?';
$query_numb = $pdo->prepare($sql_numb);
$query_numb->execute([$c_number]);
while($query_numb->rowCount() >= 1) {
    $c_number = rand(10000000, 99999999);
}

$sql_name = 'SELECT id FROM users WHERE `name_surname` = ?';
$query_name = $pdo->prepare($sql_name);
$query_name->execute([$name_surname]);
if($query_name->rowCount() == 0) {
} else {
    $err = 'Ім\'я та прізвище вже зайняті';
}

if ($err != '') {
    echo "$err";
    exit();
}

$sql = 'INSERT INTO `users` (`name_surname`, `h_password`, `h_salt`, `c_number`, `c_amount`, `code`) VALUES (?, ?, ?, ?, ?, ?)';    
$query = $pdo->prepare($sql);
$query->execute([$name_surname, $password, $h_salt, $c_number, '1000', $code]);
echo 'Done!';