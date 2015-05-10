<?php

class Database {

    private $dbObj;

    private function __construct()
    {
        $this->dbObj = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        $this->dbObj->set_charset("utf8");
    }

    public static function Instance()
    {
        static $inst = null;

        if ($inst === null) {
            $inst = new Database();
        }
        return $inst->dbObj;
    }
}