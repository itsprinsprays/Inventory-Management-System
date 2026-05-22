<?php

class Employee {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

   public function addNewEmployee($name, $contact_number, $email, $address) {
        $stmt = $this->conn->prepare("INSERT INTO employee (employee_name, contact_number, email, address) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $contact_number, $email, $address]);
    }

    public function getAllEmployees() {
        $stmt = $this->conn->prepare("SELECT * FROM employee");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}