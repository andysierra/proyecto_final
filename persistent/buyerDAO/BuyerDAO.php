<?php
class BuyerDAO
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
    
    public function __construct($idbuyer="", $fname="", $sname="", $email="", $password="", $phone="", $spend_limit="", $profilepic="", $next_approver, $active="") {
        $this->idbuyer = $idbuyer;
        $this->fname = $fname;
        $this->sname = $sname;
        $this->email = $email;
        $this->password = $password;
        $this->phone = $phone;
        $this->spend_limit = $spend_limit;
        $this->profilepic = $profilepic;
        $this->next_approver = $next_approver;
        $this->active = $active;
    }
    
    public function auth() {
        return "SELECT idbuyer FROM buyer WHERE email = '". $this->email."' "
                . "AND password = md5('". $this->password."')";
    }
    
    public function retrieve($byId) {
        return ($byId)? "SELECT idbuyer, fname, sname, email, phone, spend_limit, profilepic, next_approver, active FROM buyer "
                . "WHERE idbuyer = '".$this->idbuyer."'" : 
        "SELECT idbuyer, fname, sname, email, phone, spend_limit, profilepic, next_approver, active FROM buyer "
                . "WHERE email = '". $this->email."' "
                . "AND password = md5('". $this->password."')";
    }
    
    public function signup() {
        return "INSERT INTO buyer (fname, sname, email, password, phone, spend_limit, profilepic, next_approver, active) VALUES ("
                . "'".$this->fname."', "
                . "'".$this->sname."', "
                . "'".$this->email."', "
                . "md5('".$this->password."'), "
                . "'".$this->phone."', "
                . "'".$this->spend_limit."', "
                . "'".$this->profilepic."', "
                . "'".$this->next_approver."', "
                . "'1')";
    }
}