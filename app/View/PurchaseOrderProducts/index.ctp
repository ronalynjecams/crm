<div class="purchaseOrderProducts index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Purchase Order Products'); ?></h1>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->



	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Purchase Order Product'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Product Combos'), array('controller' => 'product_combos', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product Combo'), array('controller' => 'product_combos', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Purchase Orders'), array('controller' => 'purchase_orders', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Purchase Order'), array('controller' => 'purchase_orders', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Supplier Products'), array('controller' => 'supplier_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Supplier Product'), array('controller' => 'supplier_products', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<div class="table-responsive">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('product_combo_id'); ?></th>
						<th><?php echo $this->Paginator->sort('purchase_order_id'); ?></th>
						<th><?php echo $this->Paginator->sort('list_price'); ?></th>
						<th><?php echo $this->Paginator->sort('qty'); ?></th>
						<th><?php echo $this->Paginator->sort('reference_num'); ?></th>
						<th><?php echo $this->Paginator->sort('reference_type'); ?></th>
						<th><?php echo $this->Paginator->sort('transaction_num'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('additional'); ?></th>
						<th><?php echo $this->Paginator->sort('processed_qty'); ?></th>
						<th><?php echo $this->Paginator->sort('supplier_product_id'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($purchaseOrderProducts as $purchaseOrderProduct): ?>
					<tr>
						<td><?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($purchaseOrderProduct['ProductCombo']['id'], array('controller' => 'product_combos', 'action' => 'view', $purchaseOrderProduct['ProductCombo']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($purchaseOrderProduct['PurchaseOrder']['id'], array('controller' => 'purchase_orders', 'action' => 'view', $purchaseOrderProduct['PurchaseOrder']['id'])); ?>
		</td>
						<td><?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['list_price']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['qty']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['reference_num']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['reference_type']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['transaction_num']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($purchaseOrderProduct['User']['id'], array('controller' => 'users', 'action' => 'view', $purchaseOrderProduct['User']['id'])); ?>
		</td>
						<td><?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['additional']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['processed_qty']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($purchaseOrderProduct['SupplierProduct']['id'], array('controller' => 'supplier_products', 'action' => 'view', $purchaseOrderProduct['SupplierProduct']['id'])); ?>
		</td>
						<td><?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['created']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrderProduct['PurchaseOrderProduct']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $purchaseOrderProduct['PurchaseOrderProduct']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $purchaseOrderProduct['PurchaseOrderProduct']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $purchaseOrderProduct['PurchaseOrderProduct']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $purchaseOrderProduct['PurchaseOrderProduct']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			</div>
			<p>
				<small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></small>
			</p>

			<?php
			$params = $this->Paginator->params();
			if ($params['pageCount'] > 1) {
			?>
			<ul class="pagination pagination-sm">
				<?php
					echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false));
					echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a'));
					echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false));
				?>
			</ul>
			<?php } ?>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div><!-- end containing of content -->