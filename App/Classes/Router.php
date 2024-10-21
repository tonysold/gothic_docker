<?php
namespace App\Classes;
class Router
{
    private $routes = [];

    public function __construct()
    {
        $this->get('/', function() {
            require_once __DIR__ . '/../Views/welcomePage.php';
        });

        $this->get('/tables', function() {
            require_once __DIR__ . '/../Views/tablesPage.php';
        });

        $this->get('/registration', function(){
            require_once __DIR__ . '/../Views/registrationPage.php';
        });

        $this->post('/registration', function(){
            require_once __DIR__ . '/../Views/registrationPage.php';
        });

        $this->post('/tables', function() {
            require_once __DIR__ . '/../Views/tablesPage.php';
        });

        $this->get('/edit', function() {
            require_once __DIR__ . '/../Views/editPage.php';
        });

        $this->get('/autentification', function(){
            require_once __DIR__ . '/../Views/autentification.php';
        });

        $this->post('/autentification', function(){
            require_once __DIR__ . '/../Views/autentification.php';
        });

        $this->get('/logout', function() {
            $session = new Session();
            $session->logout();
            require_once __DIR__ . '/../Views/welcomePage.php';
        });
    }

    public function addRoute($method, $url, $callback)
    {
        $method = strtoupper($method);
        $this->routes[$method][$url] = $callback;
    }

    public function get($url, $callback)
    {
        $this->addRoute('GET', $url, $callback);
    }


    public function post($url, $callback)
    {
        $this->addRoute('POST', $url, $callback);
    }

    public function handleRequest()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

        if (isset($this->routes[$method][$url])) {
            call_user_func($this->routes[$method][$url]);
        } else {
            $this->notFound();
        }
    }

    private function notFound()
    {
        http_response_code(404);
        echo "Page not found";
    }

    public function run()
    {
        $this->handleRequest();
    }
}