<?php
class QuestionsController extends BaseController {

    function __construct() {
        parent::__construct('questions');
    }

    function index($page = 1) {
        $this->currentPage = $page;
        $questions =  $this->model->getAll($page);

        $params = array(
            'pageTitle' => 'Forum system',
            'questions' => $questions,
            'count' => $this->model->count(),
            'currentPage' => $this->currentPage,
            'url' => '/questions/index/'
        );

        View::make($this->name, 'index', $params);
    }

    function view($id) {

        $question = $this->model->find($id);
        $tags = new TagsModel();
        $tags = $tags->getTagByQuestion($id);

        $params = array(
            'question' => $question[0],
            'comments' => $this->model->getCommentsForQuestion($id),
            'questionTags' => $tags
        );

        View::make($this->name, __FUNCTION__, $params);
    }

    function tags($id, $page = 1){
        $questions = $this->model->getQuestionsByTag($id, $page);
        $params = array(
            'pageTitle' => 'Forum system',
            'questions' => $questions,
            'currentPage' => $this->currentPage,
            'url' => "/questions/tags/$id/"
        );

        View::make('questions', 'index', $params);
    }

}