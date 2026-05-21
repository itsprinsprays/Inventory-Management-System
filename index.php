<?php

require_once "config/connect.php";
require_once "controller/ProductController.php";

$productController = new ProductController($conn);

$action = $_GET['action'] ?? 'product_index';

switch ($action) {

    // SHOW ALL PRODUCTS
    case 'product_index':
        $products = $productController->getAllProducts();
        include "view/product/index.php";
        break;

    // SHOW CREATE FORM + INSERT PRODUCT
    case 'product_create':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $productController->storeNewProduct($_POST);

            header("Location: index.php?action=product_index");
            exit;
        }

        include "view/product/create.php";
        break;

    // DELETE PRODUCT
    case 'product_delete':
        if (isset($_GET['id'])) {
            $productController->deleteProduct($_GET['id']);
        }

        header("Location: index.php?action=product_index");
        exit;

    // MINUS STOCK
    case 'product_minus':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $productController->minustock(
                $_POST['product_id'],
                $_POST['quantity']
            );

            header("Location: index.php?action=product_index");
            exit;
        }

        $products = $productController->getAllProducts();
        include "view/product/minus.php";
        break;

    default:
        echo "Home Page";
}