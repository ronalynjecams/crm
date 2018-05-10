<?php
$is_authorized=false;
$authorized_users = ['sales_executive', 'sales_manager',
					 'proprietor', 'logistics_head',
					 'sales_coordinator'];
foreach($authorized_users as $authorized_user) {
	if($authorized_user==$user_role) {
		$is_authorized=true;
	}
}

if($is_authorized) {
?>

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--SWEET ALERT-->
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script>

<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow">Delivery Schedules</h1>
	</div>
	
	<div id="page-content">
		<div class="panel">
			<div class="panel-body">
                <div class="table-responsive">
	                <table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
	                        <tr>
	                            <th>Delivery Date [Time]</th>  
	                            <th>DR Number</th>
	                            <th>Client</th>
	                           	<?php
	                           	// if($UserIn['User']['role']!='sales_executive') {
		                           // echo '<th>Agent</th>';
	                           	// }
	                           	// else { echo '<th>Status</th>'; }
	                        	?>
	                        	<th>Status</th>
	                        	<th>Agent</th>
	                        	<th>Notes</th>
	                        	<th>Action</th>
	                        </tr>
	                    </thead>
	                    <tbody>
	                    	<?php
	                    	foreach($deliverySchedules as $ret_delSched) {
	                    		$DeliverySchedule = $ret_delSched['DeliverySchedule'];
	                    		$User = $ret_delSched['User'];
	                    		$first_name = $User['first_name'];
	                    		$last_name = $User['last_name'];
	                    		$full_name_tmp = ucwords($first_name." ".$last_name);
	                    		$id = $DeliverySchedule['id'];
	                    		$user_id = $DeliverySchedule['user_id'];
	                    		$status_tmp = ucwords($DeliverySchedule['status']);
	                    		$deliver_to_tmp = $DeliverySchedule['deliver_to'];
	                    		$delivery_date_tmp = $DeliverySchedule['delivery_date'];
	                    		$delivery_time_tmp = $DeliverySchedule['delivery_time'];
                    		    $dr_number_tmp = $DeliverySchedule['dr_number'];
	                    		$note = $DeliverySchedule['agent_note'];

	                    		if($delivery_date_tmp!=null || $delivery_date_tmp!=""
	                    		   || $delivery_date_tmp!="0000-00-00") {
	                    			$delivery_date = time_elapsed_string($delivery_date_tmp);  	
                    		    }
                    		    else {
                    		    	$delivery_date = "<p class='text-danger'>Not Specified</p>";
                    		    }
                    		    
                    		    if($dr_number_tmp!="" || $dr_number_tmp!=null) {
                    		    	$dr_number = "DR-".$dr_number_tmp;
                    		    }
                    		    else {
                    		    	$dr_number = "<p class='text-danger'>Unknown</p>";
                    		    }
                    		    
                    		    if($user_id!=0) {
	                    		    if($full_name_tmp!="" || $full_name_tmp!=null) {
	                    		    	$full_name = $full_name_tmp;
	                    		    }
	                    		    else {
	                    		    	$full_name = "<p class='text-danger'>Unknown</p>";
	                    		    }
                    		    }
                    		    else {
                    		    	$full_name = "<p class='text-danger'>Unknown</p>";
                    		    }
                    		    
                    		    if($deliver_to_tmp!="" || $deliver_to_tmp!=null) {
                    		    	$deliver_to = ucwords($deliver_to_tmp);
                    		    }
                    		    else {
                    		    	$deliver_to = "<p class='text-danger'>Unknown</p>";
                    		    }
                    		    
                    		    if($delivery_time_tmp!=""
                    		       || $delivery_time_tmp!=null) {
                    		       	$formatted_deltime = date("h:i a", strtotime($delivery_time_tmp));
									$delivery_time = " <small>[ ".$formatted_deltime." ]</small>";
                		        }
                		        else {
                		        	$delivery_time = "";
                		        }
                		        
                		        $delivery_datetime_tmp = $delivery_date." ".$delivery_time;
                		        
                		        if($delivery_datetime_tmp!=" ") {
                		        	$delivery_datetime = $delivery_datetime_tmp;
                		        }
                		        else {
                		        	$delivery_datetime = "<p class='text-danger'>Not Specified</p>";
                		        }
                		        
                		        if($status_tmp!="" || $status_tmp!=null) {
                		        	$status = $status_tmp;
                		        }
                		        else { $status = "<p class='text-danger'>Unknown</p>"; }
                    			
                    			$cancel_button = '';
                    			if($status=="Pending") {
                    				$cancel_button = "
                    					<button class='btn btn-danger btn-xs'
                    							id='btn_cancel'
                    							data-toggle='tooltip'
                    							data-placement='top'
                    							title='Cancel'
                    							value='".$id."'>
                    						<span class='fa fa-close'></span>
                    					</button>
                    				";
                    			}
                    			
                				echo '
                    			<tr>
                    				<td>'.$delivery_datetime.'</td>
                    				<td>'.$dr_number.'</td>
                    				<td>'.$deliver_to.'</td>
                    				<td>'.$full_name.'</td>
                    				<td>
                    					<div class="col-lg-6">'.$status.'</div>
                    					<div class="col-lg-6" align="right">
                    						'.$cancel_button.'
                    					</div>
                    				</td>
                    				<td>'.$note.'</td>
                    				<td></td>
                    			</tr>
                    			';
	                    	}
	                    	?>
	                    </tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!--JAVASCRIPT FUNCTIONS-->
<script type="text/javascript">
	$(document).ready(function() {
		$("[data-toggle='tooltip']").tooltip();
		
		$('#example').DataTable({
	        "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
	        "orderable": true,
	        "order": [[0,"desc"]],
	        "stateSave": false
	    });
	    
	    $("button#btn_cancel").on('click', function() {
	    	var del_sched_id = $(this).val();
	    	swal({
                title: "Are you sure?",
                text: "This will cancel Delivery Schedule.",
                type: "warning",
                showCancelButton: true,
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Yes",
                cancelButtonText: "No",
                closeOnConfirm: false,
                closeOnCancel: true
            },
            function (isConfirm) {
                if (isConfirm) {
                    var data = {'delivery_schedule_id': del_sched_id};
                    $.ajax({
                        url: '/delivery_schedules/cancel_delivery_schedule',
                        type: 'POST',
						data: {'data': data},
						dataType: 'text',
						success: function(id) {
							console.log(id);
							location.reload();
						},
						error: function(err) {
							console.log("AJAX error: " + JSON.stringify(err, null, 2));
							swal({
				                title: "Oops!",
				                text: "There was an error in cancelling delivery schedule.\n"+
				                	  "Please try again.",
				                type: "warning"
							});
						}
                    });
                }
            });
	    });
	});
</script>
<!--END OF JAVASCRIPT FUNCTIONS-->

<?php
}
else {
	echo '
		<div id="content-container">
			<div id="page-content">
				Access Denied. Restricted Area.
			</div>
		</div>
	';
}
?>