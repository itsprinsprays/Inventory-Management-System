<?php

require_once "config/connect.php";
require_once "controller/ProductController.php";

$productController = new ProductController($conn);

$action = $_GET['action'] ?? 'product_index';

switch ($action) {

    // SHOW ALL PRODUCTS
    case 'shop':
        $products = $productController->getAllProducts();
        include "view/shop.php";
        break;

}

?>
