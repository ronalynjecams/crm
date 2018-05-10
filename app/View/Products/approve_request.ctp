<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<script src="/css/plug/select/js/select2.min.js"></script>
<script src="/js/erp_scripts.js"></script>

<!-- REQUIRED FOR MULTIPLE SELECT ON QUOTATION -->
<link href="/css/plug/chosen/chosen.min.css" rel="stylesheet">
<script src="/css/plug/chosen/chosen.jquery.min.js"></script>

<!--TINYMCE-->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script>

<div id="content-container">
	<div class="products form">
		<div id="page-title">
	        <h1 class="page-header text-overflow">Approve Product Request</h1>
	    </div>
	    
		<div class="page-content">
			 <div class="panel">
            	<div class="panel-heading" align="center">
	                <h3 class="panel-title" align="center">
	                	<button class="btn btn-primary" id="updateproduct-top">Update</button>
	                    <button class="btn btn-primary" id="approveproduct-top">Approve</button>
	                </h3>
	            </div>
	        </div>
			
			<div class="panel">
				<div class="panel-body">
					<div class="col-lg-12">
						<div class="row">
							<div class="col-lg-3">
								<div class="form-group" class="img-responsive">
									<?php
										$image_name = $current_product['TempProduct']['image'];
										$image_from_app = WWW_ROOT.'img/product-uploads/'.$image_name;
										
										$file = new File($image_from_app);
										
										if ($file->exists()) { ?>
											<img class="img-responsive" src="/img/product-uploads/<?php echo $image_name; ?>"
											id="prod_image_preview" /><br/>
										<?php }
										else { ?>
											<img class="img-responsive" src="/img/product-uploads/image_placeholder.jpg"
											id="prod_image_preview" /><br/>
										<?php }
										
										$file->close();
									?>
								</div>
								<div id="image_input">
									<?php
										$image_name = $current_product['TempProduct']['image'];
										$image_from_app = WWW_ROOT.'img/product-uploads/'.$image_name;
										
										$file = new File($image_from_app);
										
										if ($file->exists()) { ?> 
											<p style="text-align:center" id="labelfor_imagename"><?php echo $image_name; ?></p>
											<input type="checkbox" id="keep_image" />
											<label style="margin-bottom:8px;vertical-align:middle;">Keep Image</label>
										<?php }
										
										$file->close();
									?>
									
									<input type="file" class="form-control" id="prod_image" value="/img/product-uploads/<?php echo $image_name ?>" />
								</div>
								<div id="image_here"></div>
							</div>
							
							<div class="col-lg-9">
								<div class="form-group">
								    <input type="hidden" id="prod_id" value="<?php echo $product_id; ?>" />
									<input class="form-control" type="text" placeholder="Name" id="prod_name"
									    value="<?php echo $current_product['TempProduct']['name']; ?>" /> <br/>
									
									<div class="row">
										<div class="form-group">
											<div class="col-lg-6">
												<select class="form-control" id="prod_category">
													<option value="<?php echo $sub_category['Category']['id']; ?>">
													    <?php echo $sub_category['Category']['name']; ?>
												    </option>
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
												<select class="form-control" id="prod_sub_category">
													<option value="<?php echo $current_product['SubCategory']['id']; ?>">
												        <?php echo $current_product['SubCategory']['name']; ?>
												    </option>
												</select>
											</div>
										</div>
									</div>
									
									<div class="row">
										<div class="form-group">
											<div class="col-lg-6">
												<select class="form-control" id="prod_type">
													<?php if ($current_product['TempProduct']['type']!=null) {
														echo '<option value="'.$current_product['TempProduct']['type'].'">'.$current_product['TempProduct']['type'].'</option>';
													}
													else {
														echo '<option>Select Type</option>';
													} ?>
													<option style="font-size: 0.9pt; background-color: grey;" disabled>&nbsp;</option>
													<option value="supply">Supply</option>
													<option value="customized">Customized</option>
													<option value="combination">Combination</option>
													<option value="raw">Raw</option>
													<option value="chopped">Chopped</option>
													<option value="office">Office</option>
												</select>
											</div>
											<div class="col-lg-6">
												<input type="text" class="form-control" pattern="[0-9]+" id="prod_sale_price" placeholder="Sale Price" value="<?php echo $current_product['TempProduct']['sale_price']; ?>"/>
											</div>
										</div>
									</div> <br/>
									
									<textarea class="form-control" placeholder="Other Information"
										rows="6" id="prod_other_info">
									    <?php echo $current_product['TempProduct']['other_info']; ?>
									</textarea>
								</div>
							</div>
						</div>
						<br/>
					</div>
					<div class="col-lg-12">
						<button class="btn btn-primary btn-xs" data-toggle="tooltip"
							data-placement="top" title="Add Properties and Values"
							id="add_properties_and_values">
							<span class="fa fa-plus"></span>
						</button> <br/>
						
						<div class="row" id="field_for_properties_and_values" hidden="true">
						</div>
						
					</div>
				</div>
			</div>
			
			<div class="panel">
            	<div class="panel-heading" align="center">
	                <h3 class="panel-title" align="center">
	                	<button class="btn btn-primary" id="updateproduct-bottom">Update</button>
	                    <button class="btn btn-primary" id="approveproduct-bottom">Approve</button>
	                </h3>
	            </div>
	        </div>
		</div>
	</div>
</div>

<!--JAVASCTRIPT FUNCTIONS-->
<script>
    tinymce.init({
        selector: 'textarea',
        height: 500,
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
<script>
$(document).ready(function(){
    var id = $("#prod_id").val();
	var count_for_add_properties_and_values = 0;
    $('[data-toggle="tooltip"]').tooltip();
    
    $('#keep_image').click(function() {
    	if ($(this).is(':checked'))	{
    		$("#prod_image").hide();
    		$("#image_warning").remove();
    	 //   var image_src = $("#prod_image_preview").prop('src');
		 //   var create_image = document.createElement("IMG");
		 //   create_image.setAttribute("src", image_src);
		 //   $("#image_here").append(create_image);
    	}
    	else {
    		$("#prod_image").show();
    	}
    });
   
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
    
    $.get('/quotations/product_info2', {id: id}, function (data) {
            count_for_add_properties_and_values += 1;
            var i;
            var v;
            console.log(data);
            var prod_property = data['TempProductProperty'];
            for (i = 0; i < prod_property.length; i++) {
                var prod_value = data['TempProductProperty'][i]['TempProductValue'];
                for (v = 0; v < prod_value.length; v++) {
                var diff = prod_value[v]['default'];
                if (diff==1){
                	var default_value = 'checked';
                }
                else {
                	var default_value = '';
                }
                
                $('#field_for_properties_and_values').append('<div class="col-lg-12" id="appended_div">'+
                	'<br/><div class="row">'+
                		'<div class="col-lg-3">'+
                		    '<input type="hidden" id="appended_prod_properties_id" value="'+prod_property[i]['id']+'" />'+
                			'<input type="hidden" id="appended_prod_value_id" value="'+prod_value[v]['id']+'" />'+
                			'<input type="text" class="form-control appended_prod_properties" id="appended_prod_properties" value="'+prod_property[i]['name']+'" placeholder="Properties" />'+
                		'</div>'+
                		'<div class="col-lg-3">'+
            				'<input type="text" class="form-control appended_prod_values" id="appended_prod_values" value="' + prod_value[v]['value'] + '" placeholder="Values"/>'+
            			'</div>'+
            			'<div class="col-lg-6">'+
            				'<div class="row">'+
            				     '<div class="col-lg-2" style="margin-top:6px;">'+
            						'<input type="checkbox" value="'+prod_value[v]['default']+'" class="appended_prod_default" id="appended_prod_default" '+
            						default_value+' />'+
            						'<label style="margin-bottom:8px;vertical-align:middle;">Default</label>'+
            					'</div>' +
			                	'<div class="col-lg-7">'+
            						'<input type="text" class="form-control appended_prod_price" pattern="[0-9]+" id="appended_prod_price" value="' + prod_value[v]['price'] + '" placeholder="Price" />'+
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
                	'</div>').prop('hidden',false);
                }
            }
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
        if (input.files && input.files[0] && input.files[0].name.match(/\.(jpg|jpeg)$/)) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#prod_image_preview').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        } else{
        	alert('Uploaded image must be JPG or JPEG.');
        	$('#prod_image').val("");
        }
    }
    
    $('#prod_image').change(function(){
    	readURL(this);
    });
    
    if ($("#keep_image").is(':checked')) {
		var image_file = $("#prod_image_preview").prop('src');
		console.log(image_file);
    }
    else {
	    var image_file = $("#prod_image").prop('files');
		console.log(image_file);
    }
	
	var formdata = new FormData();
    
    
    $('#approveproduct-top, #approveproduct-bottom').click(function() {
        var data = new FormData();
	
	    var image = $('#prod_image').val();
		if($('#keep_image').is(':checked')) {
			var keep_image = true;
		}
		else {
			var keep_image = false;
		}
	
		//Append files infos
		jQuery.each($('input:file')[0].files, function(i, file) {
			data.append('Image', file);
		});
		
		if (keep_image) {
			console.log("called from keeping_image");
			validation_and_update("approve");
	 	}
	 	else {
	 		console.log("called from uploading new image");
	 		if (image != "") {
				$.ajax({  
					url: "/products/image_upload",  
					type: "POST",  
					data: data,  
					cache: false,
					processData: false,  
					contentType: false, 
					context: $('input:file'),
					success: function (msg) {
						console.log("called from success in uploading image");
						validation_and_update("approve");
				     },
				     error: function (err) {
				     	console.log("Problem with uploading"+err);
				     	alert("Error in updating");
				     }
				  });
			}
			else {
				$("#prod_image").css({'border-color': 'red'});
				$("#image_input").append('<p id="image_warning"'+
					'class="text-danger">If you do not '+
					'want to replace the current image, '+
					'Please check "Keep Image".</p>');
			}
 		}
    });
    
    $('#updateproduct-top, #updateproduct-bottom').click(function() {
        var data = new FormData();
	
	    var image = $('#prod_image').val();
		if($('#keep_image').is(':checked')) {
			var keep_image = true;
		}
		else {
			var keep_image = false;
		}
	
		//Append files infos
		jQuery.each($('input:file')[0].files, function(i, file) {
			data.append('Image', file);
		});
		
		if (keep_image) {
			console.log("called from keeping_image");
			validation_and_update("update");
	 	}
	 	else {
	 		console.log("called from uploading new image");
	 		if (image != "") {
				$.ajax({  
					url: "/products/image_upload",  
					type: "POST",  
					data: data,  
					cache: false,
					processData: false,  
					contentType: false, 
					context: $('input:file'),
					success: function (msg) {
						console.log("called from success in uploading image");
						validation_and_update("update");
				     },
				     error: function (err) {
				     	console.log("Problem with uploading"+err);
				     	alert("Error in updating");
				     }
				  });
			}
			else {
				$("#prod_image").css({'border-color': 'red'});
				$("#image_input").append('<p id="image_warning"'+
					'class="text-danger">If you do not '+
					'want to replace the current image, '+
					'Please check "Keep Image".</p>');
			}
 		}
    });
    
    function validation_and_update(mycond) {
	    var image = $('#prod_image').val();
	    var image_keep_temp = "<?php echo $image_name ?>";
	    var id = $("#prod_id").val();
    	var name =  $('#prod_name').val();
	    var other_info = tinyMCE.get('prod_other_info').getContent();
	    var category = $('#prod_category').val();
	    var sub_category = $("#prod_sub_category").val();
	    var type = $("#prod_type").val();
	    var sale_price = $("#prod_sale_price").val();
	    
	    if($('#keep_image').is(':checked')) {
			var keep_image = "true";
		}
		else {
			var keep_image = "false";
		}
		
		console.log("Keep_image: "+keep_image);
		
	    var image_tmp = image.split('\\');
	    var image_filename = image_tmp[image_tmp.length-1];
	    
	    var prod_default_array = [];
	    var defff = $(".appended_prod_default").map(function() {
            var val = $(this).is(":checked");
            if(val==true) {
                prod_default = 1;	
		    }
		    else {
		    	prod_default = 0
		    }
		    prod_default_array.push(prod_default);
            
            return prod_default_array;
        }).get();
        
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
        
        if(appended_prop.length!=0) {
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
        }
        else { var appended_obj = 0; }
        
    	if(name != "") {
	    	if(category != "Select Category") {
	    		if(sub_category != "Select Sub Category") {
	    			if(other_info != "") {
						var data = {
							"id": id,
					    	"other_info": other_info,
					    	"sub_category": sub_category,
					    	"image_change": image_filename,
					    	"image_keep": image_keep_temp,
					    	"keep_image": keep_image,
					    	"sale_price": sale_price,
					    	"type": type,
							"appended_obj": appended_obj,
							"name":name
					    };
					    console.log(mycond);
					    if(mycond != "update"){
							$.ajax({
								url: "/products/approve_product",
								type: 'Post',
								data: {'data': data},
								dataType: 'text',
								success: function(id) {
									console.log(id);
									console.log(data);
									swal({
						                title: "Success!",
						                text: "The products is succesfully approved.",
						                type: "success"
									}, function(){
										window.location.replace('/products/list_requests');
									});
									// window.location.replace('/products/list_requests');
								},
								error: function(err) {
									console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
									console.log("error in ajax update");
									swal({
						                title: "Oops!",
						                text: "There was an error in updating product.",
						                type: "warning"
									}
									);
								}
							});
					    } else{
					    	$.ajax({
								url: "/products/update_product_temp",
								type: 'Post',
								data: {'data': data},
								dataType: 'text',
								success: function(id) {
									console.log(id);
									console.log(data);
									swal({
						                title: "Success!",
						                text: "The products is succesfully updated.",
						                type: "success"
									});
									// window.location.replace('/products/list_requests');
								},
								error: function(err) {
									console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
									console.log("error in ajax update");
									swal({
						                title: "Oops!",
						                text: "There was an error in updating product.",
						                type: "warning"
									});
								}
							});
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
    }
});
</script>
<!--END OF JAVASCTRIPT FUNCTIONS-->