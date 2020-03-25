<?php

class TagDAO
{
    private $idtag;
    private $name;
    private $item;
    
    public function __construct($idtag="", $name="", $item="") {
        $this->idtag = $idtag;
        $this->name = $name;
        $this->item = $item;
    }
    
    public function insert() {
        return "INSERT INTO tag (name, item) "
        . "VALUES ('".$this->name."', '".$this->item."')";
    }
    
    public function simpleSearch($filter) {
        return "SELECT * FROM tag WHERE (idtag like '%".$filter."%') "
                . "OR (name like '%".$filter."%') "
                . "OR (item like '%".$filter."%') ";
    }
    
    public function retrieve() {
        return "SELECT * FROM tag WHERE idtag = '".$this->idtag."'";
    }
}