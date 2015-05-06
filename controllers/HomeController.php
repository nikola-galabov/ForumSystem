<?php
class HomeController extends BaseController {

    function index() {
        $op = new UserModel();

        $params = array('pageTitle' => 'neshto si');
        View::make(__FUNCTION__, $params);
    }
}