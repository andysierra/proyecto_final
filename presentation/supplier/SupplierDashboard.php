<?php
$currentUser = new Supplier($_SESSION['id'], "", "", "", "", "", "", "", 1);
$currentUser->retrieve(true);
echo "<h1>BIENVENIDO ".$currentUser->getFname()." ".$currentUser->getSname()."</h1>";
?>