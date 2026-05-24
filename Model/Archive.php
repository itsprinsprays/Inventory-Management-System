<?php

class Archive {

private $conn;

public function __construct($db) {
    $this->conn = $db;
}

public function getProductArchive() {
    $stmt = $this->conn->prepare("Select * from product_archive");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}   

}

?>