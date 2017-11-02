<div class="productCombos view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Product Combo'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Product Combo'), array('action' => 'edit', $productCombo['ProductCombo']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Product Combo'), array('action' => 'delete', $productCombo['ProductCombo']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productCombo['ProductCombo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Combos'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Combo'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Units'), array('controller' => 'units', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Unit'), array('controller' => 'units', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Job Orders'), array('controller' => 'inventory_job_orders', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Job Order'), array('controller' => 'inventory_job_orders', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inventory Products'), array('controller' => 'inventory_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inventory Product'), array('controller' => 'inventory_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Combo Properties'), array('controller' => 'product_combo_properties', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Combo Property'), array('controller' => 'product_combo_properties', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Purchase Order Products'), array('controller' => 'purchase_order_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Purchase Order Product'), array('controller' => 'purchase_order_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Supplier Products'), array('controller' => 'supplier_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Supplier Product'), array('controller' => 'supplier_products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($productCombo['ProductCombo']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product'); ?></th>
		<td>
			<?php echo $this->Html->link($productCombo['Product']['name'], array('controller' => 'products', 'action' => 'view', $productCombo['Product']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ordering'); ?></th>
		<td>
			<?php echo h($productCombo['ProductCombo']['ordering']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Unit'); ?></th>
		<td>
			<?php echo $this->Html->link($productCombo['Unit']['name'], array('controller' => 'units', 'action' => 'view', $productCombo['Unit']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Min Stock Level'); ?></th>
		<td>
			<?php echo h($productCombo['ProductCombo']['min_stock_level']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($productCombo['ProductCombo']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($productCombo['ProductCombo']['modified']); ?>
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
	<h3><?php echo __('Related Inventory Job Orders'); ?></h3>
	<?php if (!empty($productCombo['InventoryJobOrder'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Combo Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Processed Qty'); ?></th>
		<th><?php echo __('Reference Id'); ?></th>
		<th><?php echo __('Reference Type'); ?></th>
		<th><?php echo __('Mode'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($productCombo['InventoryJobOrder'] as $inventoryJobOrder): ?>
		<tr>
			<td><?php echo $inventoryJobOrder['id']; ?></td>
			<td><?php echo $inventoryJobOrder['product_combo_id']; ?></td>
			<td><?php echo $inventoryJobOrder['qty']; ?></td>
			<td><?php echo $inventoryJobOrder['processed_qty']; ?></td>
			<td><?php echo $inventoryJobOrder['reference_id']; ?></td>
			<td><?php echo $inventoryJobOrder['reference_type']; ?></td>
			<td><?php echo $inventoryJobOrder['mode']; ?></td>
			<td><?php echo $inventoryJobOrder['status']; ?></td>
			<td><?php echo $inventoryJobOrder['created']; ?></td>
			<td><?php echo $inventoryJobOrder['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'inventory_job_orders', 'action' => 'view', $inventoryJobOrder['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'inventory_job_orders', 'action' => 'edit', $inventoryJobOrder['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'inventory_job_orders', 'action' => 'delete', $inventoryJobOrder['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inventoryJobOrder['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inventory Job Order'), array('controller' => 'inventory_job_orders', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Inventory Products'); ?></h3>
	<?php if (!empty($productCombo['InventoryProduct'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Combo Id'); ?></th>
		<th><?php echo __('Inv Location Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Qty For Repair'); ?></th>
		<th><?php echo __('Qty Chopped'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($productCombo['InventoryProduct'] as $inventoryProduct): ?>
		<tr>
			<td><?php echo $inventoryProduct['id']; ?></td>
			<td><?php echo $inventoryProduct['product_combo_id']; ?></td>
			<td><?php echo $inventoryProduct['inv_location_id']; ?></td>
			<td><?php echo $inventoryProduct['qty']; ?></td>
			<td><?php echo $inventoryProduct['qty_for_repair']; ?></td>
			<td><?php echo $inventoryProduct['qty_chopped']; ?></td>
			<td><?php echo $inventoryProduct['created']; ?></td>
			<td><?php echo $inventoryProduct['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'inventory_products', 'action' => 'view', $inventoryProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'inventory_products', 'action' => 'edit', $inventoryProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'inventory_products', 'action' => 'delete', $inventoryProduct['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inventoryProduct['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inventory Product'), array('controller' => 'inventory_products', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Product Combo Properties'); ?></h3>
	<?php if (!empty($productCombo['ProductComboProperty'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Combo Id'); ?></th>
		<th><?php echo __('Property'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($productCombo['ProductComboProperty'] as $productComboProperty): ?>
		<tr>
			<td><?php echo $productComboProperty['id']; ?></td>
			<td><?php echo $productComboProperty['product_combo_id']; ?></td>
			<td><?php echo $productComboProperty['property']; ?></td>
			<td><?php echo $productComboProperty['value']; ?></td>
			<td><?php echo $productComboProperty['created']; ?></td>
			<td><?php echo $productComboProperty['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'product_combo_properties', 'action' => 'view', $productComboProperty['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'product_combo_properties', 'action' => 'edit', $productComboProperty['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'product_combo_properties', 'action' => 'delete', $productComboProperty['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productComboProperty['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product Combo Property'), array('controller' => 'product_combo_properties', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Purchase Order Products'); ?></h3>
	<?php if (!empty($productCombo['PurchaseOrderProduct'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Combo Id'); ?></th>
		<th><?php echo __('Purchase Order Id'); ?></th>
		<th><?php echo __('List Price'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Reference Id'); ?></th>
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
	<?php foreach ($productCombo['PurchaseOrderProduct'] as $purchaseOrderProduct): ?>
		<tr>
			<td><?php echo $purchaseOrderProduct['id']; ?></td>
			<td><?php echo $purchaseOrderProduct['product_combo_id']; ?></td>
			<td><?php echo $purchaseOrderProduct['purchase_order_id']; ?></td>
			<td><?php echo $purchaseOrderProduct['list_price']; ?></td>
			<td><?php echo $purchaseOrderProduct['qty']; ?></td>
			<td><?php echo $purchaseOrderProduct['reference_id']; ?></td>
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
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Purchase Order Product'), array('controller' => 'purchase_order_products', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Supplier Products'); ?></h3>
	<?php if (!empty($productCombo['SupplierProduct'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Combo Id'); ?></th>
		<th><?php echo __('Supplier Id'); ?></th>
		<th><?php echo __('Supplier Code'); ?></th>
		<th><?php echo __('Supplier Price'); ?></th>
		<th><?php echo __('Note'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($productCombo['SupplierProduct'] as $supplierProduct): ?>
		<tr>
			<td><?php echo $supplierProduct['id']; ?></td>
			<td><?php echo $supplierProduct['product_combo_id']; ?></td>
			<td><?php echo $supplierProduct['supplier_id']; ?></td>
			<td><?php echo $supplierProduct['supplier_code']; ?></td>
			<td><?php echo $supplierProduct['supplier_price']; ?></td>
			<td><?php echo $supplierProduct['note']; ?></td>
			<td><?php echo $supplierProduct['created']; ?></td>
			<td><?php echo $supplierProduct['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'supplier_products', 'action' => 'view', $supplierProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'supplier_products', 'action' => 'edit', $supplierProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'supplier_products', 'action' => 'delete', $supplierProduct['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $supplierProduct['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Supplier Product'), array('controller' => 'supplier_products', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
