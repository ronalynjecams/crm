<div class="jobRequestTypes view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Job Request Type'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Job Request Type'), array('action' => 'edit', $jobRequestType['JobRequestType']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Job Request Type'), array('action' => 'delete', $jobRequestType['JobRequestType']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jobRequestType['JobRequestType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Types'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Type'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Floorplans'), array('controller' => 'job_request_floorplans', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Floorplan'), array('controller' => 'job_request_floorplans', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Products'), array('controller' => 'job_request_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Product'), array('controller' => 'job_request_products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($jobRequestType['JobRequestType']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($jobRequestType['JobRequestType']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($jobRequestType['JobRequestType']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($jobRequestType['JobRequestType']['modified']); ?>
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
	<h3><?php echo __('Related Job Request Floorplans'); ?></h3>
	<?php if (!empty($jobRequestType['JobRequestFloorplan'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Quotation Id'); ?></th>
		<th><?php echo __('Client Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Job Request Id'); ?></th>
		<th><?php echo __('Deadline Date'); ?></th>
		<th><?php echo __('Date Prs'); ?></th>
		<th><?php echo __('Date Accomplished'); ?></th>
		<th><?php echo __('Job Request Type Id'); ?></th>
		<th><?php echo __('Po Raw Request Id'); ?></th>
		<th><?php echo __('Date Received Production'); ?></th>
		<th><?php echo __('Date Forwarded Production'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Description'); ?></th>
		<th><?php echo __('Image'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($jobRequestType['JobRequestFloorplan'] as $jobRequestFloorplan): ?>
		<tr>
			<td><?php echo $jobRequestFloorplan['id']; ?></td>
			<td><?php echo $jobRequestFloorplan['quotation_id']; ?></td>
			<td><?php echo $jobRequestFloorplan['client_id']; ?></td>
			<td><?php echo $jobRequestFloorplan['user_id']; ?></td>
			<td><?php echo $jobRequestFloorplan['job_request_id']; ?></td>
			<td><?php echo $jobRequestFloorplan['deadline_date']; ?></td>
			<td><?php echo $jobRequestFloorplan['date_prs']; ?></td>
			<td><?php echo $jobRequestFloorplan['date_accomplished']; ?></td>
			<td><?php echo $jobRequestFloorplan['job_request_type_id']; ?></td>
			<td><?php echo $jobRequestFloorplan['po_raw_request_id']; ?></td>
			<td><?php echo $jobRequestFloorplan['date_received_production']; ?></td>
			<td><?php echo $jobRequestFloorplan['date_forwarded_production']; ?></td>
			<td><?php echo $jobRequestFloorplan['status']; ?></td>
			<td><?php echo $jobRequestFloorplan['description']; ?></td>
			<td><?php echo $jobRequestFloorplan['image']; ?></td>
			<td><?php echo $jobRequestFloorplan['created']; ?></td>
			<td><?php echo $jobRequestFloorplan['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'job_request_floorplans', 'action' => 'view', $jobRequestFloorplan['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'job_request_floorplans', 'action' => 'edit', $jobRequestFloorplan['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'job_request_floorplans', 'action' => 'delete', $jobRequestFloorplan['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jobRequestFloorplan['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Floorplan'), array('controller' => 'job_request_floorplans', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Job Request Products'); ?></h3>
	<?php if (!empty($jobRequestType['JobRequestProduct'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Quotation Product Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Client Id'); ?></th>
		<th><?php echo __('Job Request Id'); ?></th>
		<th><?php echo __('Date Prs'); ?></th>
		<th><?php echo __('Deadline Date'); ?></th>
		<th><?php echo __('Date Accomplished'); ?></th>
		<th><?php echo __('Job Request Type Id'); ?></th>
		<th><?php echo __('Po Raw Request Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Quotation Id'); ?></th>
		<th><?php echo __('Image'); ?></th>
		<th><?php echo __('Date Received Production'); ?></th>
		<th><?php echo __('Date Forwarded Production'); ?></th>
		<th><?php echo __('Date Deleted'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($jobRequestType['JobRequestProduct'] as $jobRequestProduct): ?>
		<tr>
			<td><?php echo $jobRequestProduct['id']; ?></td>
			<td><?php echo $jobRequestProduct['quotation_product_id']; ?></td>
			<td><?php echo $jobRequestProduct['user_id']; ?></td>
			<td><?php echo $jobRequestProduct['client_id']; ?></td>
			<td><?php echo $jobRequestProduct['job_request_id']; ?></td>
			<td><?php echo $jobRequestProduct['date_prs']; ?></td>
			<td><?php echo $jobRequestProduct['deadline_date']; ?></td>
			<td><?php echo $jobRequestProduct['date_accomplished']; ?></td>
			<td><?php echo $jobRequestProduct['job_request_type_id']; ?></td>
			<td><?php echo $jobRequestProduct['po_raw_request_id']; ?></td>
			<td><?php echo $jobRequestProduct['status']; ?></td>
			<td><?php echo $jobRequestProduct['quotation_id']; ?></td>
			<td><?php echo $jobRequestProduct['image']; ?></td>
			<td><?php echo $jobRequestProduct['date_received_production']; ?></td>
			<td><?php echo $jobRequestProduct['date_forwarded_production']; ?></td>
			<td><?php echo $jobRequestProduct['date_deleted']; ?></td>
			<td><?php echo $jobRequestProduct['product_id']; ?></td>
			<td><?php echo $jobRequestProduct['created']; ?></td>
			<td><?php echo $jobRequestProduct['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'job_request_products', 'action' => 'view', $jobRequestProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'job_request_products', 'action' => 'edit', $jobRequestProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'job_request_products', 'action' => 'delete', $jobRequestProduct['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jobRequestProduct['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Product'), array('controller' => 'job_request_products', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Job Request Revisions'); ?></h3>
	<?php if (!empty($jobRequestType['JobRequestRevision'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Job Request Pending Id'); ?></th>
		<th><?php echo __('Job Request Type Id'); ?></th>
		<th><?php echo __('Deadline Date'); ?></th>
		<th><?php echo __('Estimated Finish'); ?></th>
		<th><?php echo __('Actual Date Finished'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($jobRequestType['JobRequestRevision'] as $jobRequestRevision): ?>
		<tr>
			<td><?php echo $jobRequestRevision['id']; ?></td>
			<td><?php echo $jobRequestRevision['job_request_pending_id']; ?></td>
			<td><?php echo $jobRequestRevision['job_request_type_id']; ?></td>
			<td><?php echo $jobRequestRevision['deadline_date']; ?></td>
			<td><?php echo $jobRequestRevision['estimated_finish']; ?></td>
			<td><?php echo $jobRequestRevision['actual_date_finished']; ?></td>
			<td><?php echo $jobRequestRevision['product_id']; ?></td>
			<td><?php echo $jobRequestRevision['created']; ?></td>
			<td><?php echo $jobRequestRevision['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'job_request_revisions', 'action' => 'view', $jobRequestRevision['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'job_request_revisions', 'action' => 'edit', $jobRequestRevision['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'job_request_revisions', 'action' => 'delete', $jobRequestRevision['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jobRequestRevision['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Revision'), array('controller' => 'job_request_revisions', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
