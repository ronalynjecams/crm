<div class="taskDetails view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Task Detail'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Task Detail'), array('action' => 'edit', $taskDetail['TaskDetail']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Task Detail'), array('action' => 'delete', $taskDetail['TaskDetail']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $taskDetail['TaskDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Task Details'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Task Detail'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Tasks'), array('controller' => 'tasks', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Task'), array('controller' => 'tasks', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Subtasks'), array('controller' => 'subtasks', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Subtask'), array('controller' => 'subtasks', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($taskDetail['TaskDetail']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Task'); ?></th>
		<td>
			<?php echo $this->Html->link($taskDetail['Task']['name'], array('controller' => 'tasks', 'action' => 'view', $taskDetail['Task']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Subtask'); ?></th>
		<td>
			<?php echo $this->Html->link($taskDetail['Subtask']['name'], array('controller' => 'subtasks', 'action' => 'view', $taskDetail['Subtask']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Start Datetime'); ?></th>
		<td>
			<?php echo h($taskDetail['TaskDetail']['start_datetime']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Finished Datetime'); ?></th>
		<td>
			<?php echo h($taskDetail['TaskDetail']['finished_datetime']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Notes'); ?></th>
		<td>
			<?php echo h($taskDetail['TaskDetail']['notes']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($taskDetail['TaskDetail']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($taskDetail['TaskDetail']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

