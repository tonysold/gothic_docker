<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

spl_autoload_register(function ($class) {
    $root = __DIR__ . '/Classes/';
    $ds = DIRECTORY_SEPARATOR;
    $filename = $root . str_replace('\\', $ds, $class) . '.php';
    if (file_exists($filename)) {
        require $filename;
    } else echo "Файл $filename не найден";
});

$obj = new Router;