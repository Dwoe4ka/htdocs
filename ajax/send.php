<?
$c_number = trim(filter_var($_POST['c_number'], FILTER_SANITIZE_SPECIAL_CHARS));
$cs_amount = trim(filter_var($_POST['cs_amount'], FILTER_SANITIZE_SPECIAL_CHARS));
$err = '';

if ($c_number == '')
 $err = 'Введіть номер карти';
else if ($cs_amount == '')
 $err = 'Введіть кількість арабів, яких ви хочете надіслати';

 if ($err != '') {
     echo "$err";
     exit();
 }

 require_once "../dbconnect.php";

$sql = 'SELECT * FROM users WHERE `c_number` = ?';
$query = $pdo->prepare($sql);
$query->execute([$c_number]);
$sql_me = 'SELECT * FROM users WHERE `name_surname` = ?';
$query_me = $pdo->prepare($sql_me);
$query_me->execute([$_COOKIE['logged']]);
$c_amount_me = $query_me->fetch(PDO::FETCH_OBJ);
$c_amount_s = $query->fetch(PDO::FETCH_OBJ);
  if($query->rowCount() == 0) {
    echo 'Такого номера карти не існує';
    exit();
    }
    else if ($c_amount_me->c_amount < $cs_amount){
    echo "Мотивашок на карті замало, необхідно $cs_amount, є " . $c_amount_me->c_amount;
    }
    else if ($cs_amount < 0) {
    echo "Красти гроші заборонено статуом ОЧН";
    }
    else if ($cs_amount == 0) {
      echo "Не смішно";
    }
    else {
    $c_newamount_me = $c_amount_me->c_amount - $cs_amount;
    $c_newamount_s = $c_amount_s->c_amount + $cs_amount;
    $sql_send = 'UPDATE `users` SET `c_amount` = :c_newamount_s WHERE `c_number` = :c_number'; 
    $query_send = $pdo->prepare($sql_send);
    $query_send->execute(['c_newamount_s' => $c_newamount_s,'c_number' => $c_number]);
    $sql_me_send = 'UPDATE `users` SET `c_amount` = :c_newamount_me WHERE `name_surname` = :name_surname'; 
    $query_me_send = $pdo->prepare($sql_me_send);
    $query_me_send->execute(['c_newamount_me' => $c_newamount_me, 'name_surname' => $_COOKIE['logged']]);
    }
    
$year = date('Y');
$month = date('m');
$day = date('d');
$date = "$year-$month-$day";
$sql_transfer = 'INSERT INTO `transfers` (`t_amount`, `t_card_from`, `t_card_to`, `t_name_from`, `t_name_to`, `t_time`) VALUES (?, ?, ?, ?, ?, ?)';
$query_transfer = $pdo->prepare($sql_transfer);
$query_transfer->execute([$cs_amount, $c_amount_me->c_number, $c_amount_s->c_number, $c_amount_me->name_surname, $c_amount_s->name_surname, $date]);
echo 'Done';
    