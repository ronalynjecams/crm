<div class="jobRequestRevisions view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Job Request Revision'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Job Request Revision'), array('action' => 'edit', $jobRequestRevision['JobRequestRevision']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Job Request Revision'), array('action' => 'delete', $jobRequestRevision['JobRequestRevision']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jobRequestRevision['JobRequestRevision']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Revisions'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Revision'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Products'), array('controller' => 'job_request_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Product'), array('controller' => 'job_request_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Types'), array('controller' => 'job_request_types', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Type'), array('controller' => 'job_request_types', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($jobRequestRevision['JobRequestRevision']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request Product'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestRevision['JobRequestProduct']['id'], array('controller' => 'job_request_products', 'action' => 'view', $jobRequestRevision['JobRequestProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request Type'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestRevision['JobRequestType']['name'], array('controller' => 'job_request_types', 'action' => 'view', $jobRequestRevision['JobRequestType']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Deadline Date'); ?></th>
		<td>
			<?php echo h($jobRequestRevision['JobRequestRevision']['deadline_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Estimated Finish'); ?></th>
		<td>
			<?php echo h($jobRequestRevision['JobRequestRevision']['estimated_finish']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Actual Date Finished'); ?></th>
		<td>
			<?php echo h($jobRequestRevision['JobRequestRevision']['actual_date_finished']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestRevision['Product']['name'], array('controller' => 'products', 'action' => 'view', $jobRequestRevision['Product']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($jobRequestRevision['JobRequestRevision']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($jobRequestRevision['JobRequestRevision']['modified']); ?>
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
	<?php if (!empty($jobRequestRevision['JobRequestAssignment'])): ?>
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
	<?php foreach ($jobRequestRevision['JobRequestAssignment'] as $jobRequestAssignment): ?>
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
