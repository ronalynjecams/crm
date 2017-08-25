<div class="collections view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Collection'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Collection'), array('action' => 'edit', $collection['Collection']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Collection'), array('action' => 'delete', $collection['Collection']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $collection['Collection']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Collections'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Collection'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Banks'), array('controller' => 'banks', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Bank'), array('controller' => 'banks', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Collection Schedules'), array('controller' => 'collection_schedules', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Collection Schedule'), array('controller' => 'collection_schedules', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($collection['Collection']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation'); ?></th>
		<td>
			<?php echo $this->Html->link($collection['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $collection['Quotation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($collection['User']['id'], array('controller' => 'users', 'action' => 'view', $collection['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Bank'); ?></th>
		<td>
			<?php echo $this->Html->link($collection['Bank']['name'], array('controller' => 'banks', 'action' => 'view', $collection['Bank']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($collection['Collection']['type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Amount Paid'); ?></th>
		<td>
			<?php echo h($collection['Collection']['amount_paid']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('With Held'); ?></th>
		<td>
			<?php echo h($collection['Collection']['with_held']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Payment Mode'); ?></th>
		<td>
			<?php echo h($collection['Collection']['payment_mode']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Check Number'); ?></th>
		<td>
			<?php echo h($collection['Collection']['check_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Check Date'); ?></th>
		<td>
			<?php echo h($collection['Collection']['check_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($collection['Collection']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Deleted'); ?></th>
		<td>
			<?php echo h($collection['Collection']['date_deleted']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Updated'); ?></th>
		<td>
			<?php echo h($collection['Collection']['date_updated']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($collection['Collection']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($collection['Collection']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Completed'); ?></th>
		<td>
			<?php echo h($collection['Collection']['date_completed']); ?>
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
	<h3><?php echo __('Related Collection Schedules'); ?></h3>
	<?php if (!empty($collection['CollectionSchedule'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Quotation Id'); ?></th>
		<th><?php echo __('Collection Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created By'); ?></th>
		<th><?php echo __('Onhand'); ?></th>
		<th><?php echo __('Officer Remarks'); ?></th>
		<th><?php echo __('Agent Instruction'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($collection['CollectionSchedule'] as $collectionSchedule): ?>
		<tr>
			<td><?php echo $collectionSchedule['id']; ?></td>
			<td><?php echo $collectionSchedule['quotation_id']; ?></td>
			<td><?php echo $collectionSchedule['collection_id']; ?></td>
			<td><?php echo $collectionSchedule['user_id']; ?></td>
			<td><?php echo $collectionSchedule['created_by']; ?></td>
			<td><?php echo $collectionSchedule['onhand']; ?></td>
			<td><?php echo $collectionSchedule['officer_remarks']; ?></td>
			<td><?php echo $collectionSchedule['agent_instruction']; ?></td>
			<td><?php echo $collectionSchedule['created']; ?></td>
			<td><?php echo $collectionSchedule['modified']; ?></td>
			<td><?php echo $collectionSchedule['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'collection_schedules', 'action' => 'view', $collectionSchedule['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'collection_schedules', 'action' => 'edit', $collectionSchedule['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'collection_schedules', 'action' => 'delete', $collectionSchedule['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $collectionSchedule['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Collection Schedule'), array('controller' => 'collection_schedules', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
