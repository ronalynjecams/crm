<div class="paymentRequestCategories view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Payment Request Category'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Payment Request Category'), array('action' => 'edit', $paymentRequestCategory['PaymentRequestCategory']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Payment Request Category'), array('action' => 'delete', $paymentRequestCategory['PaymentRequestCategory']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $paymentRequestCategory['PaymentRequestCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Payment Request Categories'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Payment Request Category'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Payment Requests'), array('controller' => 'payment_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Payment Request'), array('controller' => 'payment_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($paymentRequestCategory['PaymentRequestCategory']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($paymentRequestCategory['PaymentRequestCategory']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($paymentRequestCategory['PaymentRequestCategory']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($paymentRequestCategory['PaymentRequestCategory']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Payment Requests'); ?></h3>
	<?php if (!empty($paymentRequestCategory['PaymentRequest'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Payment Request Category Id'); ?></th>
		<th><?php echo __('Requested Amount'); ?></th>
		<th><?php echo __('Purpose'); ?></th>
		<th><?php echo __('Remarks'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Released Amount'); ?></th>
		<th><?php echo __('Liquidated Amount'); ?></th>
		<th><?php echo __('Reimbursed Amount'); ?></th>
		<th><?php echo __('Returned Amount'); ?></th>
		<th><?php echo __('Ewt Released'); ?></th>
		<th><?php echo __('Ewt Returned'); ?></th>
		<th><?php echo __('Replenished Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Supplier Id'); ?></th>
		<th><?php echo __('Inserted By'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($paymentRequestCategory['PaymentRequest'] as $paymentRequest): ?>
		<tr>
			<td><?php echo $paymentRequest['id']; ?></td>
			<td><?php echo $paymentRequest['type']; ?></td>
			<td><?php echo $paymentRequest['payment_request_category_id']; ?></td>
			<td><?php echo $paymentRequest['requested_amount']; ?></td>
			<td><?php echo $paymentRequest['purpose']; ?></td>
			<td><?php echo $paymentRequest['remarks']; ?></td>
			<td><?php echo $paymentRequest['user_id']; ?></td>
			<td><?php echo $paymentRequest['released_amount']; ?></td>
			<td><?php echo $paymentRequest['liquidated_amount']; ?></td>
			<td><?php echo $paymentRequest['reimbursed_amount']; ?></td>
			<td><?php echo $paymentRequest['returned_amount']; ?></td>
			<td><?php echo $paymentRequest['ewt_released']; ?></td>
			<td><?php echo $paymentRequest['ewt_returned']; ?></td>
			<td><?php echo $paymentRequest['replenished_date']; ?></td>
			<td><?php echo $paymentRequest['status']; ?></td>
			<td><?php echo $paymentRequest['created']; ?></td>
			<td><?php echo $paymentRequest['modified']; ?></td>
			<td><?php echo $paymentRequest['supplier_id']; ?></td>
			<td><?php echo $paymentRequest['inserted_by']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'payment_requests', 'action' => 'view', $paymentRequest['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'payment_requests', 'action' => 'edit', $paymentRequest['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'payment_requests', 'action' => 'delete', $paymentRequest['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $paymentRequest['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Payment Request'), array('controller' => 'payment_requests', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
