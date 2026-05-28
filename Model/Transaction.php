<?php

class Transaction {
    private $conn;

    public function __construct($db){
        $this->conn = $db;
    } 

  public function addNewTransaction($product_id, $product_name, $stock_quantity, $unit, $request_date, $employee_name, $employee_id, $status) {
    if ($status === 'confirmed') {
        $stmt = $this->conn->prepare("UPDATE product SET stock_quantity = (stock_quantity - ?) WHERE product_id = ?");
        $stmt->execute([$stock_quantity, $product_id]);
    }

    $stmt = $this->conn->prepare("INSERT INTO transaction (product_id, product_name, stock_quantity, unit, request_date, employee_name, employee_id, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    return $stmt->execute([$product_id, $product_name, $stock_quantity, $unit, $request_date, $employee_name, $employee_id, $status]);
}

    public function getAllTransaction() {
        $stmt = $this->conn->prepare("SELECT * from transaction ORDER BY confirmRequest DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteTransaction($request_id) {
        $stmt = $this->conn->prepare("DELETE from request where request_id = ?");
        return $stmt->execute([$request_id]);
     }
}