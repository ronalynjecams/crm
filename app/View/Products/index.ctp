<link href="https://cdn.datatables.net/1.10.15/css/dataTables.bootstrap.min.css" rel="stylesheet">
<link href="../plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">
<link href="../plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

<script src="../plugins/datatables/media/js/jquery.dataTables.js"></script>
<script src="../plugins/datatables/media/js/dataTables.bootstrap.js"></script>
<script src="../plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js"></script>

<!--Select2 [ OPTIONAL ]-->
<link href="../plugins/select2/css/select2.min.css" rel="stylesheet">
<script src="../plugins/select2/js/select2.min.js"></script>
<script src="../js/erp_js/erp_scripts.js"></script>

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
	                    <?php if (($UserIn['User']['role'] == 'it_staff')) { ?>
	                    
	                    <a style="color:white;font-weight:bold;" href="/products/add"
	                        class="btn btn-mint">
	                        <i class="fa fa-plus"></i>  Add New Product
	                    </a>
	                    <?php } ?>
	                </h3>
	            </div>
	            <div class="panel-body">
	            	<div class="table-responsive">
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th><?php echo $this->Paginator->sort('id'); ?></th>
								<th><?php echo $this->Paginator->sort('name'); ?></th>
								<th><?php echo $this->Paginator->sort('image'); ?></th>
								<th><?php echo $this->Paginator->sort('sub_category_id'); ?></th>
								<th><?php echo $this->Paginator->sort('other_info'); ?></th>
								<th class="actions">Actions</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($products as $product): ?>
							<tr>
								<td><?php echo h($product['Product']['id']); ?>&nbsp;</td>
								<td><?php echo h($product['Product']['name']); ?>&nbsp;</td>
								<td><?php echo h($product['Product']['image']); ?>&nbsp;</td>
										<td>
					<?php echo $this->Html->link($product['SubCategory']['name'], array('controller' => 'sub_categories', 'action' => 'view', $product['SubCategory']['id'])); ?>
				</td>
								<td><?php echo h($product['Product']['other_info']); ?>&nbsp;</td>
								<td class="actions" align="center">
									<a class="btn btn-sm btn-info"
										data-toggle="tooltip"
										data-placement="top" title="Product Combo"
										href="/product_combos/view?id=<?php echo $product['Product']['id']; ?>">
										<span class="fa fa-book"></span>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
					</div>
				</div>
		<!--</div> <!-- end col md 9 -->
	<!--</div><!-- end row -->
	</div><!-- end containing of content -->
</div>

<!---JAVASCRIPT FUNCTIONS--->
<script>
    $(document).ready(function () {
    	$('[data-toggle="tooltip"]').tooltip();
        $('#example').DataTable({
            "lengthMenu": [[50, 100, 200, -1], [50, 100, 200, "All"]],
            "order": [[0, "asc"]],
            "stateSave": true
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