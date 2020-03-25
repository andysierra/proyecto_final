<?php
require_once 'persistent/Connection.php';
require_once 'persistent/commodityDAO/CommodityDAO.php';

class Commodity 
{
    private $idcommodity;
    private $name;
    private $active;
    private $conn;
    private $dao;
    
    public function __construct($idcommodity="", $name="", $active="") {
        $this->idcommodity = $idcommodity;
        $this->name = $name;
        $this->active = $active;
        $this->conn = new Conexion();
        $this->dao = new CommodityDAO($idcommodity, $name, $active);
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
                array_push($returnTuples, new Commodity($data[0], $data[1], $data[2]));
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
                
                $this->idcommodity = $data[0];
                $this->name = $data[1];
                $this->active = $data[2];
            }
        }
        $this->conn->cerrar();
        return $returnBoolean;
    }
    
    public function advancedSearch() {
        
    }
    function getIdcommodity() {
        return $this->idcommodity;
    }

    function getName() {
        return $this->name;
    }

    function getActive() {
        return $this->active;
    }

    function getConn() {
        return $this->conn;
    }

    function getDao() {
        return $this->dao;
    }

    function setIdcommodity($idcommodity): void {
        $this->idcommodity = $idcommodity;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function setActive($active): void {
        $this->active = $active;
    }

    function setConn($conn): void {
        $this->conn = $conn;
    }

    function setDao($dao): void {
        $this->dao = $dao;
    }


}