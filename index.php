<?php //session_start() ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>
<body>
    
    <?php 
    /*
    $user = 'root';
    $password = 'root';
    $db = 'users';
    $host = 'localhost';
    $port = 3306;
    $dsn = 'mysql:host'.$host.';dbname='.$db;
    $pdo = new PDO($dsn, $user, $password);
    $query = $pdo->query('SELECT * FROM `users`');
    //require 'header.php';
    if ($_SESSION['name_surname'] != "")
    echo 'Ім\'я та прізвище: ' . $_SESSION['name_surname'] . '<br>';
    if ($_SESSION['password'] != "")
    echo 'Пароль: ' . $_SESSION['password'] . '<br>';
    //require 'footer.php'; 
    //$name_surname = $_POST['name_surname'];
    //$password = $_POST['password'];
    ////if ($_COOKIE['name_surname'] != "" || $_COOKIE['account_password'] != "") {
    ////echo 'Ім\'я та прізвище: ' . $_COOKIE['name_surname'] . '<br>';
    ////echo 'Пароль: ' . $_COOKIE['account_password'] . '<br>';
    ////}
    while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
        echo $row['id']. ' ';
        echo $row['name_surname'].' ';
        echo $row['c_amount'];
    }
    */
    try {
        $dsn = "mysql:host=localhost;dbname=users";
        $user = "root";
        $passwd = "root";
        $pdo = new PDO($dsn, $user, $passwd);
        echo 'Done!<br>';
        $query = $pdo->query('SELECT * FROM users');
        while ($row = $query->fetch(PDO::FETCH_OBJ)) {
            echo 'TEXT ID->'.$row->id.'<br>';
            echo 'TEXT NS->'.$row->name_surname.'<br>';
            echo 'TEXT AM->'.$row->c_amount.'<br>';
        }
    }
    catch (PDOException $e) {
         echo "Error!: " . $e->getMessage() . "<br/>";
         die();
     }
    ?>
</body> 
</html> 