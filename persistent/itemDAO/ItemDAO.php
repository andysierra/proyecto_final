<?php

class ItemDAO
{
    private $iditem;
    private $name;
    private $description;
    private $photo;
    private $warehouse;
    private $active;
    private $replenisher;
    
    public function __construct($iditem="", $name="", $description="", $photo="", $warehouse="", $active="", $replenisher="") {
        $this->iditem = $iditem;
        $this->name = $name;
        $this->description = $description;
        $this->photo = $photo;
        $this->warehouse = $warehouse;
        $this->active = $active;
        $this->replenisher = $replenisher;
    }
    
    public function insert() {
        return "INSERT INTO item (name, description, photo, warehouse, active, replenisher) "
        . "VALUES ('".$this->name."', '".$this->description."', "
                . "'".$this->photo."', '".$this->warehouse."', '".$this->active."', '".$this->replenisher."')";
    }
    
    public function simpleSearch($filter) {
        return "SELECT * FROM item WHERE (iditem like '%".$filter."%') "
                . "OR (name like '%".$filter."%') "
                . "OR (warehouse like '%".$filter."%') "
                . "OR (replenisher like '%".$filter."%') ";
    }
    
    public function retrieve() {
        return "SELECT * FROM item WHERE iditem = '".$this->iditem."'";
    }
}