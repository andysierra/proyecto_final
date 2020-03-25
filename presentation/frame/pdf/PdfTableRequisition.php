<?php
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);
    
    $requisitions = (new Requisition())->simpleSearch($_GET['filter']);
    
    $pdf->Image("src/img/icon.jpg", 10, 10, 10, 10, "JPG");
    $pdf->SetXY(20, 13);
    $pdf->SetFont('Arial','B',20);
    $pdf->Cell(10, 5, "Proyecto Final", 0);
    
    $pdf->SetY(30);
    $pdf->SetFont('Arial','',20);
    $pdf->Cell(10, 5, "Solicitudes", 0);
    $pdf->SetY(40);
    
    $pdf->SetFont('Arial','B',12);
    $pdf->Cell(10,5,"ID",1,0);
    $pdf->Cell(30,5,"Estado",1,0);
    $pdf->Cell(20,5,"Creador",1,0);
    $pdf->Cell(90,5,"Items",1,0);
    $pdf->Cell(30,5,"Total",1,0);
    $pdf->SetFont('Arial','',12);
    foreach ($requisitions as $req) {
    $pdf->Ln();
        $pdf->Cell(10,5,$req->getIdRequisition(),1,0);
        
        switch($req->getStatus()) {
            case 0:
                $pdf->Cell(30,5,"Borrador",1,0);
                break;
            case 1:
                $pdf->Cell(30,5,utf8_decode("Pendiente"),1,0);
                break;
            case 2:
                $pdf->Cell(30,5,"Aprobado",1,0);
                break;
            case 3:
                $pdf->Cell(30,5,"Rechazado",1,0);
                break;
        }
        if($req->getCreator() != null)
            $pdf->Cell(20,5,$req->getCreator()->getIdBuyer(),1,0);
        else $pdf->Cell(20,5,"No tiene [error]",1,0);
        
        if(count($req->getItems()) > 0) {
            foreach ($req->getItems() as $item)
                $pdf->Cell(90,5,$item->getName(),1,0);
        }
        else $pdf->Cell(30,5,"No tiene [error]",1,0);
        
        $pdf->Cell(30,5,$req->getTotal(),1,0);
    }
    
    $pdf->Output();
?>