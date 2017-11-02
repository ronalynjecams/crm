<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<script src="../plugins/select2/js/select2.min.js"></script>
<script src="../js/erp_js/erp_scripts.js"></script>

<!-- REQUIRED FOR MULTIPLE SELECT ON QUOTATION -->
<link href="../plugins/chosen/chosen.min.css" rel="stylesheet">
<script src="../plugins/chosen/chosen.jquery.min.js"></script>

<div id="content-container">
	<div class="products form">
		<div id="page-title">
	        <h1 class="page-header text-overflow">Add Product</h1>
	    </div>
	    
		<div class="page-content">
			 <div class="panel">
            	<div class="panel-heading" align="center">
	                <h3 class="panel-title" align="center">
	                    <button class="btn btn-primary" id="addproduct-top">Add</button>
	                </h3>
	            </div>
	        </div>
			
			<div class="panel">
				<div class="panel-body">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group" style="width:260px;height:175px;">
									<img class="img-responsive" src="../product_uploads/image_placeholder.jpg"
										id="prod_image_preview" style="width:100%;height:100%;" /><br/>
								</div>
								<div>
									<input type="file" class="form-control" id="prod_image" />
								</div>
							</div>
							
							<div class="col-lg-9">
								<div class="form-group">
									<input class="form-control" type="text" placeholder="Name" id="prod_name" /> <br/>
									
									<div class="row">
										<div class="col-lg-6">
											<select class="form-control" id="prod_category">
												<option>Select Category</option>
												<?php
													foreach($categories as $category) {
														?>
														<option value="<?php echo $category['Category']['id']; ?>">
															<?php echo $category['Category']['name']; ?>
														</option>
														<?php
													}
												?>
											</select>
										</div>
										<div class="col-lg-6">
											<select class="form-control" id="prod_sub_category" disabled=true>
												<option>Select Sub Category</option>
											</select>
										</div>
									</div> <br/>
									
									<textarea class="form-control" placeholder="Other Information"
										rows="6" id="prod_other_info"></textarea>
								</div>
							</div>
						</div>
					</div>
					
					<div class="col-lg-12">
						<button class="btn btn-primary btn-xs" data-toggle="tooltip"
							data-placement="top" title="Add Properties and Values"
							id="add_properties_and_values">
							<span class="fa fa-plus"></span>
						</button> <br/><br>
					
						<div class="row">
							<div class="col-lg-12">
								<div class="row">
									<div class="col-lg-3">
										<input type="text" class="form-control" id="prod_properties" placeholder="Properties" />
									</div>
									
									<div class="col-lg-3">
										<input type="text" class="form-control" id="prod_values" placeholder="Values" />
									</div>
									
									<div class="col-lg-6">
										<div class="row">
											<div class="col-lg-2" style="margin-top:6px;">
												<input type="checkbox" id="prod_default" />
												<label style="margin-bottom:8px;vertical-align:middle;">Default</label>
											</div>
											<div class="col-lg-10">
												<input type="text" class="form-control" pattern="[0-9]+" id="prod_price" placeholder="Price" />
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						
						
						<div class="row" id="field_for_properties_and_values" hidden="true">
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="panel">
            	<div class="panel-heading" align="center">
	                <h3 class="panel-title" align="center">
	                    <button class="btn btn-primary" id="addproduct-bottom">Add</button>
	                </h3>
	            </div>
	        </div>
		</div>
	</div>
</div>

<!--JAVASCTRIPT FUNCTIONS-->
<script>
$(document).ready(function(){
	var count_for_add_properties_and_values = 0;
    $('[data-toggle="tooltip"]').tooltip();
   
    $('#add_properties_and_values').on('click', function(){
    	count_for_add_properties_and_values += 1;
    	console.log(count_for_add_properties_and_values);
    	var target_div = $("#field_for_properties_and_values");
    	target_div.prop('hidden',false);
    	target_div.append('<div class="col-lg-12" id="appended_div">'+
    	'<br/><div class="row">'+
    		'<div class="col-lg-3">'+
    			'<input type="text" class="form-control appended_prod_properties" id="appended_prod_properties" placeholder="Properties" />'+
    		'</div>'+
    		'<div class="col-lg-3">'+
				'<input type="text" class="form-control appended_prod_values" id="appended_prod_values" placeholder="Values" />'+
			'</div>'+
			'<div class="col-lg-6">'+
				'<div class="row">'+
					'<div class="col-lg-2" style="margin-top:6px;">'+
						'<input type="checkbox" class="appended_prod_default" id="appended_prod_default" />'+
						'<label style="margin-bottom:8px;vertical-align:middle;">Default</label>'+
					'</div>'+
					'<div class="col-lg-7">'+
						'<input type="text" class="form-control appended_prod_price" pattern="[0-9]+" id="appended_prod_price" placeholder="Price" />'+
					'</div>'+
					'<div class="col-lg-3" style="text-align:center">'+
						'<button class="btn btn-danger btn-sm remove_properties_and_values" style="margin-top:3px;" data-toggle="tooltip"'+
							'data-placement="top" title="Remove" id="'+count_for_add_properties_and_values+'">'+
							'<span class="fa fa-minus"></span>'+
						'</button>'+
					'</div>'+
				'</div>'+
			'</div>'+
    	'</div>'+
    	'</div>');
    });
    
    $('#field_for_properties_and_values').each(function(index) {
    	$(this).on('click', '.remove_properties_and_values', function() {
    		$(this).closest("#appended_div").remove();
    	});
    });
    
    $("#prod_category").change(function(){
    	var id = $(this).val();
    	
    	$('#prod_sub_category').empty();
    	
		$.get('/products/get_sub_category', {id: id},
		function(data) {
			if(data.length != 0) {
				$("#prod_sub_category").append('<option>Select Sub Category</option>');
				for (i = 0; i < data.length; i++) {
	                $('#prod_sub_category').append($('<option>', {
	                    value: data[i]['SubCategory']['id'],
	                    text: data[i]['SubCategory']['name']
	                })).prop('disabled', false);
	            }
			}
			else {
				$('#prod_sub_category').append($('<option>', {
                    text: "No Sub Category",
                })).prop('disabled', true);
			}
		});
    });
    
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#prod_image_preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }
    
    $('#prod_image').change(function(){
    	readURL(this);
    });
    
    var image_file = $("#prod_image").prop('files');
	console.log(image_file);
	
	var formdata = new FormData();
    
    $('#addproduct-top, #addproduct-bottom').click(function() {
    	console.log('addproduct is clicked');
    	
	    var name =  $('#prod_name').val();
	    var other_info = $('#prod_other_info').val();
	    var image = $('#prod_image').val();
	    var category = $('#prod_category').val();
	    var sub_category = $("#prod_sub_category").val();
	    var properties = $('#prod_properties').val();
	    var values = $('#prod_values').val();
	    var price = $("#prod_price").val();
	    var deflt = '';
		if ($('#prod_default').is(":checked")) {
			deflt = 'true';
	    }
	    else {
	    	deflt = 'false';
	    }
	    
	    var image_tmp = image.split('\\');
	    var image_filename = image_tmp[image_tmp.length-1];
	    
	    var prod_default_array = [];
	    $(".appended_prod_default").each(function(index) {
	        var prod_default = '';
	    		if ($(".appended_prod_default").is(":checked")) {
				prod_default = 'true';	
		    }
		    else {
		    	prod_default = 'false';
		    }
		    prod_default_array.push(prod_default);
	    });
	    
	    var array_prod_price = [];
	    $('.appended_prod_price').each(function (index) {
            var value = $(this).val();
            array_prod_price.push(value);
        });
        
        var appended_prop = [];
        $('.appended_prod_properties').each(function (index) {
            appended_prop.push($(this).val());
        });
        
        var appended_value = [];
        $('.appended_prod_values').each(function (index) {
            appended_value.push($(this).val());
        });
        
        var appended_obj = {};
        var array_obj = {};
        var prop; var val; var price; var def;
        for (var i = 0, count = appended_prop.length; i < count; i++) {
        	prop = appended_prop[i];
        	val = appended_value[i];
        	price = array_prod_price[i];
        	def = prod_default_array[i];
        	array_obj[i] = {"prop":prop, "val":val, "price":price, "def":def};
        	appended_obj["appended"] = array_obj;
        }
        
		var data = new FormData();
	
		 //Append files infos
		 jQuery.each($('input:file')[0].files, function(i, file) {
		     data.append('Image', file);
		     data.append("name", "maeiscool");
		 });
		
		 $.ajax({  
			url: "/products/image_upload",  
			type: "POST",  
			data: data,  
			cache: false,
			processData: false,  
			contentType: false, 
			context: $('input:file'),
			success: function (msg) {
				console.log(msg);
		    	
			    if(name != "") {
			    	if(category != "Select Category") {
			    		if(sub_category != "Select Sub Category") {
			    			if(other_info != "") {
			    				if(image != "") {
			    					if(properties != "") {
			    						if(values != "") {
			    							if(price != "") {
												var data = {
											    	"name": name,
											    	"other_info": other_info,
											    	"sub_category": sub_category,
											    	"image": image_filename,
											    	"properties": properties,
											    	"values": values,
											    	"price": price,
											    	"required_default": deflt,
													"required_properties": properties,
													"required_values": values,
													"required_price": price,
													"required_default": def,
													"appended_obj": appended_obj
											    };
												$.ajax({
													url: "/products/add_product",
													type: 'Post',
													data: {'data': data},
													dataType: 'text',
													success: function(id) {
														console.log(id);
														window.location="/products/index";
													},
													error: function(err) {
														console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
														console.log("error in ajax add");
													}
												});
			    							}
			    							else {
			    								$("#prod_price").css({'border-color': 'red'});
			    							}
			    						}
			    						else {
			    							$("#prod_values").css({'border-color': 'red'});
			    						}
			    					}
			    					else {
			    						$("#prod_properties").css({'border-color': 'red'});
			    					}
			    				}
			    				else {
			    					$("#prod_image").css({'border-color': 'red'});
			    				}
			    			}
			    			else {
			    				$("#prod_other_info").css({'border-color': 'red'});
			    			}
			    		}
			    		else {
			    			$('#prod_sub_category').css({'border-color': 'red'});
			    		}
			    	}
			    	else {
			    		$('#prod_category').css({'border-color': 'red'});
			    	}
			    }
			    else {
			    	$('#prod_name').css({'border-color': 'red'});
			    }
		     },
		     error: function (err) {
		     	console.log("Problem with uploading"+err);
		     	alert("Error in uploading");
		     }
		  });
    });
});
</script>
<!--END OF JAVASCTRIPT FUNCTIONS-->