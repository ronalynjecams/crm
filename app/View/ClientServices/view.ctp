<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>

<!--SWEET ALERT-->
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script> 

<!--DATATABLES-->
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<script src="/css/plug/datatables/media/js/bootstrap-confirmation.min.js"></script>

<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
        selector: 'textarea',
        height: 150,
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
</script>

<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow">
			<?php
				$role = $UserIn['User']['role'];
				$title = ucwords($client_service['Client']['name']);
				
				
				if($role=="supply_staff" ||
				   $role=="plant_manager" ||
				   $role=="logistics_head") {
				   	$Agent = $client_service['Agent'];
				   	$first_name = $Agent['first_name'];
				   	$last_name = $Agent['last_name'];
				   	$full_name = ucwords($first_name." ".$last_name);
				   	$title = "Client Name: ".$client_service['Client']['name']."<br/>
				   			  Sales Agent: ".$full_name;
				}
				
				echo $title;
			?>
		</h1>
	</div>
	
	<div id="page-content">
        <?php
        if(!empty($getDel_Schedule) && $status=="pending") {
        ?>
	    <div class="panel">
	        <div class="panel-body">
                <div class="col-sm-12">
                    <hr style="border-top: dotted 1px;" />
                    <b>Delivery Schedules</b> 
                    <table class="table table-striped">
                    <?php 
                    foreach($getDel_Schedule as $DelSched){
                        echo '<tr>';
                        echo '<td>'.$DelSched['DeliverySchedule']['dr_number'].'</td>';
                        echo '<td>'.date('F d, Y', strtotime($DelSched['DeliverySchedule']['delivery_date'])).' <small> ['.date('h:i a', strtotime($DelSched['DeliverySchedule']['delivery_time'])).'] </small></td>';
                        echo '<td>';
                        if($DelSched['DeliverySchedule']['status'] == 'ongoing') echo 'Pending';  else echo ucwords($DelSched['DeliverySchedule']['status']);
                   
                        echo '</td>';
                        echo '<td>';
                        if($UserIn['User']['role']=="sales_executive") {
                            echo '<button class="btn btn-dark btn-xs update_delivery_note" data-delscid="'.$DelSched['DeliverySchedule']['id'].'"
                                          data-delscnotes="'.$DelSched['DeliverySchedule']['agent_note'].'"
                                          data-delscstats="'.$DelSched['DeliverySchedule']['status'].'">
                                          <i class="fa fa-book"></i>
                                  </button>';
                        }
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                    </table>
                </div>
	        </div>
	    </div>
        <?php } ?>
		<div class="panel">
            <?php if($UserIn['User']['role'] == 'supply_staff' && $status=="newest") { ?>
                <div class="panel-heading" align="center">
                    <h3 class="panel-title">
                        <button class="btn btn-primary" id="btn_complete">
                            <i class="fa fa-check-square-o"></i> Complete
                        </button>
                    </h3>
                </div>
            <?php } ?>

			<div class="panel-body">
				<!--1-->
				<div class="col-lg-12">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered"
						        cellspacing="0" width="100%">
							<thead>
								<tr>
									<?php
									if($status!="cancelled") {
										echo '<th>';
							            if($status=="newest" || $status =="pending") {
						                    echo 'Expected Demo Date';
						                }
						                else if($status=="processed") {
						                	echo 'Date Processed';
						                }
						                else if($status=="delivered") {
						                    echo 'Date Delivered';
						                }
						                else if($status=="pullout") {
						                    echo 'Pull Out Date';
						                }
						                else {
						                    echo 'Date Created';
						                }
						            	echo '</th>';
						            } ?>
									<th>Product Image</th>
									<th>Product Name</th>
									<?php
									if($UserIn['User']['role']=='supply_staff'
									   || $UserIn['User']['role']=='logistics_head'
							    	   || $UserIn['User']['role']=='plant_manager') {
							    	    if($status!="pullout") {
    									   	echo '<th>Processed Quantity</th>';
							    	    }
							    	    else { echo '<th>Pullout Request Quantity</th>'; }
									   	echo '<th>Processed Delivery Request</th>';
								    }
								    else {
								    	echo '<th>Quantity</th>';
								    }
									?>
									<th>Product Description</th>
									<?php
									if($UserIn['User']['role']=='sales_executive' ||
									   $UserIn['User']['role']=='supply_staff' ||
									   $UserIn['User']['role']=='logistics_head') {
								        echo '<th width="210">Action</th>';
									}
									else {
										echo '<th>Status</th>';
									}
									?>
								</tr>
							</thead>
							<tbody>
								<?php
								if(!empty($products)) {
								foreach($products as $product_obj) {
								    $Client = $product_obj['ClientService']['Client'];
									$product = $product_obj['Product'];
									$product_id = $product['id'];
									$client_service_product = $product_obj['ClientServiceProduct'];
									$ClientService = $product_obj['ClientService'];
									$QuotationProduct = $product_obj['QuotationProduct'];
									$client_name = $Client['name'];
									$client_service_product_id = $client_service_product['id'];
									$qp_qty = $QuotationProduct['qty'];
									$client_id = $ClientService['client_id'];
									$client_address = $ClientService['address'];
									$client_service_id = $client_service_product['client_service_id'];
									$expected_demo_date = $client_service_product['expected_demo_date'];
									$expected_pullout_date = $client_service_product['pullout_date'];
									$processed_date = $client_service_product['processed_date'];
									$date_created = $client_service_product['created'];
									$date_delivered = $client_service_product['date_delivered'];
									$qpid = $client_service_product['quotation_product_id'];
									$processed_qty = intval($client_service_product['processed_qty']);
									$approved_qty = intval($client_service_product['approved_qty']);
									$qty = intval($client_service_product['qty']);
									$dr_requested = $client_service_product['dr_requested'];
									$demodate = date("Y-m-d", strtotime($expected_demo_date));
									$cs_prod_status = $client_service_product['status'];
									$pullout_approved_qty = intval($client_service_product['pullout_approved_qty']);
								?>
								<tr>
									<?php
								// 	if($status!="cancelled") {
										echo '<td width="10%">';
										if($status=="newest" || $status =="pending") {
											if($expected_demo_date!=null) {
							                    echo time_elapsed_string($expected_demo_date);
											}
											else {
												echo "<font class='text-danger'>Not specified</font>";
											}
						                }
						                else if($status=="processed") {
											if($processed_date!=null) {
							                    echo time_elapsed_string($processed_date);
											}
											else {
												echo "<font class='text-danger'>Not specified</font>";
											}
						                }
						                else if($status=="delivered") {
											if($date_delivered!=null) {
							                    echo time_elapsed_string($date_delivered);
											}
											else {
												echo "<font class='text-danger'>Not specified</font>";
											}
						                }
						                else if($status=="pullout") {
											if($expected_pullout_date!=null) {
							                    echo time_elapsed_string($expected_pullout_date);
											}
											else {
												echo "<font class='text-danger'>Not specified</font>";
											}
						                }
						                else {
											if($date_created!=null) {
							                    echo time_elapsed_string($date_created);
											}
											else {
												echo "<font class='text-danger'>Not specified</font>";
											}
						                }
										echo '</td>';
								// 	}
									?>
									<td width="10%">
										<?php
										$image_name = $product['image'];
										$image_from_app = WWW_ROOT.'img/product-uploads/'.$image_name;
										
										$file = new File($image_from_app);
										
										if ($file->exists()) { ?>
											<img class="img-responsive"
											 src="/img/product-uploads/<?php echo $image_name; ?>"
											 id="prod_image_preview"
											 style="width:60%;" />
										<?php
										}
										else { ?>
											<img class="img-responsive"
											 src="/img/product-uploads/image_placeholder.jpg"
											 id="prod_image_preview"
											 style="width:60%" />
										<?php
										}
										?>
									</td>
									<td width="15%"><?php echo $product['name']; ?></td>
									<?php
									if($UserIn['User']['role']=='supply_staff'
									   || $UserIn['User']['role']=='logistics_head'
							    	   || $UserIn['User']['role']=='plant_manager') {
							    	    if($status!="pullout") {
    									   	echo '<td>'.$processed_qty.'/'.$qty.'</td>';
							    	    }
							    	    else { echo '<td>'.$pullout_approved_qty.'/'.$approved_qty.'</td>'; }
									   	echo '<td>'.$approved_qty.'/'.$qty.'</td>';
								    }
								    else {
								    	echo '<td>'.$qty.'</td>';
								    }
									?>
									<td>
										<ul class="list-group">
										<?php
										foreach ($cs_prop[$product['id']] as $pcps) {
											$prop = $pcps['ClientServiceProperty']['property'];
											$val = $pcps['ClientServiceProperty']['value'];
											echo "<li class='list-group-item'><font style='font-weight:bold;'>".
												  ucwords($prop)."</font> : ".
												  ucwords($val)."</p></li>";
										}
										if($product['other_info']!="" && $product['other_info']!=null) {
										?>
										<li class="list-group-item"><?php echo $product['other_info']; ?></li>
										<?php } ?>
										</ul>
									</td>
									<td align="center">
									<?php
									if($UserIn['User']['role']=='sales_executive') { ?>
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
										if($status=="pending" || $status=="newest") {
										?>
										<button class="btn btn-warning edit"
											data-toggle="tooltip" data-placement="top"
											title="Edit"
											value="<?php echo $id; ?>"
											data-qpid = "<?php echo $qpid; ?>"
											data-canceledit="edited"
											data-id="<?php echo $client_service_product_id; ?>"
											data-clientserviceid="<?php echo $client_service_id; ?>"
											disabled />
											<span class="fa fa-edit"></span>
										</button>
										<button class="btn btn-danger remove"
											data-toggle="tooltip" data-placement="top"
											title="Cancel"
											value="<?php echo $id; ?>"
											data-qpid = "<?php echo $qpid; ?>"
											data-canceledit="cancelled"
											data-id="<?php echo $client_service_product_id; ?>"
											data-clientserviceid="<?php echo $client_service_id; ?>" />
											<span class="fa fa-close"></span>
										</button>
										<?php }
										else {
										    if($status=="pullout_successful") {
										        echo "Pullout Successful";
										    }
										    else {
    										    echo ucwords("$status");
										    }
										}
									}
									elseif($UserIn['User']['role']=='supply_staff') {
    									    if(($status == "pending" || $status == "processed") &&
    									       ($cs_prod_status!="cancelled")) { ?>
    										<button class="btn btn-sm btn-primary po_product_btn"
    												data-clientserviceproductid="<?php echo $client_service_product_id; ?>"
                                                    data-client="<?php echo $client_id; ?>"
                                                    data-qtprodid="<?php echo $qpid ?>"
                                                    <?php
                                                    if($processed_qty>=$qty) {
                                                        echo "disabled";
                                                    }
                                                    ?>>Select Supplier
                                            </button>
    
                                            <button class="btn btn-sm btn-warning inventory_product_btn add-tooltip" data-toggle="tooltip"
                                            	    data-original-title="Get Product From Inventory"
                                            	    data-qprdctids="<?php echo $qpid; ?>"
                                            	    data-qprdctqty="<?php echo $qp_qty; ?>"
                                            	    disabled>
                                            	<i class="fa fa-cubes"></i>
                                            </button>
                                            
                                            <button class="btn btn-sm btn-success"
                                                    id="btn_deliver"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Delivery Schedule"
                                                    data-deliverydate="<?php echo $demodate; ?>"
                                                    data-id="<?php echo $client_service_product_id; ?>"
                                                    data-productid="<?php echo $product['id']; ?>"
                                                    data-clientid="<?php echo $client_id; ?>"
                                                    data-clientaddress="<?php echo $client_address; ?>"
                                                    data-clientname="<?php echo $client_name; ?>"
                                                    <?php if($dr_requested) { echo 'disabled'; } ?>>
                                                <i class="fa fa-truck"></i>
                                            </button>
                                            
                                            <button class="btn btn-sm btn-danger remove"
    											data-toggle="tooltip" data-placement="top"
    											title="Cancel"
    											value="<?php echo $id; ?>"
    											data-qpid = "<?php echo $qpid; ?>"
    											data-canceledit="cancelled"
    											data-id="<?php echo $client_service_product_id; ?>"
    											data-clientserviceid="<?php echo $client_service_id; ?>" />
    											<span class="fa fa-close"></span>
    										</button>
                                        <?php
                                        
									    }           
                                        elseif(($status == "delivered") ||
                                               ($status == "pullout")) { 
                                               
                                            if($cs_prod_status!="cancelled") { ?>
                                               
                                            <button class="btn btn-sm btn-dark"
                                                    id="btn_pullout"
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Pull Out"
                                                    data-id="<?php echo $client_service_product_id; ?>"
                                                    data-pulloutproductid="<?php echo $product['id']; ?>"
                                                    data-pulloutclientid="<?php echo $client_id; ?>"
                                                    data-pulloutclientaddress="<?php echo $client_address; ?>"
                                                    data-pulloutclientname="<?php echo $client_name; ?>"
                                                    <?php if($dr_requested) { echo 'disabled'; } ?>>
                                                <i class="fa fa-backward"></i>
                                            </button>
                                        <?php }
                                            else {
                                                echo "Cancelled";
                                            }
                                        }
                                        elseif($cs_prod_status=="newest") {
                                            echo '<button class="btn btn-sm btn-danger remove"
    											data-toggle="tooltip" data-placement="top"
    											title="Cancel"
    											value="'.$id.'"
    											data-qpid = "'.$qpid.'"
    											data-canceledit="cancelled"
    											data-id="'.$client_service_product_id.'"
    											data-clientserviceid="'.$client_service_id.'" />
    											<span class="fa fa-close"></span>
    										</button>';
                                        }
                                        else {
                                            if($status=="pullout_successful") {
    										    echo "Pullout Successful";
    										}
    										else { echo ucwords($cs_prod_status); }
                                        }
									}
									else {
										if($status=="pullout_successful") {
										    echo "Pullout Successful";
										}
										else { echo ucwords($status); }
									}
									?>
									</td>
								</tr>
								<?php }
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<!--CREATE PURCHASE ORDER MODAL START-->
<div class="modal fade" id="purchase-order-product-modal" role="dialog"
	 aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Create PO for Product</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                    <input type="hidden" id="quote_product_id"/>    
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product</label> 
                            <select id="slctd_prdct" class="form-control" style="width: 100%;"> 
                                <option></option>
                                <?php
                                foreach ($all_products as $product) {
                                    echo '<option value="' . $product['Product']['id'] . '">' .
                                    $product['Product']['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Product Combo</label> 
                            <select id="slctd_prdctcombo" class="form-control" style="width: 100%;"> 
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Select Supplier</label> 
                            <select id="slctd_prdct_supplier" class="form-control" style="width: 100%;"> 
                                <option></option>
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-2">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Quantity</label> 
                            <input type="number" span="any" id="po_qty" class="form-control" value="0">
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="control-label" id="labelSupplier">Price</label> 
                            <input type="number" span="any" id="list_price" class="form-control" value="0">
                            <input type="hidden"  id="supplier_product_id"  >
                        </div>
                    </div>
                    <div class="col-sm-12"id="last_supplier"></div>

                    <div class="col-sm-12">
                        <div id="product_combo_properties_div">
                            <h4 align="center">Product Description</h4>
                            <div class="col-sm-12"> 
                                <div class="col-sm-6" align="center"><b> Property </b></div>
                                <div class="col-sm-6" align="center"><b> Value </b></div>  
                            </div>     
                        </div>
                    </div> 
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <button class="btn btn-primary" id="saveNewSupplierProductBtn">Add</button>
            </div>
        </div>
    </div>
</div> 
<!--CREATE PURCHASE ORDER MODAL END-->


<!--Schedule Delivery Modal Start-->
<!--===================================================-->
<div class="modal fade" id="sched-del-modal" role="dialog" tabindex="-1"
     aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                <i class="pci-cross pci-circle"></i>
              </button>
              <h4 class="modal-title">
                  Schedule Delivery 
              </h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Delivery Date</label>
                                <input type="text" id="delivery_date" class="form-control" readonly>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Delivery Time</label>
                                <input type="time" id="delivery_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Quantity</label>
                                <input type="number" step="any" id="delivery_qty" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Delivery Mode</label>
                                <select id="delivery_mode" class="form-control">
                                    <option value="deliver">Deliver</option>
                                    <option value="pickup">Pick Up</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default"
                type="button">Close</button>
              <button class="btn btn-primary" id="saveDeliverySched">Submit</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--Schedule Delivery Modal End-->


<!--PULL OUT Modal Start-->
<!--===================================================-->
<div class="modal fade" id="sched-pullout-modal" role="dialog" tabindex="-1"
     aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">
                <i class="pci-cross pci-circle"></i>
              </button>
              <h4 class="modal-title">
                  Pull Out Schedule
              </h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Pull Out Date <span class="text-danger">*</span></label>
                                <input type="date" id="pullout_date" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Pull Out Time <span class="text-danger">*</span></label>
                                <input type="time" id="pullout_time" class="form-control">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Quantity <span class="text-danger">*</span></label>
                                <input type="number" step="any" id="pullout_qty" class="form-control" />
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Delivery Mode <span class="text-danger">*</span></label>
                                <select id="pullout_delivery_mode" class="form-control">
                                    <option value="deliver">Deliver</option>
                                    <option value="pickup">Pick Up</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
              <button data-dismiss="modal" class="btn btn-default"
                type="button">Close</button>
              <button class="btn btn-primary" id="pulloutSched">Submit</button>
            </div>
        </div>
    </div>
</div>
<!--===================================================-->
<!--PULL OUT Modal End-->


<!--UPDATE AGENT NOTES-->
<!--============================================================================-->
<div class="modal fade" id="update_delivery_note_modal" role="dialog"  aria-labelledby="demo-default-modal" aria-hidden="true" style="overflow:hidden;">
    <div class="modal-dialog">
        <div class="modal-content"> 
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title">Update Delivery Note</h4>
            </div>
            <div class="modal-body" style="overflow-y:scroll;height:320px;">
                <p class="text-danger">Delivery note could not be edited if schedule was approved by the delivery personnel.</p>
                <div class="row"> 
                    <input type="hidden" id="delschedlID"/>

                    <div class="col-sm-12" id="div_delivery_note">
                        <div class="form-group">
                            <label class="control-label" id="labelDeliveryNote"></label> 
                            <textarea id="agent_note" class="form-control" ></textarea>
                        </div>
                    </div>  
                </div>
            </div>
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
                <?php if (AuthComponent::user('role') == 'sales_executive') { ?>
                <button class="btn btn-primary" id="saveDrNote">Add</button>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<!--============================================================================-->
<!--END OF UPDATE AGENT NOTES-->


<!--JAVASCRIPT METHODS-->
<script>
	var client_service_product_id = 0;
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
        
        var client_name = "";
        var client_id = 0;
        var client_address = 0;
        var client_service_id = parseInt("<?php echo $this->params['url']['id']; ?>");
        var client_service_product_id = 0;
        var product_id = 0;
        $("button#btn_deliver").on('click', function() {
            $("#saveDeliverySched").removeAttr('disabled');
            client_service_product_id = $(this).data('id');
            product_id = $(this).data('productid');
            client_id = $(this).data('clientid');
            client_address = $(this).data("clientaddress");
            client_name = $(this).data('clientname');
            var deliverydate = $(this).data('deliverydate');
            $("#delivery_date").val(deliverydate);
            $("#sched-del-modal").modal('show');
        });
        
        // FOR PULL OUT
        // ========================================================================>
            var pullout_client_name = "";
            var pullout_client_id = 0;
            var pullout_client_address = 0;
            var pullout_client_service_id = parseInt("<?php echo $this->params['url']['id']; ?>");
            var pullout_client_service_product_id = 0;
            var pullout_product_id = 0;
            var pullout_delivered_qty = 0
            var pullout_delivered_date = null;
            
            $("button#btn_pullout").on('click', function() {
                $("#pulloutSched").removeAttr('disabled');
                pullout_client_service_product_id = $(this).data('id');
                pullout_product_id = $(this).data('pulloutproductid');
                pullout_client_id = $(this).data('pulloutclientid');
                pullout_client_address = $(this).data("pulloutclientaddress");
                pullout_client_name = $(this).data('pulloutclientname');
                $("#sched-pullout-modal").modal('show');
            });
        // END OF PULL OUT
        // ======================================================================>
        
        
        // SCHEDULE DELIVERY
        // ======================================================================>
        $("#saveDeliverySched").on('click', function() {
            $(this).attr("disabled", "disabled");
            var delivery_date = $("#delivery_date").val();
            var delivery_time = $("#delivery_time").val();
            var delivery_qty = $("#delivery_qty").val();
            var delivery_mode = $("#delivery_mode").val();

            if(delivery_date!="") {
                if (delivery_time!="") {
                    if (delivery_qty!="") {
                        if (delivery_mode!="") {
                            var data = {"delivery_date": delivery_date,
                                "requested_qty": delivery_qty,
                                "product_reference": client_service_product_id,
                                "reference_number": client_service_id,
                                "delivery_time": delivery_time,
                                "mode": delivery_mode,
                                "product_id": product_id,
                                "reference_type": "client_services",
                                "deliver_to": client_name,
                                "client_id": client_id,
                                "supplier_id": 0,
                                "shipping_address": client_address,
                                "g_maps": "",
                                "delivered_qty": 0,
                                "date_delivered": null
                            };

                            console.log(data);
                            $.ajax({
                                url: "/delivery_schedules/addSched",
                                type: 'POST',
                                data: {'data': data},
                                dataType: 'text',
                                success: function (success) {
                                    console.log(success);
                                    swal({
                                        title: "Success!",
                                        text: "Successfully added delivery schedule.",
                                        type: "success"
                                    },
                                    function (isConfirm) {
                                       location.reload(); 
                                    });
                                },
                                error: function (error) {
                                    console.log(error);
                                    swal({
                                       title: "Oops!",
                                       text: "An error occured.\n Please try again later.",
                                       type: "warning"
                                    });
                                }
                            });
                        } else {
                            $("#saveDeliverySched").removeAttr('disabled');
                            swal({
                                title: "Oops!",
                                text: "Delivery Mode is empty.\n"+
                                      "Please select delivery mode and try again.",
                                type: "warning"
                            });
                        }
                    } else {
                        $("#saveDeliverySched").removeAttr('disabled');
                        $("#delivery_qty").css({'border-color':'red'});
                        swal({
                            title: "Oops!",
                            text: "Quantity is empty.\n"+
                                  "Please select quantity and try again.",
                            type: "warning"
                        });
                    }
                } else {
                    $("#saveDeliverySched").removeAttr('disabled');
                    $("#delivery_time").css({'border-color':'red'});
                    swal({
                        title: "Oops!",
                        text: "Delivery Time is empty.\n"+
                              "Please select delivery time and try again.",
                        type: "warning"
                    });
                }
            } else {
                $("#saveDeliverySched").removeAttr('disabled');
                $("input.delivery_date").css({'border-color':'red'});
                swal({
                    title: "Oops!",
                    text: "Delivery Date is empty.\n"+
                          "Please select delivery date and try again.",
                    type: "warning"
                });
            }
        });
        // END OF SCHEDULE DELIVERY
        // ======================================================================>
        
        $("button.remove").on('click', function() {
        	var cancel_or_edit = $(this).data('canceledit');
        	var client_service_product_id = $(this).data('id');
        	var client_service_id = $(this).data('clientserviceid');
        	var qpid = $(this).data('qpid');
        	swal({
	            title: "Are you sure?",
	            text: "This demo will be "+cancel_or_edit+".",
	            type: "warning",
	            showCancelButton: true,
	            confirmButtonClass: "btn-danger",
	            confirmButtonText: "Yes",
	            cancelButtonText: "No",
	            closeOnConfirm: true,
	            closeOnCancel: true
	        },
	        function (isConfirm) {
	            if (isConfirm) {
	            	data2 = {"id": client_service_product_id, "qpid": qpid,
	            	         "client_service_id": client_service_id };
	            	
        			$.ajax({
	            		url: "/client_services/edit_delete",
	            		type: "POST",
	            		data: {"data": data2},
	            		dataType: "text",
	            		success: function(success) {
	            			console.log("Success edit_delete: "+success);
	            			swal({
	            				title: "Success!",
	            				text: "Successfully "+cancel_or_edit+" demo.",
	            				type: "success"
	            			},
	            			function(isConfirm2) {
	            				if(isConfirm2) {
					            	location.reload();
	            				}
	            			});
	            		},
	            		error: function(error) {
	            			console.log("Error edit_delete: "+error);
	            			swal({
	            				title: "Oops!",
	            				text: "An error occured."+
	            					  "Please try again later.",
	            				type: "warning"
	            			});
	            		}
	            	});
	            }
	        });
        });
        
        // Select Supplier
        // ====================================================================>
        $("#slctd_inv_prdct").select2({
            placeholder: "Select Inventory Product",
            width: '100%',
            allowClear: false
        });
        
        $("#slctd_inv_prdctcombo").select2({
            placeholder: "Select Product Combo",
            width: '100%',
            allowClear: false
        });
        
        $("#slctd_prdct").select2({
            placeholder: "Select Product Code",
            width: '100%',
            allowClear: false
        });
        $("#slctd_prdctcombo").select2({
            placeholder: "Select Product Combo",
            width: '100%',
            allowClear: false
        });
        $("#slctd_prdct_supplier").select2({
            placeholder: "Select Product Supplier",
            width: '100%',
            allowClear: false
        });
        $("#slctd_inv_lcation").select2({
            placeholder: "Select Location",
            width: '100%',
            allowClear: false
        });
        var get_passed_client = 0;
        $('button.po_product_btn').each(function (index) {
            $("#saveNewSupplierProductBtn").removeAttr('disabled');
        	client_service_product_id = $(this).data('clientserviceproductid');
            $(this).click(function () {
                var qoute_prod_id = $(this).data("qtprodid");
                get_passed_client = $(this).data('client');
                $('#purchase-order-product-modal').modal('show');
                $('#quote_product_id').val(qoute_prod_id);

                $('#slctd_prdctcombo').empty().append('<option></option>');
                $("#slctd_prdct").change(function () {
                    $('#slctd_prdctcombo').empty().append('<option></option>');
                    $('#slctd_prdct_supplier').empty().append('<option></option>');
                    $('.added_product_combo_properties_div').each(function (index) {
                        $(".added_product_combo_properties_div").remove();
                    });
                    $("#slctd_prdctcombo").select2({
                        placeholder: "Select Product Combo",
                        width: '100%',
                        allowClear: false
                    });
                    var selected_product_id = $("#slctd_prdct").val();
                    ////show product combos of selected product
                    $.get('/supplier_products/get_product_combination', {
                        id: selected_product_id,
                    }, function (data) {
                        for (i = 0; i < data.length; i++) {
                            $('#slctd_prdctcombo').append($('<option>', {
                                value: data[i]['ProductCombo']['id'],
                                text: data[i]['Product']['name'] + ' [' + data[i]['ProductCombo']['ordering'] + ']'
                            }));
                        }
                    });

                    ////in here get suppliers for selected profct combo
                    $("#slctd_prdctcombo").change(function () {
                        $('.added_product_combo_properties_div').each(function (index) {
                            $(".added_product_combo_properties_div").remove();
                        });
                        $("#slctd_prdct_supplier").select2({
                            placeholder: "Select Product Supplier",
                            width: '100%',
                            allowClear: false
                        });

                        var selected_product_id = $("#slctd_prdct").val();
                        var selected_product_combo_id = $("#slctd_prdctcombo").val();

                        //GET LAST PURCHASED SUPPLIER
                        $.get('/supplier_products/get_po_product_last_supplier', {
                            id: selected_product_combo_id,
                        }, function (data) {
                            $("#added_last_supplier").remove();
                            $("#added_last_price").remove();
                            if($.isEmptyObject(data['PurchaseOrderProduct'])!=true) {
                                if(data['PurchaseOrderProduct']['list_price']!=null) {
                                    var price = data['PurchaseOrderProduct']['list_price'];
                                    $('#last_supplier').append('<div id="added_last_price" class="text-primary"> Last Purchased Price:  &#8369;'+ price + ' </div>');
                                }
                            }
                            if(data['Supplier']!=null) {
                                $('#last_supplier').append('<div id="added_last_supplier" class="text-primary"> Last Purchased:  ' + data['Supplier']['name'] + '  [<small>' + data['created'] + '</small>]</div>');
                            }
                        }); //end of ajax get /supplier_products/get_po_product_last_supplier

                        // $.get('/supplier_products/get_supplier_product_combo', {
                        //     id: selected_product_id,
                        // }, function (data) {
                        //     for (i = 0; i < data.length; i++) {
                        //         $('#slctd_prdctcombo').append($('<option>', {
                        //             value: data[i]['ProductCombo']['id'],
                        //             text: data[i]['ProductCombo']['Product']['name'] + ' [' + data[i]['ProductCombo']['ordering'] + ']'
                        //         }));
                        //     }
                        // }); //end of ajax get /supplier_products/get_product_combination

                        $('#slctd_prdct_supplier').empty().append('<option></option>');
                        $('.added_product_combo_properties_div').each(function (index) {
                            $(".added_product_combo_properties_div").remove();
                        });
                        $.get('/supplier_products/get_supplier_product_combo', {
                            id: selected_product_combo_id,
                        }, function (data) {
                            $('.added_product_combo_properties_div').each(function (index) {
                                $(".added_product_combo_properties_div").remove();
                            });
                            $('#slctd_prdct_supplier').empty().append('<option></option>');
                            for (i = 0; i < data.length; i++) {
                                $('#slctd_prdct_supplier').append($('<option>', {
                                    value: data[i]['Supplier']['id'],
                                    text: data[i]['Supplier']['name']
                                }));
                                $('#list_price').val(data[i]['ProductCombo']['SupplierProduct'][0]['supplier_price']);
                                $('#supplier_product_id').val(data[i]['ProductCombo']['SupplierProduct'][0]['id']);
                                var prod_combo_property = data[i]['ProductCombo']['ProductComboProperty'];

                                for (v = 0; v < prod_combo_property.length; v++) {
                                    $('#product_combo_properties_div').append('<div class="col-sm-12 added_product_combo_properties_div">' +
                                            '<div class="col-sm-6" align="center">' + prod_combo_property[v]['property'] + '</div>' +
                                            '<div class="col-sm-6" align="center">' + prod_combo_property[v]['value'] + '</div></div>');
                                }
                            }
                        }); //end of ajax get /supplier_products/get_supplier_product_combo 
                    }); //end of onchange slctd_prdctcombo 
                }); // end of onchange slctd_prdct 
            }); //end of each po_product_btn
        });
        
        // SAVE PURCHASE ORDER PRODUCT
        $('#saveNewSupplierProductBtn').click(function () {
            $(this).attr('disabled', 'disabled');
            $('#added_rqrd_fld').remove();
            var product_combo_id = $('#slctd_prdctcombo').val();
            var product_id = $("#slctd_prdct").val();
            var supplier_id = $("#slctd_prdct_supplier").val();
            var quote_product_id = $("#quote_product_id").val();
            var po_qty = $("#po_qty").val();
            var list_price = $("#list_price").val();
            var supplier_product_id = $("#supplier_product_id").val();

            if (product_id != "") {
                if (product_combo_id != "") {
                    if (supplier_id != "") {
                        if (po_qty != "" && po_qty != 0 && po_qty >= 1) {
                            if (list_price != "" && list_price != 0 && list_price >= 1) {
                                $('#added_rqrd_fld').remove();
                                var data = {
                                	"client_service_product_id": client_service_product_id,
                                    "product_combo_id": product_combo_id,
                                    "product_id": product_id,
                                    "supplier_id": supplier_id,
                                    "quote_product_id": quote_product_id,
                                    "po_qty": po_qty,
                                    "list_price": list_price,
                                    "additional": 0,
                                    "supplier_product_id": supplier_product_id,
                                    "inventory_job_order_type": 'po',
                                    "po_raw_request_id":0,
                                    "po_raw_request_qty":0,
                                    "client": get_passed_client,
                                    "from_demo": true
                                }
                                $.ajax({
                                    url: "/purchase_orders/process_new_po",
                                    type: 'POST',
                                    data: {'data': data},
                                    dataType: 'text',
                                    success: function (success) {
                                    	console.log("Success: "+success);
                                    	swal({
                                    		title: "Success!",
                                    		text: "Successfully purchased.",
                                    		type: "success"
                                    	},
                                    	function (isConfirm) {
                                    		if(isConfirm) {
                                    		    $("#saveNewSupplierProductBtn").removeAttr('disabled');
		                                        location.reload();
                                    		}
                                    	});
                                    },
                                    error: function (error) {
                                    	console.log("Error: "+JSON.stringify(error));
                                        swal({
                                        	title: "Oops!",
                                        	text: "An error occured. Please try again later.",
                                        	type: "warning",
                                        });
                                    }
                                });
                            } else {
                                $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Price is required</font></div>');
                                $("#saveNewSupplierProductBtn").removeAttr('disabled');
                            }
                        } else {
                            $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Quantity is required</font></div>');
                            $("#saveNewSupplierProductBtn").removeAttr('disabled');
                        }
                    } else {
                        $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Supplier is required</font></div>');
                        $("#saveNewSupplierProductBtn").removeAttr('disabled');
                    }
                } else {
                    $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Product Combination is required</font></div>');
                    $("#saveNewSupplierProductBtn").removeAttr('disabled');
                }
            } else {
                $('#rqrd_fld').append('<div id="added_rqrd_fld"><font color="red">Product is required</font></div>');
                $("#saveNewSupplierProductBtn").removeAttr('disabled');
            }
        });
        // END OF SELECT SUPPLIER
        // =======================================================================>
        
        // COMPLETE NEWEST
        // =======================================================================>
        $("button#btn_complete").on('click', function() {
            var client_service_id = parseInt('<?php echo $this->params["url"]["id"]; ?>');
            swal({
                title: "Are you sure?",
                text: "This will update demo to pending state and it cannot be undone.",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: true,
                closeOnCancel: true
            },
            function(isConfirm) {
                if(isConfirm) {
                    var data = {"id": client_service_id};
                    $.ajax({
                       url: "/client_services/complete",
                       type: "POST",
                       data: {"data": data},
                       dataType: "text",
                       success: function(success) {
                           console.log("Succes: "+success);
                           swal({
                               title: "Success!",
                               text: "Successfully completed demo. Please wait for approval.",
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
        });
        // END OF COMPLETE NEWEST
        // =======================================================================>
        
        // UPDATE AGENT NOTE
        // =======================================================================>
        $('.update_delivery_note').each(function (index) {
            $(this).click(function () {
                $('#errorNote').remove();
                var delivery_schedule_id = $(this).data("delscid");
                var anote = $(this).data("delscnotes");
                var status = $(this).data("delscstats");
                
                // UNCOMMENT
                $('#delschedlID').val(delivery_schedule_id);
                tinyMCE.activeEditor.setContent(anote);
                if(status=='scheduled' || status=='delivered'){ 
                    tinymce.activeEditor.setMode('readonly');
                }else{
                    tinymce.activeEditor.setMode('design'); 
                }
                var checklist = $('#div_no_agent_note').val();
                  
                  
                $('#agent_note').val(anote);
                $('#update_delivery_note_modal').modal('show');
            });
        });
    
        $('#saveDrNote').click(function () {
            $('#errorNote').remove();
            var delivery_schedule_id = $('#delschedlID').val();
            var agent_note = tinyMCE.activeEditor.getContent();
            if (agent_note != '') {
                var data = {"delivery_schedule_id": delivery_schedule_id,
                    "agent_note": agent_note 
                }
                $.ajax({
                    url: "/delivery_schedules/updateDeliveryAgentNote",
                    type: 'POST',
                    data: {'data': data},
                    dataType: 'json',
                    success: function (dd) {
                        location.reload();
                    },
                    error: function (dd) {
                        console.log(dd);
                        swal({
    					    title: "Oops!",
    					    text: "An error occured. Please try again.",
    					    type: "warning"
    					});
                    }
                });
            } else {
                $('#labelDeliveryNote').append('<span id="errorNote" class="text-danger"><small> *delivery note is required </small></span>');
            }
        });
        // END OF UPDATE AGENT NOTE
        // =======================================================================>
        
        // FOR PULL OUT SCHEDULE
        // ======================================================================>
        $("#pulloutSched").on('click', function() {
            $(this).attr("disabled", "disabled");
            var pullout_date = $("#pullout_date").val();
            var pullout_time = $("#pullout_time").val();
            var pullout_qty = $("#pullout_qty").val();
            var pullout_delivery_mode = $("#pullout_delivery_mode").val();

            if(pullout_date!="") {
                if (pullout_time!="") {
                    if (pullout_qty!="") {
                        if (pullout_delivery_mode!="") {
                            // ADD PULLOUT DATA
                            var data1 = {
                                "type": "demo",
                                "status": "scheduled",
                                "pullout_qty": pullout_qty,
                                "expected_pullout_date": pullout_date,
                                "expected_pullout_time": pullout_time,
                                "delivery_mode": pullout_delivery_mode,
                                "reference_number": pullout_client_service_id,
                                "reference_product_number": pullout_client_service_product_id
                            }
                            var data = {"id": pullout_client_service_product_id};
                            $.ajax({
                                url: "/delivery_sched_products/get_delivery_date_qty",
                                type: "POST",
                                data: {"data": data},
                                dataType: "json",
                                success: function(success) {
                                    pullout_delivered_date = success['date_delivered'];
                                    pullout_delivered_qty = success['delivered_qty'];
                                    console.log(success);
                                    
                                    $.ajax({
                                        url: "/client_services/update_pullout",
                                        type: "POST",
                                        data: {"data": data1},
                                        dataType: "text",
                                        success: function(success) {
                                            console.log("PULL OUT ADD SUCCESS RETURN: "+success);
                                        	if(success!="ERROR") {
                                        	    var data2 = {"delivery_date": pullout_date,
                                                    "requested_qty": pullout_qty,
                                                    "product_reference": pullout_client_service_product_id,
                                                    "reference_number": pullout_client_service_id,
                                                    "type":"pull_out",
                                                    "delivery_time": pullout_time,
                                                    "mode": pullout_delivery_mode,
                                                    "product_id": product_id,
                                                    "reference_type": "pull_out",
                                                    "deliver_to": pullout_client_name,
                                                    "client_id": pullout_client_id,
                                                    "supplier_id": 0,
                                                    "shipping_address": pullout_client_address,
                                                    "g_maps": "",
                                                    "delivered_qty": pullout_delivered_qty,
                                                    "date_delivered": pullout_delivered_date
                                                };
                                                
                                                console.log(data2);
                                                $.ajax({
                                                    url: "/delivery_schedules/addSched",
                                                    type: 'POST',
                                                    data: {'data': data2},
                                                    dataType: 'text',
                                                    success: function (success) {
                                                        console.log(success);
                                                        swal({
                                                            title: "Success!",
                                                            text: "Successfully scheduled pullout.",
                                                            type: "success"
                                                        },
                                                        function(isConfirm) {
                                                            if(isConfirm) {
                                                                location.reload();
                                                            }
                                                        });
                                                    },
                                                    error: function (error) {
                                                        console.log(error);
                                                        swal({
                                                          title: "Oops!",
                                                          text: "An error occured.\n Please try again later.",
                                                          type: "warning"
                                                        });
                                                    }
                                                });
                                        	}
                                        	else {
                                        	    swal({
                                                    title: "Oops!",
                                                    text: "An error occured. Please try again later.",
                                                    type: "warning"
                                                });
                                        	}
                                        },
                                        error: function(error) {
                                            console.log("PULL OUT ADD ERROR RETURN: "+error);
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
                                    $("#pulloutSched").removeAttr('disabled');
                                    swal({
                                        title: "Oops!",
                                        text: "An error occurred. Please try again later.",
                                        type: "warning"
                                    });
                                }
                            });
                        } else {
                            $("#pulloutSched").removeAttr('disabled');
                            swal({
                                title: "Oops!",
                                text: "Pullout Mode is empty.\n"+
                                      "Please select pullout mode and try again.",
                                type: "warning"
                            });
                        }
                    } else {
                        $("#pulloutSched").removeAttr('disabled');
                        $("#pullout_qty").css({'border-color':'red'});
                        swal({
                            title: "Oops!",
                            text: "Quantity is empty.\n"+
                                  "Please select quantity and try again.",
                            type: "warning"
                        });
                    }
                } else {
                    $("#pulloutSched").removeAttr('disabled');
                    $("#pullout_time").css({'border-color':'red'});
                    swal({
                        title: "Oops!",
                        text: "Pullout Time is empty.\n"+
                              "Please select pullout time and try again.",
                        type: "warning"
                    });
                }
            } else {
                $("#pulloutSched").removeAttr('disabled');
                $("input.pullout_date").css({'border-color':'red'});
                swal({
                    title: "Oops!",
                    text: "Pullout Date is empty.\n"+
                          "Please select pullout date and try again.",
                    type: "warning"
                });
            }
        });
        // END OF PULL OUT SCHED
        // ======================================================================>
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
