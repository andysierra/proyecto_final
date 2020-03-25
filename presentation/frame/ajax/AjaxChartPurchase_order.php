<?php

$pos = (new Purchase_order())->simpleSearch($_GET['filter']);

?>

<div class="w-50">
    <div id="byStatus">
    </div>
    <p class="text-center">Por Estado</p>
</div>
<div class="w-50">
    <div id="bySupplier">
    </div>
    <p class="text-center">Por Proveedor</p>
</div>

<?php
$statusString = "[";
for($i=0; $i<count($pos); $i++) {
    if($pos[$i]->getCreator() != "")
        $statusString .= '["'.$pos[$i]->getStatus().'",1]';
    if($i<count($pos)-1)
        $statusString .= ",";
}
$statusString .= "]";


$supplierString = "[";
for($i=0; $i<count($pos); $i++) {
    $supplierString .= '["'.$pos[$i]->getSupplier().'",1]';
    if($i<count($pos)-1)
        $supplierString .= ",";
}
$supplierString .= "]";

echo "<script>";
    echo "new Chartkick.PieChart('byStatus', ".$statusString.");";
    echo "new Chartkick.PieChart('bySupplier', ".$supplierString.");";
echo "</script>";

?>