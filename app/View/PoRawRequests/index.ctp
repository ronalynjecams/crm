<div class="poRawRequests index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Po Raw Requests'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Po Raw Request'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotation Products'), array('controller' => 'quotation_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation Product'), array('controller' => 'quotation_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Jr Products'), array('controller' => 'jr_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Jr Product'), array('controller' => 'jr_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Po Raw Request Properties'), array('controller' => 'po_raw_request_properties', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Po Raw Request Property'), array('controller' => 'po_raw_request_properties', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('quotation_product_id'); ?></th>
						<th><?php echo $this->Paginator->sort('jr_product_id'); ?></th>
						<th><?php echo $this->Paginator->sort('product_id'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('qty'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('date_needed'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($poRawRequests as $poRawRequest): ?>
					<tr>
						<td><?php echo h($poRawRequest['PoRawRequest']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($poRawRequest['QuotationProduct']['id'], array('controller' => 'quotation_products', 'action' => 'view', $poRawRequest['QuotationProduct']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($poRawRequest['JrProduct']['id'], array('controller' => 'jr_products', 'action' => 'view', $poRawRequest['JrProduct']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($poRawRequest['Product']['name'], array('controller' => 'products', 'action' => 'view', $poRawRequest['Product']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($poRawRequest['User']['id'], array('controller' => 'users', 'action' => 'view', $poRawRequest['User']['id'])); ?>
		</td>
						<td><?php echo h($poRawRequest['PoRawRequest']['qty']); ?>&nbsp;</td>
						<td><?php echo h($poRawRequest['PoRawRequest']['status']); ?>&nbsp;</td>
						<td><?php echo h($poRawRequest['PoRawRequest']['date_needed']); ?>&nbsp;</td>
						<td><?php echo h($poRawRequest['PoRawRequest']['created']); ?>&nbsp;</td>
						<td><?php echo h($poRawRequest['PoRawRequest']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $poRawRequest['PoRawRequest']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $poRawRequest['PoRawRequest']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $poRawRequest['PoRawRequest']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $poRawRequest['PoRawRequest']['id'])); ?>
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