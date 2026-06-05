<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['table'])) {
    $_SESSION['selected_table'] = $_POST['table'];
}

$selectedTable = $_POST['table'] ?? $_SESSION['selected_table'] ?? 0;

if (isset($_SESSION['login_success']) && $_SESSION['login_success']) {
    unset($_SESSION['login_success']);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gothic Tables</title>
    <link rel="stylesheet" href="/css/tablesPageStyle.css" type="text/css"> 
</head>

<body>
    <div class="container">
        <h1>Архивы Gothic</h1>
        
        <form method="post" action="/tables">
            <label for="tableSelect">Выберите раздел:</label>
            <select id="tableSelect" name="table">
                <option value="characters" <?php if ($selectedTable == 'characters') echo 'selected'; ?>>Персонажи</option>
                <option value="camps" <?php if ($selectedTable == 'camps') echo 'selected'; ?>>Лагеря</option>
                <option value="weapons" <?php if ($selectedTable == 'weapons') echo 'selected'; ?>>Оружие</option>
                <option value="enemys" <?php if ($selectedTable == 'enemys') echo 'selected'; ?>>Враги</option>
            </select>
            <input type="submit" name="submit" value="Показать">
        </form>

        <div class="table-wrapper">
            <?php
            if ($selectedTable && $selectedTable !== 0) {
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
            }
            ?>
        </div>

        <div class="footer-nav">
            <a href="/" class="back-link">← Вернуться в начало</a>
        </div>
    </div>
</body>

</html>