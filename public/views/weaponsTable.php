<h2>Оружие</h2>
<table>
    <thead>
        <th>Изображение</th>
        <th>Название</th>
        <th>Табличное<br>значение</th>
        <th>Описание</th>
        <th>Урон</th>
        <th>Тип<br>оружия</th>
    </thead>
    <tbody>
        <?php
        $showGothic = new DB_con;
        $sql = $showGothic->showAll();
        while ($row = mysqli_fetch_array($sql)) {
        ?>
            <tr>
                <td><img name="weapon_image" src="<?php echo $row['weapon_image']; ?>"></td>
                <td><?php echo htmlspecialchars($row['weapon_name']); ?></td>
                <td><?php echo htmlspecialchars($row['weapon_id']); ?></td>
                <td><?php echo htmlspecialchars($row['weapon_description']); ?></td>
                <td><?php echo htmlspecialchars($row['weapon_damage']); ?></td>
                <td><?php echo htmlspecialchars($row['weapon_type']); ?></td>
            </tr>
        <?php
        }
