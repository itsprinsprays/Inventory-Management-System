<?php

class Transaction {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    } 

    public function addNewTransaction($product_id, $product_name, $stock_quantity, $request_date, $employee_name, $employee_id) {

        $stmt = $this->conn->prepare("Update product set stock_quantity = (stock_quantity - ?) where product_id = ?");
        $stmt->execute([$stock_quantity, $product_id]);

        $stmt = $this->conn->prepare("INSERT INTO transaction (product_id, product_name, stock_quantity, request_date, employee_name, employee_id) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([$product_id, $product_name, $stock_quantity, $request_date, $employee_name, $employee_id]);
    }

    public function getAllTransaction() {
        $stmt = $this->conn->prepare("SELECT * from transaction");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}