<?php
class View {
    private $pageTitle;
    private $controllerName;

    function __construct($controller, $viewName, $params = array()) {

        $this->controllerName = $controller;
        array_key_exists('pageTitle', $params) ?
            $this->pageTitle = htmlspecialchars($params['pageTitle']):
            $this->pageTitle = $this->controllerName;

        if($params != null) {
            foreach($params as $key => $value) {
                $this->$key = $value;
            }
        }

        $this->filePath = "views/". $this->controllerName . "/$viewName.php";

        // sidebar
        $categories = new CategoriesModel();
        $this->categories = $categories->get('category_id, name');
        $tags = new TagsModel();
        $this->tags = $tags->getMostPopularTags();
    }

    function renderView() {
        $name = DEFAULT_SIDEBAR;
        include("views/layouts/header.php");
        include("views/layouts/$name.php");
        $this->renderPartialView();

        include("views/layouts/footer.php");
    }

    function renderPartialView() {
        include($this->filePath);
    }

    function escapeAndPrint($str) {
        $escapedStr = htmlspecialchars($str);

        echo($escapedStr);
    }

    static function make($controller, $viewName, $params = array(), $isPartial = false) {

        $instance = new View($controller, $viewName, $params);

        if($isPartial) {
            return $instance->renderPartialView();
        }

        return $instance->renderView();
    }

    function makePagination($params = array()) {

        foreach($params as $key => $value) {
            $this->$key = $value;
        }

        include('views/layouts/pagination.php');
    }
}