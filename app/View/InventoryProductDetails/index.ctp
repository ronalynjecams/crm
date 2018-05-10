<div class="inventoryProductDetails index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Inventory Product Details'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inventory Product Detail'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Product Combos'), array('controller' => 'product_combos', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product Combo'), array('controller' => 'product_combos', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Inv Locations'), array('controller' => 'inv_locations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inv Location'), array('controller' => 'inv_locations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Inventory Statuses'), array('controller' => 'inventory_statuses', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inventory Status'), array('controller' => 'inventory_statuses', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Suppliers'), array('controller' => 'suppliers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Supplier'), array('controller' => 'suppliers', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('product_combo_id'); ?></th>
						<th><?php echo $this->Paginator->sort('inv_location_id'); ?></th>
						<th><?php echo $this->Paginator->sort('inventory_status_id'); ?></th>
						<th><?php echo $this->Paginator->sort('supplier_id'); ?></th>
						<th><?php echo $this->Paginator->sort('min_stock_level'); ?></th>
						<th><?php echo $this->Paginator->sort('max_stock_level'); ?></th>
						<th><?php echo $this->Paginator->sort('qty'); ?></th>
						<th><?php echo $this->Paginator->sort('initial_qty'); ?></th>
						<th><?php echo $this->Paginator->sort('qr_code'); ?></th>
						<th><?php echo $this->Paginator->sort('qr_image'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($inventoryProductDetails as $inventoryProductDetail): ?>
					<tr>
						<td><?php echo h($inventoryProductDetail['InventoryProductDetail']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($inventoryProductDetail['ProductCombo']['id'], array('controller' => 'product_combos', 'action' => 'view', $inventoryProductDetail['ProductCombo']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($inventoryProductDetail['InvLocation']['name'], array('controller' => 'inv_locations', 'action' => 'view', $inventoryProductDetail['InvLocation']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($inventoryProductDetail['InventoryStatus']['name'], array('controller' => 'inventory_statuses', 'action' => 'view', $inventoryProductDetail['InventoryStatus']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($inventoryProductDetail['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $inventoryProductDetail['Supplier']['id'])); ?>
		</td>
						<td><?php echo h($inventoryProductDetail['InventoryProductDetail']['min_stock_level']); ?>&nbsp;</td>
						<td><?php echo h($inventoryProductDetail['InventoryProductDetail']['max_stock_level']); ?>&nbsp;</td>
						<td><?php echo h($inventoryProductDetail['InventoryProductDetail']['qty']); ?>&nbsp;</td>
						<td><?php echo h($inventoryProductDetail['InventoryProductDetail']['initial_qty']); ?>&nbsp;</td>
						<td><?php echo h($inventoryProductDetail['InventoryProductDetail']['qr_code']); ?>&nbsp;</td>
						<td><?php echo h($inventoryProductDetail['InventoryProductDetail']['qr_image']); ?>&nbsp;</td>
						<td><?php echo h($inventoryProductDetail['InventoryProductDetail']['created']); ?>&nbsp;</td>
						<td><?php echo h($inventoryProductDetail['InventoryProductDetail']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $inventoryProductDetail['InventoryProductDetail']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $inventoryProductDetail['InventoryProductDetail']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $inventoryProductDetail['InventoryProductDetail']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inventoryProductDetail['InventoryProductDetail']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

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