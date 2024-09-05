<?php
$selectedTable = $_POST['table'] ?? 0; //добавил ноль чтобы не вылезал ворнинг
if (isset($_SESSION['login_success']) && $_SESSION['login_success']) {
    echo "Вы успешно вошли!";
    unset($_SESSION['login_success']);
}
?>

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
        <h1>Выбери таблицу</h1>
        <form method="post" action="/tables">
            <label for="tableSelect"></label>
            <select id="tableSelect" name="table">
                <option value="characters" <?php if ($selectedTable == 'characters') echo 'selected'; ?>>Персонажи</option>
                <option value="camps" <?php if ($selectedTable == 'camps') echo 'selected'; ?>>Лагеря</option>
                <option value="weapons" <?php if ($selectedTable == 'weapons') echo 'selected'; ?>>Оружие</option>
                <option value="enemys" <?php if ($selectedTable == 'enemys') echo 'selected'; ?>>Враги</option>
            </select>
            <input type="submit" name="submit" value="Выбрать">
        </form>
        <?php
        //подключаем классы мускли
        require_once __DIR__ . '/../classes/mysqliClasses.php';

        //проверяем на сабмит, если сабмит был, выводим таблицы
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
            //проверяем что было передано в посте и в зависимости от кейса метод обращается к нужной таблице

            switch ($selectedTable) {
                case 'characters':
                    require_once 'charactersTable.php';
                    break;
                case 'camps':
                    require_once 'campsTable.php';
                    break;
                case 'weapons':
                    require_once 'weaponsTable.php';
                    break;
            }
        ?>
            </tbody>
            </table>
            <br>
            <a href="/">На Главную</a>
    </div>
</body>

</html>
<pre>
<?php
print_r ($_SESSION);
print_r ($_POST);
        }
