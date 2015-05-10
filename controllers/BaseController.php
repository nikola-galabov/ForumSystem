<?php

abstract class BaseController {
    protected $requestMethod;
    protected $model;
    protected $name;
    protected $currentPage;
    protected $user;

    function __construct($name) {
        $this->requestMethod = $_SERVER['REQUEST_METHOD'];
        $this->name = $name;
        $modelName = ucfirst($name) . 'Model';
        $this->model = new $modelName();
        $this->currentPage = 1;

        if(isset($_SESSION['username']) && isset($_SESSION['id'])){
            $this->user = array(
                'username' => $_SESSION['username'],
                'id' => $_SESSION['id']
            );
        }
    }

    private function addMessage($type, $message) {
        if (!isset($_SESSION['messages'])) {
            $_SESSION['messages'] = array();
        };

        array_push($_SESSION['messages'], array($type => $message));
    }

    function addErrorMessage($message) {
        $this->addMessage('danger', $message);
    }

    function addSuccessMessage($message) {
        $this->addMessage('success', $message);
    }

    function redirect($controller, $action = "index") {
        $this->redirectToUrl("/{$controller}/$action");
    }

    function redirectToUrl($url) {
        header('Location: ' . urldecode($url));
    }
}