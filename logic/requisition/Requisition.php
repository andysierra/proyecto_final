<?php
require_once 'persistent/Connection.php';
require_once 'logic/buyer/Buyer.php';
require_once 'logic/item/Item.php';
require_once 'persistent/requisitionDAO/RequisitionDAO.php';

class Requisition 
{
    private $idrequisition;
    private $status;
    private $conn;
    private $dao;
    
    public function __construct($idrequisition="", $status="") {
        $this->idrequisition = $idrequisition;
        $this->status = $status;
        $this->conn = new Conexion();
        $this->dao = new RequisitionDAO($idrequisition, $status);
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
                array_push($returnTuples, new Requisition($data[0], $data[1]));
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
                
                $this->idrequisition = $data[0];
        $this->status = $data[1];
            }
        }
        $this->conn->cerrar();
        return $returnBoolean;
    }
    
    public function getCreator() {
        $returnBuyer = null;
        $this->conn->abrir();
        $this->conn->ejecutar($this->dao->getCreator());
        if($this->conn->numFilas() == 1) {
            $returnBuyer = new Buyer($this->conn->extraer()[0], "", "", "", "", "", "", "", "");
            $returnBuyer->retrieve(true);
        }
        $this->conn->cerrar();
        return $returnBuyer;
    }
    
    public function getItems() {
        $returnItems = array();
        $this->conn->abrir();
        $this->conn->ejecutar($this->dao->getItems());
        if($this->conn->numFilas() > 0) {
            $currentItem = new Item($this->conn->extraer()[0], "", "", "", "", "", "");
            $currentItem->retrieve();
            array_push($returnItems, $currentItem);
        }
        $this->conn->cerrar();
        return $returnItems;
    }
    
    public function getTotal() {
        $total = 0;
        $items = $this->getItems();
        $this->conn->abrir();
        foreach ($items as $item) {
            $this->conn->ejecutar($this->dao->getTotal($item->getIditem()));
            $total += (int)$this->conn->extraer()[0];
        }
        $this->conn->cerrar();
        return $total;
    }
    
    public function advancedSearch() {
        
    }
    function getIdrequisition() {
        return $this->idrequisition;
    }

    function getStatus() {
        return $this->status;
    }

    function getConn() {
        return $this->conn;
    }

    function getDao() {
        return $this->dao;
    }

    function setIdrequisition($idrequisition): void {
        $this->idrequisition = $idrequisition;
    }

    function setStatus($status): void {
        $this->status = $status;
    }

    function setConn($conn): void {
        $this->conn = $conn;
    }

    function setDao($dao): void {
        $this->dao = $dao;
    }


}