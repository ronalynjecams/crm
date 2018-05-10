<?php
if($UserIn['User']['role']=="logistics_head") { ?>
<!--SWEET ALERT-->
<script src="/js/sweetalert.min.js"></script> 
<link href="/css/sweetalert.css" rel="stylesheet">

<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<!--<link href="/css/plug/magic-check/css/magic-check.min.css" rel="stylesheet">-->
<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<!--<script src="../js/erp_js/erp_scripts.js"></script>-->  
 


<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">

    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $req['DeliverySchedule']['deliver_to']; ?></h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-body">
                <br/>
                <div align="center">
                    <?php if ($req['DeliverySchedule']['status'] == 'pending' || $req['DeliverySchedule']['status'] == 'ongoing') { ?>
                        <button class="btn btn-primary" id="approvedSched" data-dsid="<?php echo $req['DeliverySchedule']['id']; ?>">  Done</button>
                    <?php }else{ ?>
                        <!--<button class="btn btn-primary" id="approvedSched" data-dsid="<?php echo $req['DeliverySchedule']['id']; ?>">  Prints </button>-->
                    <?php } ?>
                </div>
                <br/>
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Image</th> 
                            <th>Product Code</th>  
                            <th>Description</th>
                            <th>Requested Qty</th>
                            <?php if($UserIn['User']['role']=='logistics_head') { 
                                echo '<th>Action</th>';
                            } ?>
                        </tr>
                    </thead> 
                    <tbody>
                        <?php foreach ($vars as $var) {
                        ?>
                            <tr>
                                <th>
                                    <?php if (!is_null($var['prod_image'])) { ?>
                                        <img class="img-responsive" height="70" width="70" src="/img/product-uploads/<?php echo $var['prod_image']; ?>" alt="Product Picture">
                                        <?php
                                    } else {
                                        echo 'no image';
                                    }
                                    ?>
                                </th> 
                                <th><?php echo $var['prod_name']; ?></th>  
                                <th> 
                                    <ul class="list-group"> 
                                        <?php
                                        
                                        ?>
                                        <?php echo '<li class="list-group-item"><b>Other Info : <br/></b>' . $var['other_info'] . '</li>'; ?>

                                    </ul>
                                </th>
                                <th><?php
                                    if ($var['actual_qty'] != 0) {
                                        if($var['reference_type']=='pull_out') {
                                            echo $var['pullout_requested_qty'].' / ' . $var['delivered_qty'];
                                        }
                                        else {
                                            echo $var['requested_qty']. ' / ' . $var['actual_qty'];
                                        }
                                    } else {
                                        echo $var['requested_qty'];
                                    }
                                    ?>
                                </th>
                                <?php
                                if($UserIn['User']['role']=='logistics_head') { ?>
                                <th>
                                    <?php if ($var['status'] == 'pending' || $var['status'] == 'delivered') { ?>
                                        <button class="btn btn-primary processBtn"
                                                data-id="<?php echo $var['dsproduct_id']; ?>"
                                                data-qty="<?php echo $var['requested_qty']; ?>"
                                                data-pulloutqty="<?php echo $var['pullout_requested_qty']; ?>"
                                                data-demoqty="<?php echo $var['actual_qty']; ?>"
                                                data-demoapprovedqty="<?php echo $var['approved_qty']; ?>"
                                                data-demopulloutapprovedqty="<?php echo $var['pullout_approved_qty']; ?>"
                                                data-type="<?php echo $var['reference_type']; ?>"
                                                data-demoprodid="<?php echo $var['client_service_product_id']; ?>"
                                                data-demoid="<?php echo $var['client_service_id']; ?>"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Process Requested Quantity">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                        <?php
                                    } else if ($var['status']=='processed') {
                                        echo 'processed';
                                    } else {
                                        echo 'how about backjob?';
                                    }
                                    ?>
                                </th> 
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>

    </div>
</div>

<!--===================================================-->
<!--Add New Product Modal Start-->
<!--===================================================--> 
<div class="modal fade" id="processDeliveredModal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Process Requested Quantity</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <input id="delivery_sched_product_id" type="hidden">
                        <label>Quantity</label>
                        <input type="number" id="process_qty" class="form-control">
                    </div>
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveProduct">Save</button>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function() {
    var demoqty = 0;
    var demo_pullout_approved_qty = 0;
    var demoapproved_qty = 0;
    var type="quotation";
    var demoprodid = 0;
    var demoid = 0;
    var data_reference_type = "";
    $('[data-toggle=tooltip]').tooltip();
    $('.processBtn').each(function (index) {
        $(this).click(function () {
            var id = $(this).data("id");
            var qty = $(this).data("qty");
            var pulloutqty = $(this).data("pulloutqty");
            demoqty = $(this).data("demoqty");
            demoapproved_qty = $(this).data('demoapprovedqty');
            demo_pullout_approved_qty = $(this).data('demopulloutapprovedqty');
            data_reference_type = $(this).data('type');
            type = $(this).data('type');
            demoprodid = $(this).data('demoprodid');
            demoid = $(this).data('demoid');
            $("#delivery_sched_product_id").val(id);
            if(data_reference_type=="pull_out") { $("#process_qty").val(pulloutqty); }
            else { $("#process_qty").val(qty); }
            $('#processDeliveredModal').modal('show');
        });
    });

    $('#saveProduct').click(function () {
        var delivery_sched_product_id = $('#delivery_sched_product_id').val();
        var process_qty = $('#process_qty').val();

        if (process_qty != "" && process_qty >= 1) {
            var data = {"data_reference_type": data_reference_type,
                        "delivery_sched_product_id": delivery_sched_product_id,
                        "process_qty": process_qty,
                        "demoprodqty": demoqty,
                        "demoid": demoid,
                        "demoapproved_qty": demoapproved_qty,
                        "demo_pullout_approved_qty": demo_pullout_approved_qty,
                        "type": type,
                        "demoprodid": demoprodid };
                        
            $.ajax({
                url: "/delivery_sched_products/saveProductSched",
                type: 'POST',
                data: {'data': data},
                dataType: 'text',
                success: function (success) {
                    console.log(success);
                    location.reload();
                },
                error: function (error) {
                    console.log(error);
                    swal({
                        title: "Oops!",
                        text: "An error occured. Please try again.",
                        type: "warning"
                    });
                }
            });
        } else {
            swal("Please indicate quantity.");
        }
    });

    $('#approvedSched').click(function () {
        $("#approvedSched").prop("disabled",true);
        var delivery_schedule_id = $(this).data("dsid");
        var status = 'approved';

        swal({
            title: "Are you sure you're done?", 
            text: "You will not be able to edit after this confirmation! Other unprocessed products will be cancelled",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes, confirm!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                $.ajax({
                    url: "/delivery_schedules/changeStatus",
                    type: 'POST',
                    data: {'delivery_schedule_id': delivery_schedule_id,'status':status},
                    dataType: 'text',
                    success: function (success) {
                        console.log(success);
                        location.reload();
                    },
                    error: function (error) {
                        console.log(error);
                        location.reload();
                        swal({
                            title: "Oops!",
                            text: "An error occured. Please try again later.",
                            type: "warning"
                        });
                    }
                });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    });
    
    $('#example').DataTable({
        "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
        "order": [[0, "asc"]],
        "stateSave": true
    });
});
</script>
<?php
}
else {
    echo "<div id='content-container'>
            <div id='page-content'>This area is restricted. Please contact system administrator.</div>
          </div>";
}
?>