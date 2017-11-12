<div class="billMonitorings view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Bill Monitoring'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Bill Monitoring'), array('action' => 'edit', $billMonitoring['BillMonitoring']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Bill Monitoring'), array('action' => 'delete', $billMonitoring['BillMonitoring']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $billMonitoring['BillMonitoring']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Bill Monitorings'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Bill Monitoring'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Bills'), array('controller' => 'bills', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Bill'), array('controller' => 'bills', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($billMonitoring['BillMonitoring']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Receipt Reference Num'); ?></th>
		<td>
			<?php echo h($billMonitoring['BillMonitoring']['receipt_reference_num']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Payment Mode'); ?></th>
		<td>
			<?php echo h($billMonitoring['BillMonitoring']['payment_mode']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Billing Date From'); ?></th>
		<td>
			<?php echo h($billMonitoring['BillMonitoring']['billing_date_from']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Billing Date To'); ?></th>
		<td>
			<?php echo h($billMonitoring['BillMonitoring']['billing_date_to']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($billMonitoring['User']['id'], array('controller' => 'users', 'action' => 'view', $billMonitoring['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Bill'); ?></th>
		<td>
			<?php echo $this->Html->link($billMonitoring['Bill']['id'], array('controller' => 'bills', 'action' => 'view', $billMonitoring['Bill']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Paid By'); ?></th>
		<td>
			<?php echo h($billMonitoring['BillMonitoring']['paid_by']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($billMonitoring['BillMonitoring']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($billMonitoring['BillMonitoring']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Receipt Date'); ?></th>
		<td>
			<?php echo h($billMonitoring['BillMonitoring']['receipt_date']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

