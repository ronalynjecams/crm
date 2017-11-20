<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="../css/sweetalert.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="../js/sweetalert.min.js"></script>

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
                 $UserIn['User']['role']=="proprietor_secretary") { ?>
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">
                        <div class="btn-group btn-mint">
                          <button class="btn"><span class="fa fa-plus"></span></button>
                          <button class="btn" style="color:white">Add PO Payment Request</button>
                        </div>
                        <button class="btn btn-info" id="btn_add_request">
                            <span class="fa fa-plus"></span>
                            Add Request
                        </button>
                    </h3>
                </div>
                
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id="example"
                               class="table table-striped table-bordered"
    					       cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Date <?php echo ucwords($type); ?></th>
                                    <th>Requested By</th>
                                    <th>Requested Amount</th>
                                    <th>Released Details</th>
                                    <?php
                                    if($status=="pending" || $status=="acknowledged"
                                        || $status=="approved" || $status=="released") {
                                        echo '<th>Purpose</th>';
                                    }
                                    ?>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach($payment_requests as $payment_request) {
                                    $payment_request_obj=$payment_request['PaymentRequest'];
                                    $user = $payment_request['User'];
                                    $payment_request_id=$payment_request_obj['id'];
                                    
                                    $created='';
                                    if($status=="pending") {
                                        $created= date('F d, Y [h:i a]', strtotime($payment_request_obj['created']));
                                    }
                                    else {
                                        if(!empty($payment_request_logs[$payment_request_id])) {
                                            foreach($payment_request_logs[$payment_request_id] as $payment_request_log) {
                                                $created = date('F d, Y [h:i a]',strtotime($payment_request_log['PaymentRequestLog']['created']));
                                            }
                                        }
                                    }
                                    
                                    $created_released = '';
                                    if($type!='cheque') {
                                        foreach($payment_request_logs_released[$payment_request_id] as $payment_request_log_released) {
                                            $created_released_date = $payment_request_log_released['PaymentRequestLog']['created'];
                                            $created_released = "[ ".date('F d, Y [h:i a]', strtotime($created_released_date))." ]";
                                        }
                                    }
                                    
                                    foreach($payment_request_cheques[$payment_request_id] as $each_payment_request_cheque) {
                                        $payment_request_cheque = $each_payment_request_cheque['PaymentRequestCheque'];
                                        $bank = $each_payment_request_cheque['Bank'];
                                        $bank_name = $bank['name'];
                                        $cheque_number = $payment_request_cheque['cheque_number'];
                                        $cheque_date = $payment_request_cheque['cheque_date'];
                                    }
                                ?>
                                <tr>
                                    <td><?php echo $created; ?></td>
                                    <td><?php echo $user['first_name']." ".$user['last_name']; ?></td>
                                    <td><?php echo "₱ ".number_format((float)$payment_request_obj['requested_amount'],2,'.',','); ?></td>
                                    <td>
                                        <?php
                                        if($type!="cheque") {
                                            echo "₱ ".number_format((float)$payment_request_obj['released_amount'],2,'.',',')." ".$created_released;
                                        }
                                        else { ?>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <p><?php echo $created; ?></p>
                                                    <p><?php echo ucwords($bank_name)." ".$cheque_number." [ ".$cheque_date." ]"; ?></p>
                                                </div>
                                                <div class="col-lg-6" style="margin-top:25px;">
                                                    <p>(<?php echo ucwords($status); ?>)</p>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <?php
                                    if($status=="pending" || $status=="acknowledged"
                                        || $status=="approved" || $status=="released") {
                                        echo '<td>'.$payment_request_obj['purpose'].'</td>';
                                    }
                                    ?>
                                    <td>
                                        <button class="btn btn-primary"
                                            data-toggle="tooltip"
                                            date-placement="left"
                                            title="View Details Avalailable for All Status">
                                            <span class="fa fa-eye"></span>
                                        </button>
                                        
                                        <?php
                                        if($status=="pending" || $status=="acknowledged" ||
                                            $status=="approved") { ?>
                                            <button class="btn btn-warning"
                                                data-toggle="tooltip"
                                                data-placement="top"
                                                title="Reject Request">
                                                <span class="fa fa-close"></span>
                                            </button>
                                        <?php
                                        }
                                        
                                        if($status=="pending") {
                                            if($type=="cash") {
                                                if($UserIn['User']['role']=="accounting_head" ||
                                                   $UserIn['User']['role']=="accounting_assistant") {
                                                       ?>
                                                   <button class="btn btn-danger">
                                                       <span class="fa fa-check"></span>
                                                       Acknowledge
                                                   </button>
                                                   <?php
                                               }
                                            }
                                            else if($type=="cheque") {
                                                if($UserIn['User']['role']=="proprietor" ||
                                                   $UserIn['User']['role']=="proprietor_secretary") {
                                                    ?>
                                                    <button class="btn btn-warning">
                                                        <span class="fa fa-check"></span>
                                                        Approve
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
                                                   <button class="btn btn-danger">
                                                       <span class="fa fa-check"></span>
                                                       Approve
                                                   </button>
                                                   <?php
                                               }
                                            }
                                        }
                                        else if($status=="approved") {
                                            if($UserIn['User']['role']=="accounting_head" ||
                                               $UserIn['User']['role']=="accounting_assistant") {
                                                ?>
                                                <a ng-href=""
                                                    data-target="#release-modal"
                                                    data-toggle="modal"
                                                    class="btn btn-danger"
                                                    style="color:white;font-weight:bold;"
                                                    data-id="<?php echo $payment_request_obj['id']; ?>">
                                                    Release
                                                </a>
                                                <?php
                                            }
                                        }
                                        ?>
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
			    <div>
			        Details:<br/>
			        Requested:<br/>
			        Amount:<br/>
			    </div>
			    <div align="right">
			        Requested By:
			    </div>
			    <br/>
		         <?php
                    if($type!='cheque') {
                        ?>
                        <div class="row">
                            <input type="number" step="any" class="form-control"
                               id="released_amount" placeholder="Released Amount" />
                        </div>
                        <?php
                    }
                    else if($type=='cheque') {
                    ?>
                    <br/>
                    <div class="row">
                        <select class="form-control" id="select_bank">
                            <option>Select Bank</option>
                            <?php
                            foreach($banks as $bank) {
                                echo '<option value="'.$bank['Bank']['id'].'">
                                '.$bank['Bank']['name'].'
                                </option>';
                            }
                            ?>
                        </select>
                    </div>
                    <br/>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="row">
                                <input type="text" class="form-control" id="input_check_number"
                                   placeholder="Check Number" />
                           </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="row">
                                <input type="date" class="form-control" id="input_check_date" />
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
<div class="modal fade" id="add-request-modal" role="dialog" tabindex="-1"
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
    			    <div class="col-lg-6">
    			        <div style="margin-top:13px;">
                            <input type="checkbox" id="cheque" />
                        	<label style="margin-bottom:8px;vertical-align:middle;">Cheque</label>
                    	</div>
                	</div>
                	<div class="col-lg-6">
            	        <select class="form-control" id="select_payee">
                            <option>Select Payee</option>
                    		<option style="font-size: 0.9pt; background-color: grey;" disabled>&nbsp;</option>
                    		<?php
                    		foreach($payees as $payee) {
                    		    $payee_id = $payee['Payee']['id'];
                    		    $payee_name = $payee['Payee']['name'];
                    		    echo '<option value="'.$payee_id.'">'.$payee_name.'</option>';
                    		}
                    		?>
                    	</select>
                	</div><br/><br/><br/>
                	<?php
                	if($UserIn['User']['role']=="proprietor" || $UserIn['User']['role']=="proprietor_secretary") {
            	        echo '<div class="col-lg-6" >';
                	}
                	else {
                	    echo '<div class="col-lg-12">';
                	}
        	        ?>
            	        <input type="number"
                	       step="any"
                	       class="form-control"
                	       placeholder="Amount" id="input_amount" />
                    </div>
                	
        	        <div class="col-lg-6">
                       <?php
                        if($UserIn['User']['role']=="proprietor" || $UserIn['User']['role']=="proprietor_secretary") {
                        ?>
                    	<select class="form-control" id="select_requested_by">
                    	    <option>Requested By</option>
                    	    <option style="font-size:0.9pt;background-color:grey" disabled>&nbsp;</option>
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
                </div>
                <br/>
                <textarea placeholder="Purpose" class="form-control"
                      id="input_purpose"></textarea><br/>
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
        
        $('#release-modal').on('shown.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var payment_request_id = button.data('id');
            alert(payment_request_id);
        });
        
        $("#cheque").change(function() {
            var cheque_check = $(this).is(":checked");
            if(cheque_check==true) {
                $("#select_payee").show();
            }
            else {
                $("#select_payee").hide();
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
            var cheque_obj = $("#cheque");
            var select_payee = $("#select_payee");
            var input_amount = $("#input_amount");
            var select_requested_by = $("#select_requested_by");
            var input_purpose = $("#input_purpose");
            var proprietor = "<?php if(($UserIn['User']['role']=="proprietor") || ($UserIn['User']['role']=="proprietor_secretary")) { echo 'true'; }else { echo 'false'; } ?>";
            var type = "<?php echo $type; ?>";
            var status = "<?php echo $status; ?>";
            
            if(cheque_obj.is(":checked")==true) {
               if(select_payee.val() != "Select Payee") {
                    if(input_amount.val() != "") {
                        if(proprietor=="true") {
                            if(select_requested_by.val() != "Requested By") {
                                if(input_purpose.val() != "") {
                                    if(type=="pettycash"&&input_amount.val()>=5000) {
                                        swal({
                                            title: "Invalid Petty Cash Amount",
                                            text: "You can only avail ₱ 4999 and below.",
                                            type: "warning",
                                            confirmButtonClass: "btn-danger",
                                            confirmButtonText: "Okay",
                                            closeOnConfirm: false,
                                        });
                                    }
                                    else if(type=="cash"&&input_amount.val()<5000) {
                                        swal({
                                            title: "Invalid Cash Amount",
                                            text: "You go to Petty Cash for below ₱ 5000 request.",
                                            type: "warning",
                                            confirmButtonClass: "btn-danger",
                                            confirmButtonText: "Okay",
                                            closeOnConfirm: false,
                                        });
                                    }
                                    else {
                                        var data = {
                                            'payee_id':select_payee.val(),
                                            'amount':input_amount.val(),
                                            'requested_by':select_requested_by.val(),
                                            'purpose':input_purpose.val(),
                                            'type':type,
                                            'status':status
                                        }
                                        
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
                								console.log("AJAX error: " + JSON.stringify(err, null, 2));
                							}
                                        });
                                    }
                                }
                                else {
                                    input_purpose.css({'border-color':'red'});
                                }
                            }
                            else {
                                select_requested_by.css({'border-color':'red'});
                            }
                        }
                        else {
                            if(input_purpose.val() != "") {
                               if(type=="pettycash"&&input_amount.val()>=5000) {
                                        swal({
                                        title: "Invalid Petty Cash Amount",
                                        text: "You can only avail ₱ 4999 and below.",
                                        type: "warning",
                                        confirmButtonClass: "btn-danger",
                                        confirmButtonText: "Okay",
                                        closeOnConfirm: false,
                                    });
                                }
                                else if(type=="cash"&&input_amount.val()<5000) {
                                    swal({
                                        title: "Invalid Cash Amount",
                                        text: "You go to Petty Cash for below ₱ 5000 request.",
                                        type: "warning",
                                        confirmButtonClass: "btn-danger",
                                        confirmButtonText: "Okay",
                                        closeOnConfirm: false,
                                    });
                                }
                                else {
                                    var data = {
                                        'payee_id':select_payee.val(),
                                        'amount':input_amount.val(),
                                        'requested_by':0,
                                        'purpose':input_purpose.val(),
                                        'type':type,
                                        'status':status
                                    }
                                    
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
            								console.log("AJAX error: " + JSON.stringify(err, null, 2));
            							}
                                    });
                                }
                            }
                            else {
                                input_purpose.css({'border-color':'red'});
                            }
                        }
                    }
                    else {
                        input_amount.css({'border-color':'red'});
                    }
                }
                else {
                    select_payee.css({'border-color':'red'});
                }
            }
            else {
                if(input_amount.val() != "") {
                    if(proprietor=="true") {
                        if(select_requested_by.val() != "Requested By") {
                            if(input_purpose.val() != "") {
                                if(type=="pettycash"&&input_amount.val()>=5000) {
                                    swal({
                                        title: "Invalid Petty Cash Amount",
                                        text: "You can only avail ₱ 4999 and below.",
                                        type: "warning",
                                        confirmButtonClass: "btn-danger",
                                        confirmButtonText: "Okay",
                                        closeOnConfirm: false,
                                    });
                                }
                                else if(type=="cash"&&input_amount.val()<5000) {
                                    swal({
                                        title: "Invalid Cash Amount",
                                        text: "You go to Petty Cash for below ₱ 5000 request.",
                                        type: "warning",
                                        confirmButtonClass: "btn-danger",
                                        confirmButtonText: "Okay",
                                        closeOnConfirm: false,
                                    });
                                }
                                else {
                                    var data = {
                                        'payee_id':0,
                                        'amount':input_amount.val(),
                                        'requested_by':select_requested_by.val(),
                                        'purpose':input_purpose.val(),
                                        'type':type,
                                        'status':status
                                    }
                                    
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
            								console.log("AJAX error: " + JSON.stringify(err, null, 2));
            							}
                                    });
                                }
                            }
                            else {
                                input_purpose.css({'border-color':'red'});
                            }
                        }
                        else {
                            select_requested_by.css({'border-color':'red'});
                        }
                    }
                    else {
                        if(input_purpose.val() != "") {
                            if(type=="pettycash"&&input_amount.val()>=5000) {
                                swal({
                                    title: "Invalid Petty Cash Amount",
                                    text: "You can only avail ₱ 4999 and below.",
                                    type: "warning",
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "Okay",
                                    closeOnConfirm: false,
                                });
                            }
                            else if(type=="cash"&&input_amount.val()<5000) {
                                swal({
                                    title: "Invalid Cash Amount",
                                    text: "You go to Petty Cash for below ₱ 5000 request.",
                                    type: "warning",
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "Okay",
                                    closeOnConfirm: false,
                                });
                            }
                            else {
                                var data = {
                                    'payee_id':0,
                                    'amount':input_amount.val(),
                                    'requested_by':0,
                                    'purpose':input_purpose.val(),
                                    'type':type,
                                    'status':status
                                }
                                
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
        								console.log("AJAX error: " + JSON.stringify(err, null, 2));
        							}
                                });
                            }
                        }
                        else {
                            input_purpose.css({'border-color':'red'});
                        }
                    }
                }
                else {
                    input_amount.css({'border-color':'red'});
                }
            }
        });
    });
</script>
<!--END OF JAVASCRIPT METHODS-->