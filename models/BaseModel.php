<?php

abstract class BaseModel {
    protected $db;

    function __construct() {
        $this->db = Database::Instance();

        $query = $this->db->query("SELECT * FROM `categories`");
        $result = $query->fetch_all();
        var_dump($result);
    }
}