<div class="pullouts view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Pullout'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Pullout'), array('action' => 'edit', $pullout['Pullout']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Pullout'), array('action' => 'delete', $pullout['Pullout']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $pullout['Pullout']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Pullouts'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Pullout'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Client Services'), array('controller' => 'client_services', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client Service'), array('controller' => 'client_services', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Client Service Products'), array('controller' => 'client_service_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client Service Product'), array('controller' => 'client_service_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Pullout Logs'), array('controller' => 'pullout_logs', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Pullout Log'), array('controller' => 'pullout_logs', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($pullout['Pullout']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($pullout['Pullout']['type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($pullout['Pullout']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Delivered Qty'); ?></th>
		<td>
			<?php echo h($pullout['Pullout']['delivered_qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Delivered'); ?></th>
		<td>
			<?php echo h($pullout['Pullout']['date_delivered']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Pullout Qty'); ?></th>
		<td>
			<?php echo h($pullout['Pullout']['pullout_qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty Success'); ?></th>
		<td>
			<?php echo h($pullout['Pullout']['qty_success']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Expected Pullout Date'); ?></th>
		<td>
			<?php echo h($pullout['Pullout']['expected_pullout_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Pullout Date'); ?></th>
		<td>
			<?php echo h($pullout['Pullout']['pullout_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Delivery Mode'); ?></th>
		<td>
			<?php echo h($pullout['Pullout']['delivery_mode']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Client Service Product'); ?></th>
		<td>
			<?php echo $this->Html->link($pullout['ClientServiceProduct']['id'], array('controller' => 'client_service_products', 'action' => 'view', $pullout['ClientServiceProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Client Service'); ?></th>
		<td>
			<?php echo $this->Html->link($pullout['ClientService']['id'], array('controller' => 'client_services', 'action' => 'view', $pullout['ClientService']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($pullout['Pullout']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($pullout['Pullout']['modified']); ?>
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
	<h3><?php echo __('Related Pullout Logs'); ?></h3>
	<?php if (!empty($pullout['PulloutLog'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Pullout Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($pullout['PulloutLog'] as $pulloutLog): ?>
		<tr>
			<td><?php echo $pulloutLog['id']; ?></td>
			<td><?php echo $pulloutLog['pullout_id']; ?></td>
			<td><?php echo $pulloutLog['status']; ?></td>
			<td><?php echo $pulloutLog['created']; ?></td>
			<td><?php echo $pulloutLog['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'pullout_logs', 'action' => 'view', $pulloutLog['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'pullout_logs', 'action' => 'edit', $pulloutLog['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'pullout_logs', 'action' => 'delete', $pulloutLog['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $pulloutLog['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Pullout Log'), array('controller' => 'pullout_logs', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
