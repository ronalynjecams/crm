<div class="paymentPurchaseOrders view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Payment Purchase Order'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Payment Purchase Order'), array('action' => 'edit', $paymentPurchaseOrder['PaymentPurchaseOrder']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Payment Purchase Order'), array('action' => 'delete', $paymentPurchaseOrder['PaymentPurchaseOrder']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $paymentPurchaseOrder['PaymentPurchaseOrder']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Payment Purchase Orders'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Payment Purchase Order'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Payment Requests'), array('controller' => 'payment_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Payment Request'), array('controller' => 'payment_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Purchase Orders'), array('controller' => 'purchase_orders', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Purchase Order'), array('controller' => 'purchase_orders', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($paymentPurchaseOrder['PaymentPurchaseOrder']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Payment Request'); ?></th>
		<td>
			<?php echo $this->Html->link($paymentPurchaseOrder['PaymentRequest']['id'], array('controller' => 'payment_requests', 'action' => 'view', $paymentPurchaseOrder['PaymentRequest']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Purchase Order'); ?></th>
		<td>
			<?php echo $this->Html->link($paymentPurchaseOrder['PurchaseOrder']['id'], array('controller' => 'purchase_orders', 'action' => 'view', $paymentPurchaseOrder['PurchaseOrder']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Po Amount Request'); ?></th>
		<td>
			<?php echo h($paymentPurchaseOrder['PaymentPurchaseOrder']['po_amount_request']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($paymentPurchaseOrder['PaymentPurchaseOrder']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($paymentPurchaseOrder['PaymentPurchaseOrder']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

