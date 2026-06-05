<h2>Лагеря</h2>
<table>
    <thead>
        <th>#</th>
        <th>Название лагеря</th>
    </thead>
    <tbody>
        <?php
        $showGothic = new App\Classes\DatabaseConnection;
        $statement = $showGothic->showAll('camps');
        if ($statement) {
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
        }
