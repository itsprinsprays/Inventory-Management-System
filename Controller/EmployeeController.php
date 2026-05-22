<?php

require_once "Model/Employee.php";

class EmployeeController {
    private $employee;

    public function __construct($db) {
        $this->employee = new Employee($db);
    }

    public function storeNewEmployee($data) {
        return $this->employee->addNewEmployee(
            $data['name'], 
            $data['contact_number'], 
            $data['email'], 
            $data['address']);
    }

    public function getAllEmployees() {
        return $this->employee->getAllEmployees();
    }
                      
}