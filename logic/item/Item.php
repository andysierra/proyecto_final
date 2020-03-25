<?php
require_once 'persistent/Connection.php';
require_once 'persistent/itemDAO/ItemDAO.php';

class Item 
{
    private $iditem;
    private $name;
    private $description;
    private $photo;
    private $warehouse;
    private $active;
    private $replenisher;
    
    private $conn;
    private $dao;
    
    public function __construct($iditem="", $name="", $description="", $photo="", $warehouse="", $active="", $replenisher="") {
        $this->iditem = $iditem;
        $this->name = $name;
        $this->description = $description;
        $this->photo = $photo;
        $this->warehouse = $warehouse;
        $this->active = $active;
        $this->replenisher = $replenisher;
        $this->conn = new Conexion();
        $this->dao = new ItemDAO($iditem, $name, $description, $photo, $warehouse, $active, $replenisher);
    }
    
    public function insert() {
        $returnValue = false;
        $this->conn->abrir();
        $this->conn->ejecutar($this->dao->insert());
        $returnValue = $this->conn->sentenciaEjecutada();
        $this->conn->cerrar();
        return $returnValue;
    }
    
    public function simpleSearch($filter) {
        $returnTuples = array();
        $this->conn->abrir();
        $this->conn->ejecutar($this->dao->simpleSearch($filter));
        if($this->conn->numFilas() > 0) {
            for($i=0; $i<$this->conn->numFilas(); $i++) {
                $data = $this->conn->extraer();
                array_push($returnTuples, new Item($data[0], $data[1], $data[2], $data[3], $data[4], $data[5], $data[6]));
            }
        }
        $this->conn->cerrar();
        return $returnTuples;
    }
    
    public function retrieve() {
        $returnBoolean = false;
        $this->conn->abrir();
        $this->conn->ejecutar($this->dao->retrieve());
        if($this->conn->numFilas() > 0) {
            for($i=0; $i<$this->conn->numFilas(); $i++) {
                $data = $this->conn->extraer();
                
                $this->iditem = $data[0];
        $this->name = $data[1];
        $this->description = $data[2];
        $this->photo = $data[3];
        $this->warehouse = $data[4];
        $this->active = $data[5];
        $this->replenisher = $data[6];
            }
        }
        $this->conn->cerrar();
        return $returnBoolean;
    }
    
    public function advancedSearch() {
        
    }
    function getIditem() {
        return $this->iditem;
    }

    function getName() {
        return $this->name;
    }

    function getDescription() {
        return $this->description;
    }

    function getPhoto() {
        return $this->photo;
    }

    function getWarehouse() {
        return $this->warehouse;
    }

    function getActive() {
        return $this->active;
    }

    function getReplenisher() {
        return $this->replenisher;
    }

    function getConn() {
        return $this->conn;
    }

    function getDao() {
        return $this->dao;
    }

    function setIditem($iditem): void {
        $this->iditem = $iditem;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function setDescription($description): void {
        $this->description = $description;
    }

    function setPhoto($photo): void {
        $this->photo = $photo;
    }

    function setWarehouse($warehouse): void {
        $this->warehouse = $warehouse;
    }

    function setActive($active): void {
        $this->active = $active;
    }

    function setReplenisher($replenisher): void {
        $this->replenisher = $replenisher;
    }

    function setConn($conn): void {
        $this->conn = $conn;
    }

    function setDao($dao): void {
        $this->dao = $dao;
    }


}