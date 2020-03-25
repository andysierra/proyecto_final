<?php

if(isset($_POST['form_auth'])) {
    $currentUser = new Admin("", "", "", $_POST['form_auth_email'], $_POST['form_auth_password'], "", "", 1);
    if($currentUser->auth()) {
        $currentUser->retrieve(false);
        $_SESSION['id'] = $currentUser->getIdadmin();
    }
    else {
        $currentUser = new Replenisher("", "", "", $_POST['form_auth_email'], $_POST['form_auth_password'], "", "", 1);
        if($currentUser->auth()) {
            $currentUser->retrieve(false);
            $_SESSION['id'] = $currentUser->getIdreplenisher();
        }
        else {
            $currentUser = new Buyer("", "", "", $_POST['form_auth_email'], $_POST['form_auth_password'], "", "", "", "",1);
            if($currentUser->auth()) {
                $currentUser->retrieve(false);
                $_SESSION['id'] = $currentUser->getIdbuyer();
            }
            else {
                $currentUser = new Supplier("", "", "", $_POST['form_auth_email'], $_POST['form_auth_password'], "", "", "", 1);
                if($currentUser->auth()) {
                    $currentUser->retrieve(false);
                    $_SESSION['id'] = $currentUser->getIdsupplier();
                }
                else {
                    $msg = "Usuario o contraseña inválido";
                    $currentUser = null;
                    echo "".$msg."<br>";
                }
            }
        }
    }
    
    if($currentUser->getActive() != '1') {
        $msg = "Este usuario está inactivo! Contacte con un administrador";
        echo "".$msg."<br>";
        $currentUser = null;
        $_SESSION['id'] = "";
    }
    else {
        if($currentUser instanceof Admin) {
            header("Location: index.php?pid=".base64_encode("presentation/admin/AdminDashboard.php"));
        }
        if($currentUser instanceof Replenisher) {
            header("Location: index.php?pid=".base64_encode("presentation/replenisher/ReplenisherDashboard.php"));
        }
        if($currentUser instanceof Buyer) {
            header("Location: index.php?pid=".base64_encode("presentation/buyer/BuyerDashboard.php"));
        }
        if($currentUser instanceof Supplier) {
            header("Location: index.php?pid=".base64_encode("presentation/supplier/SupplierDashboard.php"));   
        }
    }
}