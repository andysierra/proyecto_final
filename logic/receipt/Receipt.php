<?php
require_once 'persistent/Connection.php';
require_once 'persistent/receiptDAO/ReceiptDAO.php';

class Receipt
{
    private $idreceipt;
    private $status;
    private $purchase_order;
    private $conn;
    private $dao;
    
    public function __construct($idreceipt="", $status="", $purchase_order="") {
        $this->idreceipt = $idreceipt;
        $this->status = $status;
        $this->purchase_order = $purchase_order;
        $this->conn = new Conexion();
        $this->dao = new ContractDAO($idreceipt, $status, $purchase_order);
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
                array_push($returnTuples, new Receipt($data[0], $data[1], $data[2]));
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
                
                $this->idreceipt = $data[0];
        $this->status = $data[1];
        $this->purchase_order = $data[2];
            }
        }
        $this->conn->cerrar();
        return $returnBoolean;
    }
    
    public function advancedSearch() {
        
    }
    function getIdreceipt() {
        return $this->idreceipt;
    }

    function getStatus() {
        return $this->status;
    }

    function getPurchase_order() {
        return $this->purchase_order;
    }

    function getConn() {
        return $this->conn;
    }

    function getDao() {
        return $this->dao;
    }

    function setIdreceipt($idreceipt): void {
        $this->idreceipt = $idreceipt;
    }

    function setStatus($status): void {
        $this->status = $status;
    }

    function setPurchase_order($purchase_order): void {
        $this->purchase_order = $purchase_order;
    }

    function setConn($conn): void {
        $this->conn = $conn;
    }

    function setDao($dao): void {
        $this->dao = $dao;
    }


}