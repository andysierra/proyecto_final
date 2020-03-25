<?php
require_once 'persistent/Connection.php';
require_once 'persistent/warehouseDAO/WarehouseDAO.php';

class Warehouse 
{
    private $idwarehouse;
    private $name;
    private $active;
    private $replenisher;
    private $conn;
    private $dao;
    
    public function __construct($idwarehouse="", $name="", $active="", $replenisher="") {
        $this->idwarehouse = $idwarehouse;
        $this->name = $name;
        $this->active = $active;
        $this->replenisher = $replenisher;
        $this->conn = new Conexion();
        $this->dao = new WarehouseDAO($idwarehouse, $name, $active, $replenisher);
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
                array_push($returnTuples, new Warehouse($data[0], $data[1], $data[2], $data[3]));
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
                
                $this->idwarehouse = $data[0];
        $this->name = $data[1];
        $this->active = $data[2];
        $this->replenisher = $data[3];
            }
        }
        $this->conn->cerrar();
        return $returnBoolean;
    }
    
    public function advancedSearch() {
        
    }
    function getIdwarehouse() {
        return $this->idwarehouse;
    }

    function getName() {
        return $this->name;
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

    function setIdwarehouse($idwarehouse): void {
        $this->idwarehouse = $idwarehouse;
    }

    function setName($name): void {
        $this->name = $name;
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