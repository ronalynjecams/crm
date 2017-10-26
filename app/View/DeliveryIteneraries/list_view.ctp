


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
                                        } else {
                                            echo '<button class="btn btn-xs btn-primary add-tooltip update_departure" data-toggle="tooltip"  data-original-title="Update Departure" data-deptid="' . $data['DeliveryItenerary']['id'] . '" ><i class="fa fa-calendar"></i></button>';
                                        }
                                    } else if ($data['DeliveryItenerary']['delivery_mode'] == 'transportify') {
                                        if (!is_null($data['DeliveryItenerary']['booking_code'])) {
                                            echo $data['DeliveryItenerary']['booking_code'];
                                        } else {
                                            echo '<button class="btn btn-xs btn-info add-tooltip update_booking_code" data-toggle="tooltip"  data-original-title="Update Booking Code" ><i class="fa fa-book"></i></button>';
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (!is_null($data['DeliveryItenerary']['departure'])) {
                                        if (!is_null($data['DeliveryItenerary']['actual_start'])) {
                                            echo'<div class="col-md-6">';
                                            echo date('F d, Y', strtotime($data['DeliveryItenerary']['actual_start']));
                                            echo '<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['actual_start'])) . '</small>';
                                            echo'</div>';
                                            if (!is_null($data['DeliveryItenerary']['end_work'])) {
                                                echo'<div class="col-md-6">';
                                                echo ' to ';
                                                echo date('F d, Y', strtotime($data['DeliveryItenerary']['end_work']));
                                                echo '<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['end_work'])) . '</small>';
                                                echo'</div>';
                                            } else {
                                                echo'<div class="col-md-6">';
                                                echo '<button class="btn btn-xs btn-default update_end" data-toggle="tooltip"  data-original-title="Update end date" data-endid="' . $data['DeliveryItenerary']['id'] . '" data-buttontype="end"><i class="fa fa-calendar-plus-o"></i></button>';
                                                echo'</div>';
                                            }
                                        } else {
                                            
                                            //update actual start
                                            if( $data['DeliveryItenerary']['actual_start'] == "" ){
                                                echo '<button class="btn btn-xs btn-success update_actualstart" data-toggle="tooltip"  data-original-title="Update actual start date" data-actid="' . $data['DeliveryItenerary']['id'] . '" data-buttontype="start"><i class="fa fa-calendar-plus-o"></i></button>';
                                            }
                                        }
                                    } else {
                                        echo '<small>Waiting to depart</small>';
                                    }
                                    ?>  
                                </td> 
                                <td>
                                    
                                    
                                    <?php
                                    if ($data['DeliveryItenerary']['delivery_mode'] == 'jecams') {
                                        //change vehicle_id ( select vehicle , value should be brand - plate number)
                                        //change driver (query users, value of option should be first name and last name)
                                    } else if ($data['DeliveryItenerary']['delivery_mode'] == 'transportify') {
                                       //update booking code
                                    }
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
<!-- UPDATE MODAL ACTUAL START-->
<div class="modal fade" id="updateActualstart-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Actual Start</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                
                <input type="text" class="form-control"  id="actual_id">  
                <p class="text-danger" id="error_agent"></p>
                <div class="form-group"> 
                    <div class="col-sm-6">
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="actual_date"> 
                    </div>
                    <div class="col-sm-6"> 
                        <input type="time" value="<?php echo date('H:i:s'); ?>" class="form-control" id="actual_time">
                    </div>
                </div>

            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateActualBtn">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE MODAL ACTUAL START END-->



<!-- UPDATE MODAL  END-->
<div class="modal fade" id="updateEnd-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update End work</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                
                <input type="text" class="form-control"  id="end_id">  
                <p class="text-danger" id="error_agent"></p>
                <div class="form-group"> 
                    <div class="col-sm-6">
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="end_date"> 
                    </div>
                    <div class="col-sm-6"> 
                        <input type="time" value="<?php echo date('H:i:s'); ?>" class="form-control" id="end_time">
                    </div>
                </div>
                
                <div class="form-group">
                    <label>Status</label>
                    <select class="form-control" id="status">
                    <option value="none">Please select a status</option>
                    <option value="delivered">delivered</option>
                    <option value="cancelled">cancelled</option>
                    <option value="backjob">backjob</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Remarks</label>
                    <textarea id="remarks" row="40" class="form-control"></textarea>
                </div>
                
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateEndBtn">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE MODAL END-->



<!-- UPDATE MODAL DEPARTURE START-->
<div class="modal fade" id="updateDeparture-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Departure</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <input type="hidden" class="form-control"  id="dep_itenerary_id">  
                <p class="text-danger" id="error_agent"></p>
                <div class="form-group"> 
                    <div class="col-sm-6">
                        <input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="departure_date"> 
                    </div>
                    <div class="col-sm-6"> 
                        <input type="time" value="<?php echo date('H:i:s'); ?>" class="form-control" id="departure_time">
                    </div>

                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateDepartureBtn">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE MODAL DEPARTURE END-->

<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true

        });



        $(".update_departure").each(function (index) {
            $(this).on("click", function () {
                var id = $(this).data('deptid');
                $('#dep_itenerary_id').val(id);
                $('#updateDeparture-modal').modal('show');

            });
        });




        $(".update_end").each(function (index) {
            $(this).on("click", function () {
                var id = $(this).data('endid');
                
                $('#end_id').val(id);
                $('#updateEnd-modal').modal('show');

            });
        });
        
        $('#updateEndBtn').on("click", function () {
            var end_id = $('#end_id').val();
            var end_date = $('#end_date').val();
            var end_time = $('#end_time').val();
            var status = $('#status').val();
            var remarks = $('#remarks').val();

            if(( status != "none")){
                            var data = {
                                "end_id": end_id,
                                "end_date": end_date,
                                "end_time": end_time,
                                "status": status,
                                "remarks": remarks
                            }
                            
            $.ajax({
                url: "/delivery_iteneraries/process_update_end",
                type: 'POST',
                data: {'data': data},
                dataType: 'json',
                success: function (id) {
                    location.reload();
                },
                erorr: function (id) {
                    alert('error!');
                }
            });
            
            }else{
                alert('Please select a status')
            }
            
            
            
            
        });
        







        $(".update_actualstart").each(function (index) {
            $(this).on("click", function () {
                var id = $(this).data('actid');
                
                $('#actual_id').val(id);
                $('#updateActualstart-modal').modal('show');

            });
        });
        
        $('#updateActualBtn').on("click", function () {
            var actual_id = $('#actual_id').val();
            var actual_date = $('#actual_date').val();
            var actual_time = $('#actual_time').val();

            
                            var data = {
                                "actual_id": actual_id,
                                "actual_date": actual_date,
                                "actual_time": actual_time
   
                            }
                            
                            
            $.ajax({
                url: "/delivery_iteneraries/process_update_start",
                type: 'POST',
                data: {'data': data},
                dataType: 'json',
                success: function (id) {
                    location.reload();
                },
                erorr: function (id) {
                    alert('error!');
                }
            });
        });
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        

        $('#updateDepartureBtn').on("click", function () {
            var delivery_itenerary_id = $('#dep_itenerary_id').val();
            var departure_date = $('#departure_date').val();
            var departure_time = $('#departure_time').val();
            
            
                            var data = {"delivery_itenerary_id": delivery_itenerary_id,
                                "departure_date": departure_date,
                                "departure_time": departure_time 
                            }
                            
            $.ajax({
                url: "/delivery_iteneraries/process_update_departure",
                type: 'POST',
                data: {'data': data},
                dataType: 'json',
                success: function (id) {
                    location.reload();
                },
                erorr: function (id) {
                    alert('error!');
                }
            });
        });



    });


</script>