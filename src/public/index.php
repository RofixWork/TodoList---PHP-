<?php


use App\Application;
use App\Container;
use App\Controllers\TaskController;
use App\Router;

include __DIR__ . "/../vendor/autoload.php";

//PATH NAMES
const VIEW_PATH = __DIR__ . '/../views';

$dotenv = \Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();
$container = new Container();
$router = new Router($container);

$router->get('/', [TaskController::class, 'index'])
    ->get("/create", [TaskController::class, 'create'])
    ->post('/store', [TaskController::class, 'store'])
    ->get("/edit", [TaskController::class, 'edit'])
    ->post("/update", [TaskController::class, 'update'])
    ->get('/delete', [TaskController::class, 'delete']);

(new Application($router, [
    "uri" => $_SERVER['REQUEST_URI'],
    'method' => $_SERVER["REQUEST_METHOD"]
], new \App\Config([
    'host' => $_ENV['DB_HOST'],
    'username' => $_ENV['DB_USERNAME'],
    'password' => $_ENV['DB_PASSWORD'],
    'dbname' => $_ENV['DB_DATABASE'],
])))->run();