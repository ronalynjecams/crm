<div class="inventoryProductDetails view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Inventory Product Detail'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Inventory Product Detail'), array('action' => 'edit', $inventoryProductDetail['InventoryProductDetail']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Inventory Product Detail'), array('action' => 'delete', $inventoryProductDetail['InventoryProductDetail']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inventoryProductDetail['InventoryProductDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Product Details'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Product Detail'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Combos'), array('controller' => 'product_combos', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Combo'), array('controller' => 'product_combos', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inv Locations'), array('controller' => 'inv_locations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inv Location'), array('controller' => 'inv_locations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Statuses'), array('controller' => 'inventory_statuses', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Status'), array('controller' => 'inventory_statuses', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Suppliers'), array('controller' => 'suppliers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Supplier'), array('controller' => 'suppliers', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($inventoryProductDetail['InventoryProductDetail']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product Combo'); ?></th>
		<td>
			<?php echo $this->Html->link($inventoryProductDetail['ProductCombo']['id'], array('controller' => 'product_combos', 'action' => 'view', $inventoryProductDetail['ProductCombo']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Inv Location'); ?></th>
		<td>
			<?php echo $this->Html->link($inventoryProductDetail['InvLocation']['name'], array('controller' => 'inv_locations', 'action' => 'view', $inventoryProductDetail['InvLocation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Inventory Status'); ?></th>
		<td>
			<?php echo $this->Html->link($inventoryProductDetail['InventoryStatus']['name'], array('controller' => 'inventory_statuses', 'action' => 'view', $inventoryProductDetail['InventoryStatus']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Supplier'); ?></th>
		<td>
			<?php echo $this->Html->link($inventoryProductDetail['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $inventoryProductDetail['Supplier']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Min Stock Level'); ?></th>
		<td>
			<?php echo h($inventoryProductDetail['InventoryProductDetail']['min_stock_level']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Max Stock Level'); ?></th>
		<td>
			<?php echo h($inventoryProductDetail['InventoryProductDetail']['max_stock_level']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($inventoryProductDetail['InventoryProductDetail']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Initial Qty'); ?></th>
		<td>
			<?php echo h($inventoryProductDetail['InventoryProductDetail']['initial_qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qr Code'); ?></th>
		<td>
			<?php echo h($inventoryProductDetail['InventoryProductDetail']['qr_code']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qr Image'); ?></th>
		<td>
			<?php echo h($inventoryProductDetail['InventoryProductDetail']['qr_image']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($inventoryProductDetail['InventoryProductDetail']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($inventoryProductDetail['InventoryProductDetail']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

