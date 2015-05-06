<?php
session_start();

include('/config/appConfig.php');
include('/core/View.php');
$urlParts = preg_split('/\//', $_SERVER['REQUEST_URI'], 3, PREG_SPLIT_NO_EMPTY);

$controllerName = DEFAULT_CONTROLLER;
if(isset($urlParts[0])) {
    $controllerName = ucfirst($urlParts[0]) . 'Controller';
}

$action = DEFAULT_ACTION;
if(isset($urlParts[1])) {
    $action = $urlParts[1];
}

$params = array();
if(isset($urlParts[2])) {
    $params = explode('/', $urlParts[2]);
}

if(class_exists($controllerName)) {
    $controller = new $controllerName($controllerName);
} else {
    die('Controller with name ' . $controllerName . ' does not exist!');
}

if(method_exists($controller, $action)) {
    $controller->$action($params);
    die();
} else {
    die('Action with name ' . $action . ' does not exist in ' . $controllerName);
}

function __autoload($class_name) {
    if (file_exists('controllers/' . $class_name . '.php')) {
        include 'controllers/' . $class_name . '.php';
    }
    if (file_exists("models/$class_name.php")) {
        include "models/$class_name.php";
    }
}