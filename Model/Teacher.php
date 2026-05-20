<?php

class Teacher {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

   public function addNewTeacher($name, $contact_number, $email, $address) {
        $stmt = $this->conn->prepare("INSERT INTO teacher (teacher_name, contact_number, email, address) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $contact_number, $email, $address]);
    }

    public function getAllTeachers() {
        $stmt = $this->conn->prepare("SELECT * FROM teacher");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}