<?php

$requisitions = (new Requisition())->simpleSearch($_GET['filter']);

if(count($requisitions)==0) {
    echo "No hay datos";
}
else {
    foreach ($requisitions as $req) {
        echo "<tr>";
            echo "<td class='minifont'>";
                echo "<a href='#'>".$req->getIdRequisition()."</a>";
            echo "</td>";
            echo "<td class='minifont'>";
                switch($req->getStatus()) {
                    case 0:
                        echo "Borrador";
                        break;
                    case 1:
                        echo "Aprobación Pendiente";
                        break;
                    case 2:
                        echo "Aprobado";
                        break;
                    case 3:
                        echo "Rechazado";
                        break;
                }
            echo "</td>";
            echo "<td class='minifont'>";
                if($req->getCreator() != null)
                    echo "<a href='#'>".$req->getCreator()->getIdBuyer()."</a>";
                else echo "no tiene creator [error]";
            echo "</td>";
            echo "<td class='minifont'>";
                if(count($req->getItems()) > 0) {
                    foreach ($req->getItems() as $item)
                        echo "<a href='#'>".$item->getName()."</a>".", ";
                }
                else echo "no tiene creator [error]";
            echo "</td>";
            echo "<td class='minifont'>";
                echo $req->getTotal();
            echo "</td>";
            echo "<td class='minifont'>";
                echo "acciones";
            echo "</td>";
        echo"</tr>";
    }
}