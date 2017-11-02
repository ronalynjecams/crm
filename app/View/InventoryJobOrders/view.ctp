<div class="inventoryJobOrders view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Inventory Job Order'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Inventory Job Order'), array('action' => 'edit', $inventoryJobOrder['InventoryJobOrder']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Inventory Job Order'), array('action' => 'delete', $inventoryJobOrder['InventoryJobOrder']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inventoryJobOrder['InventoryJobOrder']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Job Orders'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Job Order'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Combos'), array('controller' => 'product_combos', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Combo'), array('controller' => 'product_combos', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($inventoryJobOrder['InventoryJobOrder']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product Combo'); ?></th>
		<td>
			<?php echo $this->Html->link($inventoryJobOrder['ProductCombo']['id'], array('controller' => 'product_combos', 'action' => 'view', $inventoryJobOrder['ProductCombo']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($inventoryJobOrder['InventoryJobOrder']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Processed Qty'); ?></th>
		<td>
			<?php echo h($inventoryJobOrder['InventoryJobOrder']['processed_qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Reference Num'); ?></th>
		<td>
			<?php echo h($inventoryJobOrder['InventoryJobOrder']['reference_num']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Reference Type'); ?></th>
		<td>
			<?php echo h($inventoryJobOrder['InventoryJobOrder']['reference_type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Mode'); ?></th>
		<td>
			<?php echo h($inventoryJobOrder['InventoryJobOrder']['mode']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($inventoryJobOrder['InventoryJobOrder']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($inventoryJobOrder['InventoryJobOrder']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($inventoryJobOrder['InventoryJobOrder']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

