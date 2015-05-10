<?php

class CommentsController extends BaseController {
    function __construct(){
        parent::__construct('comments');
    }

    function add() {


        if($this->requestMethod != "POST") {
            $this->addErrorMessage("This method is not allowed!");
            $this->redirect('questions');
            return;
        }

        $comment = $_POST;

        try {
            $this->model->createComment($comment);
            $this->addSuccessMessage('Comment successfully added.');
            $this->redirectToUrl('/questions/view/' . $comment['question_id']);
        } catch(Exception $ex) {
            $this->addErrorMessage($ex->getMessage());
        }
    }
}