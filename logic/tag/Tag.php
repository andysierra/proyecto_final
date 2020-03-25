<?php
require_once 'persistent/Connection.php';
require_once 'persistent/tagDAO/TagDAO.php';

class Tag 
{
    private $idtag;
    private $name;
    private $item;
    private $conn;
    private $dao;
    
    public function __construct($idtag="", $name="", $item="") {
        $this->idtag = $idtag;
        $this->name = $name;
        $this->item = $item;
        $this->conn = new Conexion();
        $this->dao = new ContractDAO($idtag, $name, $item);
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
                array_push($returnTuples, new Tag($data[0], $data[1], $data[2]));
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
                
                $this->idtag = $data[0];
        $this->name = $data[1];
        $this->item = $data[2];
            }
        }
        $this->conn->cerrar();
        return $returnBoolean;
    }
    
    public function advancedSearch() {
        
    }
    function getIdtag() {
        return $this->idtag;
    }

    function getName() {
        return $this->name;
    }

    function getItem() {
        return $this->item;
    }

    function getConn() {
        return $this->conn;
    }

    function getDao() {
        return $this->dao;
    }

    function setIdtag($idtag): void {
        $this->idtag = $idtag;
    }

    function setName($name): void {
        $this->name = $name;
    }

    function setItem($item): void {
        $this->item = $item;
    }

    function setConn($conn): void {
        $this->conn = $conn;
    }

    function setDao($dao): void {
        $this->dao = $dao;
    }


}