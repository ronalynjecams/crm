<div class="inventoryTransactions index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Inventory Transactions'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inventory Transaction'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Inventory Product Logs'), array('controller' => 'inventory_product_logs', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inventory Product Log'), array('controller' => 'inventory_product_logs', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('reference_num'); ?></th>
						<th><?php echo $this->Paginator->sort('reference_type'); ?></th>
						<th><?php echo $this->Paginator->sort('type_num'); ?></th>
						<th><?php echo $this->Paginator->sort('type'); ?></th>
						<th><?php echo $this->Paginator->sort('client_id'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('request_qty'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($inventoryTransactions as $inventoryTransaction): ?>
					<tr>
						<td><?php echo h($inventoryTransaction['InventoryTransaction']['id']); ?>&nbsp;</td>
						<td><?php echo h($inventoryTransaction['InventoryTransaction']['reference_num']); ?>&nbsp;</td>
						<td><?php echo h($inventoryTransaction['InventoryTransaction']['reference_type']); ?>&nbsp;</td>
						<td><?php echo h($inventoryTransaction['InventoryTransaction']['type_num']); ?>&nbsp;</td>
						<td><?php echo h($inventoryTransaction['InventoryTransaction']['type']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($inventoryTransaction['Client']['name'], array('controller' => 'clients', 'action' => 'view', $inventoryTransaction['Client']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($inventoryTransaction['User']['id'], array('controller' => 'users', 'action' => 'view', $inventoryTransaction['User']['id'])); ?>
		</td>
						<td><?php echo h($inventoryTransaction['InventoryTransaction']['status']); ?>&nbsp;</td>
						<td><?php echo h($inventoryTransaction['InventoryTransaction']['request_qty']); ?>&nbsp;</td>
						<td><?php echo h($inventoryTransaction['InventoryTransaction']['created']); ?>&nbsp;</td>
						<td><?php echo h($inventoryTransaction['InventoryTransaction']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $inventoryTransaction['InventoryTransaction']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $inventoryTransaction['InventoryTransaction']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $inventoryTransaction['InventoryTransaction']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $inventoryTransaction['InventoryTransaction']['id'])); ?>
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