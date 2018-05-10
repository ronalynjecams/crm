<div class="deliveryIteneraries index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Delivery Iteneraries'); ?></h1>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->



	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Delivery Itenerary'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Delivery Schedules'), array('controller' => 'delivery_schedules', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Delivery Schedule'), array('controller' => 'delivery_schedules', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Vehicles'), array('controller' => 'vehicles', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Vehicle'), array('controller' => 'vehicles', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Delivery Installers'), array('controller' => 'delivery_installers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Delivery Installer'), array('controller' => 'delivery_installers', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<div class="table-responsive">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('delivery_schedule_id'); ?></th>
						<th><?php echo $this->Paginator->sort('vehicle_id'); ?></th>
						<th><?php echo $this->Paginator->sort('booking_code'); ?></th>
						<th><?php echo $this->Paginator->sort('amount'); ?></th>
						<th><?php echo $this->Paginator->sort('driver'); ?></th>
						<th><?php echo $this->Paginator->sort('expected_start'); ?></th>
						<th><?php echo $this->Paginator->sort('actual_start'); ?></th>
						<th><?php echo $this->Paginator->sort('end_work'); ?></th>
						<th><?php echo $this->Paginator->sort('type'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('remarks'); ?></th>
						<th><?php echo $this->Paginator->sort('departure'); ?></th>
						<th><?php echo $this->Paginator->sort('arrival'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th><?php echo $this->Paginator->sort('client_id'); ?></th>
						<th><?php echo $this->Paginator->sort('requested_by'); ?></th>
						<th><?php echo $this->Paginator->sort('request_note'); ?></th>
						<th><?php echo $this->Paginator->sort('processed_by'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($deliveryIteneraries as $deliveryItenerary): ?>
					<tr>
						<td><?php echo h($deliveryItenerary['DeliveryItenerary']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($deliveryItenerary['DeliverySchedule']['id'], array('controller' => 'delivery_schedules', 'action' => 'view', $deliveryItenerary['DeliverySchedule']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($deliveryItenerary['Vehicle']['id'], array('controller' => 'vehicles', 'action' => 'view', $deliveryItenerary['Vehicle']['id'])); ?>
		</td>
						<td><?php echo h($deliveryItenerary['DeliveryItenerary']['booking_code']); ?>&nbsp;</td>
						<td><?php echo h($deliveryItenerary['DeliveryItenerary']['amount']); ?>&nbsp;</td>
						<td><?php echo h($deliveryItenerary['DeliveryItenerary']['driver']); ?>&nbsp;</td>
						<td><?php echo h($deliveryItenerary['DeliveryItenerary']['expected_start']); ?>&nbsp;</td>
						<td><?php echo time_elapsed_string($deliveryItenerary['DeliveryItenerary']['actual_start']); ?>&nbsp;</td>
						<td><?php echo time_elapsed_string($deliveryItenerary['DeliveryItenerary']['end_work']); ?>&nbsp;</td>
						<td><?php echo h($deliveryItenerary['DeliveryItenerary']['type']); ?>&nbsp;</td>
						<td><?php echo h($deliveryItenerary['DeliveryItenerary']['status']); ?>&nbsp;</td>
						<td><?php echo h($deliveryItenerary['DeliveryItenerary']['remarks']); ?>&nbsp;</td>
						<td><?php echo h($deliveryItenerary['DeliveryItenerary']['departure']); ?>&nbsp;</td>
						<td><?php echo h($deliveryItenerary['DeliveryItenerary']['arrival']); ?>&nbsp;</td>
						<td><?php echo time_elapsed_string($deliveryItenerary['DeliveryItenerary']['created']); ?>&nbsp;</td>
						<td><?php echo time_elapsed_string($deliveryItenerary['DeliveryItenerary']['modified']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($deliveryItenerary['Client']['name'], array('controller' => 'clients', 'action' => 'view', $deliveryItenerary['Client']['id'])); ?>
		</td>
						<td><?php echo h($deliveryItenerary['DeliveryItenerary']['requested_by']); ?>&nbsp;</td>
						<td><?php echo h($deliveryItenerary['DeliveryItenerary']['request_note']); ?>&nbsp;</td>
						<td><?php echo h($deliveryItenerary['DeliveryItenerary']['processed_by']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $deliveryItenerary['DeliveryItenerary']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $deliveryItenerary['DeliveryItenerary']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $deliveryItenerary['DeliveryItenerary']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $deliveryItenerary['DeliveryItenerary']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			</div>
			<p>
				<small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></small>
			</p>

			<?php
			$params = $this->Paginator->params();
			if ($params['pageCount'] > 1) {
			?>
			<ul class="pagination pagination-sm">
				<?php
					echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false));
					echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a'));
					echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false));
				?>
			</ul>
			<?php } ?>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div><!-- end containing of content -->