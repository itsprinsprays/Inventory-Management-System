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

    $stmt = $this->conn->prepare("INSERT into product (product_id, product_name, description, stock_quantity)
        select product_id, product_name, description, stock_quantity from product_archive where product_id = ?");
    $stmt->execute([$product_id]);
    
    $stmt = $this->conn->prepare("DELETE from product_archive where product_id = ?");
    return $stmt->execute([$product_id]);
}

}

?>