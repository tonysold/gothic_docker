<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gothic Catalogue</title>
    <link rel="stylesheet" href="styles/styles.css">
</head>

<body>
    <div class="content">
        <div class="header">
            <h1>Приветствую тебя, путник!</h1>
        </div>
        <p>Ты попал на главную страницу каталога Gothic</p>
        <p>Можешь посмотреть <a href="/tables">таблицы</a></p>
        <p>Но если ты что-то знаешь, можешь зарегистрироваться</p>
        <?php
        if (isset($_SESSION['user_data'])) {
        ?>
        <div class="logout">
            <a href="/logout">Выйти</a>
        </div>
        <?php
        }
        else {
        ?>
    </div>
    <div class="registration">
        <a href="/registration">Зарегистрироваться</a>
    </div>
    <div class="autentification">
        <a href="/autentification">Войти</a>
    </div>
    <?php } ?>
</body>

</html>