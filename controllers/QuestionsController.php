<?php
class QuestionsController extends BaseController {
    private $currentPage;

    function __construct() {
        parent::__construct('');
        $this->model = new QuestionsModel();
    }

    function index($page = 1) {
        $this->currentPage = $page;
        var_dump($page);
        $params = array('pageTitle' => 'Forum system', 'questions' => $this->getQuestions($page), 'currentPage' => $this->currentPage);
        View::make(__FUNCTION__, $params);
    }

    private function getQuestions($page) {

        return $this->model->getAll($page);
    }
}
