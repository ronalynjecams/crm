<div class="productSuppliers view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Product Supplier'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Product Supplier'), array('action' => 'edit', $productSupplier['ProductSupplier']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Product Supplier'), array('action' => 'delete', $productSupplier['ProductSupplier']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productSupplier['ProductSupplier']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Suppliers'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Supplier'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Suppliers'), array('controller' => 'suppliers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Supplier'), array('controller' => 'suppliers', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($productSupplier['ProductSupplier']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product'); ?></th>
		<td>
			<?php echo $this->Html->link($productSupplier['Product']['name'], array('controller' => 'products', 'action' => 'view', $productSupplier['Product']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Supplier'); ?></th>
		<td>
			<?php echo $this->Html->link($productSupplier['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $productSupplier['Supplier']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Note'); ?></th>
		<td>
			<?php echo h($productSupplier['ProductSupplier']['note']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($productSupplier['ProductSupplier']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($productSupplier['ProductSupplier']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product Code'); ?></th>
		<td>
			<?php echo h($productSupplier['ProductSupplier']['product_code']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
			</div>
		</div><!-- end col md 9 -->

	</div>
</div>

