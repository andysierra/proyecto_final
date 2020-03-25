<?php
require_once 'persistent/Connection.php';
require_once 'persistent/supplierDAO/SupplierDAO.php';

class Supplier
{
    private $idsupplier;
    private $fname;
    private $sname;
    private $email;
    private $password;
    private $phone;
    private $profilepic;
    private $commercial_name;
    private $active;
    private $conn;
    private $dao;
    
    public function __construct($idsupplier="", $fname="", $sname="", $email="", $password="", $phone="", $profilepic="", $commercial_name="", $active="") {
        $this->idsupplier = $idsupplier;
        $this->fname = $fname;
        $this->sname = $sname;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->profilepic = $profilepic;
        $this->commercial_name = $commercial_name;
        $this->active = $active;
        $this->conn = new Conexion();
        $this->dao = new SupplierDAO($idsupplier, $fname, $sname, $email, $password, $phone, $profilepic, $commercial_name, $active);                
    }
    
    public function auth() {
        $returnBoolean = false;
        $this->conn->abrir();
        $this->conn->ejecutar($this->dao->auth());
        $returnBoolean = ($this->conn->numFilas()==1);
        $this->conn->cerrar();
        return $returnBoolean;
    }
    
    public function retrieve($byId) {
        $returnBoolean = false;
        $this->conn->abrir();
        $this->conn->ejecutar($this->dao->retrieve($byId));
        if($this->conn->numFilas()==1) {
            $data = $this->conn->extraer();
            $this->idsupplier = $data[0];
            $this->fname = $data[1];
            $this->sname = $data[2];
            $this->email = $data[3];
            $this->phone = $data[4];
            $this->profilepic = $data[5];
            $this->commercial_name =$data[6];
            $this->active = $data[7];
            $returnBoolean = true;
        }
        $this->conn->cerrar();
        return $returnBoolean;
    }
    
    public function signup() {
        $returnBoolean = false;
        $this->conn->abrir();
        $this->conn->ejecutar($this->dao->signup());
        $returnBoolean = ($this->conn->sentenciaEjecutada());
        $this->conn->cerrar();
        return $returnBoolean;
    }
    
    function getIdsupplier() {
        return $this->idsupplier;
    }

    function getFname() {
        return $this->fname;
    }

    function getSname() {
        return $this->sname;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function getPhone() {
        return $this->phone;
    }

    function getProfilepic() {
        return $this->profilepic;
    }

    function getCommercial_name() {
        return $this->commercial_name;
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

    function setIdsupplier($idsupplier): void {
        $this->idsupplier = $idsupplier;
    }

    function setFname($fname): void {
        $this->fname = $fname;
    }

    function setSname($sname): void {
        $this->sname = $sname;
    }

    function setEmail($email): void {
        $this->email = $email;
    }

    function setPassword($password): void {
        $this->password = $password;
    }

    function setPhone($phone): void {
        $this->phone = $phone;
    }

    function setProfilepic($profilepic): void {
        $this->profilepic = $profilepic;
    }

    function setCommercial_name($commercial_name): void {
        $this->commercial_name = $commercial_name;
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