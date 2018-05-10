<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>>

<!-- CONTAINER -->

<div id="content-container">
	<div class="products index">
		<div id="page-title">
		    <h1 class="page-header text-overflow">List of Products for <?php echo ucfirst($status); ?></h1>
		</div>
		
		 <div id="page-content">
	        <!-- Basic Data Tables -->
	        <!--===================================================-->
	        <div class="panel">
	            <div class="panel-heading" align="right">
	                <h3 class="panel-title">
	                </h3>
	            </div>
	            <div class="panel-body">
	            	
	            	<div class="table-responsive">
	            		<?php
	            		// pr($products);
	            		?>
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th>Product Code</th>
								<th>Qty</th>
								<th>Source</th>
								<th>Received By</th>
								<th class="actions">Actions</th>
							</tr>
						</thead>
						<tbody>
							<tr>
							</tr>
						</tbody>
					</table>
					</div>
				</div>
		<!--</div> <!-- end col md 9 -->
	<!--</div><!-- end row -->
	</div><!-- end containing of content -->
</div>

</div>

</div>


<!-- UPDATE MODAL DRIVER START-->
<div class="modal fade" id="inventory_action-modal" role="dialog" tabindex="-1" aria-labelledby="demo-default-modal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!--Modal header-->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <i class="pci-cross pci-circle"></i>
                </button>
                <h4 class="modal-title"><span id="inv_title"></span> - Qty to Processes <span id="inv_qty"></span></h4>
            </div>
            <!--Modal body-->
            <div class="modal-body">
            	<div class="row">
            		<div class="col-sm-12">
            			<div class="form-group"> 
		                    <div class="col-sm-6">
		                    	<label>Location</label>
		                        <select class="form-control" id="location">
		                         	<?php foreach($inv_locations as $inv_location): ?>
		                         		<option value="<?php echo $inv_location['InvLocation']['id']; ?>"><?php echo $inv_location['InvLocation']['name']; ?></option>
		                         	<?php endforeach; ?>
		                        </select>
		                    </div>
		                    <div class="col-sm-6">
		                    	<label>Name</label>
		                         <input type="text" class="form-control" id="name">
		                    </div>
		                </div>
		            </div>
		            <div class="col-sm-12">
		            	<br />
		                <div class="form-group"> 
		                    <input type="hidden" id="requested_qty"/>
		                	<?php foreach($inv_statuses as $inv_status): ?>
			                    <div class="col-sm-6">
			                   		<label><?php echo ucfirst($inv_status['InventoryStatus']['name']); ?></label>
			                        <input type="number" class="form-control status" data-id="<?php echo $inv_status['InventoryStatus']['id']; ?>" data-name="<?php echo $inv_status['InventoryStatus']['name']; ?>">
			                    </div>
		                	<?php endforeach; ?>
		                </div>
            		</div>
                </div>
            </div>
            <!--Modal footer-->
            <div class="modal-footer">
                <button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
	                <button class="btn btn-primary" id="inventory_btn"><?php echo ucfirst($status); ?></button>
            </div>
        </div>
    </div>
</div>
<!-- UPDATE MODAL DRIVER END-->  

<!---JAVASCRIPT FUNCTIONS--->
<script>
    $(document).ready(function () {
    	$('[data-toggle="tooltip"]').tooltip();
    	
    	
    	$("input.status").change(function () {
    	    var total = 0;
    	    $("input.status").each(function(index) {
    	        var num = ($(this).val() == "") ? 0 : $(this).val();
    	        total += parseFloat(num);
    	    });
    	    
    	    var requested_qty = $("input#requested_qty").val()
    	    alert(total <= requested_qty);
    	    
        });
    	
    	
    	$(".inventory_btn").each(function (index) {
            $(this).on("click", function () {
            	var product_name = $(this).data('product_name');
                var inv_trans_qty = $(this).data('inv_trans_qty');
                var inv_trans_id = $(this).data('inv_trans_id');
                console.log(product_name);
                $("input#requested_qty").val(inv_trans_qty);
                $("span#inv_title").text(product_name);
                $("span#inv_qty").text(inv_trans_qty);
                // $('#del_itenerary_id').val(id);
                // $('#booking_code').val(booking_code);
                $('#inventory_action-modal').modal('show');

            });
        });
    	
    	// alert($("body a.inventory_action").prop("class"));
    	
    	
        // $('#example').dataTable({
        //     "ajax": {
        //         "url": "http://crm-epr-ronalynjecams.c9users.io/products/try_serverside1.json",
        //         "type": "POST"
        //     },
        //     "deferRender": true,
        // 	// "lengthMenu": [[10,50, 100, 200, -1], [10,50, 100, 200, "All"]],
        //     "columns": [
        //         { "data": "image" },
        //         { "data": "name" },
        //         { "data": "action" }
        //     ]
        // });
        
        
    var url = host+'/products/try_serverside1.json';

    $('#example').dataTable({
        // dom: "Bfrtip",
        bProcessing: true,
        paging: true,
        // pageLength: 5,
        ajax: function ( data, callback, settings ) {
			console.log(data);
            $.ajax({
                url: '/inventory_transactions/all_list_ajax.json',
                // dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: {
                	status : "<?php echo $status; ?>",
                	// dont change
                    RecordsStart: data.start,
                    PageSize: data.length,
                    Search: data.search['value'],
                    Order: data.order[0]
                    // dont change
                },
                success: function( data, textStatus, jQxhr ){
                    callback({
                        // draw: data.draw,
                        data: data.Data,
                        recordsTotal:  data.TotalRecords,
                        recordsFiltered:  data.RecordsFiltered
                    });
                    
                    $(".inventory_action").each(function (index) {
                        $(this).on("click", function () {
                        	var product_name = $(this).data('product_name');
                            var inv_trans_qty = $(this).data('inv_trans_qty');
                            var inv_trans_id = $(this).data('inv_trans_id');
                            console.log(inv_trans_qty);
                            $("input#requested_qty").val(inv_trans_qty);
                            $("span#inv_title").text(product_name);
                            $("span#inv_qty").text(inv_trans_qty);
                            // $('#del_itenerary_id').val(id);
                            // $('#booking_code').val(booking_code);
                            $('#inventory_action-modal').modal('show');
            
                        });
                    });
                },
                error: function( jqXhr, textStatus, errorThrown ){
                }
            });
        },
        serverSide: true,
        columns: [
        	{ data: "name" },
            { data: "qty" },
            { data: "supplier" },
            { data: "fullname" },
            { data: "action" },
        ],
        columnDefs: [
		   { orderable: false, targets: [-1, 2] }
		]

    });
        
        
    })
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