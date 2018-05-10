<div class="inventoryTransactions view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Inventory Transaction'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Inventory Transaction'), array('action' => 'edit', $inventoryTransaction['InventoryTransaction']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Inventory Transaction'), array('action' => 'delete', $inventoryTransaction['InventoryTransaction']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inventoryTransaction['InventoryTransaction']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Transactions'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Transaction'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($inventoryTransaction['InventoryTransaction']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Reference Num'); ?></th>
		<td>
			<?php echo h($inventoryTransaction['InventoryTransaction']['reference_num']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Reference Type'); ?></th>
		<td>
			<?php echo h($inventoryTransaction['InventoryTransaction']['reference_type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type Num'); ?></th>
		<td>
			<?php echo h($inventoryTransaction['InventoryTransaction']['type_num']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($inventoryTransaction['InventoryTransaction']['type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Client'); ?></th>
		<td>
			<?php echo $this->Html->link($inventoryTransaction['Client']['name'], array('controller' => 'clients', 'action' => 'view', $inventoryTransaction['Client']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($inventoryTransaction['User']['id'], array('controller' => 'users', 'action' => 'view', $inventoryTransaction['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($inventoryTransaction['InventoryTransaction']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Request Qty'); ?></th>
		<td>
			<?php echo h($inventoryTransaction['InventoryTransaction']['request_qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($inventoryTransaction['InventoryTransaction']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($inventoryTransaction['InventoryTransaction']['modified']); ?>
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
	<h3><?php echo __('Related Inventory Product Logs'); ?></h3>
	<?php if (!empty($inventoryTransaction['InventoryProductLog'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Inventory Product Details Id'); ?></th>
		<th><?php echo __('Inventory Status Id'); ?></th>
		<th><?php echo __('Inventory Transaction Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Released By'); ?></th>
		<th><?php echo __('Released To'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($inventoryTransaction['InventoryProductLog'] as $inventoryProductLog): ?>
		<tr>
			<td><?php echo $inventoryProductLog['id']; ?></td>
			<td><?php echo $inventoryProductLog['inventory_product_details_id']; ?></td>
			<td><?php echo $inventoryProductLog['inventory_status_id']; ?></td>
			<td><?php echo $inventoryProductLog['inventory_transaction_id']; ?></td>
			<td><?php echo $inventoryProductLog['user_id']; ?></td>
			<td><?php echo $inventoryProductLog['released_by']; ?></td>
			<td><?php echo $inventoryProductLog['released_to']; ?></td>
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
