<?php
class QuestionsModel extends BaseModel {

    function __construct() {
        parent::__construct('questions');
    }

    function count($tag = null, $category = null){

        $statement = "Select COUNT(*) as count FROM questions";

        if($tag != null) {
            $statement .= " q JOIN `questions_has_tags` qht ON qht.question_id = q.question_id
                             JOIN `tags` t ON t.tag_id = qht.tag_id
                             WHERE t.tag_id = $tag";
        } elseif($category != null) {
            $statement .= " WHERE category_id = $category";
        }

        $query = $this->db->query($statement);
        $result = $this->process_results($query);

        return $result['0']['count'];
    }

    function getAll($page = 1, $tag = null, $category = null) {
        $from = $this->limit * ($page - 1);
        $query = "
             SELECT q.title, q.published, u.username as username, q.question_id,
                c.name as category, q.views, count(com.comment_id) comments
             FROM $this->table as q
             JOIN `users` u ON q.user_id = u.user_id
             JOIN `categories` c ON c.category_id = q.category_id
             left JOIN comments com on com.question_id = q.question_id
             ";


        if($tag != null){

            $query .= " JOIN `questions_has_tags` qht ON qht.question_id = q.question_id
                        JOIN `tags` t ON t.tag_id = qht.tag_id
                        WHERE q.isDeleted = 0 AND t.tag_id = $tag";
        } else {
            if($category != null) {
                $query .= " WHERE q.isDeleted = 0 AND c.category_id = $category";
            } else{
                $query .= " WHERE q.isDeleted = 0";
            }
        }

        $query .= " group by title ORDER BY `published` DESC, q.title ASC LIMIT $from, $this->limit";

        $statement = $this->db->query($query);

        //var_dump($this->db->error); die;
        //$statement->execute();

        //$result = $statement->get_result()->fetch_all();
        $result = $this->process_results($statement);
        //var_dump($result); die;

        return $result;
    }

    function find($id) {
        $query = $this->db->query("
            Select title, question_id, published, isRedacted, redacted, content, u.username as username, u.avatar as avatar, c.name as category
            from $this->table as q
            JOIN users u ON q.user_id = u.user_id
            JOIN categories c ON q.category_id = c.category_id
            WHERE q.isDeleted = 0 AND q.question_id = $id
        ");

//        $query->bind_param('s', $id);
//
//        $query->execute();
        $result = $this->process_results($query);

        $this->db->query("UPDATE questions SET views = views + 1  WHERE question_id = $id");


        return $result;
    }

    function getQuestionsByTag($tag, $page = 1) {
        $result = $this->getAll($page, $tag = $tag);
        return $result;
    }

    function getQuestionsByCategory($category, $page = 1) {
        $result = $this->getAll($page, $tag = null, $category);
        return $result;
    }

    function getCommentsForQuestion($id) {
        $query = $this->db->query("
            SELECT comment_id, isRedacted, text, username, avatar, published, redacted
            from comments c
            join users u on c.user_id = u.user_id
            where c.isDeleted = 0 and question_id = $id");


        $result = $this->process_results($query);
        return $result;
    }

    function createQuestion($question) {
        if($question['title'] == null || strlen($question['title']) < 10 && strlen($question['title']) > 200) {
            throw(new Exception("The title must be between 10 and 200 characters long!"));
        }

        if($question['content'] == null || strlen($question['content']) < 10) {
            throw(new Exception("The content must be at least 10 characters long!"));
        }

        if($question['category'] == null) {
            throw(new Exception("The category is required!"));
        }



        $query = $this->db->prepare("
            INSERT INTO $this->table
                (title, content, published, user_id, category_id)
            VALUES(?, ?, ?, ?, ?)");

        $dateCreated = date_format(date_create(), 'Y-m-d H:i:s');
        $query->bind_param('sssii', $question['title'], $question['content'], $dateCreated,$question['user_id'], $question['category']);
        $query->execute();
    }
}