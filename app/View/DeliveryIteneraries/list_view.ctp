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
                <button class="btn btn-sm btn-success" id="import" data-toggle="tooltip"  data-original-title="Import Transportify Data" data-buttontype="start"><i class="fa fa-upload"></i> Import Transportify Data</button>
                <button class="btn btn-sm btn-primary" id="print_itenerary" data-toggle="tooltip"  data-original-title="Print Itenerary" data-buttontype="start"><i class="fa fa-book"></i> Retrieve Itenerary</button>
             
                </h3>  
            </div>
            <div class="panel-body">
               <div class="table-responsive">
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
                        <?php
                        foreach ($iteneraries as $data) { ?>
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
                                    // echo 'change driver or vehicle button here';
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
                                          //  echo '<button class="btn btn-xs btn-info add-tooltip update_booking_code" data-toggle="tooltip"  data-original-title="Update Booking Code" ><i class="fa fa-book"></i></button>';
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    if (!is_null($data['DeliveryItenerary']['departure'])) {
                                        if (!is_null($data['DeliveryItenerary']['actual_start'])) {
                                            echo'<div class="col-md-6">';
                                            echo time_elapsed_string($data['DeliveryItenerary']['actual_start']);
                                            echo '<br/><small>' . date('h:i a', strtotime($data['DeliveryItenerary']['actual_start'])) . '</small>';
                                            echo'</div>';
                                            if (!is_null($data['DeliveryItenerary']['end_work'])) {
                                                echo'<div class="col-md-6">';
                                                echo ' to ';
                                                echo time_elapsed_string($data['DeliveryItenerary']['end_work']);
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
                                    if($data['DeliveryItenerary']['status'] != "delivered"){
                                        if ($data['DeliveryItenerary']['delivery_mode'] == 'jecams') {
                                            echo '<button class="btn btn-xs btn-success update_vehicle" data-toggle="tooltip"  data-original-title="Change Vehicle" data-actid="' . $data['DeliveryItenerary']['id'] . '" data-buttontype="start"><i class="fa fa-car"></i> Change Vehicle</button>';
                                            echo '<button class="btn btn-xs btn-warning update_driver" data-toggle="tooltip"  data-original-title="Change Driver" data-actid="' . $data['DeliveryItenerary']['id'] . '" data-buttontype="start"><i class="fa fa-id-card-o"></i> Change Driver</button>';
                                            //add condition na kapag status != delivered
                                            //change vehicle_id ( select vehicle , value should be brand - plate number) 
                                            //change driver (query users, value of option should be first name and last name)
                                        } else if ($data['DeliveryItenerary']['delivery_mode'] == 'transportify') {
                                           echo '<button class="btn btn-xs btn-info update_booking_code" data-toggle="tooltip"  data-original-title="Update Booking Code" data-actid="' . $data['DeliveryItenerary']['id'] . '" data-code="' . $data['DeliveryItenerary']['booking_code'] . '" data-buttontype="start"><i class="fa fa-cog"></i> Change Booking Code</button>';
                                            ?>
                                            <button class="btn btn-xs btn-primary add_booking_code" data-toggle="tooltip"  data-original-title="Add Booking Code" data-det='<?php echo json_encode($data['DeliveryItenerary']);?>' data-buttontype="start"><i class="fa fa-plus"></i> Add Booking Code</button>
                                            <?php
                                            
                                        }
                                    }
                                //   echo  $data['DeliveryItenerary']['delivery_mode'];
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
                
                <input type="hidden" class="form-control"  id="actual_id">  
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
                <p class="text-danger">Updating this will affect status of all products in this itenerary.</p>
                <input type="hidden" class="form-control"  id="end_id">  
                <p class="text-danger" id="error_agent"></p>
                <div class="form-group row"> 
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

<!-- UPDATE MODAL VEHICLE START-->
<div class="modal fade" id="updateVehicle-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Change Vehicle</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <input type="hidden" class="form-control"  id="del_itenerary_id">  
                <p class="text-danger" id="error_agent"></p>
                <div class="form-group"> 
                    <div class="col-sm-12">
                        <select class="form-control" id="vehicle">
                            <option value="none">Select Vehicle</option>
                            <?php foreach($vehicles as $vehicle){ ?>
                            <option value="<?php echo $vehicle['Vehicle']['id'];?>"><?php echo $vehicle['Vehicle']['brand'].' - '.$vehicle['Vehicle']['plate_number'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateVehicleBtn">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE MODAL VEHICLE END-->    

<!-- UPDATE MODAL DRIVER START-->
<div class="modal fade" id="updateDriver-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Change Driver</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <input type="hidden" class="form-control"  id="del_itenerary_id">  
                <p class="text-danger" id="error_agent"></p>
                <div class="form-group"> 
                    <div class="col-sm-12">
                        <select class="form-control" id="driver">
                            <option value="none">Select Driver</option>
                            <?php foreach($drivers as $user){ ?>
                            <option value="<?php echo $user['User']['first_name'].' '.$user['User']['last_name'];?>"><?php echo $user['User']['first_name'].' '.$user['User']['last_name'];?></option>
                            <?php } ?>
                        </select>
                    </div>

                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateDriverBtn">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE MODAL DRIVER END-->    

<!-- UPDATE MODAL DRIVER START-->
<div class="modal fade" id="updateBookingCode-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Booking Code</h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <input type="hidden" class="form-control"  id="del_itenerary_id">  
                <p class="text-danger" id="error_agent"></p>
                <div class="form-group"> 
                    <div class="col-sm-12">
                         <input type="number" class="form-control" id="booking_code">
                    </div>

                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="updateBookingCodeBtn">Update</button>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE MODAL DRIVER END-->  

<!-- UPDATE MODAL DRIVER START-->
<div class="modal fade" id="import-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <form action="/delivery_iteneraries/import" method="post" enctype="multipart/form-data" name="form1" id="form1">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Import Transportify Data</h4>
            </div>
            <!--Modal body--> 
            <div class="modal-body">
                <!--<input type="hidden" class="form-control"  id="del_itenerary_id">  -->
                <div class="form-group"> 
                    <div class="col-sm-12">
                        <p class="text-danger" id="error_agent"></p>
                        <p class="text-danger" id="error_agent">Note: Save excel file as .csv file  before uploading.</p>
                        Choose your file: <br /> 
                        <input type="file" name="file" class="form-control" />
                        <input type="hidden" name="status" value="<?php echo $status; ?>" class="form-control" />
                                        <!--<input type="text" name="name" />-->
                    </div>

                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <input type="submit" value="Import" class="btn btn-primary "type="button" />
            </div>
            </form>
        </div>
    </div>
</div>
<!-- UPDATE MODAL DRIVER END-->  

<!--Date Range Modal Start-->
<!--===================================================-->
<div class="modal fade" id="print-itenerary-modal" role="dialog" tabindex="-1"
     aria-labelledby="date-range-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			    <i class="pci-cross pci-circle"></i>
			  </button>
			  <h4 class="modal-title">
		          Select Date Range for Itenerary
	          </h4>
			</div>
			<!--Modal body-->
			<div class="modal-body">  
				<div class="row">
					<div class="col-lg-6">
						<div class="form-group">
							Start Date
							<input type="date" class="form-control" id="start_date" />
						</div>
					</div>
					<div class="col-lg-6">
						<div class="form-group">
							End Date
							<input type="date" class="form-control" id="end_date" />
						</div>
					</div> 
					<div class="col-lg-6">
						<div class="form-group">
							Select Type
							<select class="form-control" id="itenerary_type">
							    <option value="all">ALL</option>
							    <option value="per_driver">Per Driver</option>
							</select>
						</div>
					</div> 
					<div class="col-lg-6" id="itenerary_driver_div">
						<div class="form-group">
							Select Driver
							<select class="form-control" id="itenerary_driver">
                            <option value="">Select Driver</option>
                            <?php foreach($drivers as $user){ ?>
                            <option value="<?php echo $user['User']['first_name'].' '.$user['User']['last_name'];?>"><?php echo $user['User']['first_name'].' '.$user['User']['last_name'];?></option>
                            <?php } ?>
							</select>
						</div>
					</div> 
					
					
			<div id="print_itenerary_error"></div>
				</div>
			</div> 
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-primary" id="btn_print_itenerary">Submit</button>
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
<!--Date Range Modal End-->      
<script>
    $(document).ready(function () {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true

        });
        
        $('#itenerary_driver_div').hide();


        $(".update_departure").each(function (index) {
            $(this).on("click", function () {
                var id = $(this).data('deptid');
                $('#dep_itenerary_id').val(id);
                $('#updateDeparture-modal').modal('show');

            });
        });

        $(".update_vehicle").each(function (index) {
            $(this).on("click", function () {
                var id = $(this).data('actid');
                $('#del_itenerary_id').val(id);
                $('#updateVehicle-modal').modal('show');

            });
        });
        
        $(".update_driver").each(function (index) {
            $(this).on("click", function () {
                var id = $(this).data('actid');
                $('#del_itenerary_id').val(id);
                $('#updateDriver-modal').modal('show');

            });
        });

        $(".update_booking_code").each(function (index) {
            $(this).on("click", function () {
                var id = $(this).data('actid');
                var booking_code = $(this).data('code');
                $('#del_itenerary_id').val(id);
                $('#booking_code').val(booking_code);
                $('#updateBookingCode-modal').modal('show');

            });
        });
        
        $(".add_booking_code").each(function (index) {
            $(this).on("click", function () {
                var det = $(this).data('det');
                $('#delivery_itenerary').val(det);
                console.log(det);
                swal({
                    title: "Are you sure?",
                    text: "This will create duplicae of current delivery schedule it cannot be undone.",
                    type: "warning",
                    showCancelButton: true,
    	            confirmButtonClass: "btn-danger",
    	            confirmButtonText: "Yes",
    	            cancelButtonText: "No",
    	            closeOnConfirm: true,
    	            closeOnCancel: true
                },
                function(isConfirm) {
                    if(isConfirm) {
                        var data = {"det": det};
                        $.ajax({
                           url: "/delivery_iteneraries/create_duplicate",
                           type: "POST",
                           data: {"data": data},
                           dataType: "text",
                           success: function(success) {
                               console.log("Succes: "+success);
                               swal({
                                   title: "Success!",
                                   text: "Successfull..",
                                   type: "success"
                               },
                               function(isConfirm1) {
                                   if(isConfirm1) {
                                       location.reload();
                                   }
                               });
                           },
                           error: function(error) {
                               console.log("Error: "+JSON.stringify(error));
                               swal({
                                  title: "Oops!",
                                  text: "An error occured. Please try again.",
                                  type: "warning"
                               });
                           }
                        });
                    }
                });
                // console.log(JSON.parse( det ));

            });
        });
        
        $("#import").on("click", function () { 
                $('#import-modal').modal('show'); 
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
            var demodata = {"id": end_id};
            if(( status != "none")) {
                if(status=="delivered") {
                    $.ajax({
                        url: "/delivery_iteneraries/update_demo",
                        type: "POST",
                        data: {"data": demodata},
                        dataType: "text",
                        success: function(success) {
                            console.log(success);
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
                                dataType: 'text',
                                success: function (success) {
                                    console.log(success);
                                    location.reload();
                                },
                                erorr: function (error) {
                                    console.log(error);
                                    swal({
                                        title: "Oops!",
                                        text: "An error occured. Please try again later.",
                                        type: "warning"
                                    });
                                }
                            });
                        },
                        error: function(error) {
                            console.log(error);
                            swal({
                                title: "Oops!",
                                text: "An error occured. Please try again later.",
                                type: "warning"
                            });
                        }
                    });
                }
                else {
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
                        dataType: 'text',
                        success: function (success) {
                            console.log(success);
                            location.reload();
                        },
                        erorr: function (error) {
                            console.log(error);
                            swal({
                                title: "Oops!",
                                text: "An error occured. Please try again later.",
                                type: "warning"
                            });
                        }
                    });
                }
            }else{
                swal({
                    title: "Status is empty!",
                    text: "Please select status and try again.",
                    type: "warning"
                });
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
        
        $('#updateVehicleBtn').on("click", function () {
            var del_itenerary_id= $('#del_itenerary_id').val();
            var vehicle = $('#vehicle').val();
            
            var data = {
                "del_itenerary_id": del_itenerary_id,
                "vehicle": vehicle
            }
            if(vehicle !== 'none'){     
                $.ajax({
                    url: "/delivery_iteneraries/process_update_vehicle",
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
            } else{
                alert('Please select vehicle');
            }
        });
        
        $('#updateDriverBtn').on("click", function () {
            var del_itenerary_id= $('#del_itenerary_id').val();
            var driver = $('#driver').val();
            
            var data = {
                "del_itenerary_id": del_itenerary_id,
                "driver": driver
            }
            if(driver !== 'none'){     
                $.ajax({
                    url: "/delivery_iteneraries/process_update_driver",
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
            } else{
                alert('Please select driver');
            }
        });
        
        $('#updateBookingCodeBtn').on("click", function () {
            var del_itenerary_id= $('#del_itenerary_id').val();
            var booking_code = $('#booking_code').val();
            
            var data = {
                "del_itenerary_id": del_itenerary_id,
                "booking_code": booking_code
            }
            if(booking_code !== ''){     
                $.ajax({
                    url: "/delivery_iteneraries/process_update_bookingcode",
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
            } else{
                alert('Please provide booking code');
            }
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


        $("#print_itenerary").on("click", function () { 
                $('#print-itenerary-modal').modal('show'); 
        });

                $("#itenerary_type").change(function () {
                    var itenerary_type = $("#itenerary_type").val();
                    if(itenerary_type == 'per_driver'){
                        $('#itenerary_driver_div').show();
                    }else{
                        $('#itenerary_driver_div').hide();
                    }
                });
                
                
        $("#btn_print_itenerary").on("click", function () { 
            $( "#print_itenerary_error_added" ).remove();
            var end_date = $('#end_date').val();
            var start_date = $('#start_date').val();
            var itenerary_type = $("#itenerary_type").val();
            var itenerary_driver = $("#itenerary_driver").val();
            
            
            if (start_date==="" || end_date===""){
                $( "#print_itenerary_error" ).append('<div class="col-sm-12" id="print_itenerary_error_added"><p class="text-danger">Date Could not be empty</p></div>');
            } else if((new Date(start_date).getTime() > new Date(end_date).getTime())) { 
                // print_itenerary_error
                $( "#print_itenerary_error" ).append('<div class="col-sm-12"  id="print_itenerary_error_added"><p class="text-danger">Invalid Date Range</p></div>');
            }else{
                if(itenerary_type === 'per_driver'){
                    //check if huser has selected driver
                    if(itenerary_driver===""){
                        $( "#print_itenerary_error" ).append('<div class="col-sm-12"  id="print_itenerary_error_added"><p class="text-danger">Please Select Driver</p></div>');
                    }else{
                        window.open("/pdfs/print_delivery_itenerary?start_date="+start_date+"&&end_date="+end_date+"&&type="+itenerary_type+"&&driver_id="+itenerary_driver, '_blank');
                    }
                }else{
                        window.open("/pdfs/print_delivery_itenerary?start_date="+start_date+"&&end_date="+end_date+"&&type="+itenerary_type+"&&driver_id=0", '_blank');
                  
                }
            }
            // window.open("/pdfs/print_delivery_itenerary?start_date="+start_date+"&&end_date="+end_date, '_blank');
        });
         
        function processupdateend(data) {
            $.ajax({
                url: "/delivery_iteneraries/process_update_end",
                type: 'POST',
                data: {'data': data},
                dataType: 'text',
                success: function (success) {
                    console.log(success);
                    location.reload();
                },
                erorr: function (error) {
                    console.log(error);
                    swal({
                        title: "Oops!",
                        text: "An error occured. Please try again later.",
                        type: "warning"
                    });
                }
            });
        }
</script>