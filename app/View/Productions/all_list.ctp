<!--Select2 [ OPTIONAL ]-->
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

<div id="content-container">
    <div id="page-title">
        <h1 class="page-header text-overflow">
            List of Products for Production
        </h1>
    </div>
    
    <div id="page-content">
        <div class="panel">
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="example"
                           class="table table-striped table-bordered"
					       cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Date Created</th>
                                <th>Client / Job Request No.</th>
                                <th>Sales Executive / Designer</th>
                                <th>Product Name</th>
                                <th>Product Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($productions as $production_obj) {
                                $production = $production_obj['Production'];
                                $client = $production_obj['Client'];
                                $JobRequestProduct = $production_obj['JobRequestProduct'];
                                $QuotationProduct = $production_obj['QuotationProduct'];
                                $other_info = '<ul class="list-group">
                                                   <li class="list-group-item">
                                                       Other Info:
                                                   </li>
                                                   <li class="list-group-item">
                                                       '.$QuotationProduct['other_info'].'
                                                   </li>
                                               </ul>';
                                
                                $JobRequest_jr_number = '<font class="text-danger">Unknown</font>';
                                if(array_key_exists('JobRequest', $JobRequestProduct)) {
                                    if(!empty($JobRequestProduct['JobRequest'])) {
                                        $JobRequest = $JobRequestProduct['JobRequest'];
                                        if(!empty($JobRequest['jr_number'])) {
                                            $JobRequest_jr_number = $JobRequest['jr_number'];
                                        }
                                    }
                                }
                                
                                $designers = [];
                                $JobRequestAssignment_designers = '<font class="text-danger">No designer assigned.</font>';
                                if(array_key_exists('JobRequestAssignment', $JobRequestProduct)) {
                                    if(!empty($JobRequestProduct['JobRequestAssignment'])) {
                                        $JobRequestAssignments = $JobRequestProduct['JobRequestAssignment'];
                                        foreach($JobRequestAssignments as $JobRequestAssignment) {
                                            $designers[] = '<li class="list-group-item">'.$JobRequestAssignment['designer_name'].'</li>';
                                        }
                                        
                                        $designer_label = '<font style="font-weight: bold;">Designer</font>';
                                        if(count(array_unique($designers))>1) {
                                            $designer_label = '<font style="font-weight: bold;">Designers</font>';
                                        }
                                        $JobRequestAssignment_designers = $designer_label.' : <ul class="list-group">'.implode(array_unique($designers)).'</ul>';
                                    }
                                }
                                
                                $client_name = ucwords($client['name']);
                                $jr_product_id = $production['job_request_product_id'];
                                $production_id = $production['id'];
                                $quotation_product_id = $production['quotation_product_id'];
                                
                                $production_log_created = 'No Date Specified';
                                foreach($production_logs[$production_id] as $production_log_obj) {
                                    $production_log = $production_log_obj['ProductionLog'];
                                    $production_log_created = $production_log['created'];
                                }
                                
                                $user_sales_name = 'No Sales Executive';
                                if(!empty($quotations[$quotation_product_id])) {
                                    foreach($quotations[$quotation_product_id] as $quotation_obj) {
                                        // SALES EXECUTIVE
                                        $user_sales = $quotation_obj['User'];
                                        $user_sales_last_name = $user_sales['last_name'];
                                        $user_sales_first_name = $user_sales['first_name'];
                                        $user_sales_name = "<font style='font-weight: bold;'>Agent : </font>".ucwords($user_sales_first_name.
                                            " ".$user_sales_last_name);
                                    }
                                }
                                
                                $product_name = '<font class="text-danger">No Product Name</font>';
                                foreach($quotation_products[$quotation_product_id] as $quotation_product_obj) {
                                    $product = $quotation_product_obj['Product'];
                                    $productProperty = $quotation_product_obj['QuotationProductProperty'];
                                    $product_name = $product['name'];
                                    echo $product_name;
                                }
                                ?>

                                <tr>
                                    <td>
                                        <?php echo time_elapsed_string($production_log_created);
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $client_name."<br/><small>[ ".$JobRequest_jr_number." ]</small>"; ?>
                                    </td>
                                    <td>
                                            <?php echo $user_sales_name."<br/><br/>".$JobRequestAssignment_designers; ?>
                                    </td>
                                    <td>
                                        <?php echo $product_name; ?>
                                    </td>
                                    <td>
                                        <?php
                                        if(!empty($productProperty)) {
                                            echo '<ul class="list-group">';
                                            foreach($productProperty as $eachprodprop) {
                                                $prop = $eachprodprop['property'];
                                                $val = $eachprodprop['value'];
                                                $propval = ucwords($prop.": ".$val);
                                                echo '<li class="list-group-item">'.$propval.'</li>';
                                            }
                                            echo '</ul>'.$other_info;
                                        }
                                        else {
                                            echo 'No Description';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-info"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="View Details"
                                                id="btn_view_details"
                                                value="<?php echo $production_id; ?>">
                                            <span class="fa fa-eye"></span>
                                        </button>
                                        
                                        <?php
                                        if($UserIn['User']['role'] == "production_head" ||
                                          $UserIn['User']['role'] == "production_manager_assistant") {
                                            if($status == "pending" || $status == "viewed"):
                                                ?>
                                                <button class="btn btn-warning"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Update Details"
                                                        id="btn_update_details"
                                                        value="<?php echo $production_id; ?>">
                                                    <span class="fa fa-edit"></span>
                                                </button>
                                                <?php
                                            endif;
                                        } ?>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Update Details Modal Start-->
<!--===================================================-->
<div class="modal fade" id="update-details-modal" role="dialog" tabindex="-1"
     aria-labelledby="update-details-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			    <i class="pci-cross pci-circle"></i>
			  </button>
			  <h4 class="modal-title">
		          Update Details
	          </h4>
			</div>
			
			<!--Modal body-->
			<div class="modal-body">
			    <div class="row">
			        <div class="col-lg-12">
        			    <p><select class="form-control" id="select_section">
        			        <option>Select Section</option>
        			        <?php
        			            foreach($production_sections as $production_section_obj) {
        			                $production_section = $production_section_obj['ProductionSection'];
        			                $production_section_id = $production_section['id'];
        			                $production_section_name = $production_section['name'];
        			                echo '<option value="'.$production_section_id.'">'.$production_section_name.'</option>';
        			            }
        			        ?>
        			    </select></p>
        			</div>
    			    
    			    <div class="col-sm-6">
        			    <p>Expected Start of Work</p>
        			    <input type="date" class="form-control"
        			           id="date_expected_start" />
    			    </div>
    			    <div class="col-sm-6">
    			        <p>Expected End of Work</p>
    			        <input type="date" class="form-control"
    			               id="date_expected_end" />
    			    </div>
    	        </div>
			</div>
			
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-primary" id="btn_update">Update</button>
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
<!--Update Details Modal End-->

<!--JAVASCRIPT METHODS-->
<script>
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip();
    
    $('#example').DataTable({
        "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
        "orderable": true,
        "order": [[0,"asc"]],
        "stateSave": false
    });
    
    $("#select_section").select2({
            placeholder: "Select Section",
            allowClear: true,
            width: '100%'
        });
    
    $("button#btn_view_details").on('click', function() {
        var id = $(this).val();
        var status = "<?php echo $status; ?>";
        var role = "<?php echo $UserIn['User']['role']; ?>";
        
        if(status=="pending" && (role=="production_head" || role =="production_manager_assistant")) {
            $.get("/productions/viewed", {id:id}, function(data) {
                console.log(data);
            });
        }
        window.location = "/production_processes/view_list?id="+id;
    });
    
    var btn_update_id = '';
    $("button#btn_update_details").on('click', function() {
        var id = $(this).val();
        btn_update_id = id;
        $("#update-details-modal").modal('show');
    });
    
    $("#btn_update").on('click', function() {
        var select_section = $("#select_section");
        var date_expected_start = $("#date_expected_start");
        var date_expected_end = $("#date_expected_end");
        
        if(select_section.val() != "Select Section" ||
           select_section.val() != "") {
            if(date_expected_start.val() != "") {
                if(date_expected_end.val() != "") {
                    swal({
                        title: "Are you sure?",
                        text: "This will update Production Details.",
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
                            // alert("expected_start:"+date_expected_end.val()+"expected_end:"+date_expected_end.val());
                            var data = {'production_id':btn_update_id,
                                        'section':select_section.val(),
                                        'expected_start':date_expected_start.val(),
                                        'expected_end':date_expected_end.val()};
                            console.log(data);
                            $.ajax({
                                url: '/productions/update',
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
                }
                else {
                    date_expected_end.css({'border-color':'red'});
                }
            }
            else {
                date_expected_start.css({'border-color':'red'});
            }
        }
        else {
            swal({
                title: "Required Field",
                text: "Section Name should not be empty!",
                type: "warning",
                confirmButtonClass: "btn-danger",
                confirmButtonText: "Okay",
                closeOnConfirm: false,
            });
        }
    });
});
</script>
<!--END OF JAVASCRIPT METHODS-->