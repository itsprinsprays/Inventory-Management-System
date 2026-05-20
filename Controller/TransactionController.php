<?php

require_once "Model/Transaction.php";


class TransactionController {
    private $transaction;

    public function __construct($db) {
        $this->transaction = new Transaction($db);
    }

    public function storeNewTransaction($data) {
        return $this->transaction->addNewTransaction(
            $data['product_name'], 
            $data['quantity'], 
            $data['stock_quantity']
        );
    }
}