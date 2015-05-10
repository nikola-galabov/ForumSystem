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
            throw new Exception('Username or email already exists!');
        }

        $insertStatement = $this->db->prepare(
            "INSERT INTO $this->table (username, password, email, firstName, lastName)
            VALUES (?, ?, ?, ?, ?)");

        $insertStatement->bind_param("sssss", $user['username'], $user['password'], $user['email'], $user['first-name'], $user['last-name']);

        $insertStatement->execute();
    }

    function login($username, $password) {
        $statement = $this->db->prepare("SELECT user_id, username, password FROM users WHERE username = ?");
        $statement->bind_param("s", $username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        if(password_verify($password, $result['password'])) {
            return $result['user_id'];
        }

        return false;
    }

}