<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($Username, $Password, $Role, $Employee_id) {

        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("Insert into user (username, password, role, employee_id) values (?,?,?,?)");
        return $stmt->execute([$Username, $hashedPassword, $Role, $Employee_id]);
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("Select * from user where username = ?");
        $stmt->execute([$username]);
        $user =  $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }
}



?>