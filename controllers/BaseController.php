<?php

abstract class BaseController {
    protected $requestMethod;
    protected $model;

    function __construct() {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
    }

    function redirect($controller, $action = "index") {
        $this->redirectToUrl("/{$controller}Controller/$action");
    }

    function redirectToUrl($url) {
        header('Location: ' . urldecode($url));
    }
}