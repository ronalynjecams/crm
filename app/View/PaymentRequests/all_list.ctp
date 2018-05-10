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
            <?php
                if ($type == "pettycash") {
                    $display_type = "Petty Cash";
                }
                else {
                    $display_type = ucwords($type);
                }
                echo $display_type.' Request <small>'.ucwords($status).'</small>';
            ?>
        </h1>
    </div>
    
    <div id="page-content">
        <?php if($UserIn['User']['role']=="accounting_head" ||
                 $UserIn['User']['role']=="accounting_assistant" || 
                 $UserIn['User']['role']=="proprietor" ||
                 $UserIn['User']['role']=="proprietor_secretary" ||
                 $UserIn['Department']['name']=="Purchasing (Supply)" ||
                 $UserIn['Department']['name']=="Purchasing (Raw)" ||
                 $UserIn['Department']['name']=="Purchasing") { ?>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title" align="right">
                        <a href="/payment_requests/po_request_add?type=<?php echo $type; ?>">
                            <button class="btn btn-mint" style="color:white">
                                <span class="fa fa-plus"></span>
                                Add PO Payment Request
                            </button>
                        </a>
                        <button class="btn btn-info" id="btn_add_request">
                            <span class="fa fa-plus"></span>
                            Add Request
                        </button>
                        
                        <?php
                        if(!empty($payment_requests)) {
                            if($status=="verified" && $type=="pettycash") {
                                if($UserIn['User']['role']=="accounting_head" || $UserIn['User']['role']=="accounting_assistant") {
                                    ?>
                                    <button class="btn btn-danger"
                                            id="btn_replenish"
                                            data-action="replenished">
                                        <span class="fa fa-check-square"></span>
                                        Replenish
                                    </button>
    
                                    <input type="checkbox" id="check_all" />
                                	<label style="margin-bottom:8px;vertical-align:middle;"
                                	       id="label_for_check">Select All</label>
                                    <?php
                                }
                            }
                        }
                        ?>
                    </h3>
                </div>
                <?php //pr($payment_requests); ?>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="example"
                               class="table table-striped table-bordered"
    					       cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <?php
                                    if($type=="pettycash") {
                                        echo '<th>Control Number</th>
                                              <th>Invoices</th>';
                                    } ?>
                                    <th>Date <?php echo "(".ucwords($type).")"; ?></th>
                                    <th>Processed By</th>
                                    <th>Requested Amount</th>
                                    <th width="170">Amount Released</th>
                                    <?php
                                    if($type=="pettycash") { ?>
                                    <th>Total Expense</th>
                                    <th>Returned Cash</th>
                                    <th>Reimbursed Cash</th>
                                    <?php
                                    }
                                    if($type=="cheque") {
                                      ?>
                                      <th>Payee</th>
                                      <?php
                                    }
                                    ?>
                                    <th>Released Details</th>
                                    <th width="190">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($payment_requests as $payment_request) {
                                    $payment_request_obj=$payment_request['PaymentRequest'];
                                    $user = $payment_request['Payee'];
                                    $payment_request_id = $payment_request_obj['id'];
                                    
                                    $created = '';
                                    if($status == "pending") {
                                        $created = time_elapsed_string($payment_request_obj['created']);
                                    }
                                    else {
                                        if(!empty($payment_request_logs[$payment_request_id])) {
                                            foreach($payment_request_logs[$payment_request_id] as $payment_request_log) {
                                                $created = time_elapsed_string($payment_request_log['PaymentRequestLog']['created']);
                                            }
                                        }
                                    }
                                    
                                    $created_released = '';
                                    if($type!='cheque') {
                                        foreach($payment_request_logs_released[$payment_request_id] as $payment_request_log_released) {
                                            $created_released_date = $payment_request_log_released['PaymentRequestLog']['created'];
                                            $created_released = "[ ".time_elapsed_string($created_released_date)." ]";
                                        }
                                    }
                                    
                                    $bank_info = '';
                                    foreach($payment_request_cheques[$payment_request_id] as $each_payment_request_cheque) {
                                        $payment_request_cheque = $each_payment_request_cheque['PaymentRequestCheque'];
                                        $bank = $each_payment_request_cheque['Bank'];
                                        $bank_name = $bank['display_name'];
                                        $cheque_number = $payment_request_cheque['cheque_number'];
                                        $cheque_date = time_elapsed_string($payment_request_cheque['cheque_date']);
                                        $bank_info = ucwords($bank_name)." ".$cheque_number." [ ".$cheque_date." ]";
                                    }

                                    $total_expense_each_tmp = 0;
                                    $payment_invoice_display = "";
                                    $PaymentInvoice = $payment_request['PaymentInvoice'];
                                    if(!empty($PaymentInvoice)) {
                                        foreach($PaymentInvoice as $returnPaymentInvoice) {
                                            $reference_type = $returnPaymentInvoice['reference_type'];
                                            $reference_number = $returnPaymentInvoice['reference_number'];
                                            $total_expense_each_tmp += $returnPaymentInvoice['amount'];
                                            $payment_invoice_display .= "<p>$reference_type-$reference_number</p>";
                                        }
                                    }
                                    else {
                                        $payment_invoice_display = "<font class='text-danger'>No Payment Invoice.</font>";
                                    }
                                    
                                    $total_expense_each = "&#8369; ".number_format((float)$total_expense_each_tmp, 2, ".", ",");
                                    
                                    $returned_amount = "&#8369; ".number_format((float)$payment_request_obj['returned_amount'], 2, ".", ",");
                                    $reimbursed_amount= "&#8369; ".number_format((float)$payment_request_obj['reimbursed_amount'], 2, ".", ",");
                                ?>
                                <tr>
                                    <?php
                                    if($type=="pettycash") {
                                        echo '<td>'.$payment_request_obj['control_number'].'</td>
                                        <td>'.$payment_invoice_display.'</td>';
                                    }
                                    ?>
                                    <td data-order="<?php echo $payment_request_obj['created']; ?>"><?php echo $created; ?></td>
                                    <?php
                                    if($UserIn['User']['role']=='proprietor' ||
                                       $UserIn['Department']['name']=='Purchasing (Supply)' ||
                                       $UserIn['Department']['name']=='Purchasing (Raw)' ||
                                       $UserIn['Department']['name']=='Purchasing') {
                                        // echo "<td>".ucwords($payment_request['User']['first_name'].' '.$payment_request['User']['last_name'])."</td>";
                                        echo "<td>".ucwords($payment_request['InsertedBy']['first_name'].' '.$payment_request['InsertedBy']['last_name'])."</td>";
                                    }
                                    else {
                                        echo "<td>".ucwords($payment_request['InsertedBy']['first_name'].' '.$payment_request['InsertedBy']['last_name'])."</td>";
                                    } ?>
                                    <td><?php echo "₱ ".number_format((float)$payment_request_obj['requested_amount'],2,'.',','); ?></td>
                                    <td>
                                        <?php
                                        if($status!="pending" &&
                                           $status!="approved" &&
                                           $status!="acknowledged") {
                                               if($type=="cheque") {
                                                    echo "₱ ".number_format((float)$payment_request_obj['requested_amount'],2,'.',',')." ".$created_released;
                                               }
                                               else {
                                                    echo "₱ ".number_format((float)$payment_request_obj['released_amount'],2,'.',',')." ".$created_released;
                                               }
                                        ?>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <p><?php echo $created; ?></p>
                                                    <p><?php echo $bank_info; ?></p>
                                                </div>
                                                <div class="col-lg-6" style="margin-top:15px;">
                                                    <p>(<?php echo ucwords($status); ?>)</p>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        else {
                                            echo
                                            "<p>(".ucwords($status).")</p>";
                                        }
                                        ?>
                                    </td>
                                    <?php 
                                    if($type=='cheque') {
                                        echo '
                                        <td>'.ucwords($payment_request['Payee']['name']).'</td>
                                        ';
                                    }
                                    ?>
                                    <?php
                                    if($type=="pettycash") {
                                        echo '<td>'.$total_expense_each.'</td>
                                              <td>'.$returned_amount.'</td>
                                              <td>'.$reimbursed_amount.'</td>';
                                    }
                                    // if($status=="pending" || $status=="acknowledged"
                                    //     || $status=="approved" || $status=="released") {
                                        echo '<td>'.$payment_request_obj['purpose'];
                                        if($payment_request_obj['supplier_id']!=0) {
                                            echo '<p>&nbsp;</p>';
                                            if(array_key_exists($payment_request_id, $ppos_obj)) {
                                                $payment_pos = $ppos_obj[$payment_request_id];
                                                if(!empty($payment_pos)) {
                                                    foreach($payment_pos as $payment_po) {
                                                        $eppo = $payment_po['PurchaseOrder'];
                                                        $epo_id = $eppo['id'];
                                                        $po_no = $eppo['po_number'];
                                                        $po_type = ucwords($eppo['type']);
                                                        
                                                    echo ' 
                                                    <p>
                                                        '.$po_type.' PO #: '.$po_no.'
                                                        <a href="/purchase_orders/view_po?id='.$epo_id.'"
                                                        target="_blank"
                                                           data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="Go to PO"
                                                           class="btn btn-xs btn-primary">
                                                            <span class="fa fa-eye"></span>
                                                        </a>
                                                    </p>
                                                    ';
                                                    }
                                                }
                                            }
                                        // }
                                        echo '</td>';
                                    }
                                    ?>
                                    <td id="checkBoxes">
                                        <a href="/payment_requests/view?id=<?php echo $payment_request_obj['id']; ?>"
                                           style="color:white">
                                            <button class="btn btn-primary"
                                                data-toggle="tooltip"
                                                date-placement="left"
                                                title="View Details Available for All Status">
                                                <span class="fa fa-eye"></span>
                                            </button>
                                        </a>
                                        
                                        <?php
                                        if($role=="proprietor" || $role=="proprietor_secretary" ||
                                           $role=="accounting_head" || $role=="accouting_assistant") {
                                        ?>
                                        
                                        <?php
                                        if($status=="pending" || $status=="acknowledged" ||
                                            $status=="approved") { ?>
                                            <?php
                                            $epo_id = [];
                                            if($payment_request_obj['supplier_id']!=0) {
                                                if(array_key_exists($payment_request_id, $ppos_obj)) {
                                                    $payment_pos = $ppos_obj[$payment_request_id];
                                                    if(!empty($payment_pos)) {
                                                        foreach($payment_pos as $payment_po) {
                                                            $eppo = $payment_po['PurchaseOrder'];
                                                            $epo_id[$payment_request_obj['id']] = $eppo['id'];
                                                        }
                                                    }
                                                }
                                            } ?>
                                        
                                        <button class="btn btn-warning"
                                            data-toggle="tooltip"
                                            data-placement="top"
                                            title="Reject Request"
                                            value="<?php echo $payment_request_obj['id']; ?>"
                                            data-supplierid="<?php echo $payment_request_obj['id']; ?>"
                                            data-action="rejected"
                                            id="btn_reject_request">
                                            <span class="fa fa-close"></span>
                                        </button>
                                        <?php
                                        }
                                        if($status=="pending") {
                                            if($type=="cash") {
                                                if($UserIn['User']['role']=="accounting_head" ||
                                                   $UserIn['User']['role']=="accounting_assistant") {
                                                       ?>
                                                   <button class="btn btn-default" id="btn_acknowledge"
                                                           value="<?php echo $payment_request_obj['id']; ?>"
                                                           data-action="acknowledged"
                                                           data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="Acknowledge">
                                                       <span style="color:gold" class="fa fa-certificate"></span>
                                                   </button>
                                                   <?php
                                               }
                                            }
                                            else if($type=="cheque") {
                                                if($UserIn['User']['role']=="proprietor" ||
                                                   $UserIn['User']['role']=="proprietor_secretary") {
                                                    ?>
                                                    <button class="btn btn-success"
                                                            id="btn_approve"
                                                            value="<?php echo $payment_request_obj['id']; ?>"
                                                            data-action="approved"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Approve">
                                                        <span class="fa fa-check"></span>
                                                    </button>
                                                    <?php
                                                }
                                            }
                                            else if($type=="pettycash") {
                                                if($UserIn['User']['role']=="accounting_head" ||
                                                   $UserIn['User']['role']=="accounting_assistant" ||
                                                   $UserIn['User']['role']=="proprietor") {
                                                    ?>
                                                    <button class="btn btn-success"
                                                            id="btn_approve"
                                                            value="<?php echo $payment_request_obj['id']; ?>"
                                                            data-action="approved"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Approve">
                                                        <span class="fa fa-check"></span>
                                                    </button>
                                                    <?php
                                               }
                                            }
                                        }
                                        else if($status=="acknowledged") {
                                            if($type=="cash") {
                                                if($UserIn['User']['role']=="proprietor" ||
                                                   $UserIn['User']['role']=="proprietor_secretary") {
                                                   ?>
                                                    <button class="btn btn-success"
                                                           id="btn_approve"
                                                           value="<?php echo $payment_request_obj['id']; ?>"
                                                           data-action="approved"
                                                           data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="Approve">
                                                       <span class="fa fa-check"></span>
                                                    </button>
                                                   
                                                    <button
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Approve and Release"
                                                        id="btn_approve_release"
                                                        class="btn btn-danger"
                                                        style="color:white;font-weight:bold;"
                                                        data-id="<?php echo $payment_request_obj['id']; ?>"
                                                        data-payee="<?php echo $payment_request_obj['user_id']; ?>"
                                                        data-tostatus="approved_released"
                                                        data-toreleaseamnt="<?php echo $payment_request_obj['requested_amount']; ?>"
                                                        data-requestedby="<?php echo ucwords($payment_request['InsertedBy']['first_name'].' '.$payment_request['InsertedBy']['last_name']); ?>">
                                                        <span class="fa fa-unlink"></span>
                                                    </button>
                                                   <?php
                                               }
                                            }
                                        }
                                        else if($status=="approved") {
                                            if($UserIn['User']['role']=="accounting_head" ||
                                            $UserIn['User']['role']=="proprietor_secretary" ||
                                               $UserIn['User']['role']=="accounting_assistant") {
                                                ?>
                                                <button
                                                    data-toggle="tooltip"
                                                    data-placement="top"
                                                    title="Release"
                                                    id="btn_release_text"
                                                    class="btn btn-danger"
                                                    style="color:white;font-weight:bold;"
                                                    data-id="<?php echo $payment_request_obj['id']; ?>"
                                                    data-payee="<?php echo $payment_request_obj['payee_id']; ?>"
                                                    data-tostatus="released"
                                                    data-toreleaseamnt="<?php echo $payment_request_obj['requested_amount']; ?>"
                                                    data-requestedby="<?php echo ucwords($payment_request['InsertedBy']['first_name'].' '.$payment_request['InsertedBy']['last_name']); ?>">
                                                    <span class="fa fa-unlink"></span>
                                                </button>
                                                <?php
                                            }
                                        }
                                        else if($status=="liquidated") {
                                            if($UserIn['User']['role']=="accounting_head" ||
                                               $UserIn['User']['role']=="accounting_head") {
                                                ?>
                                                <button class="btn btn-success"
                                                        id="btn_verify"
                                                        value="<?php echo $payment_request_obj['id']; ?>"
                                                        data-action="verified"
                                                        data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="Verify">
                                                    <span class="fa fa-thumbs-up"></span>
                                                </button>
                                                <?php
                                           }
                                        }
                                        else if($status=="verified") {
                                            if($type=="cash") {
                                                if($UserIn['User']['role']=="proprietor" || $UserIn['User']['role']=="proprietor_secretary") {
                                                    ?>
                                                    <button class="btn btn-success"
                                                            id="btn_close"
                                                            value="<?php echo $payment_request_obj['id']; ?>"
                                                            data-action="closed"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Close">
                                                        <span class="fa fa-lock"></span>
                                                    </button>
                                                    <?php
                                                }
                                            }
                                            else if($type=="cheque") {
                                                if($UserIn['User']['role']=="proprietor") {
                                                    ?>
                                                    <button class="btn btn-success"
                                                            id="btn_close"
                                                            value="<?php echo $payment_request_obj['id']; ?>"
                                                            data-action="closed"
                                                            data-toggle="tooltip"
                                                            data-placement="top"
                                                            title="Close">
                                                        <span class="fa fa-lock"></span>
                                                    </button>
                                                    <?php
                                                }
                                            }
                                            else if($type=="pettycash") {
                                                if($UserIn['User']['role']=="accounting_head" || $UserIn['User']['role']=="accounting_assistant") {
                                                    ?>
                                                    <input type="checkbox" class="check_replenish"
                                                           value="<?php echo $payment_request_obj['id']; ?>"
                                                           data-amount="<?php echo $payment_request_obj['released_amount']; ?>"
                                                           data-toggle="tooltip"
                                                           data-placement="top"
                                                           title="Replenish" />
                                                    <?php
                                                }
                                            }
                                        }
                                        ?>
                                        <?php } ?>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        <?php
         }
         else { echo 'This is a restricted area.'; }?>
    </div>
</div>

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
    		        <p id="label_requested"></p>
    		    </div>
    			    
                <div class="form-group" style="margin-bottom:20px;">
                    <input type="number" step="any" class="form-control"
                       id="released_amount" placeholder="Amount"
                      />
                      <!--dapat nakakapag encode ng my decimal si user-->
                        <!--onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"-->
                </div>
                <?php
                if($type=='cheque') { ?>
                	<div class="form-group">
            	        <select class="form-control" id="select_payee_release">
                            <option>Select Payee</option>
                    		<option style="font-size:0.9pt;background-color: grey;" disabled>&nbsp;</option>
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

<!--Add Request Modal Start-->
<!--===================================================-->
<div class="modal fade" id="add-request-modal" role="dialog"
     aria-labelledby="add-request-default-modal" aria-hidden="true">
    <div class="modal-dialog">
		<div class="modal-content">
			<!--Modal header-->
			<div class="modal-header">
			  <button type="button" class="close" data-dismiss="modal">
			    <i class="pci-cross pci-circle"></i>
			  </button>
			  <h4 class="modal-title">
		          Add Request
	          </h4>
			</div>
			<!--Modal body-->
			<div class="modal-body">
			    <div class="row">
    			    <div class="form-group col-lg-6">
    			        <div style="margin-top:13px;">
        		            <?php
        		            if($type=="cheque") {
        		                echo '
                                    <input type="checkbox" id="cheque" checked />';
        		            }
        		            else { echo '<input type="checkbox" id="cheque" />'; }
        		            ?>
                        	<label style="margin-bottom:8px;vertical-align:middle;">Cheque</label>
                    	</div>
                	</div>
                	<?php
                	if($type=="pettycash") {
                	    echo '
                	    <div class="form-group col-lg-6">
                	        <input type="text" class="form-control" id="input_control_number" placeholder="Control Number" />
                	    </div>';
                	}
                	?>
                	<div class="form-group col-lg-6">
            	        <select class="form-control" id="select_payee">
                            <option>---- Select Payee ----</option>
                    		<option style="font-size:0.9pt;background-color: grey;" disabled>&nbsp;</option>
                    		<?php
                    		foreach($payees as $payee) {
                    		    $payee_id = $payee['Payee']['id'];
                    		    $payee_name = $payee['Payee']['name'];
                    		    echo '<option value="'.$payee_id.'">'.$payee_name.'</option>';
                    		}
                    		?>
                    	</select>
                	</div>
                    <div class="form-group col-lg-12">
                        <select class="form-control" id="select_payment_request_category">
                            <option>----Select Category----</option>
                    		<option style="font-size:0.9pt;background-color: grey;" disabled>&nbsp;</option>
                            <?php
                                foreach($get_categories as $ret_categories) {
                                    // echo pr($ret_categories);
                                    $category_obj = $ret_categories['PaymentRequestCategory'];
                                    $category_id = $category_obj['id'];
                                    $category_name = ucwords($category_obj['name']);

                                    echo '
                                        <option value="'.$category_id.'">'.$category_name.'</option>
                                    ';
                                }
                            ?>
                        </select>
                    </div>
                	<div class="form-group col-lg-12">
            	        <input type="text"
                	       class="form-control"
                	       placeholder="Amount" id="input_amount" />
                    </div>
        	        <div class="form-group col-lg-12">
                       <?php
                        if($UserIn['User']['role']=="proprietor" ||
                           $UserIn['User']['role']=="proprietor_secretary" ||
                           $UserIn['Department']['name']=="Accounting Department" ||
                           $UserIn['Department']['name']=="Purchasing (Supply)" ||
                           $UserIn['Department']['name']=="Purchasing (Raw)" ||
                           $UserIn['Department']['name']=="Purchasing"){
                        ?>
                    	<select class="form-control" id="select_requested_by">
                    	    <option>Requested By</option>
                    	    <?php
                    		foreach($users as $user) {
                    		    $user_id = $user['User']['id'];
                    		    $first_name = $user['User']['first_name'];
                    		    $last_name = $user['User']['last_name'];
                    		    $whole_name = $first_name." ".$last_name;
                    		    echo '<option value="'.$user_id.'">'.$whole_name.'</option>';
                    		}
                    		?>
                    	</select>
                    	<?php
                        }
                        ?>
                    </div>
                    <div class="form-group col-lg-12">
                        <textarea placeholder="Purpose" class="form-control"
                              id="input_purpose"></textarea><br/>
                    </div>
                </div>
            </div>
            
			<!--Modal footer-->
			<div class="modal-footer">
			  <button data-dismiss="modal" class="btn btn-default"
			    type="button">Close</button>
			  <button class="btn btn-primary" id="send_request">Request Payment</button>
			</div>
		</div>
	</div>
</div>
<!--===================================================-->
<!--Add Request Modal End-->

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

<!--JAVASCRIPT METHODS-->
<script>
var all_list_pr_id_release = 0;
var passed_pr_id = 0;
var passed_po = 0;

$(document).ready(function() {
    var cheque_check = $("#cheque").val();
    if(cheque_check=='on') {
        $("#hide_show_payee").show();
    }
    else {
        $("#hide_show_payee").hide();
    }
    
    $('[data-toggle="tooltip"]').tooltip();
    
    $('#example').DataTable({
        "lengthMenu": [[100, 200, 500, -1], [100, 200, 500, "All"]],
        "orderable": true,
        "order": [[0,"desc"]],
        "stateSave": true
    });
    
    var tostatus = 'released';
    var company_fund_id = 0;
    $("button#btn_release_text, button#btn_approve_release").on('click', function() {
        $("button#btn_release").removeAttr('disabled');
        var payment_request_id = $(this).data('id');
        var requested_by = $(this).data('requestedby');
        var pr_payee = $(this).data('payee');
        tostatus = $(this).data('tostatus');
        var toreleaseamnt = $(this).data('toreleaseamnt');
        
        
        all_list_pr_id_release = payment_request_id;
        $("#label_requested").text("Requested: "+requested_by);
        $("#select_payee_release").val(pr_payee);
        $("#released_amount").val(toreleaseamnt);
        console.log(pr_payee);
        $('#release-modal').modal('show');
    });
    
    $("#cheque").change(function() {
        var cheque_check = $(this).is(":checked");
        if(cheque_check==true) {
            $("#select_payee").show();
            $("#input_control_number").hide();
        }
        else {
            $("#select_payee").hide();
            $("#input_control_number").show();
        }
    });
     
    $("#btn_add_request").on('click', function() {
        $("#select_payee").hide();
        $(":input").val('');
        $("select").prop('selectedIndex',0);
        $("#add-request-modal").modal('show');
        var cheque_check = $("#cheque").is(":checked");
        if(cheque_check==true) {
            $("#select_payee").show();
        }
        else {
            $("#select_payee").hide();
        }
    });
        
    $("#send_request").on('click', function() {
        $("#send_request").prop("disabled", true);
        var select_payment_request_category = $("#select_payment_request_category");
        var cheque_obj = $("#cheque");
        var select_payee = $("#select_payee");
        var input_amount = $("#input_amount");
        var select_requested_by = $("#select_requested_by");
        var input_purpose = $("#input_purpose");
        var type = "<?php echo $type; ?>";
        var status = "<?php echo $status; ?>";
        var proprietor = "<?php if(($UserIn['User']['role']=='proprietor') || ($UserIn['User']['role']=='proprietor_secretary') || ($UserIn['Department']['name']=='Purchasing (Supply)') || ($UserIn['Department']['name']=='Purchasing (Raw)') || ($UserIn['Department']['name']=='Purchasing')) { echo 'true'; }else { echo 'false'; } ?>";
        if(cheque_obj.is(":checked")==true) {
           if(select_payee.val() != "Select Payee") {
                if(select_payment_request_category.val() != '----Select Category----') {
                    if(parseFloat(input_amount.val()) != "") {
                        if(proprietor=="true") {
                            console.log("proprietor = true");
                            if(select_requested_by.val() != "Requested By") {
                                if(input_purpose.val() != "") {
                                    var data = {
                                        'payee_id':select_payee.val(),
                                        'category': select_payment_request_category.val(),
                                        'amount':parseFloat(input_amount.val()),
                                        'requested_by':select_requested_by.val(),
                                        'purpose':input_purpose.val(),
                                        'type':'cheque',
                                        'status':status
                                    }
                                    console.log(data);
                                    $.ajax({
                                        url: '/payment_requests/add_request',
                                        type: 'POST',
            							data: {'data': data},
            							dataType: 'text',
            							success: function(id) {
            								console.log(id);
            								location.reload();
            							},
            							error: function(err) {
            							    $('#send_request').removeAttr('disabled');
            								console.log("AJAX error: " + JSON.stringify(err, null, 2));
            							}
                                    });
                                }
                                else {
    							    $('#send_request').removeAttr('disabled');
                                    input_purpose.css({'border-color':'red'});
                                }
                            }
                            else {
							    $('#send_request').removeAttr('disabled');
                                select_requested_by.css({'border-color':'red'});
                            }
                        }
                        else {
                            console.log("proprietor = false");
                            if(input_purpose.val() != "") {
                                var data = {
                                    'payee_id':select_payee.val(),
                                    'category': select_payment_request_category.val(),
                                    'amount':parseFloat(input_amount.val()),
                                    'requested_by': parseInt(),
                                    'purpose':input_purpose.val(),
                                    'type':'cheque',
                                    'status':status
                                }
                                
                                $.ajax({
                                    url: '/payment_requests/add_request',
                                    type: 'POST',
        							data: {'data': data},
        							dataType: 'text',
        							success: function(id) {
        								console.log(id);
        								// location.reload();
        							},
        							error: function(err) {
        							    $('#send_request').removeAttr('disabled');
        								console.log("AJAX error: " + JSON.stringify(err, null, 2));
        							}
                                });
                            }
                            else {
                                $('#send_request').removeAttr('disabled');
                                input_purpose.css({'border-color':'red'});
                            }
                        }
                    }
                    else {
                        $('#send_request').removeAttr('disabled');
                        input_amount.css({'border-color':'red'});
                    }
                }
                else {
                    $('#send_request').removeAttr('disabled');
                    select_payment_request_category.css({'border-color':'red'});
                }
            }
            else {
                $('#send_request').removeAttr('disabled');
                swal({
                    title: "Payee Is Empty",
                    text: "Please select Payee. If you do not want to select a payee, please uncheck cheque.",
                    type: "warning",
                    confirmButtonClass: "btn-danger",
                    confirmButtonText: "Okay",
                    closeOnConfirm: false,
                });
            }
        }
        else {
            if(select_payment_request_category.val()!="----Select Category----") {
                if(parseFloat(input_amount.val()) != "") {
                    if(proprietor=="true") {
                        if(select_requested_by.val() != "Requested By") {
                            if(input_purpose.val() != "") {
                                if(type=="pettycash") {
                                    var control_number = $("#input_control_number");
                                    if(control_number.val()=="") {
                                        control_number.css({'border-color':'red'});
                                    }
                                    else {
                                        var data = {
                                            'control_number':control_number.val(),
                                            'payee_id':0,
                                            'category': select_payment_request_category.val(),
                                            'amount':parseFloat(input_amount.val()),
                                            'purpose':input_purpose.val(),
                                            'requested_by':select_requested_by.val(),
                                            'type':type,
                                            'status':status
                                        }
                                        console.log("data:");
                                        console.log(data);
                                        $.ajax({
                                            url: '/payment_requests/add_request',
                                            type: 'POST',
                							data: {'data': data},
                							dataType: 'text',
                							success: function(id) {
                								console.log(id);
                								location.reload();
                							},
                							error: function(err) {
                							    $('#send_request').removeAttr('disabled');
                								console.log("AJAX error: " + JSON.stringify(err, null, 2));
                							}
                                        });
                                    }
                                }
                                else {
                                    var data = {
                                        'payee_id':0,
                                        'category': select_payment_request_category.val(),
                                        'amount':parseFloat(input_amount.val()),
                                        'purpose':input_purpose.val(),
                                        'requested_by':select_requested_by.val(),
                                        'type':type,
                                        'status':status
                                    }
                                    console.log("data:");
                                    console.log(data);
                                    $.ajax({
                                        url: '/payment_requests/add_request',
                                        type: 'POST',
            							data: {'data': data},
            							dataType: 'text',
            							success: function(id) {
            								console.log(id);
            								location.reload();
            							},
            							error: function(err) {
            							    $('#send_request').removeAttr('disabled');
            								console.log("AJAX error: " + JSON.stringify(err, null, 2));
            							}
                                    });
                                }
                            }
                            else {
                                $('#send_request').removeAttr('disabled');
                                input_purpose.css({'border-color':'red'});
                            }
                        }
                        else {
                            $('#send_request').removeAttr('disabled');
                            select_requested_by.css({'border-color':'red'});
                        }
                    }
                    else {
                        if(input_purpose.val() != "") {
                            if(type=="pettycash"&&parseFloat(input_amount.val())>=3000) {
                                $('#send_request').removeAttr('disabled');
                                swal({
                                    title: "Invalid Petty Cash Amount",
                                    text: "You can only avail ₱ 2999 and below.",
                                    type: "warning",
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "Okay",
                                    closeOnConfirm: false,
                                });
                            }
                            else if(type=="cash"&&parseFloat(input_amount.val())<3000) {
                                $('#send_request').removeAttr('disabled');
                                swal({
                                    title: "Invalid Cash Amount",
                                    text: "You go to Petty Cash for below ₱ 3000 request.",
                                    type: "warning",
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "Okay",
                                    closeOnConfirm: false,
                                });
                            }
                            else {
                                if(type=="pettycash") {
                                    var control_number = $("#input_control_number");
                                    if(control_number.val()=="") {
                                        $('#send_request').removeAttr('disabled');
                                        control_number.css({'border-color':'red'});
                                    }
                                    else {
                                        var data = {
                                            'control_number':control_number.val(),
                                            'payee_id':0,
                                            'category': select_payment_request_category.val(),
                                            'amount':parseFloat(input_amount.val()),
                                            'requested_by':select_requested_by.val(),
                                            'purpose':input_purpose.val(),
                                            'type':type,
                                            'status':status
                                        }
                                        console.log("data:");
                                        console.log(data);
                                        $.ajax({
                                            url: '/payment_requests/add_request',
                                            type: 'POST',
                							data: {'data': data},
                							dataType: 'text',
                							success: function(id) {
                								console.log(id);
                								location.reload();
                							},
                							error: function(err) {
                							    $('#send_request').removeAttr('disabled');
                								console.log("AJAX error: " + JSON.stringify(err, null, 2));
                							}
                                        });
                                    }
                                }
                                else {
                                    var data = {
                                        'payee_id':0,
                                        'category': select_payment_request_category.val(),
                                        'amount':parseFloat(input_amount.val()),
                                        'requested_by':select_requested_by.val(),
                                        'purpose':input_purpose.val(),
                                        'type':type,
                                        'status':status
                                    }
                                    console.log("data:");
                                    console.log(data);
                                    $.ajax({
                                        url: '/payment_requests/add_request',
                                        type: 'POST',
            							data: {'data': data},
            							dataType: 'text',
            							success: function(id) {
            								console.log(id);
            								location.reload();
            							},
            							error: function(err) {
            							    $('#send_request').removeAttr('disabled');
            								console.log("AJAX error: " + JSON.stringify(err, null, 2));
            							}
                                    });
                                }
                            }
                        }
                        else {
                            $('#send_request').removeAttr('disabled');
                            input_purpose.css({'border-color':'red'});
                        }
                    }
                }
                else {
                    $('#send_request').removeAttr('disabled');
                    input_amount.css({'border-color':'red'});
                }
            }
            else {
                $('#send_request').removeAttr('disabled');
                select_payment_request_category.css({'border-color': 'red'});
            }
        }
    });
    
    $("#btn_release").on('click', function() {
        $(this).attr('disabled','disabled');
        var released_amount = $("#released_amount");
        var select_bank = $("#select_bank");
        var input_cheque_date = $("#input_cheque_date");
        var input_cheque_number = $("#input_cheque_number");
        var type = "<?php echo $type; ?>";
        var selected_payee = $("#select_payee_release");

        if(tostatus=="approved_released") { tostatus_final = "released"; }
        else { tostatus_final = tostatus; }
        
        var data_release = {"id":all_list_pr_id_release,
                            "type":type,
                            "status": tostatus_final,
                            "released_amount":released_amount.val(),
                            "select_bank":select_bank.val(),
                            "input_cheque_number":input_cheque_number.val(),
                            "selected_payee":selected_payee.val(),
                            "input_cheque_date":input_cheque_date.val()};
        
        if(type != "cheque") {
            if(released_amount.val()!="") {
                // RELEASE AJAX HERE
                
                if(tostatus=='approved_released') {
                    var data = {"id":all_list_pr_id_release, "action":"approved"};
                    $.ajax({
                        url: '/payment_requests/action',
                        type: 'POST',
            			data: {'data': data},
            			dataType: 'text',
            			success: function(id) {
            			    console.log(data);
            			    $.ajax({
                                url: '/payment_requests/release',
                                type: 'POST',
            					data: {'data': data_release},
            					dataType: 'text',
            					success: function(id) {
            					    $("#btn_release").removeAttr('disabled');
                					console.log(id);
                					location.reload();
            					},
            					error: function(err) {
            					    $("#btn_release").removeAttr('disabled');
            						console.log("AJAX error: " + JSON.stringify(err, null, 2));
            					}
                            });
            			},
            			error: function(err) {
            			    $("#btn_release").removeAttr('disabled');
            				console.log("AJAX error: " + JSON.stringify(err, null, 2));
            			}
                    });
			    }
			    else {
			        $.ajax({
                        url: '/payment_requests/release',
                        type: 'POST',
    					data: {'data': data_release},
    					dataType: 'text',
    					success: function(id) {
    					    $("#btn_release").removeAttr('disabled');
        					console.log(id);
        					location.reload();
    					},
    					error: function(err) {
    					    $("#btn_release").removeAttr('disabled');
    						console.log("AJAX error: " + JSON.stringify(err, null, 2));
    					}
                    });
			    }
            }
            else {
                $("#btn_release").removeAttr('disabled');
                released_amount.css({'border-color':'red'});
            }
        }
        else {
            if(released_amount.val()!="") {
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
                                    // RELEASE AJAX HERE
                                    if(success=="no") {
                                        $.ajax({
                                            url: '/payment_requests/release',
                                            type: 'POST',
                            				data: {'data': data_release},
                            				dataType: 'text',
                            				success: function(id) {
                            					console.log(id);
                            					window.location.replace("/payment_requests/all_list?type=cheque&&status=released");
                            				},
                            				error: function(err) {
                            				    $("#btn_release").removeAttr('disabled');
                            					console.log("AJAX error: " + JSON.stringify(err, null, 2));
                            				}
                                        });
                                    }
                                    else {
                                        $("#btn_release").removeAttr('disabled');
                                        swal({
                                            title: "Oops!",
                                            text: "Cheque Number already exists in the database.\n"+
                                                  "Please indicate another cheque number and try again.",
                                            type: "warning"
                                        });
                                    }
                                },
                                error: function(error) {
                                    $("#btn_release").removeAttr('disabled');
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
                            $("#btn_release").removeAttr('disabled');
                            input_cheque_date.css({'border-color':'red'});
                        }
                    }
                    else {
                        $("#btn_release").removeAttr('disabled');
                        input_cheque_number.css({'border-color':'red'});
                    }
                }
                else {
                    $("#btn_release").removeAttr('disabled');
                    select_bank.css({'border-color':'red'});
                }
            }
            else {
                $("#btn_release").removeAttr('disabled');
                released_amount.css({'border-color':'red'});
            }
        }
    });
    
    $("button#btn_acknowledge, button#btn_approve, button#btn_close, button#btn_verify").on('click',function(e) {
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
    
    var supplier_id = 0;
    $("button#btn_reject_request").on('click',function(e) {
        var id = $(this).val();
        var action = $(this).data('action');
        supplier_id = $(this).data('supplierid');
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
                var data = {"id":id, "action":action, "supplier_id": supplier_id};
                
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
    
    $("#save_liquidation").on('click', function() {
    	var type = $("#select_type");
    	var receipt_amount = $("#inp_receipt_amount");
    	var ewt = $("#inp_ewt");
    	var tax = $("#inp_tax");
    	var with_held = $("#inp_with_held");
    	var reference_number = $("#inp_reference_number");
    	var reference_date = $("#inp_date");
    	
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
						        				"po_id":0,
						        				"payment_request_id":payment_request_id};
						        	
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
    
    $("#btn_replenish").on('click', function() {
        // GET ALL CHECKBOX IN TABLE
        var check_replenish = $(".check_replenish").map(function() {
            var val = $(this).is(":checked");
            if(val==true) {
                var payment_request_id = $(this).val();
                var amount = $(this).data('amount');
                var obj = payment_request_id+":"+amount;
            }
            
            return obj;
        }).get();
        
        if(check_replenish.length == 0) {
            swal({
                title: "Cannot Replenish",
                text: "Please check at least one (1) payment request to proceed.",
                type: "warning",
                closeOnCancel: true
            });
        }
        else {
            swal({
                title: "Are you sure?",
                text: "This will replenish all checked payment request.",
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
                    $.ajax({
                        url: '/payment_requests/replenish',
                        type: 'POST',
        				data: {'data': check_replenish},
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
    });
    
    
    
    $("#check_all").on('click', function() {
        var check_all = $(this);
        var label = $("#label_for_check");
        
        // CHECK AND UNCHECK ALL
        if(check_all.is(":checked")) {
            $('td#checkBoxes').find('input[type="checkbox"]').each(function () {
                $(this).prop('checked',true);
            });
            label.text("Disselect All");
        }
        else {
            $('td#checkBoxes').find('input[type="checkbox"]').each(function () {
                $(this).prop('checked',false);
            });
            label.text("Select All");
        }
        
        // CHECKED OR UNCHECKED INDIVIDUALLY
        $("td#checkBoxes").on('change', function() {
            var count_checked = 0;
            var count_all = 0;
            $("td#checkBoxes").find('input[type="checkbox"]').each(function() {
                if($(this).is(":checked")) {
                    count_checked++;
                }
                count_all++;
            });
            
            if(count_checked == count_all) {
                check_all.prop('checked', true);
                label.text("Diselect All");
            }
            else {
                check_all.prop('checked', false);
                label.text("Select All");
            }
        });
    });
    
    // CHECKED ALL INDIVIDUALLY
    $("input.check_replenish").on('click', function() {
       var c_checked = $("td#checkBoxes input[type='checkbox']:checked").length;
       var c_all = $("td#checkBoxes input[type='checkbox']").length;
       var check_all = $("#check_all");
       var label = $("#label_for_check");
   
       if(c_checked==c_all) {
            check_all.prop('checked', true);
            label.text("Diselect All");
       }
       else {
           check_all.prop('checked', false);
           label.text("Select All");
       }
    });
});
</script>
<!--END OF JAVASCRIPT METHODS-->