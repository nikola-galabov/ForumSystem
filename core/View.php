<?php
class View {
    private $pageTitle;
    private $controllerName;

    function __construct($viewName, $params = array()) {

        $this->controllerName = $this->getControllerName();
        array_key_exists('pageTitle', $params) ?
            $this->pageTitle = htmlspecialchars($params['pageTitle']):
            $this->pageTitle = $this->controllerName;

        if($params != null) {
            foreach($params as $key => $value) {
                $this->$key = $value;
            }
        }


        $this->filePath = "/views/". $this->controllerName . "/$viewName.php";
    }

    function renderView() {
        include("/views/layouts/header.php");
        $this->renderPartialView();

        include("/views/layouts/footer.php");
    }

    function renderPartialView() {
        include($this->filePath);
    }

    function escapeAndPrint($str) {
        $escapedStr = htmlspecialchars($str);

        echo($escapedStr);
    }

    private function getControllerName() {
        //var_dump(debug_backtrace());
        $class = debug_backtrace()[3]['class'];
        $name = substr($class, 0, strlen($class) - 10);

        return $name;
    }

    static function make($viewName, $params = array(), $isPartial = false) {

        $instance = new View($viewName, $params);

        if($isPartial) {
            return $instance->renderPartialView();
        }

        return $instance->renderView();
    }
}