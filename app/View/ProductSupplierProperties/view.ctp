<div class="productSupplierProperties view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Product Supplier Property'); ?></h1>
			</div>
		</div>
	</div>

	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Product Supplier Property'), array('action' => 'edit', $productSupplierProperty['ProductSupplierProperty']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Product Supplier Property'), array('action' => 'delete', $productSupplierProperty['ProductSupplierProperty']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productSupplierProperty['ProductSupplierProperty']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Supplier Properties'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Supplier Property'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Suppliers'), array('controller' => 'product_suppliers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Supplier'), array('controller' => 'product_suppliers', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">	
		<div class="table-responsive">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($productSupplierProperty['ProductSupplierProperty']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product Supplier'); ?></th>
		<td>
			<?php echo $this->Html->link($productSupplierProperty['ProductSupplier']['id'], array('controller' => 'product_suppliers', 'action' => 'view', $productSupplierProperty['ProductSupplier']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Property'); ?></th>
		<td>
			<?php echo h($productSupplierProperty['ProductSupplierProperty']['property']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Value'); ?></th>
		<td>
			<?php echo h($productSupplierProperty['ProductSupplierProperty']['value']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Price'); ?></th>
		<td>
			<?php echo h($productSupplierProperty['ProductSupplierProperty']['price']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($productSupplierProperty['ProductSupplierProperty']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($productSupplierProperty['ProductSupplierProperty']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
			</div>
		</div><!-- end col md 9 -->

	</div>
</div>

