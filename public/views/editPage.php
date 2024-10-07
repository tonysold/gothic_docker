<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gothic Tables</title>
    <link rel="stylesheet" href="styles/tablesPageStyle.css">
</head>

<body>
    <div class="container">
        <h2>Персонаж</h2>
        <p>Страничка показывает более подробное описание элементов таблицы</p>
        <table>
            <thead>
                <th>Изображение</th>
                <th>Имя</th>
                <th>Табличный<br>номер</th>
                <th>Уровень</th>
                <th>Лагерь</th>
                <th>Гильдия</th>
                <th>Описание</th>
                <th>Оружие</th>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['character_id'])) {
                    $showOneGothic = new DatabaseConnection;
                    $statement = $showOneGothic->showOne();
                    while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
                ?>
                        <tr>
                            <td><img name="character_image" src="<?php echo $row['character_image']; ?>"></td>
                            <td><?php echo htmlspecialchars($row['characters_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['character_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['level']); ?></td>
                            <td><?php echo htmlspecialchars($row['belong_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['characters_description']); ?></td>
                            <td><?php echo htmlspecialchars($row['weapon_name']); ?></td>
                        </tr>
            </tbody>
        </table>
        <!-- TODO: Добавить возвращение с пост параметром выбранной таблицы (вероятнее всего через сессию) -->
        <br>
        <a href="/tables">Вернуться к таблицам</a>
    </div>
</body>
<?php
                    }
                }
?>