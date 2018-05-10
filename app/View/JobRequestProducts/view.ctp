<div class="jobRequestProducts view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Job Request Product'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Job Request Product'), array('action' => 'edit', $jobRequestProduct['JobRequestProduct']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Job Request Product'), array('action' => 'delete', $jobRequestProduct['JobRequestProduct']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jobRequestProduct['JobRequestProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Products'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Product'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotation Products'), array('controller' => 'quotation_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation Product'), array('controller' => 'quotation_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Requests'), array('controller' => 'job_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request'), array('controller' => 'job_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Request Types'), array('controller' => 'job_request_types', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request Type'), array('controller' => 'job_request_types', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Po Raw Requests'), array('controller' => 'po_raw_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Po Raw Request'), array('controller' => 'po_raw_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($jobRequestProduct['JobRequestProduct']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation Product'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestProduct['QuotationProduct']['id'], array('controller' => 'quotation_products', 'action' => 'view', $jobRequestProduct['QuotationProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestProduct['User']['id'], array('controller' => 'users', 'action' => 'view', $jobRequestProduct['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Client'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestProduct['Client']['name'], array('controller' => 'clients', 'action' => 'view', $jobRequestProduct['Client']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestProduct['JobRequest']['id'], array('controller' => 'job_requests', 'action' => 'view', $jobRequestProduct['JobRequest']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Prs'); ?></th>
		<td>
			<?php echo h($jobRequestProduct['JobRequestProduct']['date_prs']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Deadline Date'); ?></th>
		<td>
			<?php echo h($jobRequestProduct['JobRequestProduct']['deadline_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Accomplished'); ?></th>
		<td>
			<?php echo h($jobRequestProduct['JobRequestProduct']['date_accomplished']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request Type'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestProduct['JobRequestType']['name'], array('controller' => 'job_request_types', 'action' => 'view', $jobRequestProduct['JobRequestType']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Po Raw Request'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestProduct['PoRawRequest']['id'], array('controller' => 'po_raw_requests', 'action' => 'view', $jobRequestProduct['PoRawRequest']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($jobRequestProduct['JobRequestProduct']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestProduct['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $jobRequestProduct['Quotation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Image'); ?></th>
		<td>
			<?php echo h($jobRequestProduct['JobRequestProduct']['image']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Received Production'); ?></th>
		<td>
			<?php echo h($jobRequestProduct['JobRequestProduct']['date_received_production']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Forwarded Production'); ?></th>
		<td>
			<?php echo h($jobRequestProduct['JobRequestProduct']['date_forwarded_production']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Deleted'); ?></th>
		<td>
			<?php echo h($jobRequestProduct['JobRequestProduct']['date_deleted']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product'); ?></th>
		<td>
			<?php echo $this->Html->link($jobRequestProduct['Product']['name'], array('controller' => 'products', 'action' => 'view', $jobRequestProduct['Product']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($jobRequestProduct['JobRequestProduct']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($jobRequestProduct['JobRequestProduct']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

