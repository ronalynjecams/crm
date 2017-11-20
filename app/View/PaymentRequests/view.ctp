<div class="paymentRequests view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Payment Request'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Payment Request'), array('action' => 'edit', $paymentRequest['PaymentRequest']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Payment Request'), array('action' => 'delete', $paymentRequest['PaymentRequest']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $paymentRequest['PaymentRequest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Payment Requests'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Payment Request'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Suppliers'), array('controller' => 'suppliers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Supplier'), array('controller' => 'suppliers', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($paymentRequest['PaymentRequest']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Requested Amount'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['requested_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Purpose'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['purpose']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($paymentRequest['User']['id'], array('controller' => 'users', 'action' => 'view', $paymentRequest['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Released Amount'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['released_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Liquidated Amount'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['liquidated_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Reimbursed Amount'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['reimbursed_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Returned Amount'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['returned_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ewt Released'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['ewt_released']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ewt Returned'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['ewt_returned']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Replenished Date'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['replenished_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Supplier'); ?></th>
		<td>
			<?php echo $this->Html->link($paymentRequest['Supplier']['name'], array('controller' => 'suppliers', 'action' => 'view', $paymentRequest['Supplier']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Inserted By'); ?></th>
		<td>
			<?php echo h($paymentRequest['PaymentRequest']['inserted_by']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

