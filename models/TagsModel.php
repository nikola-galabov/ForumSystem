<?php
class TagsModel extends BaseModel {

    function __construct() {
        parent::__construct('tags');
    }

    function getMostPopularTags() {
        $query = $this->db->query("
            SELECT  t.name, Count(t.name) as frequence, t.tag_id FROM tags as t
            JOIN questions_has_tags qht ON qht.tag_id = t.tag_id
            WHERE t.isDeleted = 0
            group by t.name
            ORDER by frequence DESC
            LIMIT 50");

        $result = $this->process_results($query);

        return $result;
    }

    function getTagByQuestion($id) {
        $query = $this->db->query("
            SELECT  t.name, t.tag_id FROM tags as t
            JOIN questions_has_tags qht ON qht.tag_id = t.tag_id
            WHERE t.isDeleted = 0 AND qht.question_id = $id ");

        $result = $this->process_results($query);

        return $result;
    }
}