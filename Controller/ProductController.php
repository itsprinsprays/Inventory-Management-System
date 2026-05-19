<?php
require_once "Model/Product.php";


class ProductController {
    private $product;

    public function __construct($db) {
        $this->product = new Product($db);
    }

    public function store($data) {
        return $this->product->addProduct(
            $data['name'], 
            $data['description'], 
            $data['price'],
            $data['quantity']);
    }

    public function minustock($product_id, $quantity) {
        return $this->product->minustock($product_id, $quantity);
    }
    
}