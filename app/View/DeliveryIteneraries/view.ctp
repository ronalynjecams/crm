<div class="deliveryIteneraries view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Delivery Itenerary'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Delivery Itenerary'), array('action' => 'edit', $deliveryItenerary['DeliveryItenerary']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Delivery Itenerary'), array('action' => 'delete', $deliveryItenerary['DeliveryItenerary']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $deliveryItenerary['DeliveryItenerary']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Delivery Iteneraries'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Delivery Itenerary'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Delivery Schedules'), array('controller' => 'delivery_schedules', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Delivery Schedule'), array('controller' => 'delivery_schedules', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Vehicles'), array('controller' => 'vehicles', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Vehicle'), array('controller' => 'vehicles', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Delivery Installers'), array('controller' => 'delivery_installers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Delivery Installer'), array('controller' => 'delivery_installers', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($deliveryItenerary['DeliveryItenerary']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Delivery Schedule'); ?></th>
		<td>
			<?php echo $this->Html->link($deliveryItenerary['DeliverySchedule']['id'], array('controller' => 'delivery_schedules', 'action' => 'view', $deliveryItenerary['DeliverySchedule']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Vehicle'); ?></th>
		<td>
			<?php echo $this->Html->link($deliveryItenerary['Vehicle']['id'], array('controller' => 'vehicles', 'action' => 'view', $deliveryItenerary['Vehicle']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Booking Code'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['booking_code']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Amount'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Driver'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['driver']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Expected Start'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['expected_start']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Actual Start'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['actual_start']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('End Work'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['end_work']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Remarks'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['remarks']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Departure'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['departure']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Arrival'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['arrival']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Client'); ?></th>
		<td>
			<?php echo $this->Html->link($deliveryItenerary['Client']['name'], array('controller' => 'clients', 'action' => 'view', $deliveryItenerary['Client']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Requested By'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['requested_by']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Request Note'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['request_note']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Processed By'); ?></th>
		<td>
			<?php echo h($deliveryItenerary['DeliveryItenerary']['processed_by']); ?>
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
	<h3><?php echo __('Related Delivery Installers'); ?></h3>
	<?php if (!empty($deliveryItenerary['DeliveryInstaller'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Delivery Itenerary Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($deliveryItenerary['DeliveryInstaller'] as $deliveryInstaller): ?>
		<tr>
			<td><?php echo $deliveryInstaller['id']; ?></td>
			<td><?php echo $deliveryInstaller['delivery_itenerary_id']; ?></td>
			<td><?php echo $deliveryInstaller['user_id']; ?></td>
			<td><?php echo $deliveryInstaller['created']; ?></td>
			<td><?php echo $deliveryInstaller['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'delivery_installers', 'action' => 'view', $deliveryInstaller['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'delivery_installers', 'action' => 'edit', $deliveryInstaller['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'delivery_installers', 'action' => 'delete', $deliveryInstaller['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $deliveryInstaller['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Delivery Installer'), array('controller' => 'delivery_installers', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
