<div class="inventoryProducts view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Inventory Product'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Inventory Product'), array('action' => 'edit', $inventoryProduct['InventoryProduct']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Inventory Product'), array('action' => 'delete', $inventoryProduct['InventoryProduct']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inventoryProduct['InventoryProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Products'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Product'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Combos'), array('controller' => 'product_combos', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Combo'), array('controller' => 'product_combos', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inv Locations'), array('controller' => 'inv_locations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inv Location'), array('controller' => 'inv_locations', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($inventoryProduct['InventoryProduct']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product Combo'); ?></th>
		<td>
			<?php echo $this->Html->link($inventoryProduct['ProductCombo']['id'], array('controller' => 'product_combos', 'action' => 'view', $inventoryProduct['ProductCombo']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Inv Location'); ?></th>
		<td>
			<?php echo $this->Html->link($inventoryProduct['InvLocation']['name'], array('controller' => 'inv_locations', 'action' => 'view', $inventoryProduct['InvLocation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($inventoryProduct['InventoryProduct']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty For Repair'); ?></th>
		<td>
			<?php echo h($inventoryProduct['InventoryProduct']['qty_for_repair']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty Chopped'); ?></th>
		<td>
			<?php echo h($inventoryProduct['InventoryProduct']['qty_chopped']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($inventoryProduct['InventoryProduct']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($inventoryProduct['InventoryProduct']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
			</div>
		</div><!-- end col md 9 -->

	</div>
</div>

