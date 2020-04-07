<?php

require('params.php');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/vendor/autoload.php';

use BugApp\Controllers\bugController;


$length = strlen(base_path);

$uri = substr($_SERVER['REQUEST_URI'], $length + 1);

$method = $_SERVER['REQUEST_METHOD'];

// var_dump($method);die;

switch (true) {

    // LIST OF ALL BUGS

    case preg_match('#^bug$#', $uri) && $method == 'GET':
        return (new bugController())->list();
        break;

    // LIST WITH FILTER

    case preg_match('#^bug(\?)#', $uri) && $method == 'GET':
        return (new bugController())->list();
        break;

    // SHOW 

    case preg_match('#^bug/(\d+)$#', $uri, $matches) && $method == 'GET':

        $id = $matches[1];

        return (new bugController())->show($id);

        break;

    // UPDATE

    case preg_match('#^bug/(\d+)$#', $uri, $matches) && $method == 'PATCH':
        $id = $matches[1];

        return (new bugController())->update($id);
        break;

    // ADD

    case preg_match('#^bug$#', $uri) && $method == 'POST':
        return (new bugController())->add();
        break;
    
    // CASE WITH ERROR (PAGE NOT FOUND)
    default:

        return (new bugController())->pageNotFound();
}
