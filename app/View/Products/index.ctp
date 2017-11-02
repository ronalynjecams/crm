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

<!-- CONTAINER -->

<div id="content-container">
	<div class="products index">
		<div id="page-title">
		    <h1 class="page-header text-overflow">Fitout Work Projects</h1>
		</div>

	<!--<div class="row">-->

		<!--<div class="col-md-3">-->
		<!--	<div class="actions">-->
		<!--		<div class="panel panel-default">-->
		<!--			<div class="panel-heading">Actions</div>-->
		<!--				<div class="panel-body">-->
		<!--					<ul class="nav nav-pills nav-stacked">-->
		<!--						<li><?php //echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product'), array('action' => 'add'), array('escape' => false)); ?></li>-->
		<!--						<li><?php //echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Sub Categories'), array('controller' => 'sub_categories', 'action' => 'index'), array('escape' => false)); ?> </li>-->
		<!--<li><?php //echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Sub Category'), array('controller' => 'sub_categories', 'action' => 'add'), array('escape' => false)); ?> </li>-->
		<!--<li><?php //echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Product Properties'), array('controller' => 'product_properties', 'action' => 'index'), array('escape' => false)); ?> </li>-->
		<!--<li><?php //echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product Property'), array('controller' => 'product_properties', 'action' => 'add'), array('escape' => false)); ?> </li>-->
		<!--					</ul>-->
		<!--				</div><!-- end body -->
		<!--		</div><!-- end panel -->
		<!--	</div><!-- end actions -->
		<!--</div><!-- end col md 3 -->

		<!--<div class="col-md-9">-->
		
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
					<table id="example" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th><?php echo $this->Paginator->sort('id'); ?></th>
								<th><?php echo $this->Paginator->sort('name'); ?></th>
								<th><?php echo $this->Paginator->sort('image'); ?></th>
								<th><?php echo $this->Paginator->sort('sub_category_id'); ?></th>
								<th><?php echo $this->Paginator->sort('other_info'); ?></th>
								<th class="actions"></th>
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
								<td class="actions">
									<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $product['Product']['id']), array('escape' => false)); ?>
									<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $product['Product']['id']), array('escape' => false)); ?>
									<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $product['Product']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $product['Product']['id'])); ?>
								</td>
							</tr>
						<?php endforeach; ?>
						</tbody>
					</table>
				</div>
		<!--</div> <!-- end col md 9 -->
	<!--</div><!-- end row -->
	</div><!-- end containing of content -->
</div>

<!---JAVASCRIPT FUNCTIONS--->
<script>
    $(document).ready(function () {
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