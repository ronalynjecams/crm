<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="../css/sweetalert.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="../js/sweetalert.min.js"></script>

<script src="../plugins/datatables/media/js/bootstrap-confirmation.min.js"></script>

<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow">
			Client Services View
		</h1>
	</div>
	
	<div id="page-content">
		<div class="panel">
			<div class="panel-body">
				<?php
				if($UserIn['User']['role']=='sales_executive') { ?>
					<div class="col-lg-12" align="center">
						<div class="row">
							<button class="btn btn-danger"
									id="btn_cancel" 
									value="<?php echo $id; ?>"
									data-qpid = "<?php echo $qpid; ?>">
								Cancel
							</button>
							<?php 
							if(!empty($product)) { ?>
							<button class="btn btn-info"
									id="btn_done"
									value="<?php echo $id; ?>">
								Done
							</button>
							<?php } ?>
							<button class="btn btn-primary"
									id="show_modal">
								Add Product
							</button>
						</div>
					</div>
				<?php
				} 
				?>
				<div class="col-lg-12">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered"
						        cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Product Image</th>
									<th>Product Name</th>
									<th>Product Description</th>
									<?php
									if($UserIn['User']['role']=='sales_executive') { ?>
										<th>Action</th>
									<?php 
									}
									else { ?>
										<th>Status</th>
									<?php	
									}
									?>
								</tr>
							</thead>
							<tbody>
								<?php
								if(!empty($product)) { ?>
								<tr>
									<td>
										<?php
										$image_name = $product['image'];
										$image_from_app = WWW_ROOT.'product_uploads/'.$image_name;
										
										$file = new File($image_from_app);
										
										if ($file->exists()) { ?>
											<img class="img-responsive"
											 src="../product_uploads/<?php echo $image_name; ?>"
											 id="prod_image_preview"
											 style="width:50%;height:50%;" />
										<?php
										}
										else { ?>
											<img class="img-responsive"
											 src="../product_uploads/image_placeholder.jpg"
											 id="prod_image_preview"
											 style="width:50%;height:50%;" />
										<?php
										}
										?>
									</td>
									<td><?php echo $product['name']; ?></td>
									<td>
										<?php
										foreach ($prod_combo_prop as $pcps) {
											foreach($pcps as $pcp) {
												$prop = $pcp['ProductComboProperty']['property'];
												$val = $pcp['ProductComboProperty']['value'];
												echo "<p><font style='font-weight:bold;'>".ucwords($prop)."</font> : ".ucwords($val)."</p>";
											}	
										}
										?>
									</td>
									<?php
									if($UserIn['User']['role']=='sales_executive') { ?>
									<td>
										<?php
										if ($status=="processed") { ?>
											<button class="btn btn-mint"
													data-toggle="tooltip"
													data-placement="top"
													title="Update Delivery Schedule">
												<span class="fa fa-calendar"></span>
											</button>
										<?php	
										}
										?>
										<button class="btn btn-danger remove"
											data-toggle="tooltip" data-placement="top"
											title="Cancel"
											value="<?php echo $id; ?>"
											data-qpid = "<?php echo $qpid; ?>"/>
											<span class="fa fa-close"></span>
										</button>
									</td>
									<?php
									}
									else { ?>
										<td><?php echo ucwords($status); ?></td>
									<?php
									}
									?>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!--Add New Demo or Service Unit Combo Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-demo-su-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			    <i class="pci-cross pci-circle"></i>
			  </button>
			  <h4 class="modal-title">
		          Add New <?php echo ucwords($type); ?> Product
	          </h4>
			</div>
			<!--Modal body-->
			<div class="modal-body">
			    <div class="form-group row">
			        <div class="col-lg-6">
			             <?php
			                $service_code="";
			                if ($type=="demo"){
			                    $service_code.="JECDEMO-";
			                }
			                else {
			                    $service_code.="JECSU-";
			                }
			                $today=date("myd");
			                $service_code.=$today;
			             ?>
                         <input type="hidden" id="service_code" value="<?php echo $service_code; ?>" />
				         <select class="form-control" id="select_client">
    				        <option>Select Client</option>
    				        <option style="font-size: 0.5pt; background-color: grey;"
				    			disabled >&nbsp</option>
				    			
    				        <?php foreach($AP_clients as $client) {
    				            $client_id = $client['Client']['id'];
    				            $client_name = $client['Client']['name'];
    				            ?>
    				            <option value="<?php echo $client_id; ?>">
				                    <?php echo $client_name; ?>
			                    </option>
    				            <?php
    				        } ?>
    				    </select>
			        </div>
			        <div class="col-lg-6">
			            <input type="text" class="form-control"
			                placeholder="Quantity" id="qty" />
			        </div>
			    </div>
                <br/>
                <div class="form-group row">
                    <div class="col-lg-6">
                         <select class="form-control" id="select_product">
    				        <option>Select Product</option>
    				        <option style="font-size: 0.5pt; background-color: grey;"
				    			disabled >&nbsp</option>
				    		<?php
				    		    foreach($AP_products as $product) {
				    		        $product_id = $product['Product']['id'];
				    		        $product_name = $product['Product']['name'];
				    		        ?>
				    		        <option value="<?php echo $product_id; ?>">
				    		            <?php echo $product_name; ?>
				    		        </option>
				    		        <?php
				    		    }
				    		?>
    				    </select>
                    </div>
                    <div class="col-lg-6">
                        <select class="form-control" id="select_product_combo" readonly>
    				        <option>Select Product Combination</option>
    				        <option style="font-size: 0.5pt; background-color: grey;"
				    			disabled >&nbsp</option>
    				    </select>
                    </div>
                </div>
			    <br/>
			    <div class="form-group row">
			        <div class="col-lg-6">
			            <label>Expected Delivery Date <span class="text-danger"> *</span></label>
	                    <input type="date" class="form-control"
    				        id="expected_delivery_date"/>
			        </div>
			        <div class="col-lg-6">
			            <label>Expected Delivery Time <span class="text-danger"> *</span></label>
			             <input type="time" class="form-control"
    				        id="expected_delivery_time" />
			        </div>
			    </div>
			    <br/>
			    <div class="form-group row">
			        <div class="col-lg-6">
			            <label>Expected Pull Out Date <span class="text-danger"> *</span></label>
			             <input type="date" class="form-control"
    				        id="expected_pull_out_date"/>
			        </div>
			        <div class="col-lg-6">
			            <label>Expected Pull Out Time <span class="text-danger"> *</span></label>
			             <input type="time" class="form-control"
    				        id="expected_pull_out_time"/>
			        </div>
			    </div>
			    <br/>
                <div class="form-group row" id="label_here"></div>
			</div>
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-primary" id="btn_add">Add</button>
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
	<!--Add New Demo Or Service Unit Modal End-->

<!--JAVASCRIPT METHODS-->
<script>
	var client;
    var qty;
    var product;
    var product_combo;
    var expected_delivery_date;
    var expected_pull_oexpected_pull_out_dateut_date;
    var expected_delivery_time;
    var expected_pull_out_time;
    var service_code = $("#service_code").val();
    var prop_tmp = [];
    var value_tmp = [];
    $(document).ready(function() {
    	var status = "<?php echo $status; ?>";
    	var type = "<?php echo $type; ?>";
    	
    	$('[data-toggle="tooltip"]').tooltip();
    	
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
        
        $('#show_modal').on("click", function() {
            $('#add-demo-su-modal').modal('show');
        });
        
        
        $('#show_del_sched_modal').on("click", function() {
            $('#del-sched-modal').modal('show');
        });
		
		$("#btn_done").on("click", function () {
        	var id = $(this).val();
        	
        	$.get("/client_services/done", {id: id},
                function (data) {
                	alert(data);
                	window.location.replace("/client_services/all_lists?type="+type+"&&status="+status);
            });
		});
		
		$("#select_product").on("change",function() {
            var id = $(this).val();
            
            prop_tmp = [];
            value_tmp = [];
            $("#label_here").empty();
            $.get('/client_services/get_prod_combo', {id: id}, function(data) {
                if(data.length!=0) {
                    $("#select_product_combo").empty().append($('<option>',
                                        {text: "Select Product Combination"}));
                    for(i=0;i<data.length;i++) {
                        $("#select_product_combo").removeAttr('readonly').
                            append($('<option>', {
                                value: data[i]['ProductCombo']['id'],
                                text: data[i]['ProductCombo']['id']
                            }));
                    }
                }
                else {
                    $("#select_product_combo").empty().attr('readonly',true)
                    .append($('<option>', {text: "No Product Combination"}));
                }
            });
        });
		
		$("#select_product_combo").change(function() {
            var id = $(this).val();
            
            prop_tmp = [];
            value_tmp = [];
            $("#label_here").empty();
            $.get('/client_services/get_prod_combo_prop', {id: id}, function(data) {
                for(i=0;i<data.length;i++) {
                    prop_tmp.push(data[i]['ProductComboProperty']['property']);
                    value_tmp.push(data[i]['ProductComboProperty']['value']);
                    $("#label_here").append('<div class="col-lg-6">'+
				    '<label class="label_property" id="label_property">'+data[i]['ProductComboProperty']['property']+'</label>'+
                    '</div>'+
                    '<div class="col-lg-6">'+
				    '<label class="label_value" id="label_value">'+data[i]['ProductComboProperty']['value']+'</label>'+
                    '</div>');
                }
            });
        });
        
        $("#btn_add").on('click', function(){
            client = $("#select_client").val();
            qty = $("#qty").val();
            product = $("#select_product").val();
            product_combo = $("#select_product_combo").val();
            expected_delivery_date = $("#expected_delivery_date").val();
            expected_pull_out_date = $("#expected_pull_out_date").val();
            expected_delivery_time = $("#expected_delivery_time").val();
            expected_pull_out_time = $("#expected_pull_out_time").val();
            if(client!="Select Client") {
                if(qty!="" && parseInt(qty)) {
                    if(product!="Select Product") {
                        if(product_combo!="Select Product Combination") {
                            if(product_combo!="No Product Combination") {
                                if(expected_delivery_date!="") {
                                    if(expected_pull_out_date!="") {
                                        var data = {
                                            'client_id':client,
                                            'qty':qty,
                                            'product_id':product,
                                            'product_combo_id':product_combo,
                                            'expected_delivery_date':expected_delivery_date,
                                            'expected_pull_out_date':expected_pull_out_date,
                                            'expected_delivery_time':expected_delivery_time,
                                            'expected_pull_out_time':expected_pull_out_time,
                                            'service_code':service_code,
                                            'type':type,
                                            'status':status,
                                            'property': prop_tmp,
                                            'value':value_tmp,
                                            'quotation_product_id':0
                                        };
                                        $.ajax({
                							url: "/client_services/add_demo_or_su",
                							type: 'Post',
                							data: {'data': data},
                							dataType: 'text',
                							success: function(id) {
                								console.log(id);
							                	window.location.replace("/client_services/all_lists?type="+type+"&&status="+status);
                							},
                							error: function(err) {
                								console.log("AJAX error in add_demo_or_su: " + JSON.stringify(err, null, 2));
                								console.log("error in ajax add_demo_or_su");
                							}
                						});
                                        console.log(data);
                                    }
                                    else {
                                        $("#expected_pull_out_date").css({'border-color':'red'});
                                    }
                                }
                                else {
                                    $("#expected_delivery_date").css({'border-color':'red'});
                                }
                            }
                            else {
                                $("#select_product_combo").css({'border-color':'red'});
                            }
                        }
                        else {
                            $("#select_product_combo").css({'border-color':'red'});
                        }
                    }
                    else {
                        $("#select_product").css({'border-color':'red'});
                    }
                }
                else {
                    $("#qty").css({'border-color':'red'});
                }
            }
            else {
                $("#select_client").css({'border-color':'red'});
            }
        });
        
        $("#btn_cancel, button.remove").on('click', function() {
        	var client_service_id = $(this).val();
        	var qpid = $(this).data('qpid');
        	swal({
	            title: "Are you sure?",
	            text: "This will cancel service unit.",
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
		        	$.get("/client_services/delete", {id: client_service_id, qpid: qpid}, 
		        	function(data) {
		            	window.location.replace("/client_services/all_lists?type="+type+"&&status="+status);
		        	});
	            }
	        });
        });
    });
</script>
<script> 
    function killCopy(e) {
        return false
    }
    function reEnable() {
        return true
    }
    document.onselectstart = new Function("return false")
    if (window.sidebar) {
        document.onmousedown = killCopy
        document.onclick = reEnable
    }
</script>
<!--END OF JAVASCRIPT METHODS-->
