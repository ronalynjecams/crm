


<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<!--<link href="../css/sweetalert.css" rel="stylesheet">-->

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<!--<script src="../js/sweetalert.min.js"></script>-->  

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
                            <th align="center">Type</th> 
                            <th align="center">Client</th>
                            <th align="center">Contract Amount</th>  
                            <th align="center">Balance</th>  
                            <th align="center"> </th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        foreach ($collections as $pending_quotation) {
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    echo date('F d, Y', strtotime($pending_quotation['Quotation']['created']));
                                    echo '<br/><small>' . date('h:i a', strtotime($pending_quotation['Quotation']['created'])) . '</small>';
                                    ?> 
                                </td>
                                <td>
                                    <?php
                                    echo $pending_quotation['Quotation']['type'];
                                    ?> 
                                </td> 
                                <td>
                                    <?php
                                    echo $pending_quotation['Client']['name'];
                                    echo '<br/><small>[' . $pending_quotation['Quotation']['quote_number'] . ']</small>';
                                    ?> 
                                </td> 
                                <td align="right">
                                    <?php
                                    echo '&#8369; ' . number_format($pending_quotation['Quotation']['grand_total'], 2);
                                    ?>
                                </td>  
                                <td align="right">
                                    <?php
                                    $grand_total = 0;
                                    foreach($pending_quotation['Collection'] as $payments){
                                        if ($payments['status'] == 'verified') {
                                                    $total = $payments['amount_paid'] + $payments['with_held'];
                                                    $grand_total = $grand_total + $total;
                                        }
                                       
                                    }
                                     $balance = $pending_quotation['Quotation']['grand_total'] - $grand_total;
                                     echo '&#8369; ' . number_format($balance, 2); 
                                    
                                    ?> 
                                </td> 
                                <td> 
                                    <button class="btn btn-info btn-icon add-tooltip view_quote" data-toggle="tooltip"  data-original-title="View Quotation?" data-viewquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>"><i class="fa fa-eye"></i> </button>
                                <!--<button class="btn btn-primary btn-icon add-tooltip print_quote" data-toggle="tooltip"  data-original-title="Print Quotation?" data-printquoteid="<?php echo $pending_quotation['Quotation']['id']; ?>"><i class="fa fa-print"></i> </button>-->
                                    <?php
                                    echo '  <a class="btn btn-success btn-icon add-tooltip addCollection" data-toggle="tooltip" href="#" data-original-title="Update Collection" data-idaddcollection="' . $pending_quotation['Quotation']['id'] . '" ><i class="fa fa-money"></i></a>';
                                    ?>
                                </td> 
                            </tr>
                        <?php } ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th align="center">Date Created</th> 
                            <th align="center">Type</th> 
                            <th align="center">Client</th>
                            <th align="center">Contract Amount</th>  
                            <th align="center">Balance</th>  
                            <th align="center"> </th> 
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
        $('.view_quote').each(function (index) {
            $(this).click(function () {
                var qid = $(this).data("viewquoteid");
                window.open("/quotations/view?id=" + qid, '_blank');
            });
        });


        $(".addCollection").each(function (index) {
            $(this).on("click", function () {
                var id = $(this).data('idaddcollection');
                window.location.replace("/collections/collect?id=" + id); 
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