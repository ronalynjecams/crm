


<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="../css/sweetalert.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="../js/sweetalert.min.js"></script>

<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Collections (<small><?php echo str_replace('_', ' ', $this->params['url']['status']);?></small>)</h1>
    
        <!--<h1 class="page-header text-overflow"> Pending Collection </h1>-->
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
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped " >
                    <thead>
                        <tr>
                            <th align="center">Date Created</th> 
                            <th align="center">Client</th> 
                            <th align="center">Sales Executive</th> 
                            <th align="center">Contract Amount</th>  
                            <th align="center">Collected Amount</th>
                            <th align="center">With Held Amount</th>
                            <th align="center">Other Amount</th>
                            <th align="center">Bank</th>
                            <th align="center">Check Number</th>
                            <th align="center">Check Date</th>
                            <th align="center">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($collections as $collection) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    echo date('F d, Y', strtotime($collection['Collection']['created']));
                                    echo '<br/><small>' . date('h:i a', strtotime($collection['Collection']['created'])) . '- '.$collection['Collection']['type'].'</small>';
                                    ?> 
                                </td>
                                <td>
                                    <?php
                                    echo $collection['Quotation']['Client']['name'];
                                    echo '<br/><small>[' . $collection['Quotation']['quote_number'] . ']</small>';
                                    ?> 
                                </td> 
                                <td>  
                                    <?php
                                    echo $collection['User']['first_name']; 
                                    ?> 
                                </td>  
                                <td align="right">
                                    <?php
                                    echo '&#8369; ' . number_format($collection['Quotation']['grand_total'], 2);
                                    
                                    ?>
                                </td>   
                                            <td align="right">
                                                <?php
                                                echo '&#8369; ' . number_format($collection['Collection']['amount_paid'], 2);
                                                ?> 
                                            </td>
                                            <td align="right">
                                                <?php
                                                if ($collection['Collection']['with_held'] != 0) {
                                                    echo '&#8369; ' . number_format($collection['Collection']['with_held'], 2);
                                                } else {
                                                    echo '-';
                                                }
                                                ?>  
                                            </td>
                                            <td align="right">
                                                <?php
                                                if ($collection['Collection']['other_amount'] != 0) {
                                                    echo '&#8369; ' . number_format($collection['Collection']['other_amount'], 2);
                                                } else {
                                                    echo '-';
                                                }
                                                ?>  
                                            </td>
                                            <td>
                                                <?php
                                                if ($collection['Collection']['bank_id'] != 0) {
                                                    echo $collection['Bank']['name'];
                                                } else {
                                                    echo '-';
                                                }
                                                ?>  
                                            </td>
                                            <td>
                                                <?php
                                                if ($collection['Collection']['bank_id'] != 0) {
                                                    echo $collection['Collection']['check_number'];
                                                } else {
                                                    echo '-';
                                                }
                                                ?>  
                                            </td>
                                            <td> 
                                                <?php
                                                if (!is_null($collection['Collection']['check_date'])) {
                                                    echo time_elapsed_string($collection['Collection']['check_date']);
                                                    echo '<br/><small>' . date('h:i a', strtotime($collection['Collection']['check_date'])) . '</small>';
                                                } else {
                                                    echo '-';
                                                }
                                                ?> 
                                            </td>
                                            <td>
                                                <?php
                                                if ($collection['Collection']['status'] == 'verified') {
                                                    $total = $collection['Collection']['amount_paid'] + $collection['Collection']['with_held'] + $collection['Collection']['other_amount'];
                                                    $grand_total = $grand_total + $total;
                                                    echo '<p class="text-success">Verified</p>';
//                                                    if ($collection['Collection']['type']
                                                    //only accounting head or proprietor could void any collection
//                                                    if ($userRole == 'accounting_head' || $userRole == 'proprietor') {
//                                                        echo ' <button class="btn btn-xs btn-danger add-tooltip updateStatus_collection" data-toggle="tooltip"  data-original-title="Delete Collection" data-collectionid="' . $collection['Collection']['id'] . '" data-stats="void"><i class="fa fa-close"></i></button>';
//                                                    }
                                                } else if ($collection['Collection']['status'] == 'void') {
                                                    echo '<p class="text-danger">Void</p>';
                                                } else {
                                                    echo ' <button class="btn btn-xs btn-danger add-tooltip updateStatus_collection" data-toggle="tooltip"  data-original-title="Delete Collection" data-collectionid="' . $collection['Collection']['id'] . '" data-quotecollectionid="' . $collection['Collection']['quotation_id'] . '" data-stats="void"><i class="fa fa-close"></i></button>';
                                                    echo '&nbsp; <button class="btn btn-xs btn-success add-tooltip updateStatus_collection"  data-toggle="tooltip"  data-original-title="Verify Collection" data-collectionid="' . $collection['Collection']['id'] . '" data-quotecollectionid="' . $collection['Collection']['quotation_id'] . '"data-stats="verified"><i class="fa fa-check"></i></button>';
                                                }
                                                ?>
                                            </td> 
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align="center">Date Created</th> 
                            <th align="center">Client</th> 
                            <th align="center">Sales Executive</th> 
                            <th align="center">Contract Amount</th>  
                            <th align="center">Collected Amount</th>
                            <th align="center">With Held Amount</th>
                            <th align="center">Other Amount</th>
                            <th align="center">Bank</th>
                            <th align="center">Check Number</th>
                            <th align="center">Check Date</th>
                            <th align="center">Status</th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--===================================================--> 
<script>
    $(document).ready(function () {
 
            
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "desc"]],
            "stateSave": true
        }); 
    });
    
    

    $(".updateStatus_collection").each(function (index) {
        $(this).on("click", function () {
            var id = $(this).data('collectionid');
            var quotation_id = $(this).data('quotecollectionid');
            
            var status = $(this).data('stats');
            if (status == 'void') {
                var warn = "You will not be able to retrieve after this confirmation!";
                var titl = "Are you sure to delete this payment?";
            } else {
                var warn = "You will not be able to revert transaction after this confirmation!";
                var titl = "Are you sure that this is a verified payment?";
            }
            swal({
                title: titl,
                text: warn,
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
                                url: "/collections/viodPayment",
                                type: 'POST',
                                data: {'id': id, 'status': status, 'quotation_id':quotation_id},
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
    });



</script>
<script>
    function killCopy(e) {
        return false
    }
    function reEnable() {
        return true
    }
    document.onselectstart = new Function("return false")
    if (window.sidebar) {
        document.onmousedown = killCopy
        document.onclick = reEnable
    }
</script>