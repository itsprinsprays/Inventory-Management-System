<?php

require_once "Model/User.php";

class AuthController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function login($credentials) {
        $user = $this->user->login(
            $credentials['username'],
            $credentials['password']
        );

        if ($user) {
            $_SESSION['user_id']  = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role']     = $user['role'];
            return $user;
        }
        return false;
    }
}
?>