<?php
require_once 'persistent/Connection.php';
require_once 'persistent/buyerDAO/BuyerDAO.php';

class Buyer 
{
    private $idbuyer;
    private $fname;
    private $sname;
    private $email;
    private $password;
    private $phone;
    private $spend_limit;
    private $profilepic;
    private $next_approver;
    private $active;
    private $conn;
    private $dao;
    
    public function __construct($idbuyer="", $fname="", $sname="", $email="", $password="", $phone="", $spend_limit="", $profilepic="", $next_approver="", $active="") {
        $this->idadmin = $idbuyer;
        $this->fname = $fname;
        $this->sname = $sname;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->spend_limit = $spend_limit;
        $this->profilepic = $profilepic;
        $this->next_approver = $next_approver;
        $this->active = $active;
        $this->conn = new Conexion();
        $this->dao = new BuyerDAO($idbuyer, $fname, $sname, $email, $password, $phone, $spend_limit, $profilepic, $next_approver, $active);
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
            $this->idbuyer = $data[0];
            $this->fname = $data[1];
            $this->sname = $data[2];
            $this->email = $data[3];
            $this->phone = $data[4];
            $this->spend_limit = $data[5];
            $this->profilepic = $data[6];
            $this->next_approver = $data[7];
            $this->active = $data[8];
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
    
    function getIdbuyer() {
        return $this->idbuyer;
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

    function getSpend_limit() {
        return $this->spend_limit;
    }

    function getProfilepic() {
        return $this->profilepic;
    }

    function getNext_approver() {
        return $this->next_approver;
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

    function setIdbuyer($idbuyer): void {
        $this->idbuyer = $idbuyer;
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

    function setSpend_limit($spend_limit): void {
        $this->spend_limit = $spend_limit;
    }

    function setProfilepic($profilepic): void {
        $this->profilepic = $profilepic;
    }

    function setNext_approver($next_approver): void {
        $this->next_approver = $next_approver;
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