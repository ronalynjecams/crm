<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="/css/plug/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="/css/plug/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="/css/plug/datatables/media/js/jquery.dataTables.js"></script>
<script src="/css/plug/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="/css/plug/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<link href="/css/plug/select/css/select2.min.css" rel="stylesheet">
<script src="/css/plug/select/js/select2.min.js"></script>
<script src="/js/erp_scripts.js"></script>

<!-- CONTAINER -->

<div id="content-container">
	<div class="products index">
		<div id="page-title">
		    <h1 class="page-header text-overflow">List of Products</h1>
		</div>
		
		 <div id="page-content">
	        <!-- Basic Data Tables -->
	        <!--===================================================-->
	        <div class="panel">
	            <div class="panel-heading" align="right">
	                <h3 class="panel-title">
	                    <?php if ($UserIn['User']['role'] == 'it_staff' || $UserIn['User']['role']=="proprietor") { ?>
	                    <a style="color:white;font-weight:bold;" href="/products/add"
	                        class="btn btn-mint">
	                        <i class="fa fa-plus"></i>  Add New Products
	                    </a>
	                    <a href="/products/export" style="color:white;font-weight:bold;" class="btn btn-success" id="btn_export_excel">
	                    	<span class="fa fa-file-excel-o" data-toggle="tooltip" data-placement="top" title="Export Products"></span>
	                    </a>
	                    <?php } ?>
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
								<th>Image</th>
								<th>Name</th>
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

<!---JAVASCRIPT FUNCTIONS--->
<script>
    $(document).ready(function () {
    	$('[data-toggle="tooltip"]').tooltip();
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
                url: '/products/try_serverside1.json',
                // dataType: 'text',
                type: 'post',
                contentType: 'application/x-www-form-urlencoded',
                data: {
                    RecordsStart: data.start,
                    PageSize: data.length,
                    Search: data.search['value'],
                    Order: data.order[0]
                },
                success: function( data, textStatus, jQxhr ){
                    callback({
                        // draw: data.draw,
                        data: data.Data,
                        recordsTotal:  data.TotalRecords,
                        recordsFiltered:  data.RecordsFiltered
                    });
                },
                error: function( jqXhr, textStatus, errorThrown ){
                }
            });
        },
        serverSide: true,
        columns: [
            { data: "image" },
            { data: "name" },
            { data: "action" },
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