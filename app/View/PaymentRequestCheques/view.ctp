<div class="paymentRequestCheques view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Payment Request Cheque'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Payment Request Cheque'), array('action' => 'edit', $paymentRequestCheque['PaymentRequestCheque']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Payment Request Cheque'), array('action' => 'delete', $paymentRequestCheque['PaymentRequestCheque']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $paymentRequestCheque['PaymentRequestCheque']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Payment Request Cheques'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Payment Request Cheque'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Payment Requests'), array('controller' => 'payment_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Payment Request'), array('controller' => 'payment_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Payees'), array('controller' => 'payees', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Payee'), array('controller' => 'payees', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Banks'), array('controller' => 'banks', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Bank'), array('controller' => 'banks', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($paymentRequestCheque['PaymentRequestCheque']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Payment Request'); ?></th>
		<td>
			<?php echo $this->Html->link($paymentRequestCheque['PaymentRequest']['id'], array('controller' => 'payment_requests', 'action' => 'view', $paymentRequestCheque['PaymentRequest']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Cheque Number'); ?></th>
		<td>
			<?php echo h($paymentRequestCheque['PaymentRequestCheque']['cheque_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Payee'); ?></th>
		<td>
			<?php echo $this->Html->link($paymentRequestCheque['Payee']['name'], array('controller' => 'payees', 'action' => 'view', $paymentRequestCheque['Payee']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Cheque Date'); ?></th>
		<td>
			<?php echo h($paymentRequestCheque['PaymentRequestCheque']['cheque_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Void Reason'); ?></th>
		<td>
			<?php echo h($paymentRequestCheque['PaymentRequestCheque']['void_reason']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Bank'); ?></th>
		<td>
			<?php echo $this->Html->link($paymentRequestCheque['Bank']['name'], array('controller' => 'banks', 'action' => 'view', $paymentRequestCheque['Bank']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($paymentRequestCheque['PaymentRequestCheque']['status']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

