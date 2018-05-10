<div class="inventoryStatuses view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Inventory Status'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Inventory Status'), array('action' => 'edit', $inventoryStatus['InventoryStatus']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Inventory Status'), array('action' => 'delete', $inventoryStatus['InventoryStatus']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inventoryStatus['InventoryStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Statuses'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Status'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Product Details'), array('controller' => 'inventory_product_details', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Product Detail'), array('controller' => 'inventory_product_details', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Product Logs'), array('controller' => 'inventory_product_logs', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Product Log'), array('controller' => 'inventory_product_logs', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($inventoryStatus['InventoryStatus']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($inventoryStatus['InventoryStatus']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($inventoryStatus['InventoryStatus']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($inventoryStatus['InventoryStatus']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Inventory Product Details'); ?></h3>
	<?php if (!empty($inventoryStatus['InventoryProductDetail'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Combo Id'); ?></th>
		<th><?php echo __('Inv Location Id'); ?></th>
		<th><?php echo __('Inventory Status Id'); ?></th>
		<th><?php echo __('Supplier Id'); ?></th>
		<th><?php echo __('Min Stock Level'); ?></th>
		<th><?php echo __('Max Stock Level'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Initial Qty'); ?></th>
		<th><?php echo __('Qr Code'); ?></th>
		<th><?php echo __('Qr Image'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($inventoryStatus['InventoryProductDetail'] as $inventoryProductDetail): ?>
		<tr>
			<td><?php echo $inventoryProductDetail['id']; ?></td>
			<td><?php echo $inventoryProductDetail['product_combo_id']; ?></td>
			<td><?php echo $inventoryProductDetail['inv_location_id']; ?></td>
			<td><?php echo $inventoryProductDetail['inventory_status_id']; ?></td>
			<td><?php echo $inventoryProductDetail['supplier_id']; ?></td>
			<td><?php echo $inventoryProductDetail['min_stock_level']; ?></td>
			<td><?php echo $inventoryProductDetail['max_stock_level']; ?></td>
			<td><?php echo $inventoryProductDetail['qty']; ?></td>
			<td><?php echo $inventoryProductDetail['initial_qty']; ?></td>
			<td><?php echo $inventoryProductDetail['qr_code']; ?></td>
			<td><?php echo $inventoryProductDetail['qr_image']; ?></td>
			<td><?php echo $inventoryProductDetail['created']; ?></td>
			<td><?php echo $inventoryProductDetail['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'inventory_product_details', 'action' => 'view', $inventoryProductDetail['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'inventory_product_details', 'action' => 'edit', $inventoryProductDetail['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'inventory_product_details', 'action' => 'delete', $inventoryProductDetail['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inventoryProductDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inventory Product Detail'), array('controller' => 'inventory_product_details', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Inventory Product Logs'); ?></h3>
	<?php if (!empty($inventoryStatus['InventoryProductLog'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Inventory Product Details Id'); ?></th>
		<th><?php echo __('Inventory Status Id'); ?></th>
		<th><?php echo __('Inventory Transaction Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($inventoryStatus['InventoryProductLog'] as $inventoryProductLog): ?>
		<tr>
			<td><?php echo $inventoryProductLog['id']; ?></td>
			<td><?php echo $inventoryProductLog['inventory_product_details_id']; ?></td>
			<td><?php echo $inventoryProductLog['inventory_status_id']; ?></td>
			<td><?php echo $inventoryProductLog['inventory_transaction_id']; ?></td>
			<td><?php echo $inventoryProductLog['user_id']; ?></td>
			<td><?php echo $inventoryProductLog['qty']; ?></td>
			<td><?php echo $inventoryProductLog['created']; ?></td>
			<td><?php echo $inventoryProductLog['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'inventory_product_logs', 'action' => 'view', $inventoryProductLog['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'inventory_product_logs', 'action' => 'edit', $inventoryProductLog['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'inventory_product_logs', 'action' => 'delete', $inventoryProductLog['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inventoryProductLog['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inventory Product Log'), array('controller' => 'inventory_product_logs', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
