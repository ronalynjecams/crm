<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<script src="../plugins/datatables/media/js/bootstrap-confirmation.min.js"></script>

<div id="content-container">
	<div id="page-title">
		<h1 class="page-header text-overflow">
			Client Services View
		</h1>
	</div>
	
	<div id="page-content">
		<div class="panel">
			<div class="panel-body">
				<?php
					if($UserIn['User']['role']=='sales_executive') {
						echo "allow user to update delivery address (google maps)";
						?>
						
						<div class="col-lg-12" align="center">
							<div class="row">
								<button class="btn btn-danger" id="btn_cancel">Cancel</button>
								<?php 
								if(!empty($product)) { ?>
								<button class="btn btn-info" id="btn_done">Done</button>
								<?php } ?>
								<button class="btn btn-primary" id="btn_add_product">Add Product</button>
							</div>
						</div>
						
						<div class="col-lg-12">
							<div class="table-responsive">
								<table id="example" class="table table-striped table-bordered"
								        cellspacing="0" width="100%">
									<thead>
										<tr>
											<th>Product Image</th>
											<th>Product Name</th>
											<th>Product Description</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php
										if(!empty($product)) { ?>
										<tr>
											<td>
												<?php
												$image_name = $product['image'];
												$image_from_app = WWW_ROOT.'product_uploads/'.$image_name;
												
												$file = new File($image_from_app);
												
												if ($file->exists()) { ?>
													<img class="img-responsive"
													 src="../product_uploads/<?php echo $image_name; ?>"
													 id="prod_image_preview"
													 style="width:50%;height:50%;" />
												<?php
												}
												else { ?>
													<img class="img-responsive"
													 src="../product_uploads/image_placeholder.jpg"
													 id="prod_image_preview"
													 style="width:50%;height:50%;" />
												<?php
												}
												?>
											</td>
											<td><?php echo $product['name']; ?></td>
											<td>
												<?php
												foreach ($prod_combo_prop as $pcps) {
													foreach($pcps as $pcp) {
														$prop = $pcp['ProductComboProperty']['property'];
														$val = $pcp['ProductComboProperty']['value'];
														echo ucwords($prop).":".ucwords($val);
													}	
												}
												?>
											</td>
											<td>
												<?php
												if ($status=="processed") { ?>
													<button>
														<span class="fa fa-calendar"></span>
													</button>
												<?php	
												}
												?>
												<button class="btn btn-danger remove"
													data-toggle="confirmation" data-placement="top"
													data-title="Are you sure?"
													data-popout="true"
													value="<?php echo $id; ?>" />
													<span class="fa fa-close"></span>
												</button>
											</td>
										</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
						</div>
					<?php
					}
					else {
						echo json_encode("same table but action column should show"+
						"status of products");
					}
				?>
			</div>
		</div>
	</div>
</div>

<!--JAVASCRIPT METHODS-->
<script>
    $(document).ready(function() {
    	$('[data-toggle="tooltip"]').tooltip();
    	
    	$('[data-toggle=confirmation]').confirmation({
		  rootSelector: '[data-toggle=confirmation]',
		  // other options
		});
    	
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
        });
       
        $("#btn_done").on('click', function() {
        	alert("update client_service status to pending")
        });
        
        $("#btn_add_product").on('click', function() {
        	alert("same to add without quotation");
        });
        
        $("button.remove, #btn_cancel").on("click", function () {
        	var id = $(this).val();
        	
        	$.ajax({
        		url: '/client_services/cancel',
	        		type: 'Post',
					data: {'data': {'id':id}},
					dataType: 'text',
					success: function(id) {
						console.log(id);
						// location.reload();
					},
					error: function(err) {
						console.log("AJAX error in request: " + JSON.stringify(err, null, 2));
					}
        	});
		})
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
<!--END OF JAVASCRIPT METHODS-->
