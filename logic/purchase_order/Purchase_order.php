<?php
require_once 'persistent/Connection.php';
require_once 'persistent/purchase_orderDAO/Purchase_orderDAO.php';

class Purchase_order 
{
    private $idpurchase_order;
    private $status;
    private $requisition;
    private $supplier;
    private $conn;
    private $dao;
    
    public function __construct($idpurchase_order="", $status="", $requisition="", $supplier="") {
        $this->idpurchase_order = $idpurchase_order;
        $this->status = $status;
        $this->requisition = $requisition;
        $this->supplier = $supplier;
        $this->conn = new Conexion();
        $this->dao = new Purchase_orderDAO($idpurchase_order, $status, $requisition, $supplier);
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
                array_push($returnTuples, new Purchase_order($data[0], $data[1], $data[2], $data[3]));
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
                
                $this->idpurchase_order = $data[0];
        $this->status = $data[1];
        $this->requisition = $data[2];
        $this->supplier = $data[3];
            }
        }
        $this->conn->cerrar();
        return $returnBoolean;
    }
    
    public function getCreator() {
        $creator = "";
        $this->conn->abrir();
        $this->conn->ejecutar($this->dao->getCreator());
        if($this->conn->numFilas() > 0) {
            $creator = $this->conn->extraer()[0];
        }
        $this->conn->cerrar();
        return $creator;
    }
    
    public function advancedSearch() {
        
    }
    function getIdpurchase_order() {
        return $this->idpurchase_order;
    }

    function getStatus() {
        return $this->status;
    }

    function getRequisition() {
        return $this->requisition;
    }

    function getSupplier() {
        return $this->supplier;
    }

    function getConn() {
        return $this->conn;
    }

    function getDao() {
        return $this->dao;
    }

    function setIdpurchase_order($idpurchase_order): void {
        $this->idpurchase_order = $idpurchase_order;
    }

    function setStatus($status): void {
        $this->status = $status;
    }

    function setRequisition($requisition): void {
        $this->requisition = $requisition;
    }

    function setSupplier($supplier): void {
        $this->supplier = $supplier;
    }

    function setConn($conn): void {
        $this->conn = $conn;
    }

    function setDao($dao): void {
        $this->dao = $dao;
    }


}