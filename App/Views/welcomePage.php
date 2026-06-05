<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gothic Catalogue</title>
    <link rel="stylesheet" href="/css/style.css" type="text/css"> 
</head>

<body>
    <div class="content">
        <div class="nav-links">
            <?php if (isset($_SESSION['user_data'])): ?>
                <a href="/logout" class="btn btn-outline">Выйти</a>
            <?php else: ?>
                <a href="/autentification" class="btn btn-outline">Войти</a>
                <a href="/registration" class="btn">Регистрация</a>
            <?php endif; ?>
        </div>

        <div class="header">
            <h1>Приветствую тебя, путник!</h1>
        </div>
        
        <p>Ты попал в обитель знаний — каталог мира Gothic.</p>
        
        <div class="main-nav">
            <p>Исследуй архивы мира Gothic:</p>
            <a href="/tables" class="btn">Открыть таблицы</a>
        </div>

        <?php if (!isset($_SESSION['user_data'])): ?>
            <p style="margin-top: 2rem; font-size: 0.9rem; color: var(--text-muted);">
                Если ты обладаешь тайными знаниями, <a href="/registration">присоединяйся к нам</a>.
            </p>
        <?php endif; ?>
    </div>
</body>

</html>