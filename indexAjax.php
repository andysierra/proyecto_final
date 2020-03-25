<?php
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


include base64_decode($_GET['pid']);

