<?php

class Transaction {
    private $conn;

    private function __construct($db){
        $this->conn = $db;
    } 

    public function addNewTransaction($product_name, $quantity, $stock_quantity) {
        $stmt = $this->conn->prepare("INSERT INTO transaction (product_name, quantity, stock_quantity) VALUES (?, ?, ?)");
        return $stmt->execute([$product_name, $quantity, $stock_quantity]);
    }
}