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
		    <h1 class="page-header text-overflow">List of Requested Products</h1>
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
								<th>Image</th>
								<th>Name</th>
								<th>Requested By</th>
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
        $('#example').dataTable({
        	//"stateSave": true,
        	// "lengthMenu": [[10,50, 100, 200, -1], [10,50, 100, 200, "All"]],
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": "<?php echo $this->Html->Url(array('controller' => 'Products', 'action' => 'requests_ajax')); ?>"
        });
    })
</script>
<script> 
    // function killCopy(e) {
    //     return false
    // }
    // function reEnable() {
    //     return true
    // }
    // document.onselectstart = new Function("return false")
    // if (window.sidebar) {
    //     document.onmousedown = killCopy
    //     document.onclick = reEnable
    // }
</script>
<!---END OF JAVASCTRIPT FUNCTIONS--->