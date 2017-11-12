<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<link href="../plugins/magic-check/css/magic-check.min.css" rel="stylesheet">
<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="../js/erp_js/erp_scripts.js"></script>  


<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow"><?php echo $product; ?></h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>Combo Code</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Total Qty</th>
                            <th> </th> 
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Combo Code</th>
                            <th>Location</th>
                            <th>Description</th>
                            <th>Total Qty</th>
                            <th> </th> 
                        </tr>
                    </tfoot>
                    <tbody>
                        <?php
                        	$ctr = 1;
                        	foreach ($prodInvCombos as $combo) { 
                        ?>
                            <tr>
                                <td><?php echo  $combo['Product']['name'] . ' Combination ' . $ctr; ?></td>
                                <td><?php echo  $combo['InvLocation']['name']; ?></td>
                                <td>
                                    <ul class="list-group">
                                        <?php
                                        foreach ($combo['ProdInvLocationProperty'] as $propertyValue){
                                            echo '<li class="list-group-item"><b>' . $propertyValue['property'] . '</b> : ' . $propertyValue['value'] . ' </li>';
                                        }
                                        ?>
                                    </ul>
                                </td>
                                <td><?php echo $combo['ProdInvCombo']['qty']; ?></td> 
                                <td>
                                    <?php
//                                    echo '<a class="btn btn-mint btn-icon add-tooltip updateSupplierBtn" data-toggle="tooltip" href="#" data-original-title="Update Supplier" data-id="' . $supplier['ProdInvLocation']['id'] . '" ><i class="fa fa-edit"></i></a>';
                                    echo '&nbsp;<a class="btn btn-info btn-icon add-tooltip productSupplierBtn" data-toggle="tooltip" href="/prod_inv_locations/view_combo?id='. $combo['Product']['id'] .'" data-original-title="View Combinations"><i class="fa fa-eye"></i> </a>';
                                    ?>
                                </td> 
                            </tr>
                        <?php $ctr++; } ?>
                    </tbody>
                </table>
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
</script>