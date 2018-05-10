<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<link href="/css/sweetalert.css" rel="stylesheet">
<!--<link href="/css/plug/magic-check/css/magic-check.min.css" rel="stylesheet">-->
<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<!--<script src="../js/erp_js/erp_scripts.js"></script>-->  
<script src="/js/sweetalert.min.js"></script>  


<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Transaction Sources</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->

        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">

                </h3>  
            </div>
            <div class="panel-body">
 
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Product Image</th> 
                            <th>Product Name</th>  
                            <th>Source</th>
                            <th>Product Combo</th>
                            <th>Qty.</th>
                            <th>Action</th>  
                        </tr>
                    </thead> 
                    <tbody>
                        <?php foreach ($sources as $data) { 
                            $src = json_encode($data);
                        ?>
                            <tr>
                                <td>
                                    <img class="img-responsive" height="70" width="70" src="/img/product-uploads/<?php echo $data['ProductCombo']['Product']['image']; ?>" alt="Product Picture">
                                </td> 
                                <td>
                                    <?php
                                    echo $data['ProductCombo']['Product']['name'];
                                    ?>  
                                </td>
                                <td> <?php echo $ref_type; ?></td>
                                <td><?php echo $data['ProductCombo']['Product']['name'].' '.$data['ProductCombo']['ordering']; ?></td>
                                <td>
                                   <?php echo $data['TransactionSource']['qty']; ?>
                                </td> 
                                <td>
                                    <?php 
                                        if($authUser['department_id'] == 6 && ($data['TransactionSource']['product_type'] == 'supply' || $data['TransactionSource']['product_type'] == 'combination')){ ?>
                                            <button class="btn btn-danger btn-icon add-tooltip delete_transaction" data-toggle="tooltip"  data-original-title="Delete Transaction"  data-deleteid="<?php echo $data['TransactionSource']['id']; ?>" data-src='<?php echo $src; ?>'><i class="fa fa-window-close"></i></button>
                                        <?php } 
                                        
                                        if($authUser['department_id'] == 7 && $data['TransactionSource']['product_type'] !== 'supply'){ ?>
                                            <button class="btn btn-danger btn-icon add-tooltip delete_transaction" data-toggle="tooltip"  data-original-title="Delete Transaction"  data-deleteid="<?php echo $data['TransactionSource']['id']; ?>" data-src='<?php echo $src; ?>'><i class="fa fa-window-close"></i></button>
                                        <?php }
                                    ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>

    </div>
</div>


<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true

        });
    });
    
    $('.delete_transaction').each(function (index) {
        $(this).click(function () {
            var trans_id = $(this).data("deleteid");
            var src = $(this).data("src");
            
            console.log(src);

            swal({
                title: "Are you sure?",
                text: "You wan to delete this transaction?",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {

                            swal("Confirms", "", "error");
                                $.ajax({
                                    url: "/transaction_sources/delete_ts",
                                    type: 'POST',
                                    data: {'src': src},
                                    dataType: 'json',
                                    success: function (dd) {
                                        //redirect to edit of products 
                                        // window.location.replace("/job_requests/joupdate?id=" + quotation_id);
                                        console.log(dd);
                                    },
                                    error: function (dd) {
                                    }
                                });
                        } else {
                            swal("Cancelled", "", "error");
                        }
                    });

//                window.location.replace("/job_requests/joupdate?id=" + quote_id);
        });
    });

</script>