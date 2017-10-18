

<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<script src="../plugins/select2/js/select2.min.js"></script>
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<link href="../css/sweetalert.css" rel="stylesheet">
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

                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>DR Number</th> 
                            <th>Delivery Date [Time]</th>  
                            <th>Client</th>
                            <th>Agent</th>
                            <th></th>  
                        </tr>
                    </thead> 
                    <tbody>  
                        <?php foreach ($arr as $data) { ?>
                            <tr>
                                <td>
                                    <?php echo 'DR-'.$data['DeliverySchedule']['dr_number']; ?> 
                                </td> 
                                <td>
                                    <?php
                                    echo date('F d, Y', strtotime($data['DeliverySchedule']['delivery_date']));
                                    echo '   [' . date('h:i a', strtotime($data['DeliverySchedule']['delivery_time'])) . ''
                                            . ']';
                                    ?>  
                                </td>  
                                <td><?php echo $data['Quotation']['Client']['name']; ?></td>
                                <td><?php echo $data['Quotation']['User']['first_name'].'  '.$data['Quotation']['User']['last_name']; ?></td>
                                <td>
                                    <!--<a href="/delivery_sched_products/process?id=<?php echo $data['DeliverySchedule']['id']; ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>-->
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



<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
            
        });
    });
</script>
