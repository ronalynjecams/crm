<div id="content-container">
	<div>
		<?php echo $this->Session->flash('alertforexisting'); ?>
	</div>
	<div id="page-title">
        <h1 class="page-header text-overflow">Edit Product Combination for <?php echo $prod_combo['Product']['name']; ?></h1>
    </div>
    
    <div id="page-content">
        <div class="panel">
        	<div class="panel-heading" align="center">
                <h3 class="panel-title" align="center">
                    <button class="btn btn-primary" id="update-top">Update</button>
                </h3>
            </div>
        </div>
	        
    	<div class="panel">
            <div class="panel-body">
                <div class="form-group row" >
                	<div class="col-lg-6">
                    	<select class="form-control" id="prod_name" readonly >
                    		<?php if (count($prod_combo['Product']) != 0) {
                    			echo '<option value="'.$prod_combo['Product']['id'].'">'.$prod_combo['Product']['name'].'</option>';
                    		}
                    		else {
                    			echo '<option disabled selected>Select Product</option>';
                    		}
                    		?>
                    	</select>
                	</div>
                	<div class="col-lg-6">
                    	<select class="form-control" id="unit_id">
                    	    <?php
                    	        if($prod_combo['ProductCombo']['unit_id'] != 0) {
                        	        $unit_id = $prod_combo['ProductCombo']['unit_id'];
                        	        $unit_name = $prod_combo['Unit']['name']." (".$prod_combo['Unit']['abbreviation'].")";
                        	        echo '<option value="'.$unit_id.'">'.$unit_name.'</option>';
                        	    }
                        	    else {
                        		    echo '<option>Select Unit</option>';
                        	    }
                    		    echo '<option style="font-size: 0.9pt; background-color: grey;" disabled>&nbsp;</option>';
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
        		    <?php
        		    foreach($prod_combo['ProductComboProperty'] as $prodprop) { ?>
        		    <div id="div_remove">
                		<div class="col-lg-5">
            			    <label>Property <span class="text-danger"> *</span></label><br/>
            			    <input type="text" class="form-control property"
            			            value="<?php echo $prodprop['property']; ?>" required />
            		    </div>
            		    <div class="col-lg-5">
            			    <label>Value <span class="text-danger"> *</span></label><br/>
            			    <input type="text" class="form-control value"
            			            value="<?php echo $prodprop['value']; ?>" required />
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
        		    <?php } ?>
                </div>
            </div>
    	</div>
    	
    	<div class="panel">
        	<div class="panel-heading" align="center">
                <h3 class="panel-title" align="center">
                    <button class="btn btn-primary" id="update-bottom">Update</button>
                </h3>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("button.remove").on("click", function () {
        	var id = $(this).val();
        	var ordering = $(this).closest("tr").find(".ordering").text();
        	
        	var data = {
        		'id':id,
        		'ordering': ordering
        	};
        	
        	$.ajax({
        		url: '/product_combos/remove',
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
	    
	    $("#update-top, #update-bottom").on("click", function() {
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
        	var id = "<?php echo $prod_combo_id; ?>";
        	if(prodcombo_prod_id != "Select Product") {
				var data = {
					"id": id,
	        		"product_id": prodcombo_prod_id,
	        		"unit_id": prodcombounitid,
	        		"prop_value_obj": appended_obj
	        	};
	        	console.log(data);
	        	$.ajax({
	        		url: '/product_combos/update',
	        		type: 'Post',
					data: {'data': data},
					dataType: 'text',
					success: function(id) {
						console.log(id);
						window.location = "/product_combos/view?id="+prodcombo_prod_id;
					},
					error: function(err) {
						console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
					}
	        	});
        	}
        	else { $("#prod_name").css({'border-color':'red'}); }
        });
    });
</script>