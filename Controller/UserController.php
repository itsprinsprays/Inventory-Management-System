<?php

require_once "Model/User.php";

class UserController {
    private $user;

    public function __construct($db) {
        $this->user = new User($db);
    }

    public function storeNewUser($data) {
        return $this->user->register(
            $data['username'],
            $data['password'],
            $data['role'],
            $data['employee_id']
        );
    }
}
?>