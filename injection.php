<?php
//session_start();
header ('Location: /');
//$_SESSION['name_surname'] = $_POST['name_surname'];
//$_SESSION['password'] = $_POST['password'];
setcookie("name_surname", $_POST['name_surname'], time () + 60);
setcookie("account_password", $_POST['account_password'], time () + 60);
?>