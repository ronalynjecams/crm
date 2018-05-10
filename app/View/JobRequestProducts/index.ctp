<div class="jobRequestProducts index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Job Request Products'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Product'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotation Products'), array('controller' => 'quotation_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation Product'), array('controller' => 'quotation_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Requests'), array('controller' => 'job_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request'), array('controller' => 'job_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Request Types'), array('controller' => 'job_request_types', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Type'), array('controller' => 'job_request_types', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Po Raw Requests'), array('controller' => 'po_raw_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Po Raw Request'), array('controller' => 'po_raw_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('quotation_product_id'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('client_id'); ?></th>
						<th><?php echo $this->Paginator->sort('job_request_id'); ?></th>
						<th><?php echo $this->Paginator->sort('date_prs'); ?></th>
						<th><?php echo $this->Paginator->sort('deadline_date'); ?></th>
						<th><?php echo $this->Paginator->sort('date_accomplished'); ?></th>
						<th><?php echo $this->Paginator->sort('job_request_type_id'); ?></th>
						<th><?php echo $this->Paginator->sort('po_raw_request_id'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('quotation_id'); ?></th>
						<th><?php echo $this->Paginator->sort('image'); ?></th>
						<th><?php echo $this->Paginator->sort('date_received_production'); ?></th>
						<th><?php echo $this->Paginator->sort('date_forwarded_production'); ?></th>
						<th><?php echo $this->Paginator->sort('date_deleted'); ?></th>
						<th><?php echo $this->Paginator->sort('product_id'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($jobRequestProducts as $jobRequestProduct): ?>
					<tr>
						<td><?php echo h($jobRequestProduct['JobRequestProduct']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($jobRequestProduct['QuotationProduct']['id'], array('controller' => 'quotation_products', 'action' => 'view', $jobRequestProduct['QuotationProduct']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($jobRequestProduct['User']['id'], array('controller' => 'users', 'action' => 'view', $jobRequestProduct['User']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($jobRequestProduct['Client']['name'], array('controller' => 'clients', 'action' => 'view', $jobRequestProduct['Client']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($jobRequestProduct['JobRequest']['id'], array('controller' => 'job_requests', 'action' => 'view', $jobRequestProduct['JobRequest']['id'])); ?>
		</td>
						<td><?php echo h($jobRequestProduct['JobRequestProduct']['date_prs']); ?>&nbsp;</td>
						<td><?php echo h($jobRequestProduct['JobRequestProduct']['deadline_date']); ?>&nbsp;</td>
						<td><?php echo h($jobRequestProduct['JobRequestProduct']['date_accomplished']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($jobRequestProduct['JobRequestType']['name'], array('controller' => 'job_request_types', 'action' => 'view', $jobRequestProduct['JobRequestType']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($jobRequestProduct['PoRawRequest']['id'], array('controller' => 'po_raw_requests', 'action' => 'view', $jobRequestProduct['PoRawRequest']['id'])); ?>
		</td>
						<td><?php echo h($jobRequestProduct['JobRequestProduct']['status']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($jobRequestProduct['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $jobRequestProduct['Quotation']['id'])); ?>
		</td>
						<td><?php echo h($jobRequestProduct['JobRequestProduct']['image']); ?>&nbsp;</td>
						<td><?php echo h($jobRequestProduct['JobRequestProduct']['date_received_production']); ?>&nbsp;</td>
						<td><?php echo h($jobRequestProduct['JobRequestProduct']['date_forwarded_production']); ?>&nbsp;</td>
						<td><?php echo h($jobRequestProduct['JobRequestProduct']['date_deleted']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($jobRequestProduct['Product']['name'], array('controller' => 'products', 'action' => 'view', $jobRequestProduct['Product']['id'])); ?>
		</td>
						<td><?php echo h($jobRequestProduct['JobRequestProduct']['created']); ?>&nbsp;</td>
						<td><?php echo h($jobRequestProduct['JobRequestProduct']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $jobRequestProduct['JobRequestProduct']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $jobRequestProduct['JobRequestProduct']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $jobRequestProduct['JobRequestProduct']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jobRequestProduct['JobRequestProduct']['id'])); ?>
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