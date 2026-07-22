<?php

require_once "Model/Request.php";
require_once "Services/EmailService.php";

class RequestController {
    private $request;

    public function __construct($db) {
        $this->request = new Request($db); 
    }

  public function storeNewRequest($data) {

    $success = $this->request->createRequest(
        $data['product_id'],
        $data['product_name'],
        $data['stock_quantity'],
        $data['unit'],
        $data['employee_id']
    );

    if($success){

        $emailService = new EmailService();

        $emailService->sendRequestNotification(
            "princejediel.benitez@cvsu.edu.ph",               
            $_SESSION['username'],           
            $data['product_name'],
            $data['stock_quantity']
        );
    }

    return $success;
}

    public function getAllRequest() {
        return $this->request->getAllRequest();
    }
}
?>