<?php

class Employee {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

   public function addNewEmployee($name, $contact_number, $email, $address) {
        $stmt = $this->conn->prepare("INSERT INTO employee (`name`, contact_number, email, `address`) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $contact_number, $email, $address]);
    }

    public function getAllEmployees() {
        $stmt = $this->conn->prepare("SELECT * FROM employee");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteEmployee($employee_id) {
        $stmt = $this->conn->prepare("DELETE FROM user WHERE Employee_id = ?");
        $stmt->execute([$employee_id]);
        $stmt = $this->conn->prepare("DELETE from employee where Employee_id = ?");
        return $stmt->execute([$employee_id]);
    }

    public function updateEmployee($name, $contact_number, $email, $address, $employee_id) {
        $stmt = $this->conn->prepare("UPDATE employee SET `name`=?, contact_number=?, email=?, `address`=? WHERE Employee_id=?");
        return $stmt->execute([$name, $contact_number, $email, $address, $employee_id]);
    }

    public function getEmployeeById($employee_id) {
        $stmt = $this->conn->prepare("SELECT * FROM employee WHERE Employee_id = ?");
        $stmt->execute([$employee_id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}