<footer></footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<footer>
    <h1 class="info">
    Історія ваших транзакцій:
    </h1>
    <? 
        $screen_width = 
        require_once "dbconnect.php";
        $sql = 'SELECT * FROM transfers WHERE `t_name_from` = ? OR `t_name_to` = ? ORDER BY `t_id` DESC';
        $query = $pdo->prepare($sql);
        $query->execute([$_COOKIE['logged'], $_COOKIE['logged']]);
        if($query->rowCount() == 0) {
            echo "<h1 class=\"info\"> Транзакції відсутні </h1>";
        }
        while($row = $query->fetch(PDO::FETCH_OBJ)) {
        echo "<p class=\"info\"><b>" . "=> " . $row->t_time . " - Transfer " .$row->t_card_from . " -> " . $row->t_card_to . "</b></p>"; 
        echo "<p class=\"info\">" . "Користувач ". $row->t_name_from . " надіслав " . $row->t_amount . " мотивашок користувачу " . $row->t_name_to . "</p>";
        if($row->t_comment != '') {
        echo "<p class=\"info\">" . "Коментар: ". $row->t_comment . "</p>";
        }   
        }
    ?>
</footer>
<!-- Файл, який під'єднується для відображення на сторінці історії транзакцій акаунта -->
<!-- Файл - під'єднання ajax і ноги сайту -->
