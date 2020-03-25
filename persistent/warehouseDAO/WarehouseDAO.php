<?php

class WarehouseDAO
{
    private $idwarehouse;
    private $name;
    private $active;
    private $replenisher;
    
    public function __construct($idwarehouse="", $name="", $active="", $replenisher="") {
        $this->idwarehouse = $idwarehouse;
        $this->name = $name;
        $this->active = $active;
        $this->replenisher = $replenisher;
    }
    
    public function insert() {
        return "INSERT INTO warehouse (name, active, replenisher) "
        . "VALUES ('".$this->name."', "
                . "'".$this->active."', '".$this->replenisher."')";
    }
    
    public function simpleSearch($filter) {
        return "SELECT * FROM warehouse WHERE (idwarehouse like '%".$filter."%') "
                . "OR (name like '%".$filter."%') "
                . "OR (replenisher like '%".$filter."%') ";
    }
    
    public function retrieve() {
        return "SELECT * FROM warehouse WHERE idwarehouse = '".$this->idwarehouse."'";
    }
}