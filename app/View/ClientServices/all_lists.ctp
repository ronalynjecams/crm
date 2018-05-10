<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>

<link href="http://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">
<link href="/css/sweetalert.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="/js/sweetalert.min.js"></script>

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
                if($type=="service_unit") {
                    $type_tmp="Service Unit";
                }
                elseif($type=="pull_out") {
                    $type_tmp="Pull Out";
                }
                else {
                    $type_tmp=ucwords($type);
                }
                
                if($status=="pullout_successful") {
                    $status_tmp = "Successful";
                }
                else { $status_tmp = ucwords($status); }
                echo ucwords($status_tmp)." ".$type_tmp;
            ?>
        </h1>
    </div>
    <div id="page-content">
        <div class="panel">
            <?php
            if (($UserIn['User']['role'] == 'fitout_facilitator')
                || ($UserIn['User']['department_id'] == 6)
                || ($UserIn['User']['department_id'] == 7)) { ?>
            <div class="panel-heading" align="right">
                <h3 class="panel-title">
                    <button id="show_modal" class="btn btn-mint">
                        <i class="fa fa-plus"></i>
                        Add <?php echo $type_tmp; ?>
                    </button>
                </h3>
            </div>
            <?php } ?>
            <div class="panel-body">
                <div class="table-responsive">
					<table id="example" class="table table-striped table-bordered"
					        cellspacing="0" width="100%">
					    <thead>
					        <tr>
					            <?php
					            if($UserIn['User']['role']=="sales_executive") {
					                echo '<th width="10">#</th>';
					            }
					            ?>
					            <th>Date Created</th>
					            <th>Control Number</th>
					            <th>Client</th>
					            <?php
					            if($UserIn['User']['role'] != 'sales_executive') {
    					            ?><th>Sales Agent</th><?php 
					            } ?>
					            <th>Action</th>
					        </tr>
					    </thead>
					    <tbody>
					        <?php
					        $count = 0;
					        foreach($client_services as $client_service) {
					            $count++;
					            $client_service_id = $client_service['ClientService']['id'];
					            $cli_srvcs_stat = $client_service['ClientService']['status'];
					        ?>
					        <tr>
					            <?php
					            if($UserIn['User']['role']=="sales_executive") {
					                echo "<td>$count</td>";
					            }
					            ?>
					            <td><?php echo time_elapsed_string($client_service['ClientService']['created']); ?></td>
					            <td><?php echo $client_service['ClientService']['service_code']; ?></td>
					            <td><?php echo $client_service['Client']['name']; ?></td>
					            <?php
					            if($UserIn['User']['role'] != 'sales_executive') { ?>
					            <td>
					                <?php
					                    $first_name = $client_service['User']['first_name'];
					                    $last_name = $client_service['User']['last_name'];
					                    echo $first_name." ".$last_name;
				                    ?>
				                </td>
				                <?php }
				                
				                foreach($cs_prods[$client_service_id] as $cs_prod) {
				                    $expected_demo_date = $cs_prod['ClientServiceProduct']['expected_demo_date'];
				                    $expected_pullout_date = $cs_prod['ClientServiceProduct']['expected_pullout_date'];
				                    $pullout_date = $cs_prod['ClientServiceProduct']['pullout_date'];
				                ?>
					            <?php } ?>
					            <td align="center">
					                <a type="button" style="color:white;font-weight:bold;"
					                    href="/client_services/view?id=<?php echo $client_service['ClientService']['id']; ?>"
                                        class="btn btn-primary btn-sm"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="View">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    
                                    <?php
                                    if($UserIn['User']['role']=="supply_staff" ||
                                       $UserIn['User']['role']=="logistics_head") { ?>
                                    <a type="button" target="_blank" style="color:white;font-weight:bold;"
					                    href="/reports/print_demo?id=<?php echo $client_service['ClientService']['id']; ?>&&type=<?php echo $type; ?>"
                                        class="btn btn-default btn-sm"
                                        data-toggle="tooltip"
                                        data-placement="top"
                                        title="Print">
                                        <i class="fa fa-file-pdf-o text-danger"></i>
                                    </a>
                                    <?php } ?>
    					       </td>
					        </tr>
					        <?php } ?>
					    </tbody>
					</table>    
				</div>
            </div>
        </div>
    </div>
    
	<!--Add New Demo or Service Unit Combo Modal Start-->
	<!--===================================================-->
    <div class="modal fade" id="add-demo-su-modal" role="dialog"   aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
			<div class="modal-content">
				<!--Modal header-->
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">
				    <i class="pci-cross pci-circle"></i>
				  </button>
				  <h4 class="modal-title">
			          Add New <?php echo $type_tmp; ?> Product
		          </h4>
				</div>
				<!--Modal body-->
				<div class="modal-body">
				    <div class="form-group row">
				        <input type="hidden" id="input_agent_id" />
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
        				        <?php foreach($clients as $client) {
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
				            <input type="number" step="any" class="form-control"
				                placeholder="Quantity" id="qty"
                                onkeypress="return (event.charCode == 8 || event.charCode == 0) ? null : event.charCode >= 48 && event.charCode <= 57" />
				        </div>
				    </div>
                    <br/>
                    <div class="form-group row">
                        <div class="col-lg-6">
                             <select class="form-control" id="select_product">
        				        <option>Select Product</option>
					    		<?php
					    		    foreach($products as $product) {
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
                    <div class="form-group row" id="label_here"></div>
				    <br/>
				    <div class="form-group row">
				        <div class="col-lg-6">
				            <label>Expected Delivery Date <span class="text-danger"> *</span></label>
		                    <input type="date" class="form-control"
        				        id="expected_delivery_date"/>
				        </div>
				        <div class="col-lg-6">
				            <label>Expected Delivery Time</label>
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
				            <label>Expected Pull Out Time</label>
				             <input type="time" class="form-control"
        				        id="expected_pull_out_time"/>
				        </div>
				    </div>
				    <br/>
		            <label>Other Information</label>
				    <textarea class="form-control" id="textarea_other_info" aria-label="Other Info"></textarea>
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
</div>





<!---JAVASCRIPT FUNCTIONS--->
<script>
    var client;
    var qty;
    var product;
    var product_combo;
    var agent_id;
    var expected_delivery_date;
    var expected_pull_out_date;
    var expected_delivery_time;
    var expected_pull_out_time;
    var type = "<?php echo $type; ?>";
    var status = "<?php echo $status; ?>";
    var service_code = $("#service_code").val();
    var prop_tmp = [];
    var value_tmp = [];
    var textarea_other_info = '';
    
    $(document).ready(function () {
    	$('[data-toggle="tooltip"]').tooltip();
    	
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
        
        $("#select_client").select2({
            placeholder: "Select Client",
            allowClear: true,
            width: '100%'
        });
        
        $("#select_product").select2({
            placeholder: "Select Product",
            allowClear: true,
            width: '100%'
        });
        
        $('#show_modal').on("click", function() {
            $("button#btn_add").removeAttr('attr');
            $('#add-demo-su-modal').modal('show');
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
                        $("#select_product_combo").removeAttr('readonly').append($('<option>', {
                                value: data[i]['ProductCombo']['id'],
                                text: data[i]['Product']['name']+" ["+data[i]['ProductCombo']['ordering']+"]"
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
        
        $("#select_client").on('change', function() {
            var data = {"id": $(this).val()};
            $.ajax({
                url: "/clients/get_agent",
                type: "POST",
                data: {"data": data},
                dataType: "text",
                success: function(success) {
                    console.log("Success: "+success);
                    $("#input_agent_id").val(success);
                },
                error: function(error) {
                    console.log("Error in getting sales agent: "+error);
                }
            });
        });
        
        $("#btn_add").on('click', function() {
            var btn_add = $(this);
            btn_add.attr('disabled', 'disabled');
            agent_id = $("#input_agent_id").val();
            client = $("#select_client").val();
            qty = $("#qty").val();
            product = $("#select_product").val();
            product_combo = $("#select_product_combo").val();
            expected_delivery_date = $("#expected_delivery_date").val();
            expected_pull_out_date = $("#expected_pull_out_date").val();
            expected_delivery_time = $("#expected_delivery_time").val();
            expected_pull_out_time = $("#expected_pull_out_time").val();
            textarea_other_info = tinymce.get('textarea_other_info').getContent();
            console.log((product_combo!="Select Product Combination"));
            if(client!="Select Client") {
                if(qty!="" && parseInt(qty)) {
                    if(product!="Select Product") {
                        if(product_combo!="Select Product Combination" &&
                           product_combo!="No Product Combination") {
                            if(expected_delivery_date!="") {
                                if(expected_pull_out_date!="") {
                                    // if(textarea_other_info!="") {
                                        var data = {
                                            'client_id':client,
                                            'agent_id': agent_id,
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
                                            'textarea_other_info': textarea_other_info,
                                            'quotation_product_id':0
                                        };
                                        $.ajax({
                							url: "/client_services/add_demo_or_su",
                							type: 'Post',
                							data: {'data': data},
                							dataType: 'text',
                							success: function(id) {
                								console.log(id);
                								location.reload();
                							},
                							error: function(err) {
                								console.log("AJAX error in add_demo_or_su: " + JSON.stringify(err, null, 2));
                								console.log("error in ajax add_demo_or_su");
                							}
                						});
                                        console.log(data);
                                    // }
                                    // else {
                                    //     swal({
                                    //         title: "Oops!",
                                    //         text: "Other Information is empty.\n"+
                                    //               "Please add other information and try again.",
                                    //         type: "warning"
                                    //     });
                                    //     btn_add.removeAttr('disabled');
                                    // }
                                }
                                else {
                                    $("#expected_pull_out_date").css({'border-color':'red'});
                                    swal({
                                        title: "Oops!",
                                        text: "Expected Pull Out Date is empty.\n"+
                                              "Please indicate pullout date and try again.",
                                        type: "warning"
                                    });
                                    btn_add.removeAttr('disabled');
                                }
                            }
                            else {
                                $("#expected_delivery_date").css({'border-color':'red'});
                                swal({
                                    title: "Oops!",
                                    text: "Expected Delivery Date is empty.\n"+
                                          "Please indicate delivery date and try again.",
                                    type: "warning"
                                });
                                btn_add.removeAttr('disabled');
                            }
                        }
                        else {
                            swal({
                                title: "Oops!",
                                text: "Product Combo is empty.\n"+
                                      "Please select product combo and try again.",
                                type: "warning"
                            });
                            btn_add.removeAttr('disabled');
                        }
                    }
                    else {
                        swal({
                            title: "Oops!",
                            text: "Product is empty.\n Please select product and try again.",
                            type: "warning"
                        });
                        btn_add.removeAttr('disabled');
                    }
                }
                else {
                    $("#qty").css({'border-color':'red'});
                    swal({
                        title: "Oops!",
                        text: "Quantity is empty.\n Please indicate quantity and try again.",
                        type: "warning"
                    });
                    btn_add.removeAttr('disabled');
                }
            }
            else {
                swal({
                    title: "Oops!",
                    text: "Client is empty.\n Please select client and try again.",
                    type: "warning"
                });
                btn_add.removeAttr('disabled');
            }
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
<!---END OF JAVASCTRIPT FUNCTIONS--->