<?php

class Purchase_orderDAO
{
    private $idpurchase_order;
    private $status;
    private $requisition;
    private $supplier;
    
    public function __construct($idpurchase_order="", $status="", $requisition="", $supplier="") {
        $this->idpurchase_order = $idpurchase_order;
        $this->status = $status;
        $this->requisition = $requisition;
        $this->supplier = $supplier;
    }
    
    public function insert() {
        return "INSERT INTO purchase_order (status, requisition, supplier) "
        . "VALUES ('".$this->status."', '".$this->requisition."', "
                . "'".$this->supplier."')";
    }
    
    public function simpleSearch($filter) {
        return "SELECT * FROM purchase_order WHERE (idpurchase_order like '%".$filter."%') "
                . "OR (requisition like '%".$filter."%') "
                . "OR (supplier like '%".$filter."%') ";
    }
    
    public function retrieve() {
        return "SELECT * FROM purchase_order WHERE idpurchase_order = '".$this->idpurchase_order."'";
    }
    
    public function getCreator() {
        return "SELECT buyer FROM requisition_has_buyer WHERE requisition IN "
        . "(SELECT requisition FROM purchase_order WHERE idpurchase_order = '".$this->idpurchase_order."')";
    }
}