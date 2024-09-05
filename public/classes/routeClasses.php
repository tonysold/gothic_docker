<?php

require_once __DIR__ . '/../classes/sessionClasses.php';

class Router
{
    private $routes = [];

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
}

$route = new Router;

$route->get('/', function() {
    require_once 'views/welcomePage.php';
});

$route->get('/tables', function() {
    require_once 'views/tablesPage.php';
});

$route->get('/registration', function(){
    require_once 'views/registrationPage.php';
});

$route->post('/registration', function(){
    require_once 'views/registrationPage.php';
});

$route->post('/tables', function() {
    require_once 'views/tablesPage.php';
});

$route->get('/edit', function() {
    require_once 'views/editPage.php';
});

$route->get('/autentification', function(){
    require_once 'views/autentification.php';
});

$route->post('/autentification', function(){
    require_once 'views/autentification.php';
});

$route->get('/logout', function() {
    $session = new Session();
    $session->logout();
    require_once 'views/welcomePage.php';
});

$route->handleRequest();