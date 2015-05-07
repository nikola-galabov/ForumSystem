<?php

class UsersModel extends BaseModel {
    function __construct() {
        parent::__construct('users');
    }

    function addUser($user) {

        if($user['password'] != $user['confirm-password']) {
            throw new Exception("Password doesn't match!");
        }

        $user['password'] = password_hash($user['password'], PASSWORD_BCRYPT);

        $statement = $this->db->prepare("SELECT COUNT(`user_id`) as users FROM $this->table WHERE `username` = ? OR `email` = ?");
        $statement->bind_param("ss", $user['username'], $user['email']);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        if($result['users'] > 0) {
            throw new Exception('There already exists a user with this username or email!');
        }

        $insertStatement = $this->db->prepare(
            "INSERT INTO $this->table (username, password, email, firstName, lastName)
            VALUES (?, ?, ?, ?, ?)");

        if ($insertStatement) {
        }
        else {
            printf("Errormessage: %s\n", $this->db->error);
            die;
        }
        $insertStatement->bind_param("sssss", $user['username'], $user['password'], $user['email'], $user['first-name'], $user['last-name']);

        $insertStatement->execute();
        $result = $insertStatement->error;
        var_dump($result);
        die;
    }
}