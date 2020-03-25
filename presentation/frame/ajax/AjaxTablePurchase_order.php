<?php

$pos = (new Purchase_order())->simpleSearch($_GET['filter']);

if(count($pos)==0) {
    echo "No hay datos";
}
else {
    foreach ($pos as $po) {
        echo "<tr>";
            echo "<td class='minifont'>";
                echo "<a href='#'>".$po->getIdpurchase_order()."</a>";
            echo "</td>";
            echo "<td class='minifont'>";
                switch($po->getStatus()) {
                    case 0:
                        echo "Facturado";
                        break;
                    case 1:
                        echo "No Facturado";
                        break;
                }
            echo "</td>";
            echo "<td class='minifont'>";
                echo "<a href='#'>".$po->getRequisition()."</a>";
            echo "</td>";
            echo "<td class='minifont'>";
                echo "<a href='#'>".$po->getSupplier()."</a>";
            echo "</td>";
            echo "<td class='minifont'>";
                echo "<a href='#'>".$po->getCreator()."</a>";
            echo "</td>";
            echo "<td class='minifont'>";
                echo "acciones";
            echo "</td>";
        echo"</tr>";
    }
}