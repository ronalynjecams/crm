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

<!--SWEET ALERT-->
<link href="/css/sweetalert.css" rel="stylesheet">
<script src="/js/sweetalert.min.js"></script>

<!--TINYMCE-->
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script> 

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
								<div class="form-group" class="img-responsive">
									<img class="img-responsive" src="/img/product-uploads/image_placeholder.jpg"
										id="prod_image_preview" /><br/>
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
									
									<div class="row">
										<div class="col-lg-6">
											<select class="form-control" id="prod_type">
												<option>Select Type</option>
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
											<input type="number" step="any" min="0" pattern="/^[0-9.](?:\.[0-9])$/" class="form-control" id="prod_sale_price" placeholder="Sale Price" />
										</div>
									</div> <br/>
									
									<textarea class="form-control" placeholder="Other Information"
										rows="4" id="prod_other_info"></textarea>
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
												<input type="number" step="any" min="0" pattern="/^[0-9.](?:\.[0-9])$/" class="form-control" id="prod_price" placeholder="Price" />
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
						'<input type="number" step="any" min="0" pattern="/^[0-9.](?:\.[0-9])$/" class="form-control appended_prod_price" id="appended_prod_price" placeholder="Price" />'+
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
        if(input.files && input.files[0] && input.files[0].name.match(/\.(jpg|jpeg)$/)) {
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
    
    var image_file = $("#prod_image").prop('files');
	console.log(image_file);
	
	var formdata = new FormData();
    
    $('#addproduct-top, #addproduct-bottom').click(function() {
    	console.log('addproduct is clicked');
    	
	    var name =  $('#prod_name').val();
	    var other_info = tinyMCE.get('prod_other_info').getContent();
	    var image = $('#prod_image').val();
	    var category = $('#prod_category').val();
	    var sub_category = $("#prod_sub_category").val();
	    var properties = $('#prod_properties').val();
	    var values = $('#prod_values').val();
	    var price = $("#prod_price").val();
	    var type = $("#prod_type").val();
	    var sale_price_tmp = $("#prod_sale_price").val();
	    var deflt = 'false';
		if ($('#prod_default').is(":checked")) {
			deflt = 'true';
	    }
	    var sale_price = 0;
	    if(sale_price_tmp!="") {
	    	sale_price = sale_price_tmp;
	    }
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
	        var prop; var val; var price1; var def;
	        for (var i = 0, count = appended_prop.length; i < count; i++) {
	        	prop = appended_prop[i];
	        	val = appended_value[i];
	        	price1 = array_prod_price[i];
	        	def = prod_default_array[i];
	        	array_obj[i] = {"prop":prop, "val":val, "price":price1, "def":def};
	        	appended_obj["appended"] = array_obj;
	        }
        }
        else {
        	var appended_obj = 0;
        }
        
		var data = new FormData();
	
		 //Append files infos
		 jQuery.each($('input:file')[0].files, function(i, file) {
		     data.append('Image', file);
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
				console.log(msg+"---Image was uploaded");
		    	
			    if(name != "") {
			    	console.log("name passed");
			    	if(category != "Select Category") {
			    		console.log("category passed");
			    		if(sub_category != "Select Sub Category") {
			    			console.log("sub category passed");
				    		if(type != "Select Type") {
			    				console.log("type passed");
				    			if(other_info != "") {
			    					console.log("other info passed");
				    				if(image != "") {
			    						console.log("image passed");
				    					if(properties != "") {
			    							console.log("properties passed");
				    						if(values != "") {
			    								console.log("values passed");
				    							if(price != "") {
			    									console.log("price passed");
													var data = {
												    	"name": name,
												    	"other_info": other_info,
												    	"sub_category": sub_category,
												    	"image": image_filename,
												    	"required_default": deflt,
														"required_properties": properties,
														"required_values": values,
														"required_price": price,
														"sale_price": sale_price,
														"appended_obj": appended_obj,
														"type": type
												    };
												    console.log(data);
													$.ajax({
														url: "/products/add_temp_product",
														type: 'Post',
														data: {'data': data},
														dataType: 'text',
														success: function(id) {
															console.log(id);
															if(id=="Error:Already_Existing") {
																console.log("ERROR~");
																$('#prod_name').css({'border-color': 'red'});
																swal({
														            title: "Oops!",
														            text: "This name already exist. Try again.",
														            type: "warning"
																});
															}
															else {
																console.log(id);
																location.reload();
															}
														},
														error: function(err) {
															console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
															console.log("error in ajax add");
														}
													});
				    							}
				    							else {
				    								$("#prod_price").css({'border-color': 'red'});
								    				swal({
								    					title: "Oops!",
								    					text: "Price cannot be empty.\n"+
								    						  "Please add price and try again.",
								    					type: "warning"
								    				});
				    							}
				    						}
				    						else {
				    							$("#prod_values").css({'border-color': 'red'});
							    				swal({
							    					title: "Oops!",
							    					text: "Product value cannot be empty.\n"+
							    						  "Please add product value and try again.",
							    					type: "warning"
							    				});
				    						}
				    					}
				    					else {
				    						$("#prod_properties").css({'border-color': 'red'});
						    				swal({
						    					title: "Oops!",
						    					text: "Product properties cannot be empty.\n"+
						    						  "Please add product properties and try again.",
						    					type: "warning"
						    				});
				    					}
				    				}
				    				else {
				    					$("#prod_image").css({'border-color': 'red'});
					    				swal({
					    					title: "Oops!",
					    					text: "Image cannot be empty.\n"+
					    						  "Please add image and try again.",
					    					type: "warning"
					    				});
				    				}
				    			}
				    			else {
				    				swal({
				    					title: "Oops!",
				    					text: "Other information cannot be empty.\n"+
				    						  "Please add other information and try again.",
				    					type: "warning"
				    				});
				    			}
				    		}
				    		else {
				    			$("#prod_type").css({'border-color': 'red'});
			    				swal({
			    					title: "Oops!",
			    					text: "Product type cannot be empty.\n"+
			    						  "Please add prouct type and try again.",
			    					type: "warning"
			    				});
				    		}
			    		}
			    		else {
			    			$('#prod_sub_category').css({'border-color': 'red'});
		    				swal({
		    					title: "Oops!",
		    					text: "Product sub-category cannot be empty.\n"+
		    						  "Please add product sub-category and try again.",
		    					type: "warning"
		    				});
			    		}
			    	}
			    	else {
			    		$('#prod_category').css({'border-color': 'red'});
	    				swal({
	    					title: "Oops!",
	    					text: "Product category cannot be empty.\n"+
	    						  "Please add product category and try again.",
	    					type: "warning"
	    				});
			    	}
			    }
			    else {
			    	$('#prod_name').css({'border-color': 'red'});
    				swal({
    					title: "Oops!",
    					text: "Product name cannot be empty.\n"+
    						  "Please add product name and try again.",
    					type: "warning"
    				});
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