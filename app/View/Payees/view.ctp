<div class="payees view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Payee'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Payee'), array('action' => 'edit', $payee['Payee']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Payee'), array('action' => 'delete', $payee['Payee']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $payee['Payee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Payees'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Payee'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Payment Request Cheques'), array('controller' => 'payment_request_cheques', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Payment Request Cheque'), array('controller' => 'payment_request_cheques', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($payee['Payee']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($payee['Payee']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($payee['Payee']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($payee['Payee']['modified']); ?>
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
	<h3><?php echo __('Related Payment Request Cheques'); ?></h3>
	<?php if (!empty($payee['PaymentRequestCheque'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Payment Request Id'); ?></th>
		<th><?php echo __('Cheque Number'); ?></th>
		<th><?php echo __('Payee Id'); ?></th>
		<th><?php echo __('Cheque Date'); ?></th>
		<th><?php echo __('Void Reason'); ?></th>
		<th><?php echo __('Bank Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($payee['PaymentRequestCheque'] as $paymentRequestCheque): ?>
		<tr>
			<td><?php echo $paymentRequestCheque['id']; ?></td>
			<td><?php echo $paymentRequestCheque['payment_request_id']; ?></td>
			<td><?php echo $paymentRequestCheque['cheque_number']; ?></td>
			<td><?php echo $paymentRequestCheque['payee_id']; ?></td>
			<td><?php echo time_elapsed_string($paymentRequestCheque['cheque_date']); ?></td>
			<td><?php echo $paymentRequestCheque['void_reason']; ?></td>
			<td><?php echo $paymentRequestCheque['bank_id']; ?></td>
			<td><?php echo $paymentRequestCheque['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'payment_request_cheques', 'action' => 'view', $paymentRequestCheque['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'payment_request_cheques', 'action' => 'edit', $paymentRequestCheque['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'payment_request_cheques', 'action' => 'delete', $paymentRequestCheque['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $paymentRequestCheque['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Payment Request Cheque'), array('controller' => 'payment_request_cheques', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
