

<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<link href="/css/sweetalert.css" rel="stylesheet">
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
        <h1 class="page-header text-overflow">  Delivery Receipts </h1>
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
                            <th>Delivery Date [Time]</th>  
                            <th>DR Number</th> 
                            <th>Client</th>
                            <th>Agent</th>
                            <th></th>  
                        </tr>
                    </thead> 
                    <tbody>  
                        <?php foreach ($arr as $data) {
                        $delivery_schedule_id = $data['DeliverySchedule']['id'];
                        ?>
                            <tr>
                                <td>
                                    <?php
                                    echo date('F d, Y', strtotime($data['DeliverySchedule']['delivery_date']));
                                    echo '   [' . date('h:i a', strtotime($data['DeliverySchedule']['delivery_time'])) . ''
                                            . ']';
                                    ?>  
                                </td>  
                                <td>
                                    <?php echo 'DR-'.$data['DeliverySchedule']['dr_number']; ?> 
                                </td> 
                                <td><?php 
                                echo $data['DeliverySchedule']['deliver_to']; 
                                if($data['DeliverySchedule']['reference_type'] == 'quotation'){
                                    echo '    <a href="/quotations/view?id='.$data['DeliverySchedule']['reference_number'].'" target="_blank" class="btn btn-info btn-icon add-tooltip btn-xs" data-toggle="tooltip" data-original-title="View Quotation?"  ><i class="fa fa-eye"></i> </a>
                                       ';
                                }
                                ?></td>
                                <td><?php echo $data['User']['first_name'].'  '.$data['User']['last_name']; ?></td>
                                <td id="td_action">
                                    <a href="/pdfs/print_agent_notes?id=<?php echo $data['DeliverySchedule']['id']; ?>"
                                       target="_blank"
                                       class="btn btn-danger add-tooltip"
                                       data-toggle="tooltip"
                                       data-original-title="Print Agent Notes">
                                        <span class="fa fa-print"></span>
                                    </a>
                                    
                                    <?php
                                    $grand_total = $quotations_grand_totals[$delivery_schedule_id];
                                    if(array_key_exists($delivery_schedule_id, $quotations_grand_totals)) {
                                        if($grand_total >= 100000) { ?>
                                            <a href="/reports/print_certificate_completion?id=<?php echo $delivery_schedule_id; ?>"
                                               target="_blank"
                                               class="btn btn-default add-tooltip"
                                               data-toggle="tooltip"
                                               data-original-title="Print Certificate of Completion">
                                                <span class="fa fa-certificate text-warning"></span>
                                            </a>
                                    <?php }
                                    } ?>
                                    
                                    <a href="https://google.com/maps"
                                       target="_blank"
                                       class="btn btn-success add-tooltip"
                                       data-toggle="tooltip"
                                       data-original-title="Go to Address">
                                        <span class="fa fa-crosshairs"></span>
                                    </a> <!-- BETA NO FUNCTION YET --> 
                                    <a href="/pdfs/print_dr?id=<?php echo $data['DeliverySchedule']['id']; ?>" target="_blank" class="btn btn-primary add-tooltip" data-toggle="tooltip"  data-original-title="Print DR" ><i class="fa fa-print"></i></a>
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
</script>
