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
            $data['stock_quantity'],
            $data['unit']);
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

 public function getProductName($product_id) {
    return $this->product->getProductName($product_id);
}

    public function deleteProduct($product_id) {
        return $this->product->deleteProduct($product_id);
    }

    public function stockQuantity($product_id) {
        return $this->product->quantityStatus($product_id);
    }

    public function getStatus($stock){
        if ($stock <= 0) return "EMPTY";
        if ($stock < 10)return "CRITICAL";
        if ($stock < 20) return "LOW";
        return "GOOD";
        } 

    public function countProducts() {
        return $this->product->countProducts();
    }

    public function countCriticalStock() {
        return $this->product->countCriticalStock();
    }

    public function needRestocks() {
        return $this->product->needRestocks();
    }

    public function archiveProduct($product_id) {
        return $this->product->archiveProduct($product_id);
    }

}