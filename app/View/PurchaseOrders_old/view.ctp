<div class="purchaseOrders view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Purchase Order'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Purchase Order'), array('action' => 'edit', $purchaseOrder['PurchaseOrder']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Purchase Order'), array('action' => 'delete', $purchaseOrder['PurchaseOrder']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $purchaseOrder['PurchaseOrder']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Purchase Orders'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Purchase Order'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Suppliers'), array('controller' => 'suppliers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Supplier'), array('controller' => 'suppliers', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Po Products'), array('controller' => 'po_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Po Product'), array('controller' => 'po_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Sources'), array('controller' => 'product_sources', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Source'), array('controller' => 'product_sources', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($purchaseOrder['PurchaseOrder']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Supplier'); ?></th>
		<td>
			<?php echo $this->Html->link($purchaseOrder['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $purchaseOrder['Supplier']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($purchaseOrder['User']['id'], array('controller' => 'users', 'action' => 'view', $purchaseOrder['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Po Number'); ?></th>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['po_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Discount'); ?></th>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['discount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Vat Amount'); ?></th>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['vat_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ewt Amount'); ?></th>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['ewt_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Void Date'); ?></th>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['void_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Void Reason'); ?></th>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['void_reason']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('With Held'); ?></th>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['with_held']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($purchaseOrder['PurchaseOrder']['type']); ?>
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
	<h3><?php echo __('Related Po Products'); ?></h3>
	<?php if (!empty($purchaseOrder['PoProduct'])): ?>
	<div class="table-responsive">
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Purchase Order Id'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($purchaseOrder['PoProduct'] as $poProduct): ?>
		<tr>
			<td><?php echo $poProduct['id']; ?></td>
			<td><?php echo $poProduct['product_id']; ?></td>
			<td><?php echo $poProduct['purchase_order_id']; ?></td>
			<td><?php echo $poProduct['price']; ?></td>
			<td><?php echo $poProduct['qty']; ?></td>
			<td><?php echo $poProduct['created']; ?></td>
			<td><?php echo $poProduct['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'po_products', 'action' => 'view', $poProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'po_products', 'action' => 'edit', $poProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'po_products', 'action' => 'delete', $poProduct['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $poProduct['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</div>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Po Product'), array('controller' => 'po_products', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Product Sources'); ?></h3>
	<?php if (!empty($purchaseOrder['ProductSource'])): ?>
	<div class="table-responsive">
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Quotation Product Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Source'); ?></th>
		<th><?php echo __('Quotation Id'); ?></th>
		<th><?php echo __('Purchase Order Id'); ?></th>
		<th><?php echo __('Prod Inv Location Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($purchaseOrder['ProductSource'] as $productSource): ?>
		<tr>
			<td><?php echo $productSource['id']; ?></td>
			<td><?php echo $productSource['quotation_product_id']; ?></td>
			<td><?php echo $productSource['qty']; ?></td>
			<td><?php echo $productSource['source']; ?></td>
			<td><?php echo $productSource['quotation_id']; ?></td>
			<td><?php echo $productSource['purchase_order_id']; ?></td>
			<td><?php echo $productSource['prod_inv_location_id']; ?></td>
			<td><?php echo $productSource['status']; ?></td>
			<td><?php echo $productSource['created']; ?></td>
			<td><?php echo $productSource['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'product_sources', 'action' => 'view', $productSource['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'product_sources', 'action' => 'edit', $productSource['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'product_sources', 'action' => 'delete', $productSource['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productSource['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</div>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product Source'), array('controller' => 'product_sources', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
