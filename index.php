<?php

session_start();

require_once "config/connection.php";
require_once "controller/ProductController.php";
require_once "controller/UserController.php";
require_once "controller/EmployeeController.php";
require_once "controller/AuthController.php";

$productController = new ProductController($conn);
$userController = new UserController($conn);
$employeeController = new EmployeeController($conn);
$authController = new AuthController($conn);

$action = $_GET['action'] ?? 'index';

switch ($action) {

    case 'register':
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password'],
                'role' => $_POST['role'],
                'employee_id' => $_POST['employee_id']
            ];

            $message = $userController->storeNewUser($data) ? "User registered successfully" : "Failed to register user";
        }
        include "View/register.php";
        break;

    case 'login':
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $credentials = [
                'username' => $_POST['username'],
                'password' => $_POST['password']
            ];
            $user = $authController->login($credentials);

            if($authController->login($credentials)) {
                header("Location: index.php?action=product_index");
                exit();
            } else {
                $message = "Invalid username or password";
            }
        }
        include "view/login.php";
        break;
    
    default:
        header("Location: index.php?action=login");
        exit();

}

?>
