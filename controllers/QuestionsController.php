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
            'url' => '/questions/index/',
            'user' => $this->user['username']
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
            'questionTags' => $tags,
            'user' => $this->user['username']
        );

        View::make($this->name, __FUNCTION__, $params);
    }

    function tags($id, $page = 1){
        $questions = $this->model->getQuestionsByTag($id, $page);
        $params = array(
            'pageTitle' => 'Forum system',
            'questions' => $questions,
            'currentPage' => $this->currentPage,
            'url' => "/questions/tags/$id/",
            'count' => $this->model->count($id),
            'user' => $this->user
        );

        View::make('questions', 'index', $params);
    }

    function categories($id, $page = 1){
        $questions = $this->model->getQuestionsByCategory($id, $page);
        $params = array(
            'pageTitle' => 'Forum system',
            'questions' => $questions,
            'currentPage' => $this->currentPage,
            'url' => "/questions/categories/$id/",
            'count' => $this->model->count(null, $id),
            'user' => $this->user['username']
        );

        View::make('questions', 'index', $params);
    }

    function create() {
        if($this->user == null) {
            $this->addErrorMessage('You have to login in the system first!');
            $this->redirect('questions', 'index');
        }

        if($this->requestMethod == "GET") {
            $categories = new CategoriesModel();
            $categories = $categories->get('category_id, name');
            $params = array(
                'user' => $this->user['username'],
                'userId' => $this->user['id'],
                'categories' => $categories
            );

            View::make($this->name, __FUNCTION__, $params);
            return;
        } else {
            $question = $_POST;
            try {

                $this->model->createQuestion($question);
                $this->addSuccessMessage('Question successfully added!');
                $this->redirect('questions');

            } catch(exception $ex) {

                $this->addErrorMessage($ex->getMessage());
                $this->redirect('questions', 'create');
            }

        }

    }

}