<?php

class Archive {

private $conn;

public function __construct($db) {
    $this->conn = $db;
}

public function getProductArchive() {
    $stmt = $this->conn->prepare("SELECT * from product_archive");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}   

public function activateProduct($product_id) {

    $stmt = $this->conn->prepare("UPDATE product SET is_archived = 1 WHERE product_id = ?");
    $stmt->execute([$product_id]);
    
    $stmt = $this->conn->prepare("DELETE from product_archive where product_id = ?");
    return $stmt->execute([$product_id]);
}

public function countArchive() {
    $stmt = $this->conn->prepare("SELECT COUNT(*) from product_archive");
    $stmt->execute();
    return $stmt->fetchColumn();
}

public function stockAverage() {
    $stmt = $this->conn->prepare("SELECT AVG(stock_quantity) from product_archive");
    $stmt->execute();
    return $stmt->fetchColumn();
}

}

?>