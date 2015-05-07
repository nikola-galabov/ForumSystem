<?php

class UsersController extends BaseController {

    function __construct() {
        parent::__construct();
        $this->model = new UsersModel();
    }

    function register() {

        if($this->requestMethod == 'GET') {
            View::make(__FUNCTION__);
        } else {
            $user = $_POST;
            try {
                $this->model->addUser($user);
            } catch(Exception $ex){
                return $this->redirectToUrl('/users/register');
            }

            $this->redirectToUrl('/questions/index');
        }
    }

    function login() {
        if($this->requestMethod == 'GET') {
            View::make(__FUNCTION__);
        } else {
            // TODO login...
            $this->redirectToUrl('/questions/index');
        }
    }
}