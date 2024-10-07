<h2>Персонажи</h2>
<table>
    <thead>
        <th>#</th>
        <th>Имя</th>
        <th>Уровень</th>
        <th>Лагерь</th>
        <th>Гильдия</th>
        <th>#</th>
    </thead>
    <tbody>
        <?php
        $showGothic = new DatabaseConnection;
        //метод Show all показывает все данные из таблицы charcters 
        //в дальнейшем метод будет показывать   и другие таблицы в зависимости от кейса
        $statement = $showGothic->showAll();
        $cnt = 1;
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr>
                <td><?php echo $cnt; ?></td>
                <td><?php echo htmlspecialchars($row['characters_name']); ?></td>
                <td><?php echo htmlspecialchars($row['level']); ?></td>
                <td><?php echo htmlspecialchars($row['belong_name']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><a href="/edit?character_id=<?= $row['character_id']; ?>">Подробнее</a></td>
            </tr>
        <?php
            $cnt++;
        }

