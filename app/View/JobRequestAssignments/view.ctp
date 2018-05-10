<div class="jobRequestAssignments view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Job Request Assignment'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Job Request Assignment'), array('action' => 'edit', $jobRequestAssignment['JobRequestAssignment']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Job Request Assignment'), array('action' => 'delete', $jobRequestAssignment['JobRequestAssignment']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jobRequestAssignment['JobRequestAssignment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Assignments'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Assignment'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Products'), array('controller' => 'job_request_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Product'), array('controller' => 'job_request_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Floorplans'), array('controller' => 'job_request_floorplans', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Floorplan'), array('controller' => 'job_request_floorplans', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Revisions'), array('controller' => 'job_request_revisions', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Revision'), array('controller' => 'job_request_revisions', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($jobRequestAssignment['JobRequestAssignment']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request Product'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestAssignment['JobRequestProduct']['id'], array('controller' => 'job_request_products', 'action' => 'view', $jobRequestAssignment['JobRequestProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request Floorplan'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestAssignment['JobRequestFloorplan']['id'], array('controller' => 'job_request_floorplans', 'action' => 'view', $jobRequestAssignment['JobRequestFloorplan']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Designer'); ?></th>
		<td>
			<?php echo h($jobRequestAssignment['JobRequestAssignment']['designer']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Sales Executive'); ?></th>
		<td>
			<?php echo h($jobRequestAssignment['JobRequestAssignment']['sales_executive']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Assigned By'); ?></th>
		<td>
			<?php echo h($jobRequestAssignment['JobRequestAssignment']['assigned_by']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Client'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestAssignment['Client']['name'], array('controller' => 'clients', 'action' => 'view', $jobRequestAssignment['Client']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestAssignment['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $jobRequestAssignment['Quotation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Assigned Task'); ?></th>
		<td>
			<?php echo h($jobRequestAssignment['JobRequestAssignment']['assigned_task']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($jobRequestAssignment['JobRequestAssignment']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request Revision'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestAssignment['JobRequestRevision']['id'], array('controller' => 'job_request_revisions', 'action' => 'view', $jobRequestAssignment['JobRequestRevision']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Rejected'); ?></th>
		<td>
			<?php echo h($jobRequestAssignment['JobRequestAssignment']['date_rejected']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($jobRequestAssignment['JobRequestAssignment']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($jobRequestAssignment['JobRequestAssignment']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

