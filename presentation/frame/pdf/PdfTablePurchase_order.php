<?php
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial','B',12);
    
    $pos = (new Requisition())->simpleSearch($_GET['filter']);
    
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
    $pdf->Cell(20,5,"Solicitud",1,0);
    $pdf->Cell(90,5,"Proveedor",1,0);
    $pdf->Cell(30,5,"Creador",1,0);
    $pdf->SetFont('Arial','',12);
    foreach ($pos as $po) {
    $pdf->Ln();
        $pdf->Cell(10,5,$po->getIdPurchase_order(),1,0);
        
        switch($po->getStatus()) {
            case 0:
                $pdf->Cell(30,5,"Facturado",1,0);
                break;
            case 1:
                $pdf->Cell(30,5,utf8_decode("No Facturado"),1,0);
                break;
        }
        $pdf->Cell(30,5,$po->getRequisition(),1,0);
        
        $pdf->Cell(30,5,$po->getSupplier(),1,0);
        
        $pdf->Cell(30,5,$req->getCreator(),1,0);
    }
    
    $pdf->Output();
?>