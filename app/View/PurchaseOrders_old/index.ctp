<div class="purchaseOrders index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Purchase Orders'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Purchase Order'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Suppliers'), array('controller' => 'suppliers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Supplier'), array('controller' => 'suppliers', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Po Products'), array('controller' => 'po_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Po Product'), array('controller' => 'po_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Product Sources'), array('controller' => 'product_sources', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product Source'), array('controller' => 'product_sources', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('supplier_id'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('po_number'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('discount'); ?></th>
						<th><?php echo $this->Paginator->sort('vat_amount'); ?></th>
						<th><?php echo $this->Paginator->sort('ewt_amount'); ?></th>
						<th><?php echo $this->Paginator->sort('void_date'); ?></th>
						<th><?php echo $this->Paginator->sort('void_reason'); ?></th>
						<th><?php echo $this->Paginator->sort('with_held'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th><?php echo $this->Paginator->sort('type'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($purchaseOrders as $purchaseOrder): ?>
					<tr>
						<td><?php echo h($purchaseOrder['PurchaseOrder']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($purchaseOrder['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $purchaseOrder['Supplier']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($purchaseOrder['User']['id'], array('controller' => 'users', 'action' => 'view', $purchaseOrder['User']['id'])); ?>
		</td>
						<td><?php echo h($purchaseOrder['PurchaseOrder']['po_number']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrder['PurchaseOrder']['status']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrder['PurchaseOrder']['discount']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrder['PurchaseOrder']['vat_amount']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrder['PurchaseOrder']['ewt_amount']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrder['PurchaseOrder']['void_date']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrder['PurchaseOrder']['void_reason']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrder['PurchaseOrder']['with_held']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrder['PurchaseOrder']['created']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrder['PurchaseOrder']['modified']); ?>&nbsp;</td>
						<td><?php echo h($purchaseOrder['PurchaseOrder']['type']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $purchaseOrder['PurchaseOrder']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $purchaseOrder['PurchaseOrder']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $purchaseOrder['PurchaseOrder']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $purchaseOrder['PurchaseOrder']['id'])); ?>
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