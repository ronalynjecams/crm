<div class="paymentInvoices view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Payment Invoice'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Payment Invoice'), array('action' => 'edit', $paymentInvoice['PaymentInvoice']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Payment Invoice'), array('action' => 'delete', $paymentInvoice['PaymentInvoice']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $paymentInvoice['PaymentInvoice']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Payment Invoices'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Payment Invoice'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Payment Requests'), array('controller' => 'payment_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Payment Request'), array('controller' => 'payment_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Purchase Orders'), array('controller' => 'purchase_orders', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Purchase Order'), array('controller' => 'purchase_orders', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($paymentInvoice['PaymentInvoice']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Payment Request'); ?></th>
		<td>
			<?php echo $this->Html->link($paymentInvoice['PaymentRequest']['id'], array('controller' => 'payment_requests', 'action' => 'view', $paymentInvoice['PaymentRequest']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Amount'); ?></th>
		<td>
			<?php echo h($paymentInvoice['PaymentInvoice']['amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('With Held Amount'); ?></th>
		<td>
			<?php echo h($paymentInvoice['PaymentInvoice']['with_held_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ewt Amount'); ?></th>
		<td>
			<?php echo h($paymentInvoice['PaymentInvoice']['ewt_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Tax Amount'); ?></th>
		<td>
			<?php echo h($paymentInvoice['PaymentInvoice']['tax_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Reference Number'); ?></th>
		<td>
			<?php echo h($paymentInvoice['PaymentInvoice']['reference_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Reference Type'); ?></th>
		<td>
			<?php echo h($paymentInvoice['PaymentInvoice']['reference_type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Purchase Order'); ?></th>
		<td>
			<?php echo $this->Html->link($paymentInvoice['PurchaseOrder']['id'], array('controller' => 'purchase_orders', 'action' => 'view', $paymentInvoice['PurchaseOrder']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($paymentInvoice['User']['id'], array('controller' => 'users', 'action' => 'view', $paymentInvoice['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Valid Purchase'); ?></th>
		<td>
			<?php echo h($paymentInvoice['PaymentInvoice']['valid_purchase']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Reference Date'); ?></th>
		<td>
			<?php echo h($paymentInvoice['PaymentInvoice']['reference_date']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

