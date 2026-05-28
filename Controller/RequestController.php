<?php

require_once "Model/Request.php";

class RequestController {
    private $request;

    public function __construct($db) {
        $this->request = new Request($db); 
    }

    public function storeNewRequest($data) {
        return $this->request->createRequest(
            $data['product_id'],
            $data['product_name'],
            $data['stock_quantity'],
            $data['employee_id']
        );
    }

    public function getAllRequest() {
        return $this->request->getAllRequest();
    }
}

?>