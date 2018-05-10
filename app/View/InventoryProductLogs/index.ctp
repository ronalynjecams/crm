<div class="inventoryProductLogs index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Inventory Product Logs'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inventory Product Log'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Inventory Product Details'), array('controller' => 'inventory_product_details', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inventory Product Details'), array('controller' => 'inventory_product_details', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Inventory Statuses'), array('controller' => 'inventory_statuses', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inventory Status'), array('controller' => 'inventory_statuses', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Inventory Transactions'), array('controller' => 'inventory_transactions', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inventory Transaction'), array('controller' => 'inventory_transactions', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('inventory_product_details_id'); ?></th>
						<th><?php echo $this->Paginator->sort('inventory_status_id'); ?></th>
						<th><?php echo $this->Paginator->sort('inventory_transaction_id'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('released_by'); ?></th>
						<th><?php echo $this->Paginator->sort('released_to'); ?></th>
						<th><?php echo $this->Paginator->sort('qty'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($inventoryProductLogs as $inventoryProductLog): ?>
					<tr>
						<td><?php echo h($inventoryProductLog['InventoryProductLog']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($inventoryProductLog['InventoryProductDetails']['id'], array('controller' => 'inventory_product_details', 'action' => 'view', $inventoryProductLog['InventoryProductDetails']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($inventoryProductLog['InventoryStatus']['name'], array('controller' => 'inventory_statuses', 'action' => 'view', $inventoryProductLog['InventoryStatus']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($inventoryProductLog['InventoryTransaction']['id'], array('controller' => 'inventory_transactions', 'action' => 'view', $inventoryProductLog['InventoryTransaction']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($inventoryProductLog['User']['id'], array('controller' => 'users', 'action' => 'view', $inventoryProductLog['User']['id'])); ?>
		</td>
						<td><?php echo h($inventoryProductLog['InventoryProductLog']['released_by']); ?>&nbsp;</td>
						<td><?php echo h($inventoryProductLog['InventoryProductLog']['released_to']); ?>&nbsp;</td>
						<td><?php echo h($inventoryProductLog['InventoryProductLog']['qty']); ?>&nbsp;</td>
						<td><?php echo h($inventoryProductLog['InventoryProductLog']['created']); ?>&nbsp;</td>
						<td><?php echo h($inventoryProductLog['InventoryProductLog']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $inventoryProductLog['InventoryProductLog']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $inventoryProductLog['InventoryProductLog']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $inventoryProductLog['InventoryProductLog']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inventoryProductLog['InventoryProductLog']['id'])); ?>
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