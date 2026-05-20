<?php

require_once "Model/Teacher.php";

class TeacherController {
    private $teacher;

    public function __construct($db) {
        $this->teacher = new Teacher($db);
    }

    public function storeNewTeacher($data) {
        return $this->teacher->addNewTeacher(
            $data['name'], 
            $data['contact_number'], 
            $data['email'], 
            $data['address']);
    }

    public function getAllTeachers() {
        return $this->teacher->getAllTeachers();
    }
                      
}