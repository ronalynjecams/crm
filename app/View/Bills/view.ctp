<div class="bills view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Bill'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Bill'), array('action' => 'edit', $bill['Bill']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Bill'), array('action' => 'delete', $bill['Bill']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $bill['Bill']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Bills'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Bill'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Bill Accounts'), array('controller' => 'bill_accounts', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Bill Account'), array('controller' => 'bill_accounts', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inv Locations'), array('controller' => 'inv_locations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inv Location'), array('controller' => 'inv_locations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Bill Monitorings'), array('controller' => 'bill_monitorings', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Bill Monitoring'), array('controller' => 'bill_monitorings', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">	
		<div class="table-responsive">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($bill['Bill']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Account Number'); ?></th>
		<td>
			<?php echo h($bill['Bill']['account_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Billing Status'); ?></th>
		<td>
			<?php echo h($bill['Bill']['billing_status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Jecams Amount'); ?></th>
		<td>
			<?php echo h($bill['Bill']['jecams_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Payment Type'); ?></th>
		<td>
			<?php echo h($bill['Bill']['payment_type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Bill Account'); ?></th>
		<td>
			<?php echo $this->Html->link($bill['BillAccount']['name'], array('controller' => 'bill_accounts', 'action' => 'view', $bill['BillAccount']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Inv Location'); ?></th>
		<td>
			<?php echo $this->Html->link($bill['InvLocation']['name'], array('controller' => 'inv_locations', 'action' => 'view', $bill['InvLocation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($bill['Bill']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($bill['Bill']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
		</div>
		</div><!-- end col md 9 -->

	</div>
</div>

<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Bill Monitorings'); ?></h3>
	<?php if (!empty($bill['BillMonitoring'])): ?>
	<div class="table-responsive">
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Receipt Reference Num'); ?></th>
		<th><?php echo __('Payment Mode'); ?></th>
		<th><?php echo __('Billing Date From'); ?></th>
		<th><?php echo __('Billing Date To'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Bill Id'); ?></th>
		<th><?php echo __('Paid By'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Receipt Date'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($bill['BillMonitoring'] as $billMonitoring): ?>
		<tr>
			<td><?php echo $billMonitoring['id']; ?></td>
			<td><?php echo $billMonitoring['receipt_reference_num']; ?></td>
			<td><?php echo $billMonitoring['payment_mode']; ?></td>
			<td><?php echo $billMonitoring['billing_date_from']; ?></td>
			<td><?php echo $billMonitoring['billing_date_to']; ?></td>
			<td><?php echo $billMonitoring['user_id']; ?></td>
			<td><?php echo $billMonitoring['bill_id']; ?></td>
			<td><?php echo $billMonitoring['paid_by']; ?></td>
			<td><?php echo $billMonitoring['created']; ?></td>
			<td><?php echo $billMonitoring['modified']; ?></td>
			<td><?php echo $billMonitoring['receipt_date']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'bill_monitorings', 'action' => 'view', $billMonitoring['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'bill_monitorings', 'action' => 'edit', $billMonitoring['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'bill_monitorings', 'action' => 'delete', $billMonitoring['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $billMonitoring['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</div>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Bill Monitoring'), array('controller' => 'bill_monitorings', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
