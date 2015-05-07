<?php

abstract class BaseModel {
    protected $db;
    protected $table;
    protected $limit;

    function __construct($table, $limit = PageSize) {
        $this->db = Database::Instance();
        $this->table = $table;
        $this->limit = $limit;
    }

//    function getAll($columns = "*", $conditions = array()) {
//        $query = "SELECT $columns FROM $this->table";
//    }
}