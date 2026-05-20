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

}