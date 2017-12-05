<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<script src="../plugins/select2/js/select2.min.js"></script>

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
    <div id="page-title">
        <h1 class="page-header text-overflow">
            Payment Request
        </h1>
    </div>
    
    <div id="page-content">
        <div class="panel">
            <div class="panel-body">
                 <div class="col-lg-6">
    		        <div style="margin-top:13px;">
                        <input type="checkbox" id="cheque" />
                    	<label style="margin-bottom:8px;vertical-align:middle;">Cheque</label>
                	</div>
            	</div>
            	<div class="col-lg-6">
            	    <div id="hide_show_payee">
            	        <select class="form-control" id="select_payee">
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
            	</div><br/><br/><br/>
            	
                <div class="col-lg-12">
                    <textarea placeholder="Purpose" class="form-control"
                          id="input_purpose"></textarea><br/>
                </div>
                
                <div class="col-lg-12" id="div_select_supplier">
                    <select class="form-control" id="select_supplier">
                        <option>Select Supplier</option>
                        <?php
                        foreach($suppliers as $supplier) {
                            $s_id = $supplier['Supplier']['id'];
                            $name = $supplier['Supplier']['name'];
                            
                            echo '<option value="'.$s_id.'">'.$name.'</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="col-lg-6" id="div_select_po_no" hidden>
                    <select class="form-control" id="select_po_no" multiple>
                    </select>
                </div>
                <div class="col-lg-12" id="div_selected_purchase_order" style="margin-top:20px;">
                    <center><label style="font-weight:bold;font-size:14px;">Selected Purchase Order</label></center><br/>
                </div>
                <center>
                    <button class="btn btn-info" id="btn_send_request_payment"
                        style="margin-top:20px;">
                        Request Payment
                    </button>
                </center>
        	</div>
        </div>
    </div>
</div>

<!--JAVASCRIPT METHODS-->
<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
        
        $("#hide_show_payee").hide();
        
        $("#select_payee").select2({
            placeholder: "Select Payee",
            allowClear: true,
            width:'100%'
        });
        
        $("#select_supplier").select2({
            placeholder: "Select Supplier",
            allowClear: true
        });
        
        $("#select_po_no").select2({
            placeholder: "Select P.O. Number",
            allowClear: true,
            width: '100%'
        });

        $("#div_selected_purchase_order").empty();
        
        $("#cheque").change(function() {
            var cheque_check = $(this).is(":checked");
            if(cheque_check==true) {
                $("#hide_show_payee").show();
            }
            else {
                $("#hide_show_payee").hide();
            }
        });
        
        $("#select_supplier").on("change", function() {
            $("#div_selected_purchase_order").empty();
            $('#select_po_no').empty().append('<option>Select P.O. Number</option>');
            $("#select_po_no").select2({
                placeholder: "Select P.O. Number",
                allowClear: true,
                width: '100%'
            });
            
            var id = $(this).val();
            $("#div_select_supplier").removeClass('col-lg-12').addClass('col-lg-6');
            $(this).select2({ width: 'resolve' });  
            $("#div_select_po_no").removeAttr('hidden');
            
            $.get('/payment_requests/get_po', {id:id},
            function (data) {
                console.log(data);
                if(data.length!=0) {
                    for (i = 0; i < data.length; i++) {
                        $('#select_po_no').append($('<option>', {
                            value: data[i]['PurchaseOrder']['id'],
                            text: data[i]['PurchaseOrder']['po_number']
                        }));
                    }
                }
                else {
                    $('#select_po_no').empty().append('<option></option>');
                    $("#select_po_no").select2({
                        placeholder: "No P.O. Number",
                        allowClear: true,
                        width: '100%'
                    });
                }
            });
        });
        
        $("#select_po_no").on("change", function() {
            var id=$(this).val();
            if (id != "") {
                $.get('/payment_requests/get_po_each', {id:id}, function(data) {
                    if(data.length > 0) {
                        var trbody = '';
                        var total = 0;
                        for(var i=0;i<data.length;i++) {
                            var po_number = data[i]['PurchaseOrder']['po_number'];
                            var po_amount = parseFloat(data[i]['PurchaseOrder']['grand_total']);
                            total += po_amount;
                            trbody += '<tr><td>'+po_number+'</td>'+
                                        '<td>'+po_amount+'</td>'+
                                        '<td>'+
                                            '<input type="number" step="any" min="0.000001"'+
                                                'class="form-control change_po_amount"'+
                                                'placeholder="Requested Amount"'+
                                                'value="'+po_amount+'" id="change_po_amount"'+
                                                'onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57"/>'+
                                        '</td></tr>';
                        }
                        
                        $("#div_selected_purchase_order").empty().append(
                            '<div class="table-responsive"><table class="table table-bordered table-striped"'+
                                'cell-spacing=0'+
                                'width="100%"'+
                                'id="example">'+
                                '<thead>'+
                                    '<tr>'+
                                        '<th>PO #</th>'+
                                        '<th>PO Amount</th>'+
                                        '<th>Requested Amount</th>'+
                                    '</tr>'+
                                '</thead>'+
                                '<tbody>'+trbody+
                                    '<tr>'+
                                        '<th colspan="2">Grand Total</th>'+
                                        '<td id="grand_total">'+total+'</td>'+
                                    '</tr>'+
                                '</tbody>'+
                            '</table></div>'
                        );
                    }
                    else {
                        $("#div_selected_purchase_order").empty();
                    }
                });
            }
            else {
                $("#div_selected_purchase_order").empty();
            }
        });
        var values = 0;
        $(document).on('keyup', "input#change_po_amount",function () {
            values = $('.change_po_amount').map(function() {
                val = $(this).val();
                if(val=="") {
                    retval = 0;
                }
                else {
                    retval = val;
                }
                return retval;
            }).get();
            
            var grand_total = 0;
            for(var i=0;i<values.length;i++) {
                grand_total += parseFloat(values[i]);
            }
            
            $("#grand_total").text(grand_total);
        });
        
        $("#btn_send_request_payment").on('click', function() {
            var cheque = $("#cheque");
            var payee = $("#select_payee");
            var purpose = $("#input_purpose");
            var supplier = $("#select_supplier");
            var po = $("#select_po_no");
            var requested_amount = $("#grand_total");
            var type = "<?php echo $type; ?>";
            
            if(cheque.is(":checked") == true) {
                var type = "cheque";
                if(payee.val() != "Select Payee") {
                    if(purpose.val() != "") {
                        if(supplier.val() != "Select Supplier") {
                            if(po.val() != "") {
                                if(requested_amount.text()!=0) {
                                    var data = {'cheque':cheque.is(":checked"),
                                                'payee':payee.val(),
                                                'purpose':purpose.val(),
                                                'supplier':supplier.val(),
                                                'po':po.val(),
                                                'requested_amount':requested_amount.text(),
                                                'type':type,
                                                'values':values};
                                    
                                    $.ajax({
                                        url: '/payment_requests/add_po_request',
                                        type: 'POST',
            							data: {'data': data},
            							dataType: 'text',
            							success: function(id) {
            								console.log(id);
            								window.location="/payment_requests/all_list?type="+type+"&&status=pending"
            							},
            							error: function(err) {
            								console.log("AJAX error: " + JSON.stringify(err, null, 2));
            							}
                                    });
                                }
                                else {
                                   swal({
                                        title: "Requested Amount Is Zero",
                                        text: "Please select Requested Amount.",
                                        type: "warning",
                                        confirmButtonClass: "btn-danger",
                                        confirmButtonText: "Okay",
                                        closeOnConfirm: false,
                                    }); 
                                }
                            }
                            else {
                                swal({
                                    title: "P.O. Number Is Empty",
                                    text: "Please select P.O. Number.",
                                    type: "warning",
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "Okay",
                                    closeOnConfirm: false,
                                });
                            }
                        }
                        else {
                            swal({
                                title: "Supplier Is Empty",
                                text: "Please select Supplier.",
                                type: "warning",
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Okay",
                                closeOnConfirm: false,
                            });
                        }
                    }
                    else {
                        purpose.css({'border-color':'red'});
                    }
                }
                else {
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
                if(purpose.val() != "") {
                    if(supplier.val() != "Select Supplier") {
                        if(po.val() != "") {
                            if(requested_amount.text()!=0) {
                                if(type == "cash") {
                                    if(requested_amount.text()<5000) {
                                       swal({
                                            title: "Invalid Requested Amount",
                                            text: "Request Amount for Cash is ₱ 5000 and above.",
                                            type: "warning",
                                            confirmButtonClass: "btn-danger",
                                            confirmButtonText: "Okay",
                                            closeOnConfirm: false,
                                        }); 
                                    }
                                    else {
                                        var data = {'cheque':cheque.is(":checked"),
                                                'payee':0,
                                                'purpose':purpose.val(),
                                                'supplier':supplier.val(),
                                                'po':po.val(),
                                                'requested_amount':requested_amount.text(),
                                                'type':type,
                                                'values':values};
                                        $.ajax({
                                            url: '/payment_requests/add_po_request',
                                            type: 'POST',
                							data: {'data': data},
                							dataType: 'text',
                							success: function(id) {
                								console.log(id);
                								window.location="/payment_requests/all_list?type="+type+"&&status=pending"
                							},
                							error: function(err) {
                								console.log("AJAX error: " + JSON.stringify(err, null, 2));
                							}
                                        });
                                    }
                                }
                                else if(type == "pettycash") {
                                    if(requested_amount.text()>5000) {
                                        swal({
                                            title: "Invalid Requested Amount",
                                            text: "Request Amount for Petty Cash is ₱ 4999 and below.",
                                            type: "warning",
                                            confirmButtonClass: "btn-danger",
                                            confirmButtonText: "Okay",
                                            closeOnConfirm: false,
                                        });
                                    }
                                    else {
                                        var data = {'cheque':cheque.is(":checked"),
                                                    'payee':0,
                                                    'purpose':purpose.val(),
                                                    'supplier':supplier.val(),
                                                    'po':po.val(),
                                                    'requested_amount':requested_amount.text(),
                                                    'type':type,
                                                    'values':values};
                                        $.ajax({
                                            url: '/payment_requests/add_po_request',
                                            type: 'POST',
                							data: {'data': data},
                							dataType: 'text',
                							success: function(id) {
                								console.log(id);
                    							window.location="/payment_requests/all_list?type="+type+"&&status=pending"
                							},
                							error: function(err) {
                								console.log("AJAX error: " + JSON.stringify(err, null, 2));
                							}
                                        });
                                    }
                                }
                            }
                            else {
                                swal({
                                    title: "Requested Amount Is Zero",
                                    text: "Please enter Requested Amount.",
                                    type: "warning",
                                    confirmButtonClass: "btn-danger",
                                    confirmButtonText: "Okay",
                                    closeOnConfirm: false,
                                });
                            }
                        }
                        else {
                            swal({
                                title: "P.O. Number Is Empty",
                                text: "Please select P.O. Number.",
                                type: "warning",
                                confirmButtonClass: "btn-danger",
                                confirmButtonText: "Okay",
                                closeOnConfirm: false,
                            });
                        }
                    }
                    else {
                        swal({
                            title: "Supplier Is Empty",
                            text: "Please select Supplier.",
                            type: "warning",
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Okay",
                            closeOnConfirm: false,
                        });
                    }
                }
                else {
                    purpose.css({'border-color':'red'});
                }
            }
        });
    });
</script>