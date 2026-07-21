<?php

require_once "Model/Employee.php";

class EmployeeController {
    private $employee;

    public function __construct($db) {
        $this->employee = new Employee($db);
    }

   public function storeNewEmployee($data) {
    if ($this->employee->isDuplicate($data['email'], $data['contact_number'])) {
        return 'duplicate';
    }

    $success = $this->employee->addNewEmployee(
        $data['name'], 
        $data['contact_number'], 
        $data['email'], 
        $data['address']
    );

    return $success ? 'success' : 'error';
}

    public function getAllEmployees() {
        return $this->employee->getAllEmployees();
    }

    public function deleteEmployee($employee_id) {
        return $this->employee->deleteEmployee($employee_id);
    }

    public function updateEmployee($data) {
    return $this->employee->updateEmployee(
        $data['name'],
        $data['contact_number'],
        $data['email'],
        $data['address'],
        $data['employee_id']);  
}

    public function getEmployeeById($employee_id) {
        return $this->employee->getEmployeeById($employee_id);
    }
                      
}