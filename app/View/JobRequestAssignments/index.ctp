<div class="jobRequestAssignments index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Job Request Assignments'); ?></h1>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->



	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Assignment'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Request Products'), array('controller' => 'job_request_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Product'), array('controller' => 'job_request_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Request Floorplans'), array('controller' => 'job_request_floorplans', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Floorplan'), array('controller' => 'job_request_floorplans', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Request Revisions'), array('controller' => 'job_request_revisions', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Revision'), array('controller' => 'job_request_revisions', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('job_request_product_id'); ?></th>
						<th><?php echo $this->Paginator->sort('job_request_floorplan_id'); ?></th>
						<th><?php echo $this->Paginator->sort('designer'); ?></th>
						<th><?php echo $this->Paginator->sort('sales_executive'); ?></th>
						<th><?php echo $this->Paginator->sort('assigned_by'); ?></th>
						<th><?php echo $this->Paginator->sort('client_id'); ?></th>
						<th><?php echo $this->Paginator->sort('quotation_id'); ?></th>
						<th><?php echo $this->Paginator->sort('assigned_task'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('job_request_revision_id'); ?></th>
						<th><?php echo $this->Paginator->sort('date_rejected'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($jobRequestAssignments as $jobRequestAssignment): ?>
					<tr>
						<td><?php echo h($jobRequestAssignment['JobRequestAssignment']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($jobRequestAssignment['JobRequestProduct']['id'], array('controller' => 'job_request_products', 'action' => 'view', $jobRequestAssignment['JobRequestProduct']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($jobRequestAssignment['JobRequestFloorplan']['id'], array('controller' => 'job_request_floorplans', 'action' => 'view', $jobRequestAssignment['JobRequestFloorplan']['id'])); ?>
		</td>
						<td><?php echo h($jobRequestAssignment['JobRequestAssignment']['designer']); ?>&nbsp;</td>
						<td><?php echo h($jobRequestAssignment['JobRequestAssignment']['sales_executive']); ?>&nbsp;</td>
						<td><?php echo h($jobRequestAssignment['JobRequestAssignment']['assigned_by']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($jobRequestAssignment['Client']['name'], array('controller' => 'clients', 'action' => 'view', $jobRequestAssignment['Client']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($jobRequestAssignment['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $jobRequestAssignment['Quotation']['id'])); ?>
		</td>
						<td><?php echo h($jobRequestAssignment['JobRequestAssignment']['assigned_task']); ?>&nbsp;</td>
						<td><?php echo h($jobRequestAssignment['JobRequestAssignment']['status']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($jobRequestAssignment['JobRequestRevision']['id'], array('controller' => 'job_request_revisions', 'action' => 'view', $jobRequestAssignment['JobRequestRevision']['id'])); ?>
		</td>
						<td><?php echo h($jobRequestAssignment['JobRequestAssignment']['date_rejected']); ?>&nbsp;</td>
						<td><?php echo h($jobRequestAssignment['JobRequestAssignment']['created']); ?>&nbsp;</td>
						<td><?php echo h($jobRequestAssignment['JobRequestAssignment']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $jobRequestAssignment['JobRequestAssignment']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $jobRequestAssignment['JobRequestAssignment']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $jobRequestAssignment['JobRequestAssignment']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jobRequestAssignment['JobRequestAssignment']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

			<p>
				<small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></small>
			</p>

			<?php
			$params = $this->Paginator->params();
			if ($params['pageCount'] > 1) {
			?>
			<ul class="pagination pagination-sm">
				<?php
					echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false));
					echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a'));
					echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false));
				?>
			</ul>
			<?php } ?>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div><!-- end containing of content -->