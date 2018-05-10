<!--IMPORTS-->
<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="/css/sweetalert.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="/js/sweetalert.min.js"></script>
<!--END IMPORTS-->

<div id="content-container">
	<div id="page-content">
		<!--REQUEST DETAILS-->
		<div class="col-lg-6">
			<div class="panel">
				<div class="panel-body">
					<?php 
						$type= '';
						$status = '';
						$pr_supplier_id = 0;
						$pr_user_id = 0;
						$pr_requested_amount = 0.000000;
						$pr_released_amount = 0.000000;
						$pr_reimbursed_amount = 0.000000;
						$pr_returned_amount = 0.000000;
						$requested_by = "<font class='text-danger'>Unknown</font>";
						if(!empty($request_details)) {
							foreach($request_details as $rec_det) {
								$request_detail = $rec_det['PaymentRequest'];
								$pr_user_id = $request_detail['user_id'];
								$pr_reimbursed_amount = $request_detail['reimbursed_amount'];
								$pr_returned_amount = $request_detail['returned_amount'];
								$user = $rec_det['InsertedBy'];
								$req_by = $rec_det['User'];
								$status = ucwords($request_detail['status']);
								$pr_requested_amount = $request_detail['requested_amount'];
								$pr_released_amount = $request_detail['released_amount'];
								$pr_liquidated_amount = $request_detail['liquidated_amount'];
								$requested_amount = "&#8369; ".number_format((float)$request_detail['requested_amount'],2,'.',',');
								
								if($UserIn['User']['role']=="proprietor" ||
								   $UserIn['User']['role']=="proprietor_secretary" ||
								   $UserIn['Department']['name']=="Purchasing (Supply)" ||
								   $UserIn['Department']['name']=="Purchasing (Raw)" ||
								   $UserIn['Department']['name']=="Purchasing") {
									$requested_by = $req_by['first_name']." ".$req_by['last_name'];
							    }
								else {
									$requested_by = $user['first_name']." ".$user['last_name'];
								}   
								
								$purpose = $request_detail['purpose'];
								$type_tmp = $request_detail['type'];
								$pr_supplier_id = $request_detail['supplier_id'];
								
								if($type_tmp=="pettycash") {
									$type = "Petty Cash";
								}
								else {
									$type = ucwords($type_tmp);
								}
								
								if($pr_returned_amount!=0){
									$returned_val = 'Returned Amount: &#8369; '.number_format((float)$pr_returned_amount,2,'.',',').'<br/>';
								}else{
									$returned_val = '';
								}
								
								if($pr_released_amount!=0){
									$released_val = 'Released Amount: &#8369; '.number_format((float)$pr_released_amount,2,'.',',').'<br/>'; 
								}else{
									$released_val = '<font color="red">Unreleased</font>';
								}
								
								if($pr_reimbursed_amount!=0){
									$reimbursed_val = 'Reimbursed Amount: &#8369; '.number_format((float)$pr_reimbursed_amount,2,'.',',').'<br/>';  
								}else{
									$reimbursed_val = '';
								}
								
								if($pr_liquidated_amount!=0){
									$liquidated_val = 'Total Liquidated Amount: &#8369; '.number_format((float)$pr_liquidated_amount,2,'.',',').'<br/>';  
								}else{
									$liquidated_val = '';
								}
								?>
								
								<label style="font-weight:bold;font-size:14px;">
									<?php echo ucwords($type); ?> Request Details
								</label><br/>
								<?php
								
								echo 'Status: '.$status.'<br/>
									  Requested Amount: '.$requested_amount.'<br/>
									  Requested By: '.$requested_by.'<br/>
									  Purpose: '.$purpose.'<br/> 
									  '.$released_val.'
									  '.$liquidated_val.'
									  '.$returned_val.'
									  '.$reimbursed_val;
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
		<?php // if(!empty($logs)) { ?>
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
										$log_id = $ret_log['id'];
										$created = time_elapsed_string($ret_log['created']);
										$type_log = $log['PaymentRequest']['type'];
										$user = $log['User'];
										$name = ucwords($user['first_name']." ".$user['last_name']);
										$status = ucwords($ret_log['status']);
										
										echo '<tr>
												<td data-order="'.$ret_log['created'].'">'.$created.'</td>
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
		<?php // } ?>
		<!--END OF LOGS-->
		
		<!--PURCHASE ORDERS-->
		<?php if($pr_supplier_id!=0) { ?>
		<div class="col-lg-6">
			<div class="panel">
				<div class="panel-body">
					<label style="font-weight:bold;font-size:14px;">
						Purchase Order
					</label><br/>
					<div class="table-responsive">
						<table class="table table-bordered table-striped"
							   cell-spacing="0" width="100%"
							   id="examplea">
							<thead>
								<tr>
									<th>PO Number</th>
									<th>PO Amount</th>
									<th>PO Status</th>
									<th>Amount Requested</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								<?php
									foreach($ppos as $pos) {
										$po = $pos['PurchaseOrder'];
										$po_id = $po['id'];
										$po_user_id = $po['user_id'];
										$ppo = $pos['PaymentPurchaseOrder'];
										$stat = ucwords($po['status']);
										$po_number = $po['po_number'];
										$po_amount = "&#8369; ".number_format((float)$po['grand_total'],2,'.',',');
										$amount_requested = $ppo['po_amount_request']; ?>
										<tr>
											<td><?php echo $po_number; ?></td>
											<td><?php echo $po_amount; ?></td>
											<td style="font-weight:bold;"><?php echo $stat; ?></td>
											<td><?php echo $amount_requested; ?></td>
											<?php
											if($status=="Released") {
												if($UserIn['User']['role']=='accounting_head' || $UserIn['User']['role']=='accounting_assistant' || $UserIn['User']['role']=='proprietor_secretary' ||
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
											<?php }
												else {
													echo '<td class="text-danger">Not available.</td>';
												}
											}
											else {
												echo '<td class="text-danger">Not available.</td>';
											}?>
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
							if($status=="Released") {
								if($UserIn['User']['role']=='accounting_head' || $UserIn['User']['role']=='accounting_assistant' || $UserIn['User']['role']=='proprietor_secretary' ||
									$UserIn['User']['id'] == $pr_user_id) { ?>
									<button class="btn btn-xs btn-mint"
											id="btn_liquidated_invoices">
										<span class="fa fa-plus"></span>
										Add Liquidated Invoices
									</button>
							<?php }
							}
							}
							if(!empty($payment_invoices)) {
								if($UserIn['User']['role']=='accounting_head' || $UserIn['User']['role']=='accounting_assistant') {
									if($pr_reimbursed_amount==0 && $pr_returned_amount==0) {
										$liquidated_amount = 0.000000;
										foreach($payment_invoices as $liquidated) {
											$liquidated_amount += $liquidated['PaymentInvoice']['amount'];
										}
										if($liquidated_amount!=$pr_released_amount) {
											echo '<button class="btn btn-xs btn-danger"
														  id="btn_close_liquidation">
													<span class="fa fa-ban"></span>
													Close Liquidation
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
									   id="exampleb">
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
												<td><?php echo "&#8369; ".number_format((float)$pi['amount'],2,'.',','); ?></td>
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
											<th><?php echo "&#8369; ".number_format((float)$invoice_grand_total,2,'.',','); ?></th>
										</tr>
									</tfoot>
								</table>
							</div>
						</div>
					</div>
					<?php
					if(!empty($payment_invoices)) {
						if($status=="Released") {
							echo '
								<button id="btn_done_liquidation"
										class="pull-right btn btn-warning">
									Done Liquidation?
								</button>
							';
						}
					}
					
							if($type == 'Cash'){
								if($status=="Liquidated") {
									if($UserIn['User']['role']=="accounting_head" ) {?>
                                        <button class="btn btn-success pull-right"
                                                id="btn_verify"
                                                value="<?php echo $this->params['url']['id']; ?>"
                                                data-action="verified"   >
                                            <span class="fa fa-thumbs-up"></span> Verify 
                                        </button>
                                                <?php
                                           }
                                        }
                                if($status=="Verified") { 
                                	if($UserIn['User']['role']=="proprietor" || $UserIn['User']['role']=="proprietor_secretary") { ?>
                                        <button class="btn btn-success pull-right"
                                                id="btn_close"
                                            value="<?php echo $this->params['url']['id']; ?>"
                                                data-action="closed"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Close">
                                            <span class="fa fa-lock"></span> Close
                                        </button>
                                            <?php
                                     } 
                                }
							}
					?>
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
									<th>Amount</th>
									<th>Bank</th>
									<th>Payee</th>
									<th>Status</th>
									<th>Void Reason</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach($payment_request_cheques as $payment_request_cheque) {
									$ret_prc = $payment_request_cheque['PaymentRequestCheque'];
									$prc_id = $ret_prc['id'];
									$pr_id = $ret_prc['payment_request_id'];
									$cheque_date_tmp = $ret_prc['cheque_date'];
									$cheque_number = $ret_prc['cheque_number'];
									$amount_check = $request_detail['requested_amount'];
									$bank = $payment_request_cheque['Bank'];
									$bank_name = $bank['display_name'];
									$payee = $payment_request_cheque['Payee'];
									$payee_name_tmp = $payee['name'];
									$status = ucwords($ret_prc['status']);
									$void_btn = '';
									$void_reason_tmp = $ret_prc['void_reason'];
									
									if($void_reason_tmp!="" || $void_reason_tmp!=null) {
										$void_reason = $void_reason_tmp;
									}
									else { 
										
										$void_reason = "<a class='btn btn-info'
                                                    href='/pdfs/print_cheque?id=".$payment_request_cheque['PaymentRequestCheque']['id']."'
                                                    target='_blank'
                                                    data-toggle='tooltip'
                                                    data-placement='top'
                                                    title='Print Cheque'>
                                                    <span class='fa fa-print'></span>
                                                </a>";
									}
									
									if($cheque_date_tmp != null ||
									   $cheque_date_tmp != "0000-00-00") {
										$cheque_date = time_elapsed_string($cheque_date_tmp);
								    }
								    else {
								    	$cheque_date = "<font style='color:red'>Not Specified</font>";
								    }
								    
								    if($payee_name_tmp != "") {
								    	$payee_name = ucwords($payee_name_tmp);
								    }
								    else {
								    	$payee_name = "<font style='color:red'>Unknown</font>";
								    }
									
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
											<td>&#8369; '.number_format((float)$amount_check, 2, ".", ",").'</td>
											<td>'.$bank_name.'</td>
											<td>'.$payee_name.'</td>
											<td>'.$status.'<br/>'.$void_btn.'</td>
											<td>'.$void_reason.'</td>
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
		// if(!empty($request_details)) {
			foreach($request_details as $rec_det) {
				$request_detail = $rec_det['PaymentRequest']; ?>
				<div class="col-lg-6">
					<div class="panel" style="margin-bottom:70px;">
						<div class="panel-body">
							<p style="font-size:14px;font-weight:bold">EWT Monitoring</p>
							<div align="center">
								<?php
								if($UserIn['User']['role']!="supply_staff" && $UserIn['User']['role']!="raw_head") {
									if($status!="Pending" && $status!="Acknowledged") {
										if($request_detail['ewt_released']==null) {
											if($status!="Released") {
												echo '<button class="btn btn-warning" id="btn_release_text"
														data-id="'.$request_detail['id'].'"
														data-prpayee="'.$request_detail['payee_id'].'"
														data-tostatus="released"
                                                    	data-toreleaseamnt="'.$request_detail['requested_amount'].'">
														Release
													</button>';
											}
										}
										
										if($request_detail['ewt_returned']==null && $status!="Received") {
											if($status!="Closed" && $status!="Pending" && $status!="Pending" && $status!="Acknowledged" && $status!="Approved") {
												echo '<button class="btn btn-danger" id="btn_receive"
														value="'.$request_detail['id'].'"
														data-tostatus="returned">
														Receive
													</button>';
											}
										}
									}
									else {
										echo "<p class='text-danger'>Waiting for approval.</p>";
									}
								}
								?>
							</div>
							<?php
							if($request_detail['ewt_released']!=null) {
								echo '<p>Released Date: '.time_elapsed_string($request_detail['ewt_released']).'</p>';
							}
							if($request_detail['ewt_returned']!=null) {
								echo '<p>Returned Date: '.time_elapsed_string($request_detail['ewt_returned']).'</p>';
							}
							?>
						</div>
					</div>
				</div>
		<?php // }
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
									<option>None</option>
								</select>
							</div>
							<div class="col-sm-6">
								<input type="number" step="any" class="form-control"
									   placeholder="Receipt Amount"
									   id="inp_receipt_amount"
									    />
							</div>
						</div>
					</div>
					<div class="col-sm-12" style="margin-bottom:20px;">
						<div class="row">
							<div class="col-sm-4">
								<input type="number" step="any" class="form-control"
									   placeholder="EWT" id="inp_ewt"
									    />
							</div>
							<div class="col-sm-4">
							    <input type="number" step="any" class="form-control"
							    	   placeholder="Tax" id="inp_tax"
							    	    />
							</div>
							<div class="col-sm-4">
							    <input type="number" step="any" class="form-control"
							    	   placeholder="With Held" id="inp_with_held"
							    	  />
						    </div>
						</div>
					</div>
				    <div class="col-sm-6">
					    <input type="number" step="any" class="form-control"
					    	   placeholder="Reference Number" id="inp_reference_number"
					    	   />
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
					  />
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

<!--Void Modal Start-->
<!--===================================================-->
<div class="modal fade" id="void-modal" role="dialog" tabindex="-1"
     aria-labelledby="void-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			    <i class="pci-cross pci-circle"></i>
			  </button>
			  <h4 class="modal-title">
		          Void
	          </h4>
			</div>
			<!--Modal body-->
			<div class="modal-body">
				<textarea id="input_remarks"
				 placeholder="Remarks" class="form-control"></textarea>
			</div>
            
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-danger" id="btn_submit_void">Submit</button>
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
<!--Void Modal End-->

<!--Release Modal Start-->
<!--===================================================-->
<div class="modal fade" id="release-modal" role="dialog" tabindex="-1"
     aria-labelledby="release-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			    <i class="pci-cross pci-circle"></i>
			  </button>
			  <h4 class="modal-title">
		          Release Request
	          </h4>
			</div>
			<!--Modal body-->
			<div class="modal-body">
			    <div class="form-group">
			        <p>Requested by: <?php echo $requested_by; ?></p>
			    </div>
			    
		         <?php
                    if($type!='Cheque') {
                        ?>
                        <div class="form-group" style="margin-bottom:20px;">
                            <input type="number" step="any" class="form-control"
                               id="released_amount" placeholder="Amount"
                             />
                        </div>
                        <?php
                    }
                    else { ?>
                        <div class="form-group">
                	        <select class="form-control" id="select_payee_release">
                                <option>Select Payee</option>
                        		<?php
                        		foreach($payees as $payee) {
                        		    $payee_id = $payee['Payee']['id'];
                        		    $payee_name = $payee['Payee']['name'];
                        		    echo '<option value="'.$payee_id.'">'.$payee_name.'</option>';
                        		}
                        		?>
                        	</select>
                    	</div>
                    	
                        <div class="form-group" style="margin-bottom:20px;">
                            <select class="form-control" id="select_bank">
                                <option>Select Bank</option>
                                <?php
                                foreach($banks as $bank) {
                                    echo '<option value="'.$bank['Bank']['id'].'">
                                    '.$bank['Bank']['display_name'].'
                                    </option>';
                                }
                                ?>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" class="form-control" id="input_cheque_number"
                                       placeholder="Cheque Number" />
                                </div>
                                <div class="col-lg-6">
                                    <input type="date" class="form-control" id="input_cheque_date" />
                                </div>
                            </div>
                        </div>
	            	<?php
	            	}
           		?>
			</div>
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-primary" id="btn_release">Release</button>
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
<!--Release Modal End-->

<!--JAVASCRIPT METHODS-->
<script>
	var passed_po = 0;
	var all_list_pr_id_release = 0;
	var passed_pr_status = '';
	var passed_pr_type = '<?php echo $type_tmp; ?>';
    $(document).ready(function() {
        $('[data-toggle="tooltip"]').tooltip();
        
        // $('#example').DataTable({
        //     "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
        //     "orderable": true,
        //     "order": [[0,"desc"]],
        //     "stateSave": false
        // });
        
        // $('#examplea').DataTable({
        //     "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
        //     "orderable": true,
        //     "order": [[0,"asc"]],
        //     "stateSave": false
        // });
        
        // $('#exampleb').DataTable({
        //     "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
        //     "orderable": true,
        //     "order": [[0,"asc"]],
        //     "stateSave": false
        // });
        
        $("#btn_done_liquidation").on('click', function() {
        	swal({
        		title: "Are you sure?",
        		text: "You are about to finish liquidation.",
        		type: "warning",
        		showCancelButton: true,
        		confirmButtonText: "Yes",
        		cancelButtonText: "No",
        		closeOnConfirm: true,
        		closeOnCancel: true
        	},
        	function(isConfirm) {
        		if(isConfirm) {
        			var data = {"payment_request_id": parseInt("<?php echo $payment_request_id; ?>")};
        			$.ajax({
        				url: "/payment_requests/done_liquidation",
        				type: "POST",
        				data: {"data": data},
        				dataType: "text",
        				success: function(success) {
        					console.log("Success: "+success);
        					swal({
        						title: "Success!",
        						text: "Successfully liquidated payment request.",
        						type: "success"
        					},
        					function (isConfirm1) {
        						if(isConfirm1) {
        							location.reload();
        						}
        					});
        				},
        				error: function(error) {
        					console.log("Error: "+ error);
        					swal({
        						title: "Oops!",
        						text: "An error occured.\n Please try again later.",
        						type: "warning"
        					});
        				}
        			});
        		}
        	});
        });
        
        $("button#btn_release_text").on('click', function() {
	        var payment_request_id = $(this).data('id');
	        var pr_status = $(this).data('tostatus');
	        var pr_payee = $(this).data('prpayee');
	        passed_pr_status = pr_status;
	        all_list_pr_id_release = payment_request_id;
	        console.log(passed_pr_type+" "+passed_pr_status);
	        var toreleaseamnt = $(this).data('toreleaseamnt');
	        $("#released_amount").val(toreleaseamnt);
	        $("#select_payee_release").val(pr_payee);
	        $('#release-modal').modal('show');
	    });
	    
	    $("#btn_receive").on('click', function() {
        	var id = $(this).val();
        	var this_status = $(this).data('tostatus');
        	var data = {"id":id, "status":this_status};
        	
        	swal({
        		title:"Are you sure?",
        		text:"This Payment Request will be "+this_status+".",
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
        			$.ajax({
        				url: '/payment_requests/update_ewt',
        				type: 'POST',
        				data: {"data": data},
        				dataType:'text',
        				success: function(msg) {
        					console.log(msg);
        					location.reload();
        				},
        				error: function(error) {
        					console.log("Error: "+error);
        					swal({
				        		title:"Oops!",
				        		text:"There was something while Payment Invoice was being "+type+". Please try again.",
				        		type:"warning"
				        	});
        				}
        				
        			});
        		}
        		else {
        			swal("Cancelled", "", "error");
        		}
        	});
        });
        
        $("input#valid_purchase").on('click', function() {
        	if($(this).is(":checked")) {
	        	var valid = 1;
	        	var text_valid = "validated";
        	}
        	else {
        		var valid = 0;
        		var text_valid = "invalidated";
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
					if(id == "Error in saving valid") {
						swal({
			                title: "Oops!",
			                text: "There was an error in validating. Please try again.",
			                type: "warning"
			            },
			            function (isConfirm) {
			                if (isConfirm) {
			                	location.reload();
			                }
			            });
					}
					else {
						swal({
			                title: "Success!",
			                text: "Payment Invoice was "+text_valid+".",
			                type: "success"
			            });
					}
				},
				error: function(err) {
					console.log("AJAX error: " + JSON.stringify(err, null, 2));
					swal({
		                title: "Oops!",
		                text: "There was an error in validating. Please try again.",
		                type: "warning"
		            });
				}
            });
        });
        
        var passed_id = 0;
        var passed_pr_id = 0;
        $("button#btn_void").on('click', function() {
        	$("#void-modal").modal("show");
        	passed_id = $(this).val();
        	passed_pr_id = $(this).data('prid');
        });
        
        $("button#btn_submit_void").on('click', function() {
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
                	var remarks = $("#input_remarks").val();
					var data = {"id": passed_id, "pr_id": passed_pr_id, "remarks": remarks};
					
					$.ajax({
		                url: '/payment_requests/void',
		                type: 'POST',
						data: {'data': data},
						dataType: 'text',
						success: function(id) {
							location.reload();
						},
						error: function(error) {
							swal({
				                title: "Oops!",
				                text: "Error in Void. Please try again.",
				                type: "warning"
							});
						}
					});
                } else {
                    swal("Cancelled", "", "error");
                }
            });
        });
        
        $("#btn_release").on('click', function() {
	        var released_amount = $("#released_amount");
	        var select_bank = $("#select_bank");
	        var input_cheque_number = $("#input_cheque_number")
	        var selected_payee = $("#select_payee_release");;
	        var input_cheque_date = $("#input_cheque_date");
        	var type = passed_pr_type;
	        
	        var data_release = {"id":all_list_pr_id_release,
	                            "type":type,
	                            "status":passed_pr_status,
	                            "released_amount":released_amount.val(),
	                            "select_bank":select_bank.val(),
	                            "input_cheque_number":input_cheque_number.val(),
	                            "selected_payee":selected_payee.val(),
	                            "input_cheque_date":input_cheque_date.val()};
	        console.log(data_release);
	        if(type != "cheque") {
	            if(released_amount.val()!="") {
	                // RELEASE AJAX HERE
	                $.ajax({
	                    url: '/payment_requests/release',
	                    type: 'POST',
						data: {'data': data_release},
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
	                released_amount.css({'border-color':'red'});
	            }
	        }
	        else {
	            if(select_bank.val()!="Select Bank") {
	                if(input_cheque_number.val()!="") {
	                    if(input_cheque_date.val()!="") {
	                    	$.ajax({
	                    		url: "/payment_request_cheques/check_existing",
	                    		type: "POST",
	                    		data: {"data": input_cheque_number.val()},
	                    		dataType: "text",
	                    		success: function(success) {
	                    			console.log(success);
	                    			if(success=="no") {
				                        // RELEASE AJAX HERE
				                         $.ajax({
				                            url: '/payment_requests/release',
				                            type: 'POST',
				            				data: {'data': data_release},
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
	                    				swal({
	                    					title: "Oops!",
	                    					text: "Cheque Number already exists in the database."+
	                    						  "Please indicate another cheque number and try again.",
	                    					type: "warning"
	                    				});
	                    			}
	                    		}
	                    	});
	                    }
	                    else {
	                        input_cheque_date.css({'border-color':'red'});
	                    }
	                }
	                else {
	                    input_cheque_number.css({'border-color':'red'});
	                }
	            }
	            else {
	                select_bank.css({'border-color':'red'});
	            }
	        }
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
        	var tax =$("#inp_tax");
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
							        				"receipt_amount":parseFloat(receipt_amount.val()),
							        				"ewt":parseFloat(ewt.val()),
							        				"tax":parseFloat(tax.val()),
							        				"with_held":parseFloat(with_held.val()),
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
		        	var data={"id":passed_pr_id,"type":type.val(),"amount":parseFloat(amount.val())};
		        	
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
    
    
    $("button#btn_close, button#btn_verify").on('click',function(e) {
        var id = $(this).val();
        var action = $(this).data('action');
        swal({
            title: "Are you sure?",
            text: "This request will be "+action+".",
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
                var data = {"id":id, "action":action, "supplier_id": 0};
                
                $.ajax({
                    url: '/payment_requests/action',
                    type: 'POST',
                	data: {'data': data},
                	dataType: 'text',
                	success: function(id) {
                		console.log(id);
                		swal({
                		    title: "Success!",
                		    text: "Successfully "+action+" payment request.",
                		    type: "success"
                		},
                		function(isConfirm1) {
                		    if(isConfirm1) {
                                location.reload();
                		    }
                		});
                	},
                	error: function(err) {
                		console.log("AJAX error: " + JSON.stringify(err, null, 2));
                		swal({
                		    title: "Oops!",
                		    text: "An error occurred. Please try again later.",
                		    type: "warning"
                		});
                	}
                });
            } else {
                swal("Cancelled", "", "error");
            }
        });
    });
</script>