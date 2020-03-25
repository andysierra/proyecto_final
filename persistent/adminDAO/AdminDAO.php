<?php
class AdminDAO
{
    private $idadmin;
    private $fname;
    private $sname;
    private $email;
    private $password;
    private $phone;
    private $profilepic;
    private $active;
    
    public function __construct($idadmin="", $fname="", $sname="", $email="", $password="", $phone="", $profilepic="", $active="") {
        $this->idadmin = $idadmin;
        $this->fname = $fname;
        $this->sname = $sname;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->profilepic = $profilepic;
        $this->active = $active;
    }
    
    public function auth() {
        return "SELECT idadmin FROM admin WHERE email = '". $this->email."' "
                . "AND password = md5('". $this->password."')";
    }
    
    public function retrieve($byId) {
        return ($byId)? "SELECT idadmin, fname, sname, email, phone, profilepic, active FROM admin "
                . "WHERE idadmin = '".$this->idadmin."'" :
        "SELECT idadmin, fname, sname, email, phone, profilepic, active FROM admin "
                . "WHERE email = '". $this->email."' "
                . "AND password = md5('". $this->password."')";
    }
    
    public function signup() {
        return "INSERT INTO admin (fname, sname, email, password, phone, profilepic, active) VALUES ("
                . "'".$this->fname."', "
                . "'".$this->sname."', "
                . "'".$this->email."', "
                . "md5('".$this->password."'), "
                . "'".$this->phone."', "
                . "'".$this->profilepic."', "
                . "'1')";
    }
}