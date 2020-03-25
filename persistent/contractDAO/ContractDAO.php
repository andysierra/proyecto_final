<?php

class ContractDAO
{
    private $idcontract;
    private $name;
    private $policy;
    private $supplier;
    private $active;
    private $replenisher;
    
    public function __construct($idcontract="", $name="", $policy="", $supplier="", $active="", $replenisher="") {
        $this->idcontract = $idcontract;
        $this->name = $name;
        $this->policy = $policy;
        $this->supplier = $supplier;
        $this->active = $active;
        $this->replenisher = $replenisher;
    }
    
    public function insert() {
        return "INSERT INTO contract (name, policy, supplier, active, replenisher) "
        . "VALUES ('".$this->name."', '".$this->policy."', "
                . "'".$this->supplier."', '".$this->active."', '".$this->replenisher."')";
    }
    
    public function simpleSearch($filter) {
        return "SELECT * FROM contract WHERE (idcontract like '%".$filter."%') "
                . "OR (name like '%".$filter."%') "
                . "OR (supplier like '%".$filter."%') "
                . "OR (replenisher like '%".$filter."%') ";
    }
    
    public function retrieve() {
        return "SELECT * FROM contract WHERE idcontract = '".$this->idcontract."'";
    }
}