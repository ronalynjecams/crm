<!--IMPORTS-->
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="../css/sweetalert.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="../js/sweetalert.min.js"></script>
<!--END IMPORTS-->

<div id="content-container">
	<div id="page-content">
		<!--REQUEST DETAILS-->
		<div class="col-lg-6">
			<div class="panel">
				<div class="panel-body">
					<label style="font-weight:bold;font-size:14px;">
						Request Details
					</label><br/>
					<?php 
						$pr_user_id = 0;
						$pr_requested_amount = 0.000000;
						$pr_reimbursed_amount = 0.000000;
						$pr_returned_amount = 0.000000;
						
						if(!empty($request_details)) {
							foreach($request_details as $rec_det) {
								$request_detail = $rec_det['PaymentRequest'];
								$pr_user_id = $request_detail['user_id'];
								$pr_reimbursed_amount = $request_detail['reimbursed_amount'];
								$pr_returned_amount = $request_detail['returned_amount'];
								$user = $rec_det['User'];
								$status = ucwords($request_detail['status']);
								$pr_requested_amount = $request_detail['requested_amount'];
								$requested_amount = "₱ ".number_format((float)$request_detail['requested_amount'],2,'.',',');
								$requested_by = $user['first_name']." ".$user['last_name'];
								$purpose = $request_detail['purpose'];
								$type_tmp = $request_detail['type'];
								if($type_tmp=="pettycash") {
									$type = "Petty Cash";
								}
								else {
									$type = ucwords($type_tmp);
								}
								
								echo 'Status: '.$status.'<br/>
									  Requested Amount: '.$requested_amount.'<br/>
									  Requested By: '.$requested_by.'<br/>
									  Purpose: '.$purpose.'<br/>
									  Type: '.$type.'<br/>';
							}
						}
						else {
							echo 'No data available in Request Details';
						}
					?>
				</div>
			</div>
		</div>
		<!--END OF REQUEST DETAILS-->
		
		<!--LOGS-->
		<?php if(!empty($logs)) { ?>
		<div class="col-lg-6">
			<div class="panel">
				<div class="panel-body">
					<label style="font-weight:bold;font-size:14px;">
						Logs
					</label><br/>
					<div class="table-responsive">
						<table class="table table-bordered table-striped"
							   cell-spacing="0" width="100%"
							   id="example">
							<thead>
								<tr>
									<th>Date Created</th>
									<th>User</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($logs as $log) {
										$ret_log = $log['PaymentRequestLog'];
										$created = date("F d, Y [h:i a]", strtotime($ret_log['created']));
										$user = $log['User'];
										$name = $user['first_name']." ".$user['last_name'];
										$status = ucwords($ret_log['status']);
										
										echo '<tr>
												<td>'.$created.'</td>
												<td>'.$name.'</td>
												<td>'.$status.'</td>
											  </tr>';
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<!--END OF LOGS-->
		
		<!--PURCHASE ORDERS-->
		<?php if(!empty($ppos)) { ?>
		<div class="col-lg-6">
			<div class="panel">
				<div class="panel-body">
					<label style="font-weight:bold;font-size:14px;">
						Purchase Order
					</label><br/>
					<div class="table-responsive">
						<table class="table table-bordered table-striped"
							   cell-spacing="0" width="100%"
							   id="example1">
							<thead>
								<tr>
									<th>PO Number</th>
									<th>PO Amount</th>
									<th>Amount Requested</th>
									<?php
									if($withPO == true) { 
										if($UserIn['User']['role']=='accounting_head' || $UserIn['User']['role']=='accounting_assistant' || $UserIn['UserIn']['role']=='proprietor_secretary' ||
											$UserIn['User']['id'] == $pr_user_id) { ?>
											<th>Action</th>
									<?php } 
									} ?>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($ppos as $pos) {
										$po = $pos['PurchaseOrder'];
										$po_id = $po['id'];
										$po_user_id = $po['user_id'];
										$ppo = $pos['PaymentPurchaseOrder'];
										$po_number = $po['po_number'];
										$po_amount = "₱ ".number_format((float)$po['grand_total'],2,'.',',');
										$amount_requested = $ppo['po_amount_request']; ?>
										<tr>
											<td><?php echo $po_number; ?></td>
											<td><?php echo $po_amount; ?></td>
											<td><?php echo $amount_requested; ?></td>
											<?php
												if($UserIn['User']['role']=='accounting_head' || $UserIn['User']['role']=='accounting_assistant' || $UserIn['UserIn']['role']=='proprietor_secretary' ||
													$UserIn['User']['id'] == $pr_user_id) { ?>
													<td align="center">
														<button class="btn btn-mint btn-xs"
															data-toggle="tooltip"
															data-placement="top"
															title="Add Liquidation"
															id="btn_liquidation"
															value="<?php echo $po_id; ?>">
															<span class="fa fa-plus"></span>
														</button>
													</td>
											<?php }?>
									   </tr>
								<?php }
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<!--END OF PURCHASE ORDERS-->
		
		<!--LIQUIDATED INVOICES-->
		<?php //if(!empty($payment_invoices)) { ?>
		<div class="col-lg-6">
			<div class="panel">
				<div class="panel-body">
					<div class="row">
						<div class="col-lg-6">
							<label style="font-weight:bold;font-size:14px;">
								Liquidated Invoices
							</label><br/>
						</div>
						<div class="col-lg-6" align="right">
							<?php
							if($withPO != true) { 
								if($UserIn['User']['role']=='accounting_head' || $UserIn['User']['role']=='accounting_assistant' || $UserIn['User']['role']=='proprietor_secretary' ||
									$UserIn['User']['id'] == $pr_user_id) { ?>
									<button class="btn btn-mint btn-xs"
											id="btn_liquidated_invoices"
											data-toggle="tooltip"
											data-placement="top"
											title="Add Liquidated Invoices">
										<span class="fa fa-plus"></span>
									</button>
							<?php }
							}
							if(!empty($payment_invoices)) {
								if($UserIn['User']['role']=='accounting_head' || $UserIn['User']['role']=='accounting_assistant') {
									if($pr_reimbursed_amount==0 && $pr_returned_amount==0) {
										$liquidated_amount = 0.000000;
										foreach($payment_invoices as $liquidated) {
											$liquidated_amount += $liquidated['PaymentInvoice']['amount'];
										}
										if($liquidated_amount!=$pr_requested_amount) {
											echo '<button class="btn btn-xs btn-danger"
														  id="btn_close_liquidation"
														  data-toggle="tooltip"
														  data-placement="top"
														  title="Close Liquidation">
													<span class="fa fa-book"></span>
												  </button>';
										}
									}
								}
							}?>
						</div>
					</div>
					<div class="col-lg-12">
						<div class="row">
							<div class="table-responsive">
								<table class="table table-bordered table-striped"
									   cell-spacing="0" width="100%"
									   id="example2">
									<thead>
										<tr>
											<th>Type</th>
											<th>Reference</th>
											<th>Amount</th>
											<?php
											if($UserIn['User']['role']=='accounting_head' || $UserIn['User']['role']=='accounting_assistant') {
												echo '<th>Valid</th>';
											}
											?>
										</tr>
									</thead>
									<tbody>
										<?php 
										$invoice_grand_total = 0.000000;
										foreach($payment_invoices as $payment_invoice) {
											$pi = $payment_invoice['PaymentInvoice'];
											$invoice_grand_total += floatval($pi['amount']); ?>
											<tr>
												<td><?php echo $pi['reference_type']; ?></td>
												<td><?php echo $pi['reference_number']; ?></td>
												<td><?php echo "₱ ".number_format((float)$pi['amount'],2,'.',','); ?></td>
												<?php
												if($UserIn['User']['role']=='accounting_head' || $UserIn['User']['role']=='accounting_assistant') { ?>
													<td>
														<input
															id="valid_purchase"
															type="checkbox"
															data-id = "<?php echo $pi['id']; ?>"
															<?php
															if($pi['valid_purchase']==1) {
																echo 'checked';
															}
															?> />
													</td>
												<?php } ?>
											</tr>
										<?php } ?>
									</tbody>
									<tfoot>
										<tr>
											<?php if($UserIn['User']['role']=='accounting_head' || $UserIn['User']['role']=='accounting_assistant') {
												echo '<th colspan="3">';
											}
											else {
												echo '<th colspan="2">';
											}?>
												Grand Total</th>
											<th><?php echo "₱ ".number_format((float)$invoice_grand_total,2,'.',','); ?></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php //} ?>
		<!--END OF LIQUIDATED INVOICES-->
		
		<!--ISSUED CHEQUES-->
		<?php if(!empty($payment_request_cheques)) { ?>
		<div class="col-lg-6">
			<div class="panel">
				<div class="panel-body">
					<label style="font-size:14px;font-weight:bold;">
						Issued Cheques
					</label>
					
					<div class="table-responsive">
						<table class="table table-bordered table-striped"
							   cell-spacing="0" width="100%">
							<thead>
								<tr>
									<th>Cheque Date</th>
									<th>Cheque Number</th>
									<th>Bank</th>
									<th>Payee</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach($payment_request_cheques as $payment_request_cheque) {
									$ret_prc = $payment_request_cheque['PaymentRequestCheque'];
									$prc_id = $ret_prc['id'];
									$pr_id = $ret_prc['payment_request_id'];
									$cheque_date = $ret_prc['cheque_date'];
									$cheque_number = $ret_prc['cheque_number'];
									$bank = $payment_request_cheque['Bank'];
									$bank_name = $bank['display_name'];
									$payee = $payment_request_cheque['Payee'];
									$payee_name = $payee['name'];
									$status = ucwords($ret_prc['status']);
									$void_btn = '';
									
									if($status=="Released"&&$user_role=="accounting_head") {
										$void_btn .= '<button class="btn btn-danger btn-xs"
															  id="btn_void"
															  value="'.$prc_id.'"
															  data-prid="'.$pr_id.'">
														Void
													  </button>';
									}
									
									echo '<tr>
											<td>'.$cheque_date.'</td>
											<td>'.$cheque_number.'</td>
											<td>'.$bank_name.'</td>
											<td>'.$payee_name.'</td>
											<td>'.$status.'<br/>'.$void_btn.'</td>
										  </tr>';
								}
								?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<?php } ?>
		<!--END OF ISSUED CHEQUES-->
		
		<!--EWT MONITORING-->
		<?php
		if(!empty($request_details)) {
			foreach($request_details as $rec_det) {
				$request_detail = $rec_det['PaymentRequest']; ?>
				<div class="col-lg-6">
					<div class="panel">
						<div class="panel-body">
							<p style="font-size:14px;font-weight:bold">EWT Monitoring</p>
							<div align="center">
								<?php
								if($request_detail['ewt_released']==null) {
									echo '<button class="btn btn-warning" id="btn_release"
											value="'.$request_detail['id'].'"
											data-type="release">
											Release
										</button>';
								}
								else {
									if ($request_detail['ewt_returned']==null) {
									echo '<button class="btn btn-danger" id="btn_receive"
											value="'.$request_detail['id'].'"
											data-type="receive">
											Receive
										</button>';
									}
								} ?>
							</div>
							<?php
							if($request_detail['ewt_released']!=null) {
								echo '<p>Released Date: '.date("F d, Y [h:i a]", strtotime($request_detail['ewt_released'])).'</p>';
							}
							if($request_detail['ewt_returned']!=null) {
								echo '<p>Returned Date: '.date("F d, Y [h:i a]", strtotime($request_detail['ewt_returned'])).'</p>';
							}
							?>
						</div>
					</div>
				</div>
		<?php }
		} ?>
		<!--END OF EWT MONITORING-->
	</div>
</div>

<!--Add Liquidation Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-liquidation-modal" role="dialog" tabindex="-1"
     aria-labelledby="add-liquidation-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			    <i class="pci-cross pci-circle"></i>
			  </button>
			  <h4 class="modal-title">
		          Liquidate
	          </h4>
			</div>
			<!--Modal body-->
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12" style="margin-bottom:20px;">
						<div class="row">
							<div class="col-sm-6">
								<select class="form-control" id="select_type">
									<option>Select Type</option>
									<option style="font-size:0.9px;background-color:grey" disabled>&nbsp;</option>
									<option>SI</option>
									<option>OR</option>
									<option>DR</option>
								</select>
							</div>
							<div class="col-sm-6">
								<input type="number" step="any" class="form-control"
									   placeholder="Receipt Amount"
									   id="inp_receipt_amount"
									   onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
							</div>
						</div>
					</div>
					<div class="col-sm-12" style="margin-bottom:20px;">
						<div class="row">
							<div class="col-sm-4">
								<input type="number" step="any" class="form-control"
									   placeholder="EWT" id="inp_ewt"
									   onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
							</div>
							<div class="col-sm-4">
							    <input type="number" step="any" class="form-control"
							    	   placeholder="Tax" id="inp_tax"
							    	   onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
							</div>
							<div class="col-sm-4">
							    <input type="number" step="any" class="form-control"
							    	   placeholder="With Held" id="inp_with_held"
							    	   onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
						    </div>
						</div>
					</div>
				    <div class="col-sm-6">
					    <input type="number" step="any" class="form-control"
					    	   placeholder="Reference Number" id="inp_reference_number"
					    	   onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
		    	    </div>
		    	    <div class="col-sm-6">
		    	    	<input type="date" class="form-control" id="inp_date" />
		    	    </div>
				    <input type="hidden" id="inp_payment_request_id" value="<?php echo $payment_request_id; ?>" />
				</div>
			</div>
            
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-primary" id="save_liquidation">Add</button>
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
<!--Add Liquidation Modal End-->


<!--Close Liquidation Modal Start-->
<!--===================================================-->
<div class="modal fade" id="close-liquidation-modal" role="dialog" tabindex="-1"
     aria-labelledby="close-liquidation-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			    <i class="pci-cross pci-circle"></i>
			  </button>
			  <h4 class="modal-title">
		          Close Liquidatation
	          </h4>
			</div>
			<!--Modal body-->
			<div class="modal-body">
				<select class="form-control" id="select_close_liquidation_type"
						style="margin-bottom:20px;">
					<option>Select Type</option>
					<option style="font-size:0.9px;background-color:grey" disabled>&nbsp;</option>
					<option value="reimburse">Reimburse</option>
					<option value="return">Return</option>
				</select>
				
				<input type="number" step="any"
					id="inp_close_liquidation_amount"
					class="form-control"
					placeholder="Amount"
					onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
			</div>
            
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-primary" id="close_liquidation">Okay</button>
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
<!--Close Liquidation Modal End-->

<!--JAVASCRIPT METHODS-->
<script>
	var passed_po = 0; 
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        
        $('#example, #example1, #example2').DataTable({
            "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
            "orderable": true,
            "order": [[0,"asc"]],
            "stateSave": false
        });
        
        $("#valid_purchase").on('click', function() {
        	if($(this).is(":checked")) {
	        	var valid = 1;
        	}
        	else {
        		var valid = 0;
        	}
        	var id = $(this).data('id');
        	var data = {"id": id, "valid":valid};
        	
        	$.ajax({
                url: '/payment_requests/valid',
                type: 'POST',
				data: {'data': data},
				dataType: 'text',
				success: function(id) {
					console.log(id);
					// location.reload();
				},
				error: function(err) {
					console.log("AJAX error: " + JSON.stringify(err, null, 2));
				}
            });
        });
        
        $("button#btn_void").on('click', function() {
        	var id = $(this).val();
        	var pr_id = $(this).data('prid')
        	swal({
                title: "Are you sure?",
                text: "This will void payment request cheque.",
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
					$.get('/payment_requests/void', {id: id, pr_id:pr_id}, function(data) {
						console.log(data);
						location.reload();
					})
                } else {
                    swal("Cancelled", "", "error");
                }
            });
        });
        
        $("#btn_release, #btn_receive").on('click', function() {
        	var id = $(this).val();
        	var type = $(this).data('type');
        	
        	swal({
        		title:"Are you sure?",
        		text:"This will "+type+" payment request.",
        		type:"warning",
        		showCancelButton:true,
        		confirmButtonClass: "btn-danger",
        		confirmButtonText: "Yes",
        		cancelButtonText: "No",
        		closeOnConfirm: false,
        		closeOnCancel: false
        	},
        	function (isConfirm) {
        		if(isConfirm) {
        			$.get('/payment_requests/update_ewt',{id:id, type:type},
        			function(data){
        				console.log(data);
        				location.reload();
        			});
        		}
        		else {
        			swal("Cancelled", "", "error");
        		}
        	});
        });
        
        $("button#btn_liquidation, #btn_liquidated_invoices").on('click', function() {
        	var id = $(this).val();
        	passed_po = id;
            $("#add-liquidation-modal").modal('show');
        });
        
        $("#save_liquidation").on('click', function() {
        	var type = $("#select_type");
        	var receipt_amount = $("#inp_receipt_amount");
        	var ewt = $("#inp_ewt");
        	var tax = $("#inp_tax");
        	var with_held = $("#inp_with_held");
        	var reference_number = $("#inp_reference_number");
        	var reference_date = $("#inp_date");
        	var po_id = passed_po;
        	var payment_request_id = $("#inp_payment_request_id");
        	
        	if(type.val() != "Select Type") {
        		if(receipt_amount.val() != "") {
        			if(ewt.val() != "") {
        				if(tax.val() != "") {
        					if(with_held.val() != "") {
        						if(reference_number.val() != "") {
        							if(reference_date.val() != "") {
        								var data = {"type":type.val(),
							        				"receipt_amount":receipt_amount.val(),
							        				"ewt":ewt.val(),
							        				"tax":tax.val(),
							        				"with_held":with_held.val(),
							        				"reference_number":reference_number.val(),
							        				"reference_date":reference_date.val(),
							        				"po_id":po_id,
							        				"payment_request_id":payment_request_id.val()};
							        	
							        	$.ajax({
							                url: '/payment_requests/liquidate',
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
        								reference_date.css({'border-color':'red'});
        							}
        						}
        						else {
        							reference_number.css({'border-color':'red'});
        						}
        					}
        					else {
        						with_held.css({'border-color':'red'});
        					}
        				}
        				else {
        					tax.css({'border-color':'red'});
        				}
        			}
        			else {
        				ewt.css({'border-color':'red'});
        			}
        		}
        		else {
        			receipt_amount.css({'border-color':'red'});
        		}
        	}
        	else {
        		type.css({'border-color':'red'});
        	}
        });
        
        $("button#btn_close_liquidation").on('click', function() {
            $("#close-liquidation-modal").modal('show');
        });
        
        $("#close_liquidation").on('click', function() {
        	var type = $("#select_close_liquidation_type");
        	var amount = $("#inp_close_liquidation_amount");
        	
        	if(type.val()!="Select Type") {
        		if(amount.val()!="") {
        			var passed_pr_id = "<?php echo $payment_request_id; ?>";
		        	var data={"id":passed_pr_id,"type":type.val(),"amount":amount.val()};
		        	
		        	$.ajax({
		                url: '/payment_requests/close_liquidation',
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
        			amount.css({'border-color':'red'});
        		}
        	}
        	else {
        		type.css({'border-color':'red'});
        	}
        });
    });
</script>