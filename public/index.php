<?php
require "../vendor/autoload.php";
require "../config/config.php";

use TinyMVC\core\App;
use TinyMVC\core\Matcher;

$request = $_SERVER['REQUEST_URI'];
$routes = include '../app/routes.php';

$matcher = new Matcher($routes, $request);

$app = new App($matcher);
$response = $app->handle();

$response->send();