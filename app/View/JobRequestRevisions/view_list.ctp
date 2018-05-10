<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="/css/sweetalert.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="/js/sweetalert.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<?php

        // GLOBAL VARIABLES
            $userin = $UserIn['User']['id'];
            $role = $UserIn['User']['role'];
        // END OF GLOBAL VARIABLES 
        
        if($job_request_type == 'jrp'){ 
            $Client = $getJRProduct['Client'];
            $JobRequest = $getJRProduct['JobRequest'];
            $Quotation = $getJRProduct['Quotation']; 
            $SalesAgent = $getJRProduct['User'];
        }else{
            $Client = $getFloorPlan['Client'];
        }
        
        $unknown = "<font style='color:red;'>Unknown</font>";
        $not_specified = "<font style='color:red;'>Not Specified</font>";
        
        $Client_name = $unknown;
        if(!empty($Client)) {
            $Client_name = ucwords($Client['name']);
        }
        
        $JobRequest_jr_number = $unknown;
        $JobRequest_status = $unknown;
        if(!empty($JobRequest)) {
            $JobRequest_jr_number = "<font style='font-weight:bold;'>".
                                        $JobRequest['jr_number'].
                                    "</font>";
            $JobRequest_status = ucwords($JobRequest['status']);
        }
        
        $Quotation_id = 0;
        $Quotation_tentative_date = $unknown;
        if(!empty($Quotation)) {
            $Quotation_id = $Quotation['id'];
            $Quotation_tentative_date = date("F d, Y",
                                        strtotime($Quotation['target_delivery']));
        }
        $SalesAgent_name = $unknown;
        if(!empty($SalesAgent)) {
            $SalesAgent_name = ucwords($SalesAgent['first_name']." ".
                                       $SalesAgent['last_name']);
        }
?>

<div id="content-container">
    <div id="page-content"> 
        <div class="col-lg-6">
            <div class="panel">
                <div class="panel-body">
                    <h1 class="page-header text-overflow">Client Details</h1>
                    <div class="col-lg-12">
                        <div class="col-lg-3">
                            <p>Client Name:</p>
                            <p>JR #:</p> 
                            <p>Sales Executive:</p>
                            <p>Tentative Delivery Date:</p>
                        </div>
                        <div class="col-lg-4">
                            <p>
                                <?php echo $Client_name;  ?>
                            </p>
                            <p><?php echo $JobRequest_jr_number; ?></p> 
                            <p><?php echo $SalesAgent_name; ?></p>
                            <p><?php echo $Quotation_tentative_date; ?></p>
                        </div>
                        <?php  if($job_request_type == 'jrp'){ 
                        
                            $JRProduct_image = "image_placeholder.jpg";
                            if($getJRProduct['JobRequestProduct']['image']!=null &&
                            $getJRProduct['JobRequestProduct']['image']!="") {
                                $JRProduct_image = $getJRProduct['JobRequestProduct']['image'];
                            }
                        ?>
                        <!--get image from job request table-->
                            <div class="col-lg-5">
                                <p> <img class='img-responsive' width='150px;' src='/img/product-uploads/<?php echo $JRProduct_image;?> '></p> 
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php 
         if($job_request_type == 'jrp'){
             
            $Product = $getJRProduct['Product']; 
            $jr_label = $Product['name'];
            ?>
        <div class="col-lg-6">
            <div class="panel">
                <div class="panel-body">
                    <h1 class="page-header text-overflow"><?php echo $jr_label; ?></h1>
                    <div class="col-lg-12">
                        <div class="col-lg-6"> 
                            <p><strong>Quotation Product Details:</strong></p> 
                            <?php 
                            foreach($getQuotationProductProperties as $getQuotationProductProperty){
                                echo '<li>'.$getQuotationProductProperty['QuotationProductProperty']['property'].' : '.$getQuotationProductProperty['QuotationProductProperty']['value'].'</li>';
                            }
                            ?>
                        </div>
                        <div class="col-lg-6"> 
                            <p><strong>Other Info:</strong></p> 
                            <p><?php echo $getJRProduct['QuotationProduct']['other_info']; ?></p>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        <?php
        
         }else{
            ?>
            
        <div class="col-lg-6">
            <div class="panel">
                <div class="panel-body">
                    <h1 class="page-header text-overflow"><?php echo $jr_label; ?></h1>
                    <div class="col-lg-12">  
                            <p><strong>Floor Plan Details:</strong></p> 
                            <?php  
                                echo $getFloorPlan['JobRequestFloorplan']['description'];
                            ?> 
                    </div>
                </div>
            </div>
        </div>
            <?php
         } ?>
         
        
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-body">
                    <h1 class="page-header text-overflow">Revision Details</h1>
                    
					        <!-- Start Accordion-->
					        <!--===================================================-->
					        <div class="panel-group accordion" id="accordion">
					            <?php 
					           // echo pr($getJRRevisions);
					           foreach($getJRRevisions as $getJRRevision){
					               $jrrevision_id = $getJRRevision['JobRequestRevision']['id'];
					               $revision_type = $getJRRevision['JobRequestType']['name']; 
					               $job_request_revision_remarks = $getJRRevision['JobRequestRevision']['remarks'];
					               $deadline_date = date('F d, Y', strtotime($getJRRevision['JobRequestRevision']['deadline_date'])); 
					               $actual_date_finished = $getJRRevision['JobRequestRevision']['actual_date_finished']; 
					               $remarks = $getJRRevision['JobRequestRevision']['remarks']; 
					               
					               $job_request_product_id = $getJRRevision['JobRequestRevision']['job_request_product_id'];
					               $sales_executive = $getJRRevision['JobRequestProduct']['user_id'];
					               $client_id = $getJRRevision['JobRequestProduct']['client_id'];
					               $quotation_id = $getJRRevision['QuotationProduct']['quotation_id'];
					               $job_request_floorplan_id = $getJRRevision['JobRequestRevision']['job_request_floorplan_id'];
					               $job_request_id = $getJRRevision['JobRequestRevision']['job_request_id'];
					               $quotation_product_id = 0;
					               if($getJRRevision['JobRequestProduct']['quotation_product_id']!="" &&
    					               $getJRRevision['JobRequestProduct']['quotation_product_id']!=null) {
    					               $quotation_product_id = $getJRRevision['JobRequestProduct']['quotation_product_id'];
					               }
					           ?> 
					            
					            <div class="panel">
					 
					                <div class="panel-heading">
					                    <h4 class="panel-title">
					                        <a data-parent="#accordion" data-toggle="collapse" href="#<?php echo $jrrevision_id; ?>"><?php echo $revision_type; ?> [ <small>Deadline Date:  <?php echo $deadline_date ?></small>]</a>
					                    </h4>
					                </div>
					 
					                <div class="panel-collapse collapse" id="<?php echo $jrrevision_id; ?>">
					                    <div class="panel-body">
					                        <div class="row">
					                            <div class="col-lg-6">
        					                        <p>Total Estimated Time Finish:</p>
        					                        <p>Total Actual Time Finish:</p>
        					                    </div>
        					                   
        					                    <div class="col-lg-6" align="right">
        					                        Remarks: 
                                                    <p><?php echo $job_request_revision_remarks; ?></p>
        					                    </div>
        					                </div>
        					                
					                        <?php if($role=="design_head"): ?>
                                            <div align="right"  >
                                                <p>
                                                    <button id="btn_add_designer"
                                                            class="btn btn-success"
                                                            data-jobrequestproductid="<?php echo $job_request_product_id; ?>"
                                                            data-salesexecutiveid="<?php echo $sales_executive; ?>"
                                                            data-clientid="<?php echo $client_id; ?>"
                                                            data-quotationid="<?php echo $quotation_id; ?>"
                                                            data-jobrequestfloorplanid="<?php echo $job_request_floorplan_id; ?>"
                                                            data-jobrequestid="<?php echo $job_request_id; ?>"
                                                            data-quotationproductid="<?php echo $quotation_product_id; ?>"
                                                            value="<?php echo $jrrevision_id; ?>"
                                                            >
                                                        Add Designer
                                                    </button>
                                                </p>  
                                            </div>
                                            <?php endif; ?>
                                            
					                        <div class="table-responsive">
    					                        <table class="table table-striped">
    					                            <tr>
    					                                <td>Date Assigned<br/>[Status]</td>
    					                                <td>Designer</td>
    					                                <td>Assigned Task</td>
    					                                <td>Estimated Finish</td>
    					                                <td>Actual (Start - End)</td>
    					                                <td>Action</td>
    					                                <?php  
    					                                    foreach($getJRRevision['JobRequestAssignment'] as $assignments){ 
    					                                        $assignment_id = $assignments['id'];

                                                                $estimated_finish_date = $unknown;
                                                                if(!empty($assignments['estimated_finish_date'])) {
                                                                    $estimated_finish_date = date('F d, Y', strtotime($assignments['estimated_finish_date']));
                                                                }
                                                                
                                                                $date_started = $unknown;
                                                                if(!empty($assignments['date_started'])) {
                                                                    $date_started = date('F d, Y', strtotime($assignments['date_started']));
                                                                }
                                                                
                                                                $date_end = $unknown;
                                                                if(!empty($assignments['date_end'])) {
                                                                    $date_end = date('F d, Y', strtotime($assignments['date_end']));
                                                                }
                                                                
                                                                $designer_name= $unknown;
                                                                if(!empty($assignments['designer_name'])) {
                                                                    $designer_name = $assignments['designer_name'];
                                                                }
                                                                
                                                                $assigned_task= $unknown;
                                                                if(!empty($assignments['assigned_task'])) {
                                                                    $assigned_task = $assignments['assigned_task'];
                                                                }
                                                                
                                                                $status = $assignments['status'];
    					                                ?>
    					                                
    					                                    <tr>
            					                                <td><?php echo  date('F d, Y', strtotime($assignments['created'])).'<br/><small>['.$status.']</small>'; ?></td>
            					                                <td><?php echo $designer_name; ?></td>
            					                                <td><?php echo '<small>'.$assigned_task.'</small>'; ?></td>
            					                                <td><?php echo $estimated_finish_date; ?></td>
            					                                <td><?php echo $date_started.' - '.$date_end; ?></td>
            					                                <td> 
            					                                <?php
            					                                    if(empty($assignments['date_rejected'])){
            					                                       // MAE: changed "my_id" to "$UserIn['User']['id']" because "my_id" was undefined
            					                                       if($UserIn['User']['id'] == $assignments['designer']){
            					                                           if($status == 'new') { ?>
                    					                                    <button class="btn btn-danger"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Reject"
                                                                                    id="btn_update_status"
                                                                                    data-id="<?php echo $assignment_id;?>" 
                                                                                    data-jrfpid="<?php echo $assignments['job_request_floorplan_id']; ?>"
                                                                                    data-jrpid="<?php echo $assignments['job_request_product_id']; ?>"
                                                                                    data-jrrevid="<?php echo $assignments['job_request_revision_id']; ?>"
                                                                                    data-jrid="<?php echo $job_request_id; ?>"
                                                                                    data-qpid="<?php echo $quotation_product_id; ?>"
                                                                                    data-btntype="rejected">
                                                                                <span class="fa fa-close"></span>
                                                                            </button>
                                                                            <?php
            					                                            }
                                                                            if($status == 'new' || $status=="onhold") {
                                                                                if($estimated_finish_date!=$unknown) { ?>
                                                                                <button class="btn btn-success"
                                                                                        data-toggle="tooltip"
                                                                                        data-placement="top"
                                                                                        title="Start"
                                                                                        id="btn_update_status"
                                                                                        data-id="<?php echo $assignment_id;?>" 
                                                                                        data-jrfpid="<?php echo $assignments['job_request_floorplan_id']; ?>"
                                                                                        data-jrpid="<?php echo $assignments['job_request_product_id']; ?>"
                                                                                        data-jrrevid="<?php echo $assignments['job_request_revision_id']; ?>"
                                                                                        data-jrid="<?php echo $job_request_id; ?>"
                                                                                        data-qpid="<?php echo $quotation_product_id; ?>"
                                                                                        data-btntype="started">
                                                                                    start
                                                                                </button>
                                                                                <?php 
                                                                                }
                                                                                else { ?>
                                                                                    <button class="btn btn-info"
                                                                                            data-toggle="tooltip"
                                                                                            data-placement="top"
                                                                                            title="Add Estimate"
                                                                                            id="btn_add_estimate"
                                                                                            data-id="<?php echo $assignment_id; ?>"
                                                                                            data-jrfpid="<?php echo $assignments['job_request_floorplan_id']; ?>"
                                                                                            data-jrpid="<?php echo $assignments['job_request_product_id']; ?>"
                                                                                            data-jrrevid="<?php echo $assignments['job_request_revision_id']; ?>"
                                                                                            data-jrid="<?php echo $job_request_id; ?>"
                                                                                            data-qpid="<?php echo $quotation_product_id; ?>">
                                                                                        <span class="fa fa-hourglass-start"></span>
                                                                                    </button>
                                                                                <?php
                                                                                }
            					                                            }
            					                                           if($status == 'started'){ 
                                                                            ?>
                                                                            
                                                                            <button class="btn btn-default"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Hold"
                                                                                    id="btn_update_status"
                                                                                    data-id="<?php echo $assignment_id;?>" 
                                                                                    data-jrfpid="<?php echo $assignments['job_request_floorplan_id']; ?>"
                                                                                    data-jrpid="<?php echo $assignments['job_request_product_id']; ?>"
                                                                                    data-jrrevid="<?php echo $assignments['job_request_revision_id']; ?>"
                                                                                    data-jrid="<?php echo $job_request_id; ?>"
                                                                                    data-qpid="<?php echo $quotation_product_id; ?>"
                                                                                    data-btntype="onhold">
                                                                                hold
                                                                            </button>
                                                                            
                                                                            <button class="btn btn-success"
                                                                                    data-toggle="tooltip"
                                                                                    data-placement="top"
                                                                                    title="Accomplished"
                                                                                    id="btn_update_status"
                                                                                    data-id="<?php echo $assignment_id;?>" 
                                                                                    data-jrfpid="<?php echo $assignments['job_request_floorplan_id']; ?>"
                                                                                    data-jrpid="<?php echo $assignments['job_request_product_id']; ?>"
                                                                                    data-jrrevid="<?php echo $assignments['job_request_revision_id']; ?>"
                                                                                    data-jrid="<?php echo $job_request_id; ?>"
                                                                                    data-qpid="<?php echo $quotation_product_id; ?>"
                                                                                    data-btntype="accomplished">
                                                                                <span class="fa fa-check"></span>
                                                                            </button>
                                                                        <?php } ?>
                                                                            
                                                                <?php
            					                                       }
                                                                    }else{
                                                                        echo date('F d, Y', strtotime($assignments['date_rejected']));
                                                                    }
                                                                ?>
            					                                </td>
        					                                </tr>
    					                                <?php } ?>
    					                            </tr>
    					                        </table>
					                        </div>
					                    </div>
					                </div>
					            </div> 
					            
    					            <!--<ul class="nav nav-tabs">-->
    					            <!--    <li>-->
    					            <!--        <a data-toggle="tab" href="#demo-stk-lft-tab-<?php echo $jrrevision_id; ?>"><?php echo $revision_type; ?></a>-->
    					            <!--    </li> -->
    					            <!--</ul>-->
    					            
    					            <!--Tabs Content-->
    					            <!--<div class="tab-content">-->
    					            <!--    <div id="demo-stk-lft-tab-<?php echo $jrrevision_id; ?>" class="tab-pane fade  ">-->
    					            <!--        <h3 class="page-header text-overflow">Deadline Date:  <?php echo $deadline_date ?></h3>-->
    					                   
    					            <!--    </div> -->
    					            <!--</div>-->
					            <?php } ?>
					            
					        </div>
					        <!--===================================================-->
					        <!--End  Accordion-->
					            
					           
					        
                </div>
            </div>
        </div>
        
    </div>
</div>

<!--MAE: MODIFICATION-->
<!--=========================================================================-->
<!--START OF MODALS HERE-->
<!--Add DESIGNER modal-->
	<!--===================================================-->
    <div class="modal fade" id="add-designer-modal" role="dialog"   aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
			<div class="modal-content">
				<!--Modal header-->
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">
				    <i class="pci-cross pci-circle"></i>
				  </button>
				  <h4 class="modal-title">
			          Add Designer
		          </h4>
				</div>
				
				<!--Modal body-->
				<div class="modal-body">
				    <div class="row">
				        <div class="col-lg-12">
				            <?php if($role=="design" || $role=="design_head"): ?>
				            <div class="form-group">
    				            <label>Select Designer <span class="text-danger">*</span></label>
    				            <select id="select_designer"
    				                    class="form-control">
    				                <option></option>
    				                <?php
    				                foreach($Designers as $Designer) {
    				                    $id = $Designer['User']['id'];
    				                    $name = ucwords($Designer['User']['first_name']." ".$Designer['User']['last_name']);
    				                    
    				                    echo "
    				                    <option value='".$id."'>$name</option>
    				                    ";
    				                }
    				                ?>
    				            </select>
				            </div>
				            <?php endif; ?>

				            <div class="form-group">
				                <label>Task <span class="text-danger">*</span></label>
				                <textarea id="tasks"></textarea>
				            </div>
				        </div>
				    </div>
				</div>
				
				<!--Modal footer-->
				<div class="modal-footer">
				  <button data-dismiss="modal" class="btn btn-default"
				    type="button">Close</button>
				  <button class="btn btn-primary" id="send_add_designer">Add</button>
				</div>
			</div>
    	</div>
	</div>
<!--===================================================-->
<!--End of add DESIGNER modal -->

<!--Add type / revision modal-->
	<!--===================================================-->
    <div class="modal fade" id="update-start-modal" role="dialog"   aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
			<div class="modal-content">
				<!--Modal header-->
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">
				    <i class="pci-cross pci-circle"></i>
				  </button>
				  <h4 class="modal-title">
			          Estimated Finish
		          </h4>
				</div>
				
				<!--Modal body-->
				<div class="modal-body">
				    <div class="form-group">
				        <label>Date <span class="text-danger">*</span></label>
    			        <input type="date" class="form-control"
    			               id="input_estimated_finish" />
			         </div>
			         <div class="form-group">
			             <label>Time <span class="text-danger">*</span></label>
			             <input type="time" class="form-control"
			                    id="input_time" />
			         </div>
				</div>
				
				<!--Modal footer-->
				<div class="modal-footer">
				  <button data-dismiss="modal" class="btn btn-default"
				    type="button">Close</button>
				  <button class="btn btn-primary" id="send_start">Update</button>
				</div>
			</div>
    	</div>
	</div>
<!--===================================================-->
<!--End of add new type / revision modal -->

<!--END OF MAE: MODIFICATION-->
<!--=========================================================================-->

<script type="text/javascript">
    $(document).ready(function() {
        $("[data-toggle=tooltip]").tooltip();
        
        $('#example').DataTable({
            "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
            "orderable": true,
            "order": [[0,"desc"]],
            "stateSave": true
        });
        
        // MAE: MODIFICATION
        // ======================================================================>
        $("#select_designer").select2({
            placeholder: "Designer",
            allowClear: true,
            width: '100%'
        });
        
        tinymce.init({
            selector: 'textarea',
            height: 100,
            menubar: false,
            plugins: [
                'autolink',
                'link',
                'codesample',
                'lists',
                'searchreplace visualblocks',
                'table contextmenu paste code'
            ],
            toolbar: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample | link',
        });
        
        var jr_rev_id = 0;
        var job_request_product_id = 0;
        var client_id = 0;
        var quotation_id = 0;
        var job_request_floorplan_id = 0;
        var job_request_id = 0;
        var quotation_product_id = 0;
        var sales_executive = 0;
        $("button#btn_add_designer").on('click', function() {
            $("#send_add_designer").removeAttr('disabled');
            $("#add-designer-modal").modal('show');
            jr_rev_id = $(this).val();
            job_request_product_id = $(this).data('jobrequestproductid');
            client_id = $(this).data('clientid');
            quotation_id = $(this).data('quotationid');
            job_request_floorplan_id = $(this).data('jobrequestfloorplanid');
            job_request_id = $(this).data('jobrequestid');
            quotation_product_id = $(this).data('quotationproductid');
            sales_executive = $(this).data('salesexecutiveid');
        });
        
        $("#send_add_designer").on('click', function() {
            $(this).prop('disabled', true);
            
            var select_designer = $("#select_designer");
            var tasks = tinymce.get('tasks').getContent();
            var designer_name = $("#select_designer option:selected").text();
            
            if(select_designer.val()!="") {
                if(tasks!="") {
                    var data = {
                                "select_designer": select_designer.val(),
                                "tasks": tasks,
                                "jr_rev_id": jr_rev_id,
                                "type": "<?php echo $this->params['url']['type']; ?>",
                                "designer_name": designer_name,
                                "sales_executive_id": sales_executive,
                                "client_id": client_id,
                                "quotation_id": quotation_id,
                                "job_request_floorplan_id": job_request_floorplan_id,
                                "job_request_id": job_request_id,
                                "job_request_product_id": job_request_product_id,
                                "quotation_product_id": quotation_product_id
                                };
                                
                    $.ajax({
                        url: "/job_request_assignments/add_designer",
                        type: "POST",
                        data: {"data": data},
                        dataType: "text",
                        success: function(success) {
                            console.log(success);
                            var jr_rev_id = 0;
                            var job_request_product_id = 0;
                            var client_id = 0;
                            var quotation_id = 0;
                            var job_request_floorplan_id = 0;
                            var job_request_id = 0;
                            var quotation_product_id = 0;
                            var sales_executive = 0;
                            
                            swal({
                                title: "Success!",
                                text: "Successfully assigned designer",
                                type: "success"
                            },
                            function(isConfirm) {
                                if(isConfirm) {
                                    location.reload();
                                }
                            });
                        },
                        error: function(error) {
                            console.log(error);
                            $("#send_add_designer").removeAttr('disabled');
                            swal({
                                title: "Oops!",
                                text: "An error occured. Please try again later.",
                                type: "warning"
                            });
                        }
                    });
                }
                else {
                    $("#send_add_designer").removeAttr('disabled');
                    swal({
                       title: "Oops!",
                       text: "Please add task and try again.",
                       type: "warning"
                    });
                }
            }
            else {
                $("#send_add_designer").removeAttr('disabled');
                swal({
                    title:"Oops!",
                    text: "Please select designer and try again.",
                    type: "warning"
                });
            }
        });
        
        var btntype = "";
        var assignment_id = 0;
        var job_request_floorplan_id = 0;
    	var job_request_product_id = 0;
    	var job_request_revision_id = 0;
    	var job_request_id = 0;
    	var quotation_product_id = 0;
        $("button#btn_update_status").on('click', function() {
            btntype = $(this).data('btntype');
            assignment_id = $(this).data('id');
            job_request_floorplan_id =  $(this).data('jrfpid');
        	job_request_product_id =  $(this).data('jrpid');
        	job_request_revision_id =  $(this).data('jrrevid');
        	job_request_id = $(this).data('jrid');
        	quotation_product_id = $(this).data('qpid');
            
            // S T A R T E D,  O N H O L D ,  R E J E C T E D ,  A C C O M P L I S H E D
            swal({
                title: "Are you sure?",
                text: "This will be "+btntype+".",
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
                    var data = {"btntype": btntype,
                                "assignment_id": assignment_id,
                            	"job_request_floorplan_id": job_request_floorplan_id,
                            	"job_request_product_id": job_request_product_id,
                            	"job_request_revision_id": job_request_revision_id,
                            	"job_request_id": job_request_id,
                                "quotation_product_id":quotation_product_id };
                            	
                    $.ajax({
                        url: "/job_request_assignments/action",
                        type: "POST",
                        data: {"data": data},
                        dataType: "text",
                        success: function(success) {
                            console.log(success);
                            location.reload();
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
            });
        });
        
        $("button#btn_add_estimate").on('click', function() {
            assignment_id = $(this).data('id');
            job_request_floorplan_id =  $(this).data('jrfpid');
        	job_request_product_id =  $(this).data('jrpid');
        	job_request_revision_id =  $(this).data('jrrevid');
        	job_request_id = $(this).data('jrid');
        	quotation_product_id = $(this).data('qpid');
        	
            $("#update-start-modal").modal("show");
        });
        
        $("#send_start").on('click', function() {
            var input_estimated_finish = $("#input_estimated_finish");
            var input_time = $("#input_time");
            if(input_estimated_finish.val()!="") {
                var data = {"assignment_id": assignment_id,
                            "input_estimated_finish": input_estimated_finish.val(),
                        	"job_request_floorplan_id": job_request_floorplan_id,
                        	"job_request_product_id": job_request_product_id,
                        	"job_request_revision_id": job_request_revision_id,
                        	"job_request_id": job_request_id,
                            "quotation_product_id":quotation_product_id,
                            "input_time": input_time.val()};
                $.ajax({
                    url: "/job_request_assignments/estimate",
                    type: "POST",
                    data: {"data": data},
                    dataType: "text",
                    success: function(success) {
                        console.log(success);
                        location.reload();
                    },
                    erorr: function(error) {
                        console.log(error);
                        swal({
                            title: "Oops!",
                            text: "An error occurred. Please try again later.",
                            type: "warning"
                        });
                    }
                });
            }
            else {
                input_estimated_finish.css({'border-color':'red'});
                swal({
                    title: "Oops!",
                    text: "Please specify estimated finish date and try again.",
                    type: "warning"
                });
            }
        });
        // ======================================================================>
        // END OF MAE: MODIFICATION
    });
</script>
