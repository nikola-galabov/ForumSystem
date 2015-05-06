<?php

class UsersController extends BaseController {

    function register() {
        if($this->requestMethod == 'GET') {
            View::make(__FUNCTION__);
        } else {
            // TODO Registering...
            $this->redirectToUrl('/Home/index');
        }
    }

    function login() {
        if($this->requestMethod == 'GET') {
            View::make(__FUNCTION__);
        } else {
            // TODO login...
            $this->redirectToUrl('/Home/index');
        }
    }
}