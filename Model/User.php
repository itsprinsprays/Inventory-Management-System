<?php

class User {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function employeeExists($employee_id) {
        $stmt = $this->conn->prepare("SELECT employee_id FROM employee WHERE employee_id = ?");
        $stmt->execute([$employee_id]);
        return $stmt->fetch() !== false;
    }

    public function register($Username, $Password, $Role, $Employee_id) {
        if (!$this->employeeExists($Employee_id)) {
            return 'invalid_employee';
        }

        $stmt = $this->conn->prepare("SELECT user_id FROM user WHERE employee_id = ?");
        $stmt->execute([$Employee_id]);
        if ($stmt->fetch()) {
            return 'already_registered';
        }

        $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO user (username, password, role, employee_id) VALUES (?,?,?,?)");
        
        try {
            $stmt->execute([$Username, $hashedPassword, $Role, $Employee_id]);
            return 'success';
        } catch (PDOException $e) {
            return 'error';
        }
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function getAllUser() {
        $stmt = $this->conn->prepare("SELECT * FROM user");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>