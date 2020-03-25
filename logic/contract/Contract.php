<?php
require_once 'persistent/Connection.php';
require_once 'persistent/contractDAO/ContractDAO.php';

class Contract 
{
    private $idcontract;
    private $name;
    private $policy;
    private $supplier;
    private $active;
    private $replenisher;
    private $conn;
    private $dao;
    
    public function __construct($idcontract="", $name="", $policy="", $supplier="", $active="", $replenisher="") {
        $this->idcontract = $idcontract;
        $this->name = $name;
        $this->policy = $policy;
        $this->supplier = $supplier;
        $this->active = $active;
        $this->replenisher = $replenisher;
        $this->conn = new Conexion();
        $this->dao = new ContractDAO($idcontract, $name, $policy, $supplier, $active, $replenisher);
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
                array_push($returnTuples, new Contract($data[0], $data[1], $data[2], $data[3], $data[4], $data[5]));
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
                
                $this->idcontract = $data[0];
        $this->name = $data[1];
        $this->policy = $data[2];
        $this->supplier = $data[3];
        $this->active = $data[4];
        $this->replenisher = $data[5];
            }
        }
        $this->conn->cerrar();
        return $returnBoolean;
    }
    
    public function advancedSearch() {
        
    }
    function getIdcontract() {
        return $this->idcontract;
    }

    function getName() {
        return $this->name;
    }

    function getPolicy() {
        return $this->policy;
    }

    function getSupplier() {
        return $this->supplier;
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

    function setIdcontract($idcontract): void {
        $this->idcontract = $idcontract;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function setPolicy($policy): void {
        $this->policy = $policy;
    }

    function setSupplier($supplier): void {
        $this->supplier = $supplier;
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