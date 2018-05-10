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
<script src="/js/sweetalert.min.js"></script>  

<!--CONTENT CONTAINER-->
<!--===================================================-->
<div id="content-container">
    <!--Page Title-->
    <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
    <div id="page-title">
        <h1 class="page-header text-overflow">Processed Quotations</h1>
    </div>

    <!--Page content-->
    <!--===================================================-->
    <div id="page-content">
        <!-- Basic Data Tables -->
        <!--===================================================-->
        <div class="panel">
            <div class="panel-heading" align="right">
                <h3 class="panel-title">

                    <?php if ($UserIn['User']['role'] == 'sales_executive') { ?>
                        <a class="btn btn-mint " href="/quotations/create" >
                            <i class="fa fa-plus"></i>  Add New Quotations
                        </a>
                    <?php } ?>
                </h3>
                <!--<h3 class="panel-title">Basic Data Tables with responsive plugin</h3>-->
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th align="center">Date Processed</th> 
                            <th align="center">Date Moved</th> 
                            <th align="center">Type</th> 
                            <th align="center">Subject</th>
                            <th align="center">Client</th>
                            <th align="center">Agent</th> 
                            <?php
                            if($UserIn['User']['role']=="purchasing_supervisor" ||
                               $UserIn['User']['role']=="supply_staff" ||
                               $UserIn['User']['role']=="raw_head") {
                                echo '<th>Remarks</th>';
                            }
                            ?>
                            <th align="center">Action</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($processed_quotes as $processed_quote) {
                        	if($processed_quote['Quotation']['date_processed']!=null) {
                        		$date_processed_order = $processed_quote['Quotation']['date_processed'];
                        	}
                        	else {
                        		$date_processed_order = 0;
                        	}
                            ?>
                            <tr>

                                <td data-order="<?php echo $date_processed_order; ?>">
                                    <?php
                                    if($date_processed_order!=0) {
                                        echo time_elapsed_string($processed_quote['Quotation']['date_processed']);
                                        echo '<br/><small>' . date('h:i a', strtotime($processed_quote['Quotation']['date_processed'])) . '</small>';
                                    }
                                    else {
                                        echo "<font class='text-danger'>Not yet processed</font>";
                                    }
                                    ?> 
                                </td>

                                <td>
                                    <?php
                                    echo time_elapsed_string($processed_quote['Quotation']['date_moved']);
                                    echo '<br/><small>' . date('h:i a', strtotime($processed_quote['Quotation']['date_moved'])) . '</small>';
                                    ?> 
                                </td>
                                <td> 
                                    <?php
                                    echo $processed_quote['Quotation']['type'];
                                    echo '<br/><small>[' . $processed_quote['Quotation']['quote_number'] . ']</small>';
                                    ?> 
                                </td> 
                                <td><?php echo $processed_quote['Quotation']['subject']; ?></td>
                                <td>
                                    <?php
                                    echo $processed_quote['Quotation']['Client']['name'];
                                    echo '<br/><small>[' . $processed_quote['Quotation']['Client']['tin_number'] . ']</small>';
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    echo $processed_quote['Quotation']['User']['first_name'] . '  ' . $processed_quote['Quotation']['User']['last_name'];
                                    ?>
                                </td>  
                                <?php
                                if($UserIn['User']['role']=="purchasing_supervisor" ||
                                   $UserIn['User']['role']=="supply_staff" ||
                                   $UserIn['User']['role']=="raw_head") {
                                    echo '<td>'.$processed_quote['Quotation']['purchasing_remarks'].'</td>';
                                }
                                ?>
                                <td>
                                    <a target="_blank" href="/purchase_orders/quotation_view_supply?id=<?php echo $processed_quote['Quotation']['id']; ?>"
                                       style="color:white;" class="btn btn-info"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="View Quotation?">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <!--<button class="btn btn-mint btn-icon add-tooltip print_soa" data-toggle="tooltip"  data-original-title="Print SOA" data-viewquoteid="<?php // echo $processed_quote['Quotation']['id']; ?>"><i class="fa fa-print"></i> SOA </button>-->
                                    <!--<button class="btn btn-primary btn-icon add-tooltip print_dr" data-toggle="tooltip"  data-original-title="Print DR" data-viewquoteid="<?php // echo $processed_quote['Quotation']['id']; ?>"><i class="fa fa-print"></i> DR </button>-->
                                    <!--<button class="btn btn-warning btn-icon add-tooltip download_si" data-toggle="tooltip"  data-original-title="Download SI" data-viewquoteid="<?php // echo $processed_quote['Quotation']['id']; ?>"><i class="fa fa fa-cloud-download"></i> SI </button>-->
                                </td>  
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align="center">Date Processed</th> 
                            <th align="center">Date Moved</th> 
                            <th align="center">Type</th> 
                            <th align="center">Subject</th>
                            <th align="center">Client</th>
                            <th align="center">Agent</th>
                            <?php
                            if($UserIn['User']['role']=="purchasing_supervisor" ||
                               $UserIn['User']['role']=="supply_staff" ||
                               $UserIn['User']['role']=="raw_head") {
                                echo '<th>Remarks</th>';
                            }
                            ?>
                            <th>Action</th>  
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
            // "stateSave": true
        });

        $("[data-toggle=tooltip]").tooltip();
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