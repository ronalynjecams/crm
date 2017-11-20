<div class="paymentRequests index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Payment Requests'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Payment Request'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('type'); ?></th>
						<th><?php echo $this->Paginator->sort('requested_amount'); ?></th>
						<th><?php echo $this->Paginator->sort('purpose'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('released_amount'); ?></th>
						<th><?php echo $this->Paginator->sort('liquidated_amount'); ?></th>
						<th><?php echo $this->Paginator->sort('reimbursed_amount'); ?></th>
						<th><?php echo $this->Paginator->sort('returned_amount'); ?></th>
						<th><?php echo $this->Paginator->sort('ewt_released'); ?></th>
						<th><?php echo $this->Paginator->sort('ewt_returned'); ?></th>
						<th><?php echo $this->Paginator->sort('replenished_date'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th><?php echo $this->Paginator->sort('supplier_id'); ?></th>
						<th><?php echo $this->Paginator->sort('inserted_by'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($paymentRequests as $paymentRequest): ?>
					<tr>
						<td><?php echo h($paymentRequest['PaymentRequest']['id']); ?>&nbsp;</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['type']); ?>&nbsp;</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['requested_amount']); ?>&nbsp;</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['purpose']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($paymentRequest['User']['id'], array('controller' => 'users', 'action' => 'view', $paymentRequest['User']['id'])); ?>
		</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['released_amount']); ?>&nbsp;</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['liquidated_amount']); ?>&nbsp;</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['reimbursed_amount']); ?>&nbsp;</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['returned_amount']); ?>&nbsp;</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['ewt_released']); ?>&nbsp;</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['ewt_returned']); ?>&nbsp;</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['replenished_date']); ?>&nbsp;</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['status']); ?>&nbsp;</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['created']); ?>&nbsp;</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['modified']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($paymentRequest['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $paymentRequest['Supplier']['id'])); ?>
		</td>
						<td><?php echo h($paymentRequest['PaymentRequest']['inserted_by']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $paymentRequest['PaymentRequest']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $paymentRequest['PaymentRequest']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $paymentRequest['PaymentRequest']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $paymentRequest['PaymentRequest']['id'])); ?>
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