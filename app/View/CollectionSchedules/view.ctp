<div class="collectionSchedules view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Collection Schedule'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Collection Schedule'), array('action' => 'edit', $collectionSchedule['CollectionSchedule']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Collection Schedule'), array('action' => 'delete', $collectionSchedule['CollectionSchedule']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $collectionSchedule['CollectionSchedule']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Collection Schedules'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Collection Schedule'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Collections'), array('controller' => 'collections', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Collection'), array('controller' => 'collections', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($collectionSchedule['CollectionSchedule']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation'); ?></th>
		<td>
			<?php echo $this->Html->link($collectionSchedule['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $collectionSchedule['Quotation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Collection'); ?></th>
		<td>
			<?php echo $this->Html->link($collectionSchedule['Collection']['id'], array('controller' => 'collections', 'action' => 'view', $collectionSchedule['Collection']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($collectionSchedule['User']['id'], array('controller' => 'users', 'action' => 'view', $collectionSchedule['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created By'); ?></th>
		<td>
			<?php echo h($collectionSchedule['CollectionSchedule']['created_by']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Onhand'); ?></th>
		<td>
			<?php echo h($collectionSchedule['CollectionSchedule']['onhand']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Officer Remarks'); ?></th>
		<td>
			<?php echo h($collectionSchedule['CollectionSchedule']['officer_remarks']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Agent Instruction'); ?></th>
		<td>
			<?php echo h($collectionSchedule['CollectionSchedule']['agent_instruction']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($collectionSchedule['CollectionSchedule']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($collectionSchedule['CollectionSchedule']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($collectionSchedule['CollectionSchedule']['status']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
			</div>
		</div><!-- end col md 9 -->

	</div>
</div>

