<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP</title>
</head>
<body>
    <form action = "/injection.php" method="post">
        <label for="name_surname">Вкажіть ім'я та прізвище</label>
        <input type="text", name="name_surname"><br>
        <label for="password">Вкажіть пароль</label>
        <input type="text", name="password"><br>
        <button type="submit">Надіслати до Аллаха</button>
    <?php 
    require 'header.php';
    require 'footer.php';
    ?>
</body>
</html>