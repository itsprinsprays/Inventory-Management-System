<?php

require_once "Model/User.php";

class UserController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function register($data) {
        $password    = trim($data['password']    ?? '');
        $role        = trim($data['role']        ?? '');
        $employee_id = trim($data['employee_id'] ?? '');

        $result = $this->user->register($password, $role, $employee_id); // ← was $this->userModel

        return match($result) {
            'success'            => ['status' => 'success', 'message' => 'User registered successfully.'],
            'invalid_employee'   => ['status' => 'error',   'message' => 'Employee ID not found.'],
            'no_email'           => ['status' => 'error',   'message' => 'No Gmail found for this Employee ID.'],
            'already_registered' => ['status' => 'error',   'message' => 'This Employee already has an account.'],
            default              => ['status' => 'error',   'message' => 'Registration failed.'],
        };
    }

    public function getAllUser() {
        return $this->user->getAllUser();
    }

    public function updateRole($employee_id, $role) {
        return $this->user->updateRole($employee_id, $role); // ← was $this->userModel
    }
}
?>