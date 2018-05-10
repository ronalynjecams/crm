<div class="inventoryProductLogs view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Inventory Product Log'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Inventory Product Log'), array('action' => 'edit', $inventoryProductLog['InventoryProductLog']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Inventory Product Log'), array('action' => 'delete', $inventoryProductLog['InventoryProductLog']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inventoryProductLog['InventoryProductLog']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Product Logs'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Product Log'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Product Details'), array('controller' => 'inventory_product_details', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Product Details'), array('controller' => 'inventory_product_details', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Statuses'), array('controller' => 'inventory_statuses', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Status'), array('controller' => 'inventory_statuses', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Transactions'), array('controller' => 'inventory_transactions', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Transaction'), array('controller' => 'inventory_transactions', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($inventoryProductLog['InventoryProductLog']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Inventory Product Details'); ?></th>
		<td>
			<?php echo $this->Html->link($inventoryProductLog['InventoryProductDetails']['id'], array('controller' => 'inventory_product_details', 'action' => 'view', $inventoryProductLog['InventoryProductDetails']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Inventory Status'); ?></th>
		<td>
			<?php echo $this->Html->link($inventoryProductLog['InventoryStatus']['name'], array('controller' => 'inventory_statuses', 'action' => 'view', $inventoryProductLog['InventoryStatus']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Inventory Transaction'); ?></th>
		<td>
			<?php echo $this->Html->link($inventoryProductLog['InventoryTransaction']['id'], array('controller' => 'inventory_transactions', 'action' => 'view', $inventoryProductLog['InventoryTransaction']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($inventoryProductLog['User']['id'], array('controller' => 'users', 'action' => 'view', $inventoryProductLog['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Released By'); ?></th>
		<td>
			<?php echo h($inventoryProductLog['InventoryProductLog']['released_by']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Released To'); ?></th>
		<td>
			<?php echo h($inventoryProductLog['InventoryProductLog']['released_to']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($inventoryProductLog['InventoryProductLog']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($inventoryProductLog['InventoryProductLog']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($inventoryProductLog['InventoryProductLog']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

