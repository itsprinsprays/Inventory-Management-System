<?php

class Request {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function createRequest($product_id, $product_name, $stock_quantity, $employee_id) {
        $stmt = $this->conn->prepare("INSERT INTO request (product_id, product_name, stock_quantity, employee_id) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$product_id, $product_name, $stock_quantity, $employee_id]);
    }
}

?>