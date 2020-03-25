<?php 
session_start();
require_once 'logic/admin/Admin.php';
require_once 'logic/buyer/Buyer.php';
require_once 'logic/commodity/Commodity.php';
require_once 'logic/contract/Contract.php';
require_once 'logic/invoice/Invoice.php';
require_once 'logic/item/Item.php';
require_once 'logic/purchase_order/Purchase_order.php';
require_once 'logic/receipt/Receipt.php';
require_once 'logic/replenisher/Replenisher.php';
require_once 'logic/requisition/Requisition.php';
require_once 'logic/supplier/Supplier.php';
require_once 'logic/tag/Tag.php';
require_once 'logic/warehouse/Warehouse.php';
$msg = "";
?>

<html>
    <head>
        <script src="src/js/jquery.js"></script>
        <script src="src/js/popper.js"></script>
        <script src="src/js/bootstrap.min.js"></script>
        <script src="src/js/all.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chartkick/2.3.0/chartkick.min.js"></script>
        <script src="https://www.gstatic.com/charts/loader.js"></script>
        
        <link rel="stylesheet" href="src/css/bootstrap.min.css"/>
        <link rel="stylesheet" href="src/css/all.css"/>
        <link rel="stylesheet" href="src/css/indev.css"/>
        <link rel="stylesheet" href="src/css/project.css"/>
        
    </head>
    <body>
        
        <?php
        
        if(isset($_GET['pid'])) {
            if(isset($_GET['nos']) || (!isset($_GET['nos']) && $_SESSION['id']!='')) {
                include base64_decode($_GET['pid']);
            }
            else {
                header("Location: index.php");
            }
        }
        else {
            $_SESSION['id'] = '';
            include "presentation/startpage/Startpage.php";
        }
        
        ?>
        
    </body>
</html>
