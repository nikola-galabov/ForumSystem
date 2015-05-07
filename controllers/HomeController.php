<?php
class HomeController extends BaseController {

    function index() {
        $params = array('pageTitle' => 'neshto si');
        View::make(__FUNCTION__, $params);
    }
}