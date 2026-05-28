<?php

class Product {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addNewProduct($name, $description, $quantity) {
        $stmt = $this->conn->prepare("INSERT INTO product (product_name, description, stock_quantity) VALUES (?, ?, ?)");
        return $stmt->execute([$name, $description, $quantity]);
    }

    public function minustock($product_id, $quantity) {
        $stmt = $this->conn->prepare("UPDATE product SET stock_quantity = (stock_quantity - ?) WHERE product_id = ?");
        return $stmt->execute([$quantity, $product_id]);
    }

    public function restock($product_id, $quantity) {
        $stmt = $this->conn->prepare("UPDATE product SET stock_quantity = (stock_quantity + ?) WHERE product_id = ?");
        return $stmt->execute([$quantity, $product_id]);
    }

    public function getAllProducts() {
        $stmt = $this->conn->prepare("SELECT * FROM product");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getProductName($product_id) {
        $stmt = $this->conn->prepare("SELECT product_name FROM product WHERE product_id = ?");
        $stmt->execute([$product_id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['product_name'];
    }

    public function deleteProduct($product_id) {
        $stmt = $this->conn->prepare("Delete from product where product_id =?");
        return $stmt->execute([$product_id]);
    }

    public function quantityStatus($product_id) {
        $stmt = $this->conn->prepare("SELECT stock_quantity FROM product WHERE product_id = ?");
        $stmt->execute([$product_id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['stock_quantity'] : null;
    }

    public function countProducts() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM product");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['total'] : 0;
    }

    public function countCriticalStock() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM product WHERE stock_quantity < 10");
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['total'] : 0;
    }

    public function needRestocks() {
    $stmt = $this->conn->prepare("SELECT COUNT(*) as total FROM product WHERE stock_quantity < 20");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['total'] : 0;
    }
    
    public function archiveProduct($product_id) {
    $stmt = $this->conn->prepare("
        INSERT INTO product_archive (product_id, product_name, description, stock_quantity)
        SELECT product_id, product_name, description, stock_quantity
        FROM product
        WHERE product_id = ?
    ");
    $stmt->execute([$product_id]);

    $stmt = $this->conn->prepare("DELETE FROM product WHERE product_id = ?");
    return $stmt->execute([$product_id]);
}



}