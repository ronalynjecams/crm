<div class="jobRequestLogs view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Job Request Log'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Job Request Log'), array('action' => 'edit', $jobRequestLog['JobRequestLog']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Job Request Log'), array('action' => 'delete', $jobRequestLog['JobRequestLog']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jobRequestLog['JobRequestLog']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Logs'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Log'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Requests'), array('controller' => 'job_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request'), array('controller' => 'job_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Products'), array('controller' => 'job_request_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Product'), array('controller' => 'job_request_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Assignments'), array('controller' => 'job_request_assignments', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Assignment'), array('controller' => 'job_request_assignments', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotation Products'), array('controller' => 'quotation_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation Product'), array('controller' => 'quotation_products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($jobRequestLog['JobRequestLog']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestLog['User']['id'], array('controller' => 'users', 'action' => 'view', $jobRequestLog['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestLog['JobRequest']['id'], array('controller' => 'job_requests', 'action' => 'view', $jobRequestLog['JobRequest']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request Product'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestLog['JobRequestProduct']['id'], array('controller' => 'job_request_products', 'action' => 'view', $jobRequestLog['JobRequestProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request Assignment'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestLog['JobRequestAssignment']['id'], array('controller' => 'job_request_assignments', 'action' => 'view', $jobRequestLog['JobRequestAssignment']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($jobRequestLog['JobRequestLog']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation Product'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestLog['QuotationProduct']['id'], array('controller' => 'quotation_products', 'action' => 'view', $jobRequestLog['QuotationProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request Revision'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestLog['JobRequestRevision']['id'], array('controller' => 'job_request_revisions', 'action' => 'view', $jobRequestLog['JobRequestRevision']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($jobRequestLog['JobRequestLog']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($jobRequestLog['JobRequestLog']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

