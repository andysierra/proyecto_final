<?php
class ReplenisherDAO
{
    private $idreplenisher;
    private $fname;
    private $sname;
    private $email;
    private $password;
    private $phone;
    private $profilepic;
    private $active;
    
    public function __construct($idreplenisher="", $fname="", $sname="", $email="", $password="", $phone="", $profilepic="", $active="") {
        $this->idreplenisher = $idreplenisher;
        $this->fname = $fname;
        $this->sname = $sname;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->profilepic = $profilepic;
        $this->active = $active;
    }
    
    public function auth() {
        return "SELECT idreplenisher FROM replenisher WHERE email = '". $this->email."' "
                . "AND password = md5('". $this->password."')";
    }
    
    public function retrieve($byId) {
        return ($byId) ? "SELECT idreplenisher, fname, sname, email, phone, profilepic, active FROM replenisher "
                . "WHERE idreplenisher = '".$this->idreplenisher."'":
        "SELECT idreplenisher, fname, sname, email, phone, profilepic, active FROM replenisher "
                . "WHERE email = '". $this->email."' "
                . "AND password = md5('". $this->password."')";
    }
    
    public function signup() {
        return "INSERT INTO replenisher (fname, sname, email, password, phone, profilepic, active) VALUES ("
                . "'".$this->fname."', "
                . "'".$this->sname."', "
                . "'".$this->email."', "
                . "md5('".$this->password."'), "
                . "'".$this->phone."', "
                . "'".$this->profilepic."', "
                . "'1')";
    }
}