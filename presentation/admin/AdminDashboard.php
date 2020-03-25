<?php
$currentUser = new Admin($_SESSION['id'], "", "", "", "", "", "", 1);
$currentUser->retrieve(true);
?>

<?php include "presentation/Topbar.php"; ?>
<?php include "presentation/admin/AdminTabs.php"; ?>

<div class="container">
    <div class="row mx-auto">
        <div class="card col-12 col-sm-12 col-md-12 col-lg-12 px-0" id="frame">
            <!-- AJAX SPACE -->
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
    $('.tab').click(function(){
        let route = "";
        switch($(this).attr('id')) {
            case 'home': 
                route = 'indexAjax.php?pid=<?= base64_encode("presentation/frame/FrameHome.php")?>';
                $('#frame').load(route);
            break;
            case 'requisition': 
                route = 'indexAjax.php?pid=<?= base64_encode("presentation/frame/FrameRequisition.php")?>';
                $('#frame').load(route);
            break;
            case 'purchase_order': 
                route = 'indexAjax.php?pid=<?= base64_encode("presentation/frame/FramePurchase_order.php")?>';
                $('#frame').load(route);
            break;
            case 'invoice': 
                route = 'indexAjax.php?pid=<?= base64_encode("presentation/frame/FrameInvoice.php")?>';
                $('#frame').load(route);
            break;
            case 'receipt': 
                route = 'indexAjax.php?pid=<?= base64_encode("presentation/frame/FrameReceiot.php")?>';
                $('#frame').load(route);
            break;
            case 'settings': 
                route = 'indexAjax.php?pid=<?= base64_encode("presentation/frame/FrameSettings.php")?>';
                $('#frame').load(route);
            break;
        }
    });
});
</script>