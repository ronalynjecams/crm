<div class="deliverySchedules view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Delivery Schedule'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Delivery Schedule'), array('action' => 'edit', $deliverySchedule['DeliverySchedule']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Delivery Schedule'), array('action' => 'delete', $deliverySchedule['DeliverySchedule']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $deliverySchedule['DeliverySchedule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Delivery Schedules'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Delivery Schedule'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Delivery Sched Products'), array('controller' => 'delivery_sched_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Delivery Sched Product'), array('controller' => 'delivery_sched_products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($deliverySchedule['DeliverySchedule']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Delivery Date'); ?></th>
		<td>
			<?php echo h($deliverySchedule['DeliverySchedule']['delivery_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Requested Qty'); ?></th>
		<td>
			<?php echo h($deliverySchedule['DeliverySchedule']['requested_qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Actual Qty'); ?></th>
		<td>
			<?php echo h($deliverySchedule['DeliverySchedule']['actual_qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation'); ?></th>
		<td>
			<?php echo $this->Html->link($deliverySchedule['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $deliverySchedule['Quotation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Approved By'); ?></th>
		<td>
			<?php echo h($deliverySchedule['DeliverySchedule']['approved_by']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($deliverySchedule['DeliverySchedule']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($deliverySchedule['DeliverySchedule']['modified']); ?>
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
	<h3><?php echo __('Related Delivery Sched Products'); ?></h3>
	<?php if (!empty($deliverySchedule['DeliverySchedProduct'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Delivery Schedule Id'); ?></th>
		<th><?php echo __('Quotation Product Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($deliverySchedule['DeliverySchedProduct'] as $deliverySchedProduct): ?>
		<tr>
			<td><?php echo $deliverySchedProduct['id']; ?></td>
			<td><?php echo $deliverySchedProduct['delivery_schedule_id']; ?></td>
			<td><?php echo $deliverySchedProduct['quotation_product_id']; ?></td>
			<td><?php echo $deliverySchedProduct['status']; ?></td>
			<td><?php echo $deliverySchedProduct['created']; ?></td>
			<td><?php echo $deliverySchedProduct['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'delivery_sched_products', 'action' => 'view', $deliverySchedProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'delivery_sched_products', 'action' => 'edit', $deliverySchedProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'delivery_sched_products', 'action' => 'delete', $deliverySchedProduct['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $deliverySchedProduct['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Delivery Sched Product'), array('controller' => 'delivery_sched_products', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
