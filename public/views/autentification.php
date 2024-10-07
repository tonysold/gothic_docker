<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gothic Autentification</title>
    <link rel="stylesheet" href="styles/registrationStyle.css">
</head>

<body>
    <div class="container">
        <div class="header">
            <h1>Кто ты, воин?</h1>
        </div>
        <form method="post" action="/autentification">
            <div class="form-group">
                <label for="username">Введитe имя</label>
                <input type="text" name="username">
                <br>
            </div>
            <div class="form-group">
                <label for="password">Введите пароль</label>
                <input type="password" name="password">
                <br>
            </div>
            <br>
    </div>
    <div class="btn-container">
        <input type="hidden" name="auth" value="true">
        <button type="submit" class="btn">Войти</button>
    </div>
    </form>
    </div>
    <?php
    if (isset($_POST['auth']) && $_POST['auth'] == true) {
        if (empty($_POST['username']) && empty($_POST['password'])) {
            echo 'Введите все данные';
        } else {
            $autentification = new DatabaseConnection;
            $autentification->loginUser();
        }
    }
    if (isset($autentification) && $autentification == true) {
        $_SESSION['login_success'] = true;
        header('Location: tables');
    }
    ?>
    <a href="/">На Главную</a>
</body>

</html>