<!DOCTYPE html>
<html lang="ua">
<head>
    <? require 'head.php' ?>
    <title>Дворобанк</title>
</head>
<body>
    <? require 'header.php' ?>
    <? require "aside.php" ?>
    <main>
    <?
    require_once "dbconnect.php";
    $sql = 'SELECT c_number, c_amount FROM users WHERE `name_surname` = ?';
    $query = $pdo->prepare($sql);
    $query->execute([$_COOKIE['logged']]);
    $user = $query->fetch(PDO::FETCH_OBJ);  
    ?>
    <span>Дворобанк</span>
    <? if(isset($_COOKIE['logged'])): ?>
    <p>Вітаю, <?=$_COOKIE['logged'] ?></p>
    <p>Номер вашої карти - <?=$user->c_number ?></p>
    <p>Кількість мотивашок - <?=$user->c_amount ?></p>
    <? else: ?>
    <h2>Зареєструйтесь або увійдіть в акаунт для перегляду своїх карток</h2>
    <? endif ?>
    </main>
    <?
    ?>
    <? require "footer.php" ?>
</body> 
</html> 
<!-- Основний файл з головною сторінкою, виводить всі дані при увійденому акаунті -->