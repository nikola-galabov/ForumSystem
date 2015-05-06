<?php
class HomeController extends BaseController {

    function index() {
        $params = array('pageTitle' => 'neshto si', 'gyz'=>'gyz');
        View::make(__FUNCTION__, $params);
    }
}