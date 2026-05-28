<?php

require_once "Model/Transaction.php";

class TransactionController {
    private $transaction;

    public function __construct($db) {
        $this->transaction = new Transaction($db);
    }

   public function confirmRequest($data) {
    return $this->transaction->addNewTransaction(
        $data['product_id'],
        $data['product_name'],
        $data['stock_quantity'],
        $data['request_date'],
        $data['employee_name'],
        $data['employee_id'],
        $data['status']
    );
}

    public function getAllTransaction() {
        return $this->transaction->getAllTransaction();
    }

    public function deleteTransaction($request_id) {
        return $this->transaction->deleteTransaction($request_id);
    }

}