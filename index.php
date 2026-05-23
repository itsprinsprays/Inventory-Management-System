<?php

session_start();

require_once "config/connection.php";
require_once "controller/ProductController.php";
require_once "controller/UserController.php";
require_once "controller/EmployeeController.php";
require_once "controller/AuthController.php";
require_once "config/role_guard.php";

$productController = new ProductController($conn);
$userController = new UserController($conn);
$employeeController = new EmployeeController($conn);
$authController = new AuthController($conn);

$action = $_GET['action'] ?? 'index';

switch ($action) {


    case 'login':

        $message = "";
        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            $credentials = [
                'username' => $_POST['username'],
                'password' => $_POST['password'] 
            ];

            $user = $authController->login($credentials);

            if($user) {
                header("Location: index.php?action=dashboard");
                exit();
            } else {
                $message = "Invalid username or password";
                header("Location: index.php?action=register");
            }
        }
        include "View/login.php";
        break;

    case 'register':
        
        requireRole('admin');
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
        
    case 'dashboard':
        
        include "View/Dashboard.php";
        break;

    case 'inventory':

        requireRole('admin', 'employee');
        include "View/Inventory.php";
        break;

    case 'archive':

        requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'];
            $productController->archiveProduct($product_id);
        }
        header("Location: index.php?action=inventory");
        exit();

    case 'logout':

        session_destroy();
        header("Location: index.php?action=login");
        exit();

    default:

        header("Location: index.php?action=login");
        exit();

}
