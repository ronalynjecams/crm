<div class="paymentRequestCheques index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Payment Request Cheques'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Payment Request Cheque'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Payment Requests'), array('controller' => 'payment_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Payment Request'), array('controller' => 'payment_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Payees'), array('controller' => 'payees', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Payee'), array('controller' => 'payees', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Banks'), array('controller' => 'banks', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Bank'), array('controller' => 'banks', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('cheque_number'); ?></th>
						<th><?php echo $this->Paginator->sort('payee_id'); ?></th>
						<th><?php echo $this->Paginator->sort('cheque_date'); ?></th>
						<th><?php echo $this->Paginator->sort('void_reason'); ?></th>
						<th><?php echo $this->Paginator->sort('bank_id'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($paymentRequestCheques as $paymentRequestCheque): ?>
					<tr>
						<td><?php echo h($paymentRequestCheque['PaymentRequestCheque']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($paymentRequestCheque['PaymentRequest']['id'], array('controller' => 'payment_requests', 'action' => 'view', $paymentRequestCheque['PaymentRequest']['id'])); ?>
		</td>
						<td><?php echo h($paymentRequestCheque['PaymentRequestCheque']['cheque_number']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($paymentRequestCheque['Payee']['name'], array('controller' => 'payees', 'action' => 'view', $paymentRequestCheque['Payee']['id'])); ?>
		</td>
						<td><?php echo time_elapsed_string($paymentRequestCheque['PaymentRequestCheque']['cheque_date']); ?>&nbsp;</td>
						<td><?php echo h($paymentRequestCheque['PaymentRequestCheque']['void_reason']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($paymentRequestCheque['Bank']['name'], array('controller' => 'banks', 'action' => 'view', $paymentRequestCheque['Bank']['id'])); ?>
		</td>
						<td><?php echo h($paymentRequestCheque['PaymentRequestCheque']['status']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $paymentRequestCheque['PaymentRequestCheque']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $paymentRequestCheque['PaymentRequestCheque']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $paymentRequestCheque['PaymentRequestCheque']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $paymentRequestCheque['PaymentRequestCheque']['id'])); ?>
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