<?php

class SupplierDAO
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
    }
    
    public function auth() {
        return "SELECT idsupplier FROM supplier WHERE email = '". $this->email."' "
                . "AND password = md5('". $this->password."')";
    }
    
    public function retrieve($byId) {
        return ($byId) ? "SELECT idsupplier, fname, sname, email, phone, profilepic, commercial_name, active FROM supplier "
                . "WHERE idsupplier = '".$this->idsupplier."'" :
        "SELECT idsupplier, fname, sname, email, phone, profilepic, commercial_name, active FROM supplier "
                . "WHERE email = '". $this->email."' "
                . "AND password = md5('". $this->password."')";
    }
    
    public function signup() {
        return "INSERT INTO supplier (fname, sname, email, password, phone, profilepic, commercial_name, active) VALUES ("
                . "'".$this->fname."', "
                . "'".$this->sname."', "
                . "'".$this->email."', "
                . "md5('".$this->password."'), "
                . "'".$this->phone."', "
                . "'".$this->profilepic."', "
                . "'".$this->commercial_name."', "
                . "'1')";
    }
}