<?php

abstract class BaseModel {
    protected $db;
    protected $table;
    protected $limit;

    function __construct($table, $limit = PAGE_SIZE) {
        $this->db = Database::Instance();
        $this->table = $table;
        $this->limit = $limit;
    }

    function get($columns, $where = null, $offset = 0, $limit = PAGE_SIZE) {
        $query = "SELECT $columns FROM $this->table WHERE isDeleted = 0";
        if($where != null) {
            $query .= " AND $where";
        }

        $query .= " LIMIT $offset, $limit";

        $result_set =  $this->db->query($query);

        return $this->process_results($result_set);
    }

    protected function process_results( $result_set ) {
        $results = array();

        if( ! empty( $result_set ) && $result_set->num_rows > 0) {
            while($row = $result_set->fetch_assoc()) {
                $results[] = $row;
            }
        }

        return $results;
    }
}