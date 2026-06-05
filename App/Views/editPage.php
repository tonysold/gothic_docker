<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gothic Tables</title>
    <link rel="stylesheet" href="/css/tablesPageStyle.css">
</head>

<body>
    <div class="container">
        <h1>Сведения о персонаже</h1>
        
        <?php
        if (isset($_GET['character_id'])) {
            $showOneGothic = new \App\Classes\DatabaseConnection;
            $statement = $showOneGothic->showOne();
            if ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
        ?>
            <div class="profile-card">
                <div class="profile-image-container">
                    <img src="<?php echo $row['character_image']; ?>" alt="<?php echo htmlspecialchars($row['characters_name']); ?>">
                </div>
                
                <div class="profile-info">
                    <div class="profile-header">
                        <h2><?php echo htmlspecialchars($row['characters_name']); ?></h2>
                    </div>

                    <div class="profile-stats">
                        <div class="stat-item">
                            <span class="stat-label">ID</span>
                            <span class="stat-value">#<?php echo htmlspecialchars($row['character_id']); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Уровень</span>
                            <span class="stat-value"><?php echo htmlspecialchars($row['level']); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Лагерь</span>
                            <span class="stat-value"><?php echo htmlspecialchars($row['belong_name']); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Гильдия</span>
                            <span class="stat-value"><?php echo htmlspecialchars($row['name']); ?></span>
                        </div>
                        <div class="stat-item">
                            <span class="stat-label">Оружие</span>
                            <span class="stat-value"><?php echo htmlspecialchars($row['weapon_name'] ?: 'Нет данных'); ?></span>
                        </div>
                    </div>

                    <div class="profile-description">
                        <strong>Описание:</strong><br>
                        <?php echo nl2br(htmlspecialchars($row['characters_description'])); ?>
                    </div>
                </div>
            </div>
        <?php
            } else {
                echo "<p style='text-align:center;'>Персонаж не найден.</p>";
            }
        }
        ?>

        <div class="footer-nav">
            <a href="/tables" class="back-link">← Вернуться к таблицам</a>
        </div>
    </div>
</body>
</html>
