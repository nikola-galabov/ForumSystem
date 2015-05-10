<?php

class UsersController extends BaseController {

    function __construct() {
        parent::__construct('users');
    }

    function register() {

        if($this->requestMethod == 'GET') {
            $params = array(
                'user' => $this->user['username']
            );
            View::make($this->name, __FUNCTION__, $params);
        } else {
            $user = $_POST;
            try {
                $this->model->addUser($user);
            } catch(Exception $ex){
                $this->addErrorMessage($ex->getMessage());

                $this->redirect('users', 'register');
                return;
            }
            $this->addSuccessMessage("Successfully registered!");
            $this->login();
        }
    }

    function login() {
        if($this->requestMethod == 'GET') {
            $params = array(
                'user' => $this->user['username']
            );
            View::make($this->name, __FUNCTION__, $params);
        } else {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $id = $this->model->login($username, $password);
            if ($id != null) {
                $_SESSION['username'] = $username;
                $_SESSION['id'] = $id;
                $this->addSuccessMessage("Successful login!");
            }
            else {
                $this->addErrorMessage("Username or password is incorrect!");
                $this->redirect('users', 'login');
                return;
            }

            $this->redirect('questions', 'index');
        }
    }

    function logout() {
        unset($_SESSION['username']);
        unset($_SESSION['id']);
        $this->redirect('questions');
    }
}