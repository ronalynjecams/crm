<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<script src="../plugins/select2/js/select2.min.js"></script>

<!--SWEET ALERT-->
<link href="../css/sweetalert.css" rel="stylesheet">
<script src="../js/sweetalert.min.js"></script>

<!--TABLE-->
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--CONTENT-->
<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
            Production Detail for 
            <?php
                if(!empty($production['Product'])) {
                    echo $production['Product']['name'];
                }
                else {
                    echo 'UNKNOWN';
                }
            ?>
        </h1>
    </div>
    
    <div id="page-content">
        <?php
        if(!empty($production_processes)) {
            // echo json_encode($QuotationProductProperty).'<br/><br/>';
            // echo json_encode($production['JrProduct']).'<br/><br/><br/><br/>';
            // echo json_encode($production_processes).'<br/><br/><br/><br/>';
            
            $jrprodid = 0;
            $jrprod = $production['JrProduct'];
            $jrprodid = $jrprod['id'];
            $production_process_id = 0;
            $production_id = $production['Product']['id'];
            
            foreach($production_processes as $production_process) {
                $production = $production_process['Production'];
                $ProductionProcess = $production_process['ProductionProcess'];
                $ProductionSection = $production_process['ProductionSection'];
                $productioncarpenter_obj = $production_process['ProductionCarpenter'];
                
                $production_process_id = $ProductionProcess['id'];
                $production_client_id = $production['client_id'];
                $client_name = ucwords($client[$production_client_id]['Client']['name']);
                $sales_executive_name = ucwords($sales_executive['User']['first_name'].
                    " ".$sales_executive['User']['last_name']);
                $designer_name = ucwords($designer['User']['first_name']." ".$designer['User']['last_name']);
                $section_head_name = ucwords($section_head['User']['first_name']." ".$section_head['User']['last_name']);
                $target_delivery = date("F d, Y", strtotime($sales_executive['Quotation']['target_delivery']));
                $ProductionSection_name = ucwords($ProductionSection['name']);
                $expected_start_tmp = date("F d, Y", strtotime($ProductionProcess['expected_start']));
                $expected_end_tmp = date("F d, Y", strtotime($ProductionProcess['expected_end']));
                $start_tmp = date("F d, Y", strtotime($ProductionProcess['start_work']));
                $end_tmp = date("F d, Y", strtotime($ProductionProcess['end_work']));
                
                if($ProductionProcess['expected_start']==null) { $expected_start = "Date is not specified"; }
                else { $expected_start = $expected_start_tmp; }
                
                if($ProductionProcess['expected_end']==null) { $expected_end = "Date is not specified"; }
                else { $expected_end = $expected_end_tmp; }
                
                if($ProductionProcess['start_work']==null) { $start = "Date is not specified"; }
                else { $start = $start_tmp; }
                
                if($ProductionProcess['end_work']==null) { $end = "Date is not specified"; }
                else { $end = $end_tmp; }
                
        ?>
        <div class="panel">
            <div class="panel-body">
                <p style="font-weight:bold;">Production Details</p>
                <div class="col-lg-12">
                    <div class="col-lg-6">
                        <p>Client: <?php echo $client_name ?></p>
                        <p>Sales Executive: <?php echo $sales_executive_name; ?></p>
                    </div>
                    <div class="col-lg-6">
                        <p>Target Delivery: <?php echo $target_delivery; ?></p>
                        <p>Designer: <?php echo $designer_name; ?></p>
                    </div>
                </div>
                
                <?php
                if(!empty($QuotationProductProperty)) {
                ?>
                <div style="margin-top:40px;">
                    <p style="font-weight:bold;">Product Property</p>
                    <?php
                    foreach($QuotationProductProperty as $qprod_prop_obj) {
                        $qprod_prop = $qprod_prop_obj['QuotationProductProperty'];
                        $prop = ucwords($qprod_prop['property']);
                        $val = ucwords($qprod_prop['value']);
                    ?>
                        <div class="col-lg-6">
                            <?php echo $prop; ?>
                        </div>
                        <div class="col-lg-6">
                            <?php echo $val; ?>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
        
        <div class="panel">
            <div class="panel-body">
                <p style="font-weight:bold;">Processes</p>
                <div class="col-lg-12">
                    <div class="col-lg-6">
                        <p><?php echo $ProductionSection_name; ?></p>
                        <div class="col-lg-12" style="margin-top:20px;">
                            <p>Expected Start: <?php echo $expected_start; ?></p>
                            <p>Actual Start: <?php echo $start; ?></p>
                            <p>Section Head: <?php echo $section_head_name; ?></p>
                        </div>
                    </div>
                    <div class="col-lg-6" align="right">
                        <?php
                        if($UserIn['User']['role']=="production_head" ||
                           $UserIn['User']['role']=="production_manager_assistant" ||
                           $UserIn['User']['role']=="production_section_head") {
                            echo '<button class="btn btn-mint"
                                    id="btn_add_worker">
                                <span class="fa fa-plus"></span>
                                Add Worker
                            </button>';
                           }
                        ?>
                        <div style="margin-top:20px;">
                            <p>Expected End: <?php echo $expected_end; ?></p>
                            <p>Actual End: <?php echo $end; ?></p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-12" style="margin-top:20px;">
                    <p style="font-weight:bold;"><span class="fa fa-circle"></span> Workers </p>
                    
                    <?php
                    $count = 0;
                    foreach($ProductionCarpenter as $carpenters) {
                            $count++;
			                $carpenter = $carpenters['ProductionCarpenter'];
			                $carpenter_id = $carpenter['id'];
			                $user = $carpenters['User'];
			                $carpenter_name = ucwords($user['first_name']." ".$user['last_name']);
			                $carpenter_qty = $carpenter['qty_assigned'];
			                $carpstatus = ucwords($carpenter['status']);
                    ?>
                    <p>
                        <?php
                        echo "( ".$count." ) ".$carpenter_name." - ".
                             $carpenter_qty."&nbsp;&nbsp;";
                        
                        if($carpstatus=="Pending") {
                            echo '<button class="btn btn-info btn-xs" id="btn_start"
                                   value="'.$carpenter_id.'">Start</button>';
                        }
                        else if($carpstatus=="Ongoing") {
                            echo '<button class="btn btn-danger btn-xs"
                                   id="btn_accomplish"
                                   value="'.$carpenter_id.'">Accomplish</button>';
                        }
                        
                        if($carpstatus!="Accomplished") { ?>
                            <button class="btn btn-xs btn-danger"
                                id="btn_del_section_head"
                                data-toggle="tooltip"
                                data-placement="top"
                                title="Delete"
                                value="<?php echo $carpenter_id; ?>">
                                <span class="fa fa-close"></span>
                            </button>
                        <?php } ?>
                    </p>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <div class="panel">
            <div class="panel-body" align="center">
                <button class="btn btn-info"
                        id="btn_attached_docs">
                    Attached Documents
                </button>
                <button class="btn btn-primary"
                        id="btn_materials">
                    Materials
                </button>
            </div>
        </div>
        <?php
            }
        }
        else {
            echo 'No Production Process Details';
        }
        ?>
    </div>
</div>

<!--Add Worker Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-worker-modal" role="dialog" tabindex="-1"
     aria-labelledby="add-worker-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			    <i class="pci-cross pci-circle"></i>
			  </button>
			  <h4 class="modal-title">
		          Add Worker
	          </h4>
			</div>
			
			<!--Modal body-->
			<div class="modal-body">
			    <div class="row">
			        <div class="col-lg-6">
    			        <select class="form-control" id="select_worker">
    			            <option>Select Worker</option>
    			            <?php
    			            foreach($carp_opts as $carp_opt) {
    			                $user = $carp_opt['User'];
    			                $carpenter_id = $user['id'];
    			                $carpenter_name = ucwords($user['first_name']." ".$user['last_name']);
    			             
        			             echo '<option value="'.$carpenter_id.'">'.$carpenter_name.'</option>';
    			            }
    			            ?>
    			        </select>
    			    </div>
    			    <div class="col-lg-6">
    			        <input type="number" step="any" id="input_qty_assigned"
    			               placeholder="Quantity Assigned"
    			               class="form-control"
    			               onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
    			               <!--INPUT TYPE NUMBER DONT ACCEPT NEGATIVE VALUES-->
    			    </div>
    	        </div>
			</div>
			
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-primary" id="btn_send_add_worker">Add</button>
			  <!--add data to procduction carpenter where status  == pending with logs-->
			  <!--uppdate production process.status to ongoing with logs-->
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
<!--Update Details Modal End-->

<!--JAVASCRIPT FUNCTIONS-->
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    
    $('#example').DataTable({
        "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
        "orderable": true,
        "order": [[0,"asc"]],
        "stateSave": false
    });
    
    $("#select_worker").select2({
        placeholder: "Select Worker",
        allowClear: true,
        width: '100%'
    });
    
    $("#btn_add_worker").on('click', function() {
        $("#add-worker-modal").modal('show');
    });
    
    $("#btn_send_add_worker").on('click', function() {
        var select_worker = $("#select_worker");
        var input_qty_assigned = $("#input_qty_assigned");
        var production_process_id = "<?php echo $production_process_id; ?>";
        var production_id = "<?php echo $production_id; ?>";
        
        if(select_worker.val()!="Select Worker" ||
           select_worker.val()!="" ||
           select_worker.val()!=null) {
            if(input_qty_assigned.val()!="") {
                var data = {'production_process_id':production_process_id,
                            'user_id':select_worker.val(),
                            'qty_assigned':input_qty_assigned.val(),
                            'production_id':production_id
                            };
                $.ajax({
                    url: '/production_processes/add_worker',
                    type: 'POST',
					data: {'data': data},
					dataType: 'text',
					success: function(id) {
						console.log(id);
						location.reload();
					},
					error: function(err) {
						console.log("AJAX error: " + JSON.stringify(err, null, 2));
					}
                });
            }  
            else {
                input_qty_assigned.css({'border-color':'red'});
            }
       }
       else {
           swal({
                title: "Cannot be empty!",
                text: "Please Select Worker.",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Okay",
                closeOnConfirm: false,
            });
       }
    });
    
    $("button#btn_del_section_head").on('click', function() {
        var carpenter_id = $(this).val();
        swal({
            title: "Are you sure?",
            text: "This will delete Worker.",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                $.get('/production_processes/delete_carp', {id:carpenter_id}, function(data) {
                   console.log(data);
                  location.reload();
                });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    });
    
    $("#btn_start").on('click', function() {
        var carp_id = $(this).val();
        var production_process_id = "<?php echo $production_process_id; ?>";
        var production_id = "<?php echo $production_id; ?>";
        
        swal({
            title: "Are you sure?",
            text: "This will start Production Process.",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                var data = {'production_process_id':production_process_id,
                            'carp_id':carp_id,
                            'production_id':production_id,
                            'status':'ongoing'
                            };
                $.ajax({
                    url: '/production_processes/start_accomplished',
                    type: 'POST',
					data: {'data': data},
					dataType: 'text',
					success: function(id) {
						console.log(id);
						location.reload();
					},
					error: function(err) {
						console.log("AJAX error: " + JSON.stringify(err, null, 2));
					}
                });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    });
    
    $("#btn_accomplish").on('click', function() {
        var carp_id = $(this).val();
        var production_process_id = "<?php echo $production_process_id; ?>";
        var production_id = "<?php echo $production_id; ?>";
        
        swal({
            title: "Are you sure?",
            text: "This will accomplish Production Process.",
            type: "warning",
            showCancelButton: true,
            confirmButtonClass: "btn-danger",
            confirmButtonText: "Yes",
            cancelButtonText: "No",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                 var data = {'production_process_id':production_process_id,
                            'carp_id':carp_id,
                            'production_id':production_id,
                            'status':'accomplished'
                            };
                $.ajax({
                    url: '/production_processes/start_accomplished',
                    type: 'POST',
					data: {'data': data},
					dataType: 'text',
					success: function(id) {
						console.log(id);
						location.reload();
					},
					error: function(err) {
						console.log("AJAX error: " + JSON.stringify(err, null, 2));
					}
                });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    });
    
    $("#btn_attached_docs, #btn_materials").on('click', function() {
        var id = "<?php echo $jrprodid; ?>";
       window.location = "http://crm-epr-ronalynjecams.c9users.io/job_requests/designer_upload?id="+id; 
    });
});
</script>