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
    <h1>Вітаю, <?=$_COOKIE['logged'] ?></h1>
    <h2>Номер вашої карти - <?=$user->c_number ?></h2>
    <h3>Кількість мотивашок - <?=$user->c_amount ?></h3>
    <? else: ?>
    <h4>Зареєструйтесь або увійдіть в акаунт для перегляду своїх карток</h4>
    <? endif ?>
    </main>
    <?
    ?>
    <? require "footer.php" ?>
</body> 
</html> 