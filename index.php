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
require_once "Controller/TransactionController.php";

$productController = new ProductController($conn);
$userController = new UserController($conn);
$employeeController = new EmployeeController($conn);
$authController = new AuthController($conn);
$archiveController = new ArchiveController($conn);
$requestController = new RequestController($conn);
$transactionController = new TransactionController($conn);

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
            }
        }

    include "View/login.php";
    break;

    case 'add-product':

        requireRole('admin');
        $message = "";
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['product_name'],
                'description' => $_POST['description'],
                'stock_quantity' => $_POST['stock_quantity'],
                'unit' => $_POST['unit']
            ];

         $message = $productController->storeNewProduct($data) ? "Product Added successfully" : "Failed to add product";

        }

        include "View/AddProductPage.php";

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
        break;

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
        break;

    case 'restock':
        
        requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $product_id = $_POST['product_id'] ?? null;
            $quantity   = $_POST['stock_quantity'] ?? 0;


            $result = $productController->restock($product_id, $quantity);

            if ($result) {
                header("Location: index.php?action=inventory&success=restocked");
                exit();
            } else {
                echo "Failed to restock product.";
            }
        } 
        break;

    case 'restock-page':

        requireRole('admin');
        include "View/RestockPage.php";
        break;

    case 'submit-request':
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'product_id'     => $_POST['product_id'],
                'product_name'   => $_POST['product_name'],
                'stock_quantity' => $_POST['stock_quantity'],
                'unit'           => $_POST['unit'],
                'employee_id'    => $_SESSION['employee_id'] // from session
            ];
            $requestController->storeNewRequest($data);
            }
            header("Location: index.php?action=dashboard");
        exit();
        break;


    case 'confirm-request':

        requireRole('admin');
        include "View/ConfirmRequest.php";
        break;

   case 'confirm-request-submit':
        requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'product_id'     => $_POST['product_id'],
                'product_name'   => $_POST['product_name'],
                'stock_quantity' => $_POST['stock_quantity'],
                'unit'           => $_POST['unit'] ?? null  ,
                'request_date'   => $_POST['request_date'],
                'employee_name'  => $_POST['employee_name'],
                'employee_id'    => $_POST['employee_id'],
                'status'         => 'confirmed'
            ];
            
            $transactionController->confirmRequest($data);

            $stmt = $conn->prepare("DELETE FROM request WHERE request_id = ?");
            $stmt->execute([$_POST['request_id']]);
        }
        header("Location: index.php?action=confirm-request");
        exit();
        break;

    case 'remove-request':
        requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'product_id'     => $_POST['product_id'],
                'product_name'   => $_POST['product_name'],
                'stock_quantity' => $_POST['stock_quantity'],
                'unit'           => $_POST['unit'],
                'request_date'   => $_POST['request_date'],
                'employee_name'  => $_POST['employee_name'],
                'employee_id'    => $_POST['employee_id'],
                'status'         => 'removed'
            ];
            $transactionController->confirmRequest($data);

            $stmt = $conn->prepare("DELETE FROM request WHERE request_id = ?");
            $stmt->execute([$_POST['request_id']]);
        }
        header("Location: index.php?action=confirm-request");
        exit();
        break;

    case 'transaction-history':

        requireRole('admin');
        include "View/TransactionHistory.php";
        break;

    case 'user-information':

        requireRole('admin');
        include "View/UserInformation.php";
        break;

    case 'delete-employee':
        requireRole('admin');
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $employee_id = $_POST['employee_id'];
            $employeeController->deleteEmployee($employee_id);
        }
        include "View/UserInformation.php";
        break;

    case 'add-employee':
        requireRole('admin');
        $message = "";
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name'           => trim($_POST['name'] ?? ''),
                'contact_number' => trim($_POST['contact_number'] ?? ''),
                'email'          => trim($_POST['email'] ?? ''),
                'address'        => trim($_POST['address'] ?? ''),
            ];
    
            if ($data['name'] && $data['contact_number'] && $data['email'] && $data['address']) {
                $result = $employeeController->storeNewEmployee($data);
                $message = $result ? "Employee added successfully." : "Failed to add employee.";
            } else {
                $message = "All fields are required.";
            }
        }
    
        include "View/AddEmployee.php";
        break;
    
    case 'edit-employee':
        requireRole('admin');
        $message = "";

        $employee_id = $_GET['employee_id'] ?? $_POST['Employee_id'] ?? null;
        //                                              ^ capital E

        if (!$employee_id) {
            header("Location: index.php?action=user-information");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'employee_id'    => trim($_POST['Employee_id'] ?? ''),
                'name'           => trim($_POST['name'] ?? ''),
                'contact_number' => trim($_POST['contact_number'] ?? ''),
                'email'          => trim($_POST['email'] ?? ''),
                'address'        => trim($_POST['address'] ?? ''),
            ];

            if ($data['name'] && $data['contact_number'] && $data['email'] && $data['address']) {
                $result = $employeeController->updateEmployee($data);
                $message = $result ? "Employee updated successfully." : "Failed to update employee.";
            } else {
                $message = "All fields are required.";
            }
        }

        $employee = $employeeController->getEmployeeById($employee_id);

        if (!$employee) {
            header("Location: index.php?action=user-information");
            exit;
        }

        include "View/EditEmployee.php";
        break;

    case 'logout':

        session_destroy();
        header("Location: index.php?action=login");
        exit();
        break;

    case 'import-xml':
    requireRole('admin');
    $message = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['xml_file'])) {
        $file  = $_FILES['xml_file']['tmp_name'];
        $table = $_POST['table'] ?? '';

        $dom = new DOMDocument("1.0", "UTF-8");
        $dom->load($file);

        switch ($table) {

            case 'product':
                foreach ($dom->getElementsByTagName("product") as $node) {
                    $data = [
                        'id'             => $node->getElementsByTagName("id")->item(0)?->nodeValue ?? null,
                        'name'           => $node->getElementsByTagName("product_name")->item(0)->nodeValue,
                        'description'    => $node->getElementsByTagName("description")->item(0)->nodeValue,
                        'stock_quantity' => $node->getElementsByTagName("stock_quantity")->item(0)->nodeValue,
                        'unit'           => $node->getElementsByTagName("unit")->item(0)->nodeValue,
                    ];
                    $productController->storeNewProduct($data);
                }
                $message = "Products imported successfully";
                break;

            case 'employee':
                foreach ($dom->getElementsByTagName("employee") as $node) {
                    $data = [
                        'id'             => $node->getElementsByTagName("id")->item(0)?->nodeValue ?? null,
                        'name'           => $node->getElementsByTagName("name")->item(0)->nodeValue,
                        'contact_number' => $node->getElementsByTagName("contact_number")->item(0)->nodeValue,
                        'email'          => $node->getElementsByTagName("email")->item(0)->nodeValue,
                        'address'        => $node->getElementsByTagName("address")->item(0)->nodeValue,
                    ];
                    $employeeController->storeNewEmployee($data);
                }
                $message = "Employees imported successfully";
                break;

        }
    }

    include "View/ImportXML.php";
    break;

    default:

        header("Location: index.php?action=login");
        exit();
        break;
}
