<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addNewUser($Username, $Password, $Role, $Employee_id) {
        $stmt = $this->conn->prepare("Insert into User (username, password, role, employee_id) values (?,?,?,?)");
        return $stmt->execute([$Username, $Password, $Role, $Employee_id]);
    }
}



?>