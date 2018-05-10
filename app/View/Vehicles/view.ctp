<div class="vehicles view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Vehicle'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Vehicle'), array('action' => 'edit', $vehicle['Vehicle']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Vehicle'), array('action' => 'delete', $vehicle['Vehicle']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $vehicle['Vehicle']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Vehicles'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Vehicle'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Delivery Iteneraries'), array('controller' => 'delivery_iteneraries', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Delivery Itenerary'), array('controller' => 'delivery_iteneraries', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($vehicle['Vehicle']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Plate Number'); ?></th>
		<td>
			<?php echo h($vehicle['Vehicle']['plate_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Brand'); ?></th>
		<td>
			<?php echo h($vehicle['Vehicle']['brand']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($vehicle['Vehicle']['type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo time_elapsed_string($vehicle['Vehicle']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo time_elapsed_string($vehicle['Vehicle']['modified']); ?>
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
	<h3><?php echo __('Related Delivery Iteneraries'); ?></h3>
	<?php if (!empty($vehicle['DeliveryItenerary'])): ?>
	<div class="table-responsive">
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Delivery Schedule Id'); ?></th>
		<th><?php echo __('Vehicle Id'); ?></th>
		<th><?php echo __('Booking Code'); ?></th>
		<th><?php echo __('Amount'); ?></th>
		<th><?php echo __('Driver'); ?></th>
		<th><?php echo __('Expected Start'); ?></th>
		<th><?php echo __('Actual Start'); ?></th>
		<th><?php echo __('End Work'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Remarks'); ?></th>
		<th><?php echo __('Departure'); ?></th>
		<th><?php echo __('Arrival'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Client Id'); ?></th>
		<th><?php echo __('Requested By'); ?></th>
		<th><?php echo __('Request Note'); ?></th>
		<th><?php echo __('Processed By'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($vehicle['DeliveryItenerary'] as $deliveryItenerary): ?>
		<tr>
			<td><?php echo $deliveryItenerary['id']; ?></td>
			<td><?php echo $deliveryItenerary['delivery_schedule_id']; ?></td>
			<td><?php echo $deliveryItenerary['vehicle_id']; ?></td>
			<td><?php echo $deliveryItenerary['booking_code']; ?></td>
			<td><?php echo $deliveryItenerary['amount']; ?></td>
			<td><?php echo $deliveryItenerary['driver']; ?></td>
			<td><?php echo $deliveryItenerary['expected_start']; ?></td>
			<td><?php echo time_elapsed_string($deliveryItenerary['actual_start']); ?></td>
			<td><?php echo time_elapsed_string($deliveryItenerary['end_work']); ?></td>
			<td><?php echo $deliveryItenerary['type']; ?></td>
			<td><?php echo $deliveryItenerary['status']; ?></td>
			<td><?php echo $deliveryItenerary['remarks']; ?></td>
			<td><?php echo $deliveryItenerary['departure']; ?></td>
			<td><?php echo $deliveryItenerary['arrival']; ?></td>
			<td><?php echo time_elapsed_string($deliveryItenerary['created']); ?></td>
			<td><?php echo time_elapsed_string($deliveryItenerary['modified']); ?></td>
			<td><?php echo $deliveryItenerary['client_id']; ?></td>
			<td><?php echo $deliveryItenerary['requested_by']; ?></td>
			<td><?php echo $deliveryItenerary['request_note']; ?></td>
			<td><?php echo $deliveryItenerary['processed_by']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'delivery_iteneraries', 'action' => 'view', $deliveryItenerary['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'delivery_iteneraries', 'action' => 'edit', $deliveryItenerary['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'delivery_iteneraries', 'action' => 'delete', $deliveryItenerary['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $deliveryItenerary['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</div>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Delivery Itenerary'), array('controller' => 'delivery_iteneraries', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
