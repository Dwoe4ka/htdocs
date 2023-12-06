<!DOCTYPE html>
<html lang="uk">
<head>
    <? require 'head.php' ?>
    <title>Дворобанк</title>
</head>
<body>
    <? require 'header.php' ?>
    <main>
    <?
    require_once "dbconnect.php";
    $sql = 'SELECT c_number, c_amount FROM users WHERE `name_surname` = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$_COOKIE['logged']]);
    $user = $query->fetch(PDO::FETCH_OBJ);  
    ?>
    <? if(isset($_COOKIE['logged'])): ?>
    <p>Вітаю, <b><?=$_COOKIE['logged']?></b>.     Номер вашої карти - <b><?=$user->c_number ?></b>.     Кількість мотивашок - <b><?=$user->c_amount ?></b></p>
    <? else: ?>
    <p><b>Зареєструйтесь або увійдіть в акаунт для перегляду своїх карток</b></p>
    <? endif ?>
    </main>     
    <? require "footer.php" ?>
</body> 
</html> 
<!-- Основний файл з головною сторінкою, виводить всі дані при увійденому акаунті -->