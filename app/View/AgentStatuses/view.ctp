<div class="agentStatuses view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Agent Status'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Agent Status'), array('action' => 'edit', $agentStatus['AgentStatus']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Agent Status'), array('action' => 'delete', $agentStatus['AgentStatus']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $agentStatus['AgentStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Agent Statuses'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Agent Status'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Teams'), array('controller' => 'teams', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Team'), array('controller' => 'teams', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($agentStatus['AgentStatus']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quota'); ?></th>
		<td>
			<?php echo h($agentStatus['AgentStatus']['quota']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($agentStatus['User']['id'], array('controller' => 'users', 'action' => 'view', $agentStatus['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Team'); ?></th>
		<td>
			<?php echo $this->Html->link($agentStatus['Team']['name'], array('controller' => 'teams', 'action' => 'view', $agentStatus['Team']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date From'); ?></th>
		<td>
			<?php echo h($agentStatus['AgentStatus']['date_from']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date To'); ?></th>
		<td>
			<?php echo h($agentStatus['AgentStatus']['date_to']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($agentStatus['AgentStatus']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($agentStatus['AgentStatus']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

