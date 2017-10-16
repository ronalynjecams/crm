


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
        <h1 class="page-header text-overflow"><?php echo ucwords($status); ?> Delivery Itenerary</h1>
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
                            <th>Expected Delivery Date</th> 
                            <th>Client</th>  
                            <th>Delivery Mode </th> <!--jecams or transportify-->
                            <th>Vehicle - Driver</th>
                            <th>Departure - Arrival</th>
                            <th>Actual Work - End Work</th>
                            <th></th>  
                        </tr>
                    </thead> 
                    <tbody>
                        <?php foreach ($iteneraries as $data) { ?>
                            <tr>
                                <td>
                                    <?php
                                    echo date('F d, Y', strtotime($data['DeliveryItenerary']['expected_start']));
                                    echo '<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['expected_start'])) . '</small>';
                                    ?>  
                                </td> 
                                <td>
                                    <?php
                                    echo $data['Client']['name'];
                                    ?>  
                                </td>  
                                <td><?php echo $data['DeliveryItenerary']['delivery_mode']; ?></td>
                                <td>
                                    <?php
                                    if ($data['DeliveryItenerary']['delivery_mode'] == 'jecams') {
                                        echo $data['Vehicle']['plate_number'] . ' - ';
                                    } else if ($data['DeliveryItenerary']['delivery_mode'] == 'transportify') {
                                        
                                    }

                                    echo $data['DeliveryItenerary']['driver'];
                                    echo 'change driver or vehicle';
                                    ?>
                                </td>
                                <td>
                                <?php 
                                    if ($data['DeliveryItenerary']['delivery_mode'] == 'jecams') {
                                    if (!is_null($data['DeliveryItenerary']['departure'])) {
                                            echo date('F d, Y', strtotime($data['DeliveryItenerary']['departure']));
                                            echo '<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['departure'])) . '</small>';
                                            //arrival here 
                                    }else{
                                        echo '<button class="btn btn-xs btn-primary add-tooltip" data-toggle="tooltip"  data-original-title="Update Departure" ><i class="fa fa-calendar"></i></button>';                                        
                                    }
                                    } else if ($data['DeliveryItenerary']['delivery_mode'] == 'transportify') {
//                                        if(!is_null($data['DeliveryItenerary']['booling_code']))
                                    }
                                ?>
                                </td>
                                <td>
                                    <?php
                                    if (!is_null($data['DeliveryItenerary']['departure'])) {
                                        if (!is_null($data['DeliveryItenerary']['actual_start'])) {
                                            echo date('F d, Y', strtotime($data['DeliveryItenerary']['actual_start']));
                                            echo '<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['actual_start'])) . '</small>';

                                            if (!is_null($data['DeliveryItenerary']['end_work'])) {
                                                echo ' to ';
                                                echo date('F d, Y', strtotime($data['DeliveryItenerary']['end_work']));
                                                echo '<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['end_work'])) . '</small>';
                                            } else {
                                                echo '<button class="btn btn-xs btn-primary"><i class="fa fa-calendar-check-o"></i></button>';
                                            }
                                        } else {
                                            //update actual
                                                echo '<button class="btn btn-xs btn-primary"><i class="fa fa-calendar-plus-o"></i></button>';
                                        }
                                    } else {
                                        echo '<small>Waiting to depart</small>';
                                    }
                                    ?>  
                                </td> 
                                <td></td>
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