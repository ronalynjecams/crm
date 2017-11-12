

<link href="../css/sweetalert.css" rel="stylesheet">

<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<script src="../plugins/select2/js/select2.min.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<!--<link href="../plugins/magic-check/css/magic-check.min.css" rel="stylesheet">-->
<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<!--<script src="../js/erp_js/erp_scripts.js"></script>-->  
<script src="../js/sweetalert.min.js"></script>  


<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">

    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $req['Quotation']['Client']['name']; ?></h1>
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
                        <button class="btn btn-primary" id="approvedSched" data-dsid="<?php echo $req['DeliverySchedule']['id']; ?>">  Prints </button>
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
                            <th></th>  
                        </tr>
                    </thead> 
                    <tbody>
                        <?php foreach ($scheds as $sched) { ?>
                            <tr>
                                <th>
                                    <?php if (!is_null($sched['QuotationProduct']['Product']['image'])) { ?>
                                        <img class="img-responsive" height="70" width="70" src="../product_uploads/<?php echo $sched['QuotationProduct']['Product']['image']; ?>" alt="Product Picture">
                                        <?php
                                    } else {
                                        echo 'no image';
                                    }
                                    ?>
                                </th> 
                                <th><?php echo $sched['QuotationProduct']['Product']['name']; ?></th>  
                                <th> 
                                    <ul class="list-group"> 
                                        <?php
                                        foreach ($sched['QuotationProduct']['QuotationProductProperty'] as $desc) {
                                            if (is_null($desc['property'])) {
                                                echo '<li class="list-group-item"><b>' . $desc['ProductProperty']['name'] . '</b> : ' . $desc['ProductValue']['value'] . '</li>';
                                            } else {
                                                echo '<li class="list-group-item"><b>' . $desc['property'] . '</b> : ' . $desc['value'] . '</li>';
                                            }
                                        }
                                        ?>
                                        <?php echo '<li class="list-group-item"><b>Other Info : <br/></b>' . $sched['QuotationProduct']['other_info'] . '</li>'; ?>

                                    </ul>
                                </th>
                                <th><?php
                                    if ($sched['DeliverySchedProduct']['actual_qty'] != 0) {
                                        echo $sched['DeliverySchedProduct']['actual_qty'] . ' / ' . $sched['DeliverySchedProduct']['requested_qty'];
                                    } else {
                                        echo $sched['DeliverySchedProduct']['requested_qty'];
                                    }
                                    ?>
                                </th> 
                                <th>
                                    <?php if ($sched['DeliverySchedProduct']['status'] == 'pending') { ?>
                                        <button class="btn btn-primary processBtn" data-id="<?php echo $sched['DeliverySchedProduct']['id']; ?>" data-qty="<?php echo $sched['DeliverySchedProduct']['requested_qty']; ?>"><i class="fa fa-edit"></i></button>
                                        <?php
                                    } else if ($sched['DeliverySchedProduct']['status'] == 'processed') {
                                        echo 'processed';
                                    } else if ($sched['DeliverySchedProduct']['status'] == 'delivered') {
                                        echo 'how about backjob?';
                                    }
                                    ?>
                                </th>  
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
                <h4 class="modal-title">Approved Quantity</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <input id="delivery_sched_product_id" type="hidden">
                        <!--<label>Approved Quantity</label>-->
                        <input type="number" id="actual_qty" class="form-control">
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

    $('.processBtn').each(function (index) {
        $(this).click(function () {
            var id = $(this).data("id");
            var qty = $(this).data("qty");
            $("#delivery_sched_product_id").val(id);
            $("#actual_qty").val(qty);
            $('#processDeliveredModal').modal('show');
        });
    });


    $('#saveProduct').click(function () {
        var delivery_sched_product_id = $('#delivery_sched_product_id').val();
        var actual_qty = $('#actual_qty').val();

        if (actual_qty != "" && actual_qty >= 1) {
            var data = {"delivery_sched_product_id": delivery_sched_product_id,
                "actual_qty": actual_qty,
            }
            $.ajax({
                url: "/delivery_sched_products/saveProductSched",
                type: 'POST',
                data: {'data': data},
                dataType: 'json',
                success: function (dd) {
                    location.reload();
                },
                error: function (dd) {
                    console.log(dd);
                }
            });
        } else {
            swal("Please indicate quantity.");
        }
    });

    $('#approvedSched').click(function () {
        var delivery_schedule_id = $(this).data("dsid");
        var status = 'approved';

        swal({
            title: "Are you sure you're done?",
            text: "You will not be able to edit after this confirmation!",
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
                            data: {'delivery_schedule_id': delivery_schedule_id,'status':status },
                            dataType: 'json',
                            success: function (dd) {
                                location.reload();
                            },
                            error: function (dd) {
//                                location.reload();
                            }
                        });
                    } else {
                        swal("Cancelled", "", "error");
                    }
                });

    });
</script>