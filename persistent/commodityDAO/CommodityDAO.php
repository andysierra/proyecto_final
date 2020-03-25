<?php

class CommodityDAO
{
    private $idcommodity;
    private $name;
    private $active;
    
    public function __construct($idcommodity="", $name="", $active="") {
        $this->idcommodity = $idcommodity;
        $this->name = $name;
        $this->active = $active;
    }
    
    public function insert() {
        return "INSERT INTO commodity (name, active) VALUES ('".$this->name."','".$this->active."')";
    }
    
    public function simpleSearch($filter) {
        return "SELECT * FROM commodity WHERE (idcommodity like '%".$filter."%') "
                . "OR (name like '%".$filter."%') ";
    }
    
    public function retrieve() {
        return "SELECT * FROM commodity WHERE idcommodity = '".$this->idcommodity."'";
    }
}