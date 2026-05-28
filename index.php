<?php

session_start();

require_once "config/connection.php";
require_once "controller/ProductController.php";
require_once "controller/UserController.php";
require_once "controller/EmployeeController.php";
require_once "controller/AuthController.php";
require_once "controller/ArchiveController.php";
require_once "config/role_guard.php";
require_once "controller/RequestController.php";

$productController = new ProductController($conn);
$userController = new UserController($conn);
$employeeController = new EmployeeController($conn);
$authController = new AuthController($conn);
$archiveController = new ArchiveController($conn);
$requestController = new RequestController($conn);

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

    case 'register-ui':

        include "View/register.php";
        break;

    case 'registerPage':

        requireRole('admin');
        header("Location: index.php?action=register-ui");
        break;
        
    case 'dashboard':
        
        include "View/Dashboard.php";
        break;

    case 'request-Page':
        
        include "View/RequestPage.php";
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

    case 'restock':

        requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $product_id = $_POST['product_id'];
            $quantity = $_POST['stock_quantity'];
            $productController->restock($product_id, $quantity);
        }

    case 'archive-ui':
    
        include "View/ArchivePage.php";
        break;

    case 'archived':
        requireRole('admin');
        header("Location: index.php?action=archive-ui");
        break;

    case 'activateProduct':
        requireRole('admin');

        if($_SERVER['REQUEST_METHOD'] === "POST") {
            $product_id = $_POST['product_id'];
            $archiveController->activateProduct($product_id);
        }

        header("Location: index.php?action=archive-ui");
        exit;

    case 'submit-request':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'product_id'     => $_POST['product_id'],
                'product_name'   => $_POST['product_name'],
                'stock_quantity' => $_POST['stock_quantity'],
                'employee_id'    => $_SESSION['employee_id'] // from session
            ];
            $requestController->storeNewRequest($data);
            }
            header("Location: index.php?action=dashboard");
        exit();
        break;

    case 'request-tracking':

        requireRole('admin');
        include "View/RequestTracking.php";
        break;

    case 'logout':

        session_destroy();
        header("Location: index.php?action=login");
        exit();

    default:

        header("Location: index.php?action=login");
        exit();

}
