<div class="jrProducts index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Jr Products'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Jr Product'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotation Products'), array('controller' => 'quotation_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation Product'), array('controller' => 'quotation_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Requests'), array('controller' => 'job_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request'), array('controller' => 'job_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('date_assigned'); ?></th>
						<th><?php echo $this->Paginator->sort('deadline'); ?></th>
						<th><?php echo $this->Paginator->sort('job_request_id'); ?></th>
						<th><?php echo $this->Paginator->sort('floor_plan_details'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('date_ongoing'); ?></th>
						<th><?php echo $this->Paginator->sort('date_declined'); ?></th>
						<th><?php echo $this->Paginator->sort('date_cancelled'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th><?php echo $this->Paginator->sort('date_finished'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($jrProducts as $jrProduct): ?>
					<tr>
						<td><?php echo h($jrProduct['JrProduct']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($jrProduct['QuotationProduct']['id'], array('controller' => 'quotation_products', 'action' => 'view', $jrProduct['QuotationProduct']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($jrProduct['User']['id'], array('controller' => 'users', 'action' => 'view', $jrProduct['User']['id'])); ?>
		</td>
						<td><?php echo h($jrProduct['JrProduct']['date_assigned']); ?>&nbsp;</td>
						<td><?php echo h($jrProduct['JrProduct']['deadline']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($jrProduct['JobRequest']['id'], array('controller' => 'job_requests', 'action' => 'view', $jrProduct['JobRequest']['id'])); ?>
		</td>
						<td><?php echo h($jrProduct['JrProduct']['floor_plan_details']); ?>&nbsp;</td>
						<td><?php echo h($jrProduct['JrProduct']['status']); ?>&nbsp;</td>
						<td><?php echo h($jrProduct['JrProduct']['date_ongoing']); ?>&nbsp;</td>
						<td><?php echo h($jrProduct['JrProduct']['date_declined']); ?>&nbsp;</td>
						<td><?php echo h($jrProduct['JrProduct']['date_cancelled']); ?>&nbsp;</td>
						<td><?php echo h($jrProduct['JrProduct']['created']); ?>&nbsp;</td>
						<td><?php echo h($jrProduct['JrProduct']['modified']); ?>&nbsp;</td>
						<td><?php echo h($jrProduct['JrProduct']['date_finished']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $jrProduct['JrProduct']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $jrProduct['JrProduct']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $jrProduct['JrProduct']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jrProduct['JrProduct']['id'])); ?>
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