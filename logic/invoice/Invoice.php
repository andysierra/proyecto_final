<?php
require_once 'persistent/Connection.php';
require_once 'persistent/invoiceDAO/InvoiceDAO.php';

class Invoice 
{
    private $idinvoice;
    private $status;
    private $receipt;
    private $supplier;
    private $conn;
    private $dao;
    
    public function __construct($idinvoice="", $status="", $receipt="", $supplier="") {
        $this->idinvoice = $idinvoice;
        $this->status = $status;
        $this->receipt = $receipt;
        $this->supplier = $supplier;
        $this->conn = new Conexion();
        $this->dao = new InvoiceDAO($idinvoice, $status, $receipt, $supplier);
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
                array_push($returnTuples, new Invoice($data[0], $data[1], $data[2], $data[3]));
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
                
                $this->idinvoice = $data[0];
        $this->status = $data[1];
        $this->receipt = $data[2];
        $this->supplier = $data[3];
            }
        }
        $this->conn->cerrar();
        return $returnBoolean;
    }
    
    public function advancedSearch() {
        
    }
    function getIdinvoice() {
        return $this->idinvoice;
    }

    function getStatus() {
        return $this->status;
    }

    function getReceipt() {
        return $this->receipt;
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

    function setIdinvoice($idinvoice): void {
        $this->idinvoice = $idinvoice;
    }

    function setStatus($status): void {
        $this->status = $status;
    }

    function setReceipt($receipt): void {
        $this->receipt = $receipt;
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