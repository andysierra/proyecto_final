<?php

class ReceiptDAO
{
    private $idreceipt;
    private $status;
    private $purchase_order;
    
    public function __construct($idreceipt="", $status="", $purchase_order="") {
        $this->idreceipt = $idreceipt;
        $this->status = $status;
        $this->purchase_order = $purchase_order;
    }
    
    public function insert() {
        return "INSERT INTO receipt (status, purchase_order) "
        . "VALUES ('".$this->status."', '".$this->purchase_order."')";
    }
    
    public function simpleSearch($filter) {
        return "SELECT * FROM receipt WHERE (idreceipt like '%".$filter."%') "
                . "OR (purchase_order like '%".$filter."%') ";
    }
    
    public function retrieve() {
        return "SELECT * FROM receipt WHERE idreceipt = '".$this->idreceipt."'";
    }
}