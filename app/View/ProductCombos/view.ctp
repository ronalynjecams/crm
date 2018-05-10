<!--SWEET ALERT-->
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script>

<link href="http://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>
<script src="/css/plug/datatables/media/js/bootstrap-confirmation.min.js"></script>

<div id="content-container">
	<div>
		<?php echo $this->Session->flash('alertforexisting'); ?>
	</div>
	<div id="page-title">
        <h1 class="page-header text-overflow">List of Product Combination for <?php echo $product_name; ?></h1>
    </div>
    
    <div id="page-content">
		<div class="page-content">
			<div class="panel">
				<div class="panel-heading" align="right">
	                <h3 class="panel-title">
	                    <?php if (($UserIn['User']['role'] == 'it_staff')
	                    		  ||
	                    		  ($UserIn['User']['role'] == 'proprietor')
	                    		  ||
	                    		  ($UserIn['User']['role'] == 'raw_head')
	                    		  ||
	                    		  ($UserIn['User']['role'] == 'supply_staff')) { ?>
	                    
	                    <button id="add_new_prod_combo" class="btn btn-mint"
	                    		style="font-weight:bold;">
	                        <i class="fa fa-plus"></i>  Add New Product Combination
	                    </button>
	                    <?php } ?>
	                </h3>
	            </div>
				<div class="panel-body">
					<div class="table-responsive">
						<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
							<thead>
								<tr>
									<th>Ordering</th>
									<th>Unit</th>
									<th>Description</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($product_combos as $product_combo) { ?>
								<tr>
									<td class="ordering"><?php echo $product_combo['ProductCombo']['ordering']; ?></td>
									<td><?php
										if($product_combo['Unit']['id']!=0) {
											echo $product_combo['Unit']['name']."(".$product_combo['Unit']['abbreviation'].")";
										}
										else {
											echo "N/A";
										}
									?></td>
									<td>
										<?php foreach($product_combo['ProductComboProperty'] as $product_property) {
											echo "<p>".$product_property['property'].": ".$product_property["value"]."</p>";
										}
										?>
									</td>
									<td align="center">
										<?php
											$prod_combo_id_tmp = '';
											foreach($product_combo['ProductComboProperty'] as $pcp) {
												$prod_combo_id_tmp .= $pcp['id'].",";
											}
											$prod_combo_id = ($prod_combo_id_tmp);
										?>
										<button class="btn btn-warning edit"
											data-toggle="tooltip" data-placement="top"
											title="Edit"
											data-popout="true"
											value="<?php echo $product_combo['ProductCombo']['id']; ?>" />
											<span class="fa fa-edit"></span>
										</button>
										<?php if($UserIn['User']['role'] == 'super_admin' ||
												 $UserIn['User']['role'] == 'raw_head' ||
												 $UserIn['User']['role'] == 'supply_staff') { ?>
										<button class="btn btn-danger remove"
											data-toggle="tooltip" data-placement="top"
											title="Delete Combination"
											value="<?php echo $product_combo['ProductCombo']['id']; ?>" />
											<span class="fa fa-close"></span>
										</button>
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
	</div>
	
	<!--Add New Product Combo Modal Start-->
	<!--===================================================-->
    <div class="modal fade" id="add-product-combo-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
        <div class="modal-dialog">
			<div class="modal-content">
				<!--Modal header-->
				<div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal">
				    <i class="pci-cross pci-circle"></i>
				  </button>
				  <h4 class="modal-title">Add New Product Combination</h4>
				</div>
				<!--Modal body-->
				<div class="modal-body">
				    <div class="form-group row" >
				    	<div class="col-lg-6">
					    	<select class="form-control" id="prod_name" disabled >
					    		<?php if ($product_name != "") {
					    			echo '<option value="'.$product_id.'">'.$product_name.'</option>';
					    		}
					    		else {
					    			echo '<option disabled selected>Select Product</option>';
					    		}
					    		
					    		echo '<option style="font-size: 0.5pt; background-color: grey;" disabled>&nbsp</option>';
					    		
				    			foreach($products as $option_product) {
				    				$option_product_id = $option_product['Product']['id'];
				    				$option_product_name = $option_product['Product']['name'];
				    				echo '<option value="'.$option_product_id.'">'.$option_product_name.'</option>';
				    			}
					    		?>
					    	</select>
				    	</div>
				    	<div class="col-lg-6">
					    	<select class="form-control" id="unit_id">
					    		<option>Select Unit</option>
					    		<?php
					    			foreach($units as $unit) {
					    				$unit_id = $unit['Unit']['id'];
					    				$unit_name = $unit['Unit']['name'];
					    				$unit_abbvr = $unit['Unit']['abbreviation'];
					    				echo '<option value="'.$unit_id.'">'.ucwords($unit_name).
					    				' ('.$unit_abbvr.')</option>';
					    			}
					    		?>
					    	</select>
					    </div>	
				    </div>
				    <br/>
				    <div class="form-group" align="right">
				    	<button class="btn btn-sm btn-info" data-toggle="tooltip"
				    		data-placement="top" title="Add Property and Value"
				    		id="add_prop_and_value" >
				    		<span class="fa fa-plus"></span>
				    	</button>
				    </div>
				    
				    <div class="form-group row" id="prop_value_field">
				    		<div id="div_remove">
					    		<div class="col-lg-5">
								    <label>Property <span class="text-danger"> *</span></label><br/>
								    <input type="text" class="form-control property" required />
							    </div>
							    <div class="col-lg-5">
								    <label>Value <span class="text-danger"> *</span></label><br/>
								    <input type="text" class="form-control value" required />
							    </div>
							    <div class="col-lg-2" align="center">
								    <button data-toggle="confirmation"
								    	data-popout="true"
								    	data-placement="top"
								    	class="btn btn-xs btn-danger btn_remove"
								    	style="margin-top:30px">
								    	<span class="fa fa-minus"></span>
								    </button>
							    </div>
						    </div>
					</div>
				</div>
				<!--Modal footer-->
				<div class="modal-footer">
				  <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
				  <button class="btn btn-primary" id="saveProdCombo">Add</button>
				</div>
			</div>
    	</div>
	</div>
	<!--===================================================-->
	<!--Add New Product Combo Modal End-->
	
</div>

<!---JAVASCRIPT FUNCTIONS--->
<script>
    $(document).ready(function () {
    	$('[data-toggle=confirmation]').confirmation({
		  rootSelector: '[data-toggle=confirmation]',
		  // other options
		});
		
    	$('[data-toggle="tooltip"]').tooltip();
    	
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
        
        $("button.edit").on('click', function() {
        	var prod_combo_id = $(this).val();
        	window.location = '/product_combos/edit?id='+prod_combo_id;
        });
        
        $("button.remove").on("click", function () {
        	var id = $(this).val();
        	
        	swal({
                title: "Are you sure?",
                text: "This will delete combination.",
                type: "warning",
                showCancelButton: true,
                closeOnConfirm: true,
	            closeOnCancel: true
            },
            function(isConfirm) {
                if(isConfirm) {
		        	$.ajax({
		        		url: '/product_combos/remove',
			        		type: 'Post',
							data: {"data":id},
							dataType: 'text',
							success: function(id) {
								console.log(id);
								location.reload();
							},
							error: function(err) {
								console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
								console.log("Error in ajax add prod combo");
							}
		        	});
                }
            });
		})
        
        $('#prop_value_field').each(function(index) {
	    	$(this).on('click', '.btn_remove', function() {
	    		$(this).closest("#div_remove").remove();
	    	});
	    });
	    
	    $("#add_prop_and_value").on("click", function() {
	    	$("#prop_value_field").append('<div id="div_remove">'+
	    		'<div class="col-lg-5">'+
				    '<label>Property <span class="text-danger"> *</span></label><br/>'+
				    '<input type="text" class="form-control property" required />'+
			    '</div>'+
			    '<div class="col-lg-5">'+
				    '<label>Value <span class="text-danger"> *</span></label><br/>'+
				    '<input type="text" class="form-control value" required />'+
			    '</div>'+
			    '<div class="col-lg-2" align="center">'+
				    '<button data-toggle="tooltip" data-placement="top"'+
				    	'title="Remove" class="btn btn-xs btn-danger btn_remove"'+
				    	'style="margin-top:30px">'+
				    	'<span class="fa fa-minus"></span>'+
				    '</button>'+
			    '</div>'+
		    '</div>');
	    });
        
        $('#add_new_prod_combo').on("click", function() {
            $('#add-product-combo-modal').modal('show');
        });
        
        $("#saveProdCombo").on("click", function() {
        	var prodcombo_prod_id = $("#prod_name").val();
			var prodcombo_unit_id = $("#unit_id").val();
        	var prodcombo_property = [];
		    $('.property').each(function (index) {
		        prodcombo_property.push($(this).val());
		    });
		        
		    var prodcombo_value = [];
		    $('.value').each(function (index) {
		        prodcombo_value.push($(this).val());
		    });
		    
		    var appended_obj = {}; var array_obj = {};
		    var tmp_prop; var tmp_val;
		    for (var i = 0, count = prodcombo_property.length; i < count; i++) {
		    	tmp_prop = prodcombo_property[i];
		    	tmp_val = prodcombo_value[i];
		    	
		    	array_obj[i] = {"prodcombo_prop":tmp_prop, "prodcombo_val":tmp_val};
		    	appended_obj["prodcombo"] = array_obj;
		    }
        	var prodcombounitid;
        	if(prodcombo_unit_id == "Select Unit") {
				prodcombounitid = 0;
        	}
        	else {
        		prodcombounitid = prodcombo_unit_id;
        	}
        	
        	if(prodcombo_prod_id != "Select Product") {
				var data = {
	        		"product_id": prodcombo_prod_id,
	        		"unit_id": prodcombounitid,
	        		"prop_value_obj": appended_obj
	        	};
	        	
	        	$.ajax({
	        		url: '/product_combos/add',
	        		type: 'Post',
					data: {'data': data},
					dataType: 'text',
					success: function(id) {
						console.log(id);
						location.reload();
					},
					error: function(err) {
						console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
						console.log("Error in ajax add prod combo");
					}
	        	});
        	}
        	else { $("#prod_name").css({'border-color':'red'}); }
        });
    })
</script>
<!---END OF JAVASCTRIPT FUNCTIONS--->