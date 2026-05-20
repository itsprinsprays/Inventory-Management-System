<?php

class Product {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addNewProduct($name, $description, $price, $quantity) {
        $stmt = $this->conn->prepare("INSERT INTO product (product_name, description, price, stock_quantity) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$name, $description, $price, $quantity]);
    }

    public function minustock($product_id, $quantity) {
        $stmt = $this->conn->prepare("UPDATE product SET stock_quantity = stock_quantity - ? WHERE product_id = ?");
        return $stmt->execute([$quantity, $product_id]);
    }

    public function restock($product_id, $quantity) {
        $stmt = $this->conn->prepare("UPDATE product SET stock_quantity = stock_quantity + ? WHERE product_id = ?");
        return $stmt->execute([$quantity, $product_id]);
    }

    public function getAllProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM product");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }



}