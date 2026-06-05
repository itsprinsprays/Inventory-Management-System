<?php

require_once "Model/User.php";

class AuthController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function register($data) {
        $result = $this->user->register(
            $data['password'],
            $data['role'],
            $data['employee_id']
        );

        switch ($result) {
            case 'success':
                return ['status' => 'success', 'message' => 'User registered successfully.'];
            case 'invalid_employee':
                return ['status' => 'error', 'message' => 'Employee ID does not exist. Please enter a valid Employee ID.'];
            case 'already_registered':
                return ['status' => 'error', 'message' => 'This Employee ID is already linked to an existing user.'];
            default:
                return ['status' => 'error', 'message' => 'Registration failed. Please try again.'];
        }
    }

    public function updateRole($employee_id, $role) {
    return $this->userModel->updateRole($employee_id, $role);
}

    public function login($credentials) {
        $user = $this->user->login(
            $credentials['username'],
            $credentials['password']
        );

        if ($user) {
            $_SESSION['user_id']     = $user['user_id'];
            $_SESSION['username']    = $user['username'];
            $_SESSION['role']        = $user['role'];
            $_SESSION['employee_id'] = $user['Employee_id'];
            return $user;
        }
        return false;
    }
}
?>