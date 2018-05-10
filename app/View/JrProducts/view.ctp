<div class="jrProducts view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Jr Product'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Jr Product'), array('action' => 'edit', $jrProduct['JrProduct']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Jr Product'), array('action' => 'delete', $jrProduct['JrProduct']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jrProduct['JrProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Jr Products'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Jr Product'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotation Products'), array('controller' => 'quotation_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation Product'), array('controller' => 'quotation_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Requests'), array('controller' => 'job_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request'), array('controller' => 'job_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($jrProduct['JrProduct']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation Product'); ?></th>
		<td>
			<?php echo $this->Html->link($jrProduct['QuotationProduct']['id'], array('controller' => 'quotation_products', 'action' => 'view', $jrProduct['QuotationProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($jrProduct['User']['id'], array('controller' => 'users', 'action' => 'view', $jrProduct['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Assigned'); ?></th>
		<td>
			<?php echo time_elapsed_string($jrProduct['JrProduct']['date_assigned']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Deadline'); ?></th>
		<td>
			<?php echo h($jrProduct['JrProduct']['deadline']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request'); ?></th>
		<td>
			<?php echo $this->Html->link($jrProduct['JobRequest']['id'], array('controller' => 'job_requests', 'action' => 'view', $jrProduct['JobRequest']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Floor Plan Details'); ?></th>
		<td>
			<?php echo h($jrProduct['JrProduct']['floor_plan_details']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($jrProduct['JrProduct']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Ongoing'); ?></th>
		<td>
			<?php echo time_elapsed_string($jrProduct['JrProduct']['date_ongoing']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Declined'); ?></th>
		<td>
			<?php echo time_elapsed_string($jrProduct['JrProduct']['date_declined']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Cancelled'); ?></th>
		<td>
			<?php echo time_elapsed_string($jrProduct['JrProduct']['date_cancelled']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo time_elapsed_string($jrProduct['JrProduct']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo time_elapsed_string($jrProduct['JrProduct']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Finished'); ?></th>
		<td>
			<?php echo time_elapsed_string($jrProduct['JrProduct']['date_finished']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
		</div>
		</div><!-- end col md 9 -->

	</div>
</div>

