<h2>Лагеря</h2>
<table>
    <thead>
        <th>#</th>
        <th>Название лагеря</th>
    </thead>
    <tbody>
        <?php
        $showGothic = new DatabaseConnection;
        //через шоу ол показываем другую табллицу кэмпс, 
        //не знаю как избавиться от двойного свич кейса здесь и в классах
        //может так оно и должно работать
        $statement = $showGothic->showAll();
        $cnt = 1;
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <tr>
                <td><?php echo $cnt; ?></td>
                <td><?php echo htmlspecialchars($row['belong_name']); ?></td>
            </tr>
        <?php
            $cnt++;
        }
