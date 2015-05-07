<?php
class QuestionsModel extends BaseModel {

    function __construct() {
        parent::__construct('questions');
    }

    static function count(){
        $db = Database::Instance();
        $number = $db->query('Select COUNT(*) FROM questions');

        return $number->fetch_row()[0];
    }

    function getAll($page = 1) {
        $from = $this->limit * ($page - 1);
        $statement = $this->db->prepare(
            "SELECT title, published, u.username, question_id FROM $this->table as q
             JOIN `users` u ON q.user_id = u.user_id
             WHERE isDeleted = 0
             ORDER BY `published` DESC
             LIMIT $from, $this->limit"
        );

        $statement->execute();

        $result = $statement->get_result()->fetch_all();

        return $result;
    }
}