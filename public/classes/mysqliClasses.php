<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'dobr');
define('DB_PASS', 'risenovsky');
define('DB_NAME', 'gothic');
class DB_con
{
    public $dbh;
    function __construct()
    {
        $con = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->dbh = $con;
        // Check connection
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    }
    //Data show all Function
    public function showAll()
    {
        switch ($_POST['table']) {
            case 'characters':
                $showQuery = mysqli_query($this->dbh, "SELECT * FROM characters 
                LEFT JOIN belongs ON characters.belong_id = belongs.id 
                LEFT JOIN jobs ON characters.job_id = jobs.id
                ORDER BY characters_name ASC");
                return $showQuery;
                break;
            case 'weapons':
                $showQuery = mysqli_query($this->dbh, "SELECT * FROM weapons");
                return $showQuery;
                break;
            case 'camps':
                $showQuery = mysqli_query($this->dbh, "SELECT * FROM belongs");
                return $showQuery;
                break;
        }
    }
    //Data show one Function
    public function showOne()
    {
        //обозначаем что будем получать внешний id по гет параметру
        $characterid = $_GET['character_id'];
        $showOneQuery = mysqli_query($this->dbh, "SELECT * FROM characters 
        LEFT JOIN belongs ON characters.belong_id = belongs.id 
        LEFT JOIN jobs ON characters.job_id = jobs.id 
        LEFT JOIN weapons ON characters.character_weapon_id = weapon_id 
        WHERE character_id=$characterid");
        return $showOneQuery;
        // TODO: Добавить остальные таблицы через свитч кейс
    }

    //User Insertion Function
    public function addUser()
    {
        $userName = $_POST['username'];
        $userPass = $_POST['password'];

        if (!preg_match('/[^a-zA-Z0-9_]/', $userName) && strlen($userName) >= 2) {
            $checkQuery = mysqli_prepare($this->dbh, "SELECT * FROM users WHERE user_name=?");
            mysqli_stmt_bind_param($checkQuery, "s", $userName);
            mysqli_stmt_execute($checkQuery);
            $result = mysqli_stmt_get_result($checkQuery);
            if (mysqli_num_rows($result) > 0) {
                echo 'Пользователь с таким именем существует';
                return false;
            } else {
                //TODO: Добавить хэширование паролей
                $addUserQuery = mysqli_prepare($this->dbh, "INSERT INTO users(user_name, user_pass) values (?, ?)");
                mysqli_stmt_bind_param($addUserQuery, "ss", $userName, $userPass);
                mysqli_stmt_execute($addUserQuery);
                echo 'Пользователь успешно добавлен';
                return mysqli_stmt_affected_rows($addUserQuery);
            }
        } else {
            echo "Недопустимые символы в имени пользователя или короткое имя";
            return false;
        }
    }
    //Data one record read Function

    //Data updation Function

    //User login

    public function loginUser()
    {
        require_once __DIR__ . '/../classes/sessionClasses.php';
        $userName = $_POST['username'];
        $userPass = $_POST['password'];

        $checkQuery = mysqli_prepare($this->dbh, "SELECT * FROM users WHERE user_name=? AND user_pass=?");
        mysqli_stmt_bind_param($checkQuery, "ss", $userName, $userPass);
        mysqli_stmt_execute($checkQuery);
        $result = mysqli_stmt_get_result($checkQuery);

        if (mysqli_num_rows($result) > 0) {
            $userData = mysqli_fetch_assoc($result);
            echo "Пользователь с именем $userName найден";
            $session = new Session();
            $session->setUserData($userData);
            return true;
        } else {
            echo 'Неправильный логин или пароль';
            return false;
        }
    }
}
