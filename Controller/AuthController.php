<?php

require_once "Model/User.php";

class UserController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function login($credentials) {
        return $this->user->login(
            $credentials['username'],
            $credentials['password']
        );

        if ($user) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['role'] = $user['role'];
            return true;
        }
        return false;
    }



}

?>