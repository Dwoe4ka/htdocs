<aside>
    <h1 class="info">
    Історія ваших транзакцій:
    </h1>
    <? 
        require_once "dbconnect.php";
        $sql = 'SELECT * FROM transfers WHERE `t_name_from` = ? ORDER BY `t_time` DESC';
        $query = $pdo->prepare($sql);
        $query->execute([$_COOKIE['logged']]);
        if($query->rowCount() == 0) {
            echo "<h1 class=\"info\"> Транзакції відсутні </h1>";
        }
        while($row = $query->fetch(PDO::FETCH_OBJ)) {
        echo "<p class=\"info\">" . $row->t_time . " - Transfer " .$row->t_card_from . " -> " . $row->t_card_to . "</p>"; 
        echo "<p class=\"info\">" . "Користувач ". $row->t_name_from . " надіслав " . $row->t_amount . " мотивашок користувачу " . $row->t_name_to . "</p>";   
        }
    ?>
</aside>
<!-- Файл, який під'єднується для відображення на сторінці історії транзакцій акаунта -->