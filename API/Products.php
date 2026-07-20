<?php

require_once "../Config/connection.php";
require_once "../Controller/ProductController.php";

$productController = new ProductController($conn);

header("Content-Type: application/json");

echo json_encode(
    $productController->getAllProducts()
);