

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
        <h1 class="page-header text-overflow"><?php if($status == 'ongoing') echo 'Pending';  else echo ucwords($status); ?> Delivery Schedules</h1>
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
                            <th>Date of Request</th> 
                            <th>Delivery Date [Time]</th>  
                            <th>Deliver To</th>
                            <th>Requested By</th>
                            <th>Action</th>  
                        </tr>
                    </thead> 
                    <tbody>
                        <?php foreach ($arr as $data) { ?>
                            <tr>
                                <td data-order="<?php echo $data['DeliverySchedule']['created']; ?>">
                                    <?php
                                    echo time_elapsed_string($data['DeliverySchedule']['created']);
                                    echo '<br/><small>' . date('h:i a', strtotime($data['DeliverySchedule']['created'])) . '</small>';
                                    ?>  
                                </td> 
                                <td>
                                    <?php
                                    echo date('F d, Y', strtotime($data['DeliverySchedule']['delivery_date']));
                                    echo '   [' . date('h:i a', strtotime($data['DeliverySchedule']['delivery_time'])) . ''
                                            . ']';
                                    ?>  
                                </td>  
                                <td><?php echo $data['DeliverySchedule']['deliver_to']; ?></td>
                                <td><?php echo $data['User']['first_name'].'  '.$data['User']['last_name']; ?></td>
                                <td>
                                    <?php 
                                    if($data['DeliverySchedule']['type'] == 'dr' ||
                                       $data['DeliverySchedule']['type'] == 'demo' ||
                                       $data['DeliverySchedule']['type'] == 'pull_out'){
                                       echo '<a href="/delivery_sched_products/process?id='.$data['DeliverySchedule']['id'].'" class="btn btn-primary"><i class="fa fa-eye"></i></a>'; 
                                    }
                                    
                                    if($data['DeliverySchedule']['status']== 'approved'){
                                        echo '&nbsp; <a href="/delivery_iteneraries/new_itenerary?type='.$data['DeliverySchedule']['type'].'&&id='.$data['DeliverySchedule']['id'].'" class="btn btn-dark  add-tooltip "data-toggle="tooltip"  data-original-title="Schedule Itenerary" ><i class="fa fa-calendar"></i></a>'; 
                                    }
                                    
                                    if($data['DeliverySchedule']['status']== 'scheduled'){
                                    //   echo 'scheduled';
                                        // echo '&nbsp; <a href="/delivery_iteneraries/new_itenerary?type='.$data['DeliverySchedule']['type'].'&&id='.$data['DeliverySchedule']['id'].'" class="btn btn-dark  add-tooltip "data-toggle="tooltip"  data-original-title="Update Departure" ><i class="fa fa-edit"></i></a>'; 
                                    }
                                    ?>
                                    
<!--                                    if status == approved
                                    pwede nya iset ang schedule-->
                                    
                                
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
            "order": [[0, "desc"]],
            "stateSave": true
        });
    });
</script>