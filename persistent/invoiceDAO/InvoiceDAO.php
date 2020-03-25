<?php

class InvoiceDAO
{
    private $idinvoice;
    private $status;
    private $receipt;
    private $supplier;
    
    public function __construct($idinvoice="", $status="", $receipt="", $supplier="") {
        $this->idinvoice = $idinvoice;
        $this->status = $status;
        $this->receipt = $receipt;
        $this->supplier = $supplier;
    }
    
    public function insert() {
        return "INSERT INTO invoice (status, receipt, supplier) "
        . "VALUES ('".$this->status."', '".$this->receipt."', "
                . "'".$this->supplier."')";
    }
    
    public function simpleSearch($filter) {
        return "SELECT * FROM invoice WHERE (idinvoice like '%".$filter."%') "
                . "OR (receipt like '%".$filter."%') "
                . "OR (supplier like '%".$filter."%') ";
    }
    
    public function retrieve() {
        return "SELECT * FROM invoice WHERE idonvoice = '".$this->idinvoice."'";
    }
}