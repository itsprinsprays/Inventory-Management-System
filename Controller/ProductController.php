<?php
require_once "Model/Product.php";


class ProductController {
    private $product;

    public function __construct($db) {
        $this->product = new Product($db);
    }

    public function storeNewProduct($data) {
        return $this->product->addNewProduct(
            $data['name'], 
            $data['description'], 
            $data['quantity']);
    }

    public function minustock($product_id, $quantity) {
        return $this->product->minustock($product_id, $quantity);
    }

    public function restock($product_id, $quantity) {
        return $this->product->restock($product_id, $quantity);
    }

    public function getAllProducts() {
        return $this->product->getAllProducts();
    }

    public function deleteProduct($product_id) {
        return $this->product->deleteProduct($product_id);
    }

    public function stockQuantity($product_id) {
        return $this->product->quantityStatus($product_id);
    }

    public function quantityStatus($product_id) {
    if($this->product->quantityStatus($product_id) !== null && $this->product->quantityStatus($product_id) < 10) {
        return "Critical";
    } else if($this->product->quantityStatus($product_id) !== null && $this->product->quantityStatus($product_id) < 20) {
        return "Low";
    } else if($this->product->quantityStatus($product_id) !== null && $this->product->quantityStatus($product_id) >= 20) {
        return "Good";
    } else {
        return "Unknown";
    }
    }   
}