<div class="paymentInvoices index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Payment Invoices'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Payment Invoice'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Payment Requests'), array('controller' => 'payment_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Payment Request'), array('controller' => 'payment_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Purchase Orders'), array('controller' => 'purchase_orders', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Purchase Order'), array('controller' => 'purchase_orders', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('payment_request_id'); ?></th>
						<th><?php echo $this->Paginator->sort('amount'); ?></th>
						<th><?php echo $this->Paginator->sort('with_held_amount'); ?></th>
						<th><?php echo $this->Paginator->sort('ewt_amount'); ?></th>
						<th><?php echo $this->Paginator->sort('tax_amount'); ?></th>
						<th><?php echo $this->Paginator->sort('reference_number'); ?></th>
						<th><?php echo $this->Paginator->sort('reference_type'); ?></th>
						<th><?php echo $this->Paginator->sort('purchase_order_id'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('valid_purchase'); ?></th>
						<th><?php echo $this->Paginator->sort('reference_date'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($paymentInvoices as $paymentInvoice): ?>
					<tr>
						<td><?php echo h($paymentInvoice['PaymentInvoice']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($paymentInvoice['PaymentRequest']['id'], array('controller' => 'payment_requests', 'action' => 'view', $paymentInvoice['PaymentRequest']['id'])); ?>
		</td>
						<td><?php echo h($paymentInvoice['PaymentInvoice']['amount']); ?>&nbsp;</td>
						<td><?php echo h($paymentInvoice['PaymentInvoice']['with_held_amount']); ?>&nbsp;</td>
						<td><?php echo h($paymentInvoice['PaymentInvoice']['ewt_amount']); ?>&nbsp;</td>
						<td><?php echo h($paymentInvoice['PaymentInvoice']['tax_amount']); ?>&nbsp;</td>
						<td><?php echo h($paymentInvoice['PaymentInvoice']['reference_number']); ?>&nbsp;</td>
						<td><?php echo h($paymentInvoice['PaymentInvoice']['reference_type']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($paymentInvoice['PurchaseOrder']['id'], array('controller' => 'purchase_orders', 'action' => 'view', $paymentInvoice['PurchaseOrder']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($paymentInvoice['User']['id'], array('controller' => 'users', 'action' => 'view', $paymentInvoice['User']['id'])); ?>
		</td>
						<td><?php echo h($paymentInvoice['PaymentInvoice']['valid_purchase']); ?>&nbsp;</td>
						<td><?php echo time_elapsed_string($paymentInvoice['PaymentInvoice']['reference_date']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $paymentInvoice['PaymentInvoice']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $paymentInvoice['PaymentInvoice']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $paymentInvoice['PaymentInvoice']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $paymentInvoice['PaymentInvoice']['id'])); ?>
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