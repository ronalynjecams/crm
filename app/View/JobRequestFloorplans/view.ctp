<div class="jobRequestFloorplans view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Job Request Floorplan'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Job Request Floorplan'), array('action' => 'edit', $jobRequestFloorplan['JobRequestFloorplan']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Job Request Floorplan'), array('action' => 'delete', $jobRequestFloorplan['JobRequestFloorplan']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jobRequestFloorplan['JobRequestFloorplan']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Floorplans'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Floorplan'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Requests'), array('controller' => 'job_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request'), array('controller' => 'job_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Types'), array('controller' => 'job_request_types', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Type'), array('controller' => 'job_request_types', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Po Raw Requests'), array('controller' => 'po_raw_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Po Raw Request'), array('controller' => 'po_raw_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Assignments'), array('controller' => 'job_request_assignments', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Assignment'), array('controller' => 'job_request_assignments', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($jobRequestFloorplan['JobRequestFloorplan']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestFloorplan['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $jobRequestFloorplan['Quotation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Client'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestFloorplan['Client']['name'], array('controller' => 'clients', 'action' => 'view', $jobRequestFloorplan['Client']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestFloorplan['User']['id'], array('controller' => 'users', 'action' => 'view', $jobRequestFloorplan['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestFloorplan['JobRequest']['id'], array('controller' => 'job_requests', 'action' => 'view', $jobRequestFloorplan['JobRequest']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Deadline Date'); ?></th>
		<td>
			<?php echo h($jobRequestFloorplan['JobRequestFloorplan']['deadline_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Prs'); ?></th>
		<td>
			<?php echo h($jobRequestFloorplan['JobRequestFloorplan']['date_prs']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Accomplished'); ?></th>
		<td>
			<?php echo h($jobRequestFloorplan['JobRequestFloorplan']['date_accomplished']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request Type'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestFloorplan['JobRequestType']['name'], array('controller' => 'job_request_types', 'action' => 'view', $jobRequestFloorplan['JobRequestType']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Po Raw Request'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestFloorplan['PoRawRequest']['id'], array('controller' => 'po_raw_requests', 'action' => 'view', $jobRequestFloorplan['PoRawRequest']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Received Production'); ?></th>
		<td>
			<?php echo h($jobRequestFloorplan['JobRequestFloorplan']['date_received_production']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Forwarded Production'); ?></th>
		<td>
			<?php echo h($jobRequestFloorplan['JobRequestFloorplan']['date_forwarded_production']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($jobRequestFloorplan['JobRequestFloorplan']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Description'); ?></th>
		<td>
			<?php echo h($jobRequestFloorplan['JobRequestFloorplan']['description']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Image'); ?></th>
		<td>
			<?php echo h($jobRequestFloorplan['JobRequestFloorplan']['image']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($jobRequestFloorplan['JobRequestFloorplan']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($jobRequestFloorplan['JobRequestFloorplan']['modified']); ?>
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
	<h3><?php echo __('Related Job Request Assignments'); ?></h3>
	<?php if (!empty($jobRequestFloorplan['JobRequestAssignment'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Job Request Product Id'); ?></th>
		<th><?php echo __('Job Request Floorplan Id'); ?></th>
		<th><?php echo __('Designer Id'); ?></th>
		<th><?php echo __('Sales Executive'); ?></th>
		<th><?php echo __('Assigned By'); ?></th>
		<th><?php echo __('Client Id'); ?></th>
		<th><?php echo __('Quotation Id'); ?></th>
		<th><?php echo __('Assigned Task'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Job Request Revision Id'); ?></th>
		<th><?php echo __('Date Rejected'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($jobRequestFloorplan['JobRequestAssignment'] as $jobRequestAssignment): ?>
		<tr>
			<td><?php echo $jobRequestAssignment['id']; ?></td>
			<td><?php echo $jobRequestAssignment['job_request_product_id']; ?></td>
			<td><?php echo $jobRequestAssignment['job_request_floorplan_id']; ?></td>
			<td><?php echo $jobRequestAssignment['designer_id']; ?></td>
			<td><?php echo $jobRequestAssignment['sales_executive']; ?></td>
			<td><?php echo $jobRequestAssignment['assigned_by']; ?></td>
			<td><?php echo $jobRequestAssignment['client_id']; ?></td>
			<td><?php echo $jobRequestAssignment['quotation_id']; ?></td>
			<td><?php echo $jobRequestAssignment['assigned_task']; ?></td>
			<td><?php echo $jobRequestAssignment['status']; ?></td>
			<td><?php echo $jobRequestAssignment['job_request_revision_id']; ?></td>
			<td><?php echo $jobRequestAssignment['date_rejected']; ?></td>
			<td><?php echo $jobRequestAssignment['created']; ?></td>
			<td><?php echo $jobRequestAssignment['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'job_request_assignments', 'action' => 'view', $jobRequestAssignment['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'job_request_assignments', 'action' => 'edit', $jobRequestAssignment['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'job_request_assignments', 'action' => 'delete', $jobRequestAssignment['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jobRequestAssignment['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Assignment'), array('controller' => 'job_request_assignments', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
