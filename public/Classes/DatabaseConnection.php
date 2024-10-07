<?php

define('DB_SERVER', 'mariadb');
define('DB_USER', 'dobr');
define('DB_PASS', 'risenovsky');
define('DB_NAME', 'gothic');
class DatabaseConnection
{
    private $dbh;

    function __construct()
    {
        try {
            $dsn = 'mysql:host=' . DB_SERVER . ';dbname=' . DB_NAME;
            $this->dbh = new PDO($dsn, DB_USER, DB_PASS);
            $this->dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Ошибка подключения к базе данных: ' . $e->getMessage();
            exit;
        }
    }

    public function showAll()
    {
        switch ($_POST['table']) {
            case 'characters':
                $showQuery =  $this->dbh->prepare("SELECT * FROM characters 
                LEFT JOIN belongs ON characters.belong_id = belongs.id 
                LEFT JOIN jobs ON characters.job_id = jobs.id
                ORDER BY characters_name ASC");
                $showQuery->execute();
                return $showQuery;
                break;
            case 'weapons':
                $showQuery = $this->dbh->prepare("SELECT * FROM weapons");
                $showQuery->execute();
                return $showQuery;
                break;
            case 'camps':
                $showQuery = $this->dbh->prepare("SELECT * FROM belongs");
                $showQuery->execute();
                return $showQuery;
                break;
        }
    }

    public function showOne()
    {
        $characterid = $_GET['character_id'];
        $showOneQuery = $this->dbh->prepare("SELECT characters.*, belongs.name AS belong_name, jobs.name AS job_name, weapons.name AS weapon_name 
    FROM characters 
    LEFT JOIN belongs ON characters.belong_id = belongs.id 
    LEFT JOIN jobs ON characters.job_id = jobs.id 
    LEFT JOIN weapons ON characters.character_weapon_id = weapons.weapon_id 
    WHERE characters.character_id = :character_id");
        $showOneQuery->bindParam(':character_id', $characterid);
        $showOneQuery->execute();
        return $showOneQuery;
    }
    public function addUser()
    {
        $userName = $_POST['username'];
        $userPass = $_POST['password'];

        if (!preg_match('/[^a-zA-Z0-9_]/', $userName) && strlen($userName) >= 2) {
            $checkQuery = $this->dbh->prepare("SELECT * FROM users WHERE user_name = :username");
            $checkQuery->bindParam(':username', $userName);
            $checkQuery->execute();
            $result = $checkQuery->fetchAll();

            if (empty($result)) {
                $addUserQuery = $this->dbh->prepare("INSERT INTO users (user_name, user_pass) VALUES (:username, :password)");
                $addUserQuery->bindParam(':username', $userName);
                $addUserQuery->bindParam(':password', $userPass);
                $addUserQuery->execute();
                echo 'Пользователь успешно добавлен';
                return $addUserQuery->rowCount();
            } else {
                echo 'Пользователь с таким именем существует';
                return false;
            }
        } else {
            echo "Недопустимые символы в имени пользователя или короткое имя";
            return false;
        }
    }

    public function loginUser()
    {
        $userName = $_POST['username'];
        $userPass = $_POST['password'];

        $checkQuery = $this->dbh->prepare("SELECT * FROM users WHERE user_name = :username AND user_pass = :password");
        $checkQuery->bindParam(':username', $userName);
        $checkQuery->bindParam(':password', $userPass);
        $checkQuery->execute();
        $result = $checkQuery->fetchAll(PDO::FETCH_ASSOC);

        if (count($result) > 0) {
            $userData = $result[0];
            $session = new Session;
            $session->setUserData($userData);
            return true;
        } else {
            echo 'Неправильный логин или пароль';
            return false;
        }
    }
    // Другие методы класса DatabaseConnection
}
