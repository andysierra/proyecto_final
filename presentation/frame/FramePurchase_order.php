<div class="card-header my-0 py-0 d-flex flex-nowrap flex-row justify-content-start">
<!--    <a href="#" class="mr-5 text-secondary">Mi Pez</a>
    <a href="#" class="mr-5 text-secondary">Mi Pez</a>
    <a href="#" class="mr-5 text-secondary">Mi Pez</a>-->
</div>


<div class="card-body">
    <h2 class="segan mb-4">Ordenes de compra</h2>
    
    <div class="bg-primary d-flex flex-row flex-nowrap justify-content-between py-1 px-2 rounded-top"> <!-- search -->
        <div class="d-flex flex-nowrap flex-row">
            <a class="btn btn-sm btn-light pb-0"
               id="btnPdf"
               href="">
                <span class="fas fa-file-pdf"></span>
                &nbsp;Imprimir reporte
            </a>
        </div>
        <div class="d-flex flex-nowrap flex-row">
            <button class="btn btn-sm btn-light py-0 text-nowrap">
                <span class="fas fa-search"></span>
                &nbsp;Avanzado
            </button>
            &nbsp;&nbsp;&nbsp;
            <input type="text"
                   style="height: 30px;"
                   id="txfSearch"
                   placeholder="Buscar"
                   class="form-control"/>
        </div>
    </div>
    
    
    <div class="d-flex flex-row flex-nowrap justify-content-around" id="charts"> <!-- chartzone -->
        
    </div>
    
    <div class="border"> <!-- table -->
        <table class="table table-sm table-striped table-hover">
            <thead>
            <th class="minifont">
                ID
            </th>
            <th class="minifont">
                Estado
            </th>
            <th class="minifont">
                Solicitud
            </th>
            <th class="minifont">
                Proveedor
            </th>
            <th class="minifont">
                Creador
            </th>
            <th class="minifont">
                Acciones
            </th>
            </thead>
            
            <tbody id="rows">
                <!-- AJAX SPACE -->
            </tbody>
        </table>
    </div>
</div>

<script>
$(document).ready(function(){
    search();   
    
    function search() {
        $('#btnPdf').attr('href', "indexPDF.php?pid=<?= base64_encode('presentation/frame/pdf/PdfTablePurchase_order.php')?>&filter="+$('#txfSearch').val());
        
        let chartRoute = "indexAjax.php?pid=<?= base64_encode('presentation/frame/ajax/AjaxChartPurchase_order.php')?>&filter="+$('#txfSearch').val();
        $('#charts').load(chartRoute);
        
        let route = "indexAjax.php?pid=<?= base64_encode('presentation/frame/ajax/AjaxTablePurchase_order.php')?>&filter="+$('#txfSearch').val();
        $('#rows').load(route);
    }
    
    $('#txfSearch').on('input', search)
});
</script>