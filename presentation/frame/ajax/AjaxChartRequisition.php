<?php

$requisitions = (new Requisition())->simpleSearch($_GET['filter']);

?>

<div class="w-50">
    <div id="byBuyer">
    </div>
    <p class="text-center">Por Solicitantes</p>
</div>
<div class="w-50">
    <div id="byPrices">
    </div>
    <p class="text-center">Por Precios</p>
</div>

<?php
$buyersString = "[";
for($i=0; $i<count($requisitions); $i++) {
    if($requisitions[$i]->getCreator() != null)
        $buyersString .= '["'.$requisitions[$i]->getCreator()->getFname().'",1]';
    if($i<count($requisitions)-1)
        $buyersString .= ",";
}
$buyersString .= "]";


$pricesString = "[";
for($i=0; $i<count($requisitions); $i++) {
    $pricesString .= '["'.$requisitions[$i]->getTotal().'",1]';
    if($i<count($requisitions)-1)
        $pricesString .= ",";
}
$pricesString .= "]";

echo "<script>";
    echo "new Chartkick.PieChart('byBuyer', ".$buyersString.");";
    echo "new Chartkick.PieChart('byPrices', ".$pricesString.");";
echo "</script>";

?>