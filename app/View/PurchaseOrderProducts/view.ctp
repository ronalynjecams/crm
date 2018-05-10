<div class="purchaseOrderProducts view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Purchase Order Product'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Purchase Order Product'), array('action' => 'edit', $purchaseOrderProduct['PurchaseOrderProduct']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Purchase Order Product'), array('action' => 'delete', $purchaseOrderProduct['PurchaseOrderProduct']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $purchaseOrderProduct['PurchaseOrderProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Purchase Order Products'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Purchase Order Product'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Combos'), array('controller' => 'product_combos', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Combo'), array('controller' => 'product_combos', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Purchase Orders'), array('controller' => 'purchase_orders', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Purchase Order'), array('controller' => 'purchase_orders', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Supplier Products'), array('controller' => 'supplier_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Supplier Product'), array('controller' => 'supplier_products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product Combo'); ?></th>
		<td>
			<?php echo $this->Html->link($purchaseOrderProduct['ProductCombo']['id'], array('controller' => 'product_combos', 'action' => 'view', $purchaseOrderProduct['ProductCombo']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Purchase Order'); ?></th>
		<td>
			<?php echo $this->Html->link($purchaseOrderProduct['PurchaseOrder']['id'], array('controller' => 'purchase_orders', 'action' => 'view', $purchaseOrderProduct['PurchaseOrder']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('List Price'); ?></th>
		<td>
			<?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['list_price']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Reference Num'); ?></th>
		<td>
			<?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['reference_num']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Reference Type'); ?></th>
		<td>
			<?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['reference_type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Transaction Num'); ?></th>
		<td>
			<?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['transaction_num']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($purchaseOrderProduct['User']['id'], array('controller' => 'users', 'action' => 'view', $purchaseOrderProduct['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Additional'); ?></th>
		<td>
			<?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['additional']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Processed Qty'); ?></th>
		<td>
			<?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['processed_qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Supplier Product'); ?></th>
		<td>
			<?php echo $this->Html->link($purchaseOrderProduct['SupplierProduct']['id'], array('controller' => 'supplier_products', 'action' => 'view', $purchaseOrderProduct['SupplierProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo time_elapsed_string($purchaseOrderProduct['PurchaseOrderProduct']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo time_elapsed_string($purchaseOrderProduct['PurchaseOrderProduct']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
			</div>
		</div><!-- end col md 9 -->

	</div>
</div>

