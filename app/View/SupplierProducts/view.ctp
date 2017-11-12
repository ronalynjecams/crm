<div class="supplierProducts view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Supplier Product'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Supplier Product'), array('action' => 'edit', $supplierProduct['SupplierProduct']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Supplier Product'), array('action' => 'delete', $supplierProduct['SupplierProduct']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $supplierProduct['SupplierProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Supplier Products'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Supplier Product'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Combos'), array('controller' => 'product_combos', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Combo'), array('controller' => 'product_combos', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Suppliers'), array('controller' => 'suppliers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Supplier'), array('controller' => 'suppliers', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Purchase Order Products'), array('controller' => 'purchase_order_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Purchase Order Product'), array('controller' => 'purchase_order_products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($supplierProduct['SupplierProduct']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product Combo'); ?></th>
		<td>
			<?php echo $this->Html->link($supplierProduct['ProductCombo']['id'], array('controller' => 'product_combos', 'action' => 'view', $supplierProduct['ProductCombo']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Supplier'); ?></th>
		<td>
			<?php echo $this->Html->link($supplierProduct['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $supplierProduct['Supplier']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Supplier Code'); ?></th>
		<td>
			<?php echo h($supplierProduct['SupplierProduct']['supplier_code']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Supplier Price'); ?></th>
		<td>
			<?php echo h($supplierProduct['SupplierProduct']['supplier_price']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Note'); ?></th>
		<td>
			<?php echo h($supplierProduct['SupplierProduct']['note']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($supplierProduct['SupplierProduct']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($supplierProduct['SupplierProduct']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
			</div>
		</div><!-- end col md 9 -->

	</div>
</div>

<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Purchase Order Products'); ?></h3>
	<?php if (!empty($supplierProduct['PurchaseOrderProduct'])): ?>
	<div class="table-responsive">
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Combo Id'); ?></th>
		<th><?php echo __('Purchase Order Id'); ?></th>
		<th><?php echo __('List Price'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Reference Num'); ?></th>
		<th><?php echo __('Reference Type'); ?></th>
		<th><?php echo __('Transaction Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Additional'); ?></th>
		<th><?php echo __('Processed Qty'); ?></th>
		<th><?php echo __('Supplier Product Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($supplierProduct['PurchaseOrderProduct'] as $purchaseOrderProduct): ?>
		<tr>
			<td><?php echo $purchaseOrderProduct['id']; ?></td>
			<td><?php echo $purchaseOrderProduct['product_combo_id']; ?></td>
			<td><?php echo $purchaseOrderProduct['purchase_order_id']; ?></td>
			<td><?php echo $purchaseOrderProduct['list_price']; ?></td>
			<td><?php echo $purchaseOrderProduct['qty']; ?></td>
			<td><?php echo $purchaseOrderProduct['reference_num']; ?></td>
			<td><?php echo $purchaseOrderProduct['reference_type']; ?></td>
			<td><?php echo $purchaseOrderProduct['transaction_id']; ?></td>
			<td><?php echo $purchaseOrderProduct['user_id']; ?></td>
			<td><?php echo $purchaseOrderProduct['additional']; ?></td>
			<td><?php echo $purchaseOrderProduct['processed_qty']; ?></td>
			<td><?php echo $purchaseOrderProduct['supplier_product_id']; ?></td>
			<td><?php echo $purchaseOrderProduct['created']; ?></td>
			<td><?php echo $purchaseOrderProduct['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'purchase_order_products', 'action' => 'view', $purchaseOrderProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'purchase_order_products', 'action' => 'edit', $purchaseOrderProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'purchase_order_products', 'action' => 'delete', $purchaseOrderProduct['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $purchaseOrderProduct['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</div>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Purchase Order Product'), array('controller' => 'purchase_order_products', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
