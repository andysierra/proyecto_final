<?php

class RequisitionDAO
{
    private $idrequisition;
    private $status;
    
    public function __construct($idrequisition="", $status="") {
        $this->idrequisition = $idrequisition;
        $this->status = $status;
    }
    
    public function insert() {
        return "INSERT INTO requisition (status) "
        . "VALUES ('".$this->status."')";
    }
    
    public function simpleSearch($filter) {
        return "SELECT * FROM requisition WHERE (idrequisition like '%".$filter."%') ";
    }
    
    public function retrieve() {
        return "SELECT * FROM requisition WHERE idrequisition = '".$this->idrequisition."'";
    }
    
    public function getCreator() {
        return "SELECT buyer FROM requisition_has_buyer "
        . "WHERE requisition = '".$this->idrequisition."' "
                . "AND role = 0";
    }
    
    public function getItems() {
        return "SELECT item FROM requisition_has_item "
        . "WHERE requisition = '".$this->idrequisition."'";
    }
    
    public function getTotal($idItem) {
        return "SELECT price FROM item_has_contract WHERE item = '".$idItem."'";
    }
}