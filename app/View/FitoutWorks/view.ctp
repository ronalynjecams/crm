<div class="fitoutWorks view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Fitout Work'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Fitout Work'), array('action' => 'edit', $fitoutWork['FitoutWork']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Fitout Work'), array('action' => 'delete', $fitoutWork['FitoutWork']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $fitoutWork['FitoutWork']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Fitout Works'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Fitout Work'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Fitout People'), array('controller' => 'fitout_people', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Fitout Person'), array('controller' => 'fitout_people', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Fitout Qoutes'), array('controller' => 'fitout_qoutes', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Fitout Qoute'), array('controller' => 'fitout_qoutes', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Fitout Reports'), array('controller' => 'fitout_reports', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Fitout Report'), array('controller' => 'fitout_reports', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($fitoutWork['FitoutWork']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($fitoutWork['FitoutWork']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Expected Start'); ?></th>
		<td>
			<?php echo h($fitoutWork['FitoutWork']['expected_start']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Deadline'); ?></th>
		<td>
			<?php echo h($fitoutWork['FitoutWork']['deadline']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Client'); ?></th>
		<td>
			<?php echo $this->Html->link($fitoutWork['Client']['name'], array('controller' => 'clients', 'action' => 'view', $fitoutWork['Client']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Accomplished'); ?></th>
		<td>
			<?php echo time_elapsed_string($fitoutWork['FitoutWork']['date_accomplished']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($fitoutWork['User']['id'], array('controller' => 'users', 'action' => 'view', $fitoutWork['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Agents Remarks'); ?></th>
		<td>
			<?php echo h($fitoutWork['FitoutWork']['agents_remarks']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo time_elapsed_string($fitoutWork['FitoutWork']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo time_elapsed_string($fitoutWork['FitoutWork']['modified']); ?>
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
	<h3><?php echo __('Related Fitout People'); ?></h3>
	<?php if (!empty($fitoutWork['FitoutPerson'])): ?>
	<div class="table-responsive">
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Fitout Work Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($fitoutWork['FitoutPerson'] as $fitoutPerson): ?>
		<tr>
			<td><?php echo $fitoutPerson['id']; ?></td>
			<td><?php echo $fitoutPerson['fitout_work_id']; ?></td>
			<td><?php echo $fitoutPerson['user_id']; ?></td>
			<td><?php echo $fitoutPerson['created']; ?></td>
			<td><?php echo $fitoutPerson['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'fitout_people', 'action' => 'view', $fitoutPerson['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'fitout_people', 'action' => 'edit', $fitoutPerson['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'fitout_people', 'action' => 'delete', $fitoutPerson['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $fitoutPerson['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</div>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Fitout Person'), array('controller' => 'fitout_people', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Fitout Qoutes'); ?></h3>
	<?php if (!empty($fitoutWork['FitoutQoute'])): ?>
	<div class="table-responsive">
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Quotation Id'); ?></th>
		<th><?php echo __('Fitout Work Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($fitoutWork['FitoutQoute'] as $fitoutQoute): ?>
		<tr>
			<td><?php echo $fitoutQoute['id']; ?></td>
			<td><?php echo $fitoutQoute['quotation_id']; ?></td>
			<td><?php echo $fitoutQoute['fitout_work_id']; ?></td>
			<td><?php echo $fitoutQoute['created']; ?></td>
			<td><?php echo $fitoutQoute['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'fitout_qoutes', 'action' => 'view', $fitoutQoute['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'fitout_qoutes', 'action' => 'edit', $fitoutQoute['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'fitout_qoutes', 'action' => 'delete', $fitoutQoute['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $fitoutQoute['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</div>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Fitout Qoute'), array('controller' => 'fitout_qoutes', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Fitout Reports'); ?></h3>
	<?php if (!empty($fitoutWork['FitoutReport'])): ?>
	<div class="table-responsive">
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Report'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Fitout Work Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($fitoutWork['FitoutReport'] as $fitoutReport): ?>
		<tr>
			<td><?php echo $fitoutReport['id']; ?></td>
			<td><?php echo $fitoutReport['report']; ?></td>
			<td><?php echo $fitoutReport['user_id']; ?></td>
			<td><?php echo $fitoutReport['fitout_work_id']; ?></td>
			<td><?php echo $fitoutReport['created']; ?></td>
			<td><?php echo $fitoutReport['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'fitout_reports', 'action' => 'view', $fitoutReport['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'fitout_reports', 'action' => 'edit', $fitoutReport['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'fitout_reports', 'action' => 'delete', $fitoutReport['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $fitoutReport['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</div>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Fitout Report'), array('controller' => 'fitout_reports', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
