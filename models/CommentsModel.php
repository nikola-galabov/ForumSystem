<?php
class CommentsModel extends BaseModel {

    function __construct() {
        parent::__construct('comments');
    }

    function createComment($comment){

        if($comment['content'] == null || strlen($comment['content']) < 10) {
            throw(new Exception("The content must be at least 10 characters long!"));
        }

        $dateCreated = date_format(date_create(), 'Y-m-d H:i:s');
        $content = $comment['content'];
        $userId = $comment['user_id'];
        $questionId = $comment['question_id'];

        $query = $this->db->query("INSERT INTO `comments`(content, published, user_id, question_id) VALUES($content, $dateCreated, $userId, $questionId)");



        //$query->bind_param('ssii', $comment['content'], $dateCreated, $comment['user_id'], $comment['question_id']);

        //$query->execute();
    }
}