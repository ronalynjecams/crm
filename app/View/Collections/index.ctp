<div class="collections index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Collections'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Collection'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Banks'), array('controller' => 'banks', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Bank'), array('controller' => 'banks', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Collection Schedules'), array('controller' => 'collection_schedules', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Collection Schedule'), array('controller' => 'collection_schedules', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<div class="table-responsive">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('quotation_id'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('bank_id'); ?></th>
						<th><?php echo $this->Paginator->sort('type'); ?></th>
						<th><?php echo $this->Paginator->sort('amount_paid'); ?></th>
						<th><?php echo $this->Paginator->sort('with_held'); ?></th>
						<th><?php echo $this->Paginator->sort('payment_mode'); ?></th>
						<th><?php echo $this->Paginator->sort('check_number'); ?></th>
						<th><?php echo $this->Paginator->sort('check_date'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('date_deleted'); ?></th>
						<th><?php echo $this->Paginator->sort('date_updated'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th><?php echo $this->Paginator->sort('date_completed'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($collections as $collection): ?>
					<tr>
						<td><?php echo h($collection['Collection']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($collection['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $collection['Quotation']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($collection['User']['id'], array('controller' => 'users', 'action' => 'view', $collection['User']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($collection['Bank']['name'], array('controller' => 'banks', 'action' => 'view', $collection['Bank']['id'])); ?>
		</td>
						<td><?php echo h($collection['Collection']['type']); ?>&nbsp;</td>
						<td><?php echo h($collection['Collection']['amount_paid']); ?>&nbsp;</td>
						<td><?php echo h($collection['Collection']['with_held']); ?>&nbsp;</td>
						<td><?php echo h($collection['Collection']['payment_mode']); ?>&nbsp;</td>
						<td><?php echo h($collection['Collection']['check_number']); ?>&nbsp;</td>
						<td><?php echo h($collection['Collection']['check_date']); ?>&nbsp;</td>
						<td><?php echo h($collection['Collection']['status']); ?>&nbsp;</td>
						<td><?php echo h($collection['Collection']['date_deleted']); ?>&nbsp;</td>
						<td><?php echo h($collection['Collection']['date_updated']); ?>&nbsp;</td>
						<td><?php echo h($collection['Collection']['created']); ?>&nbsp;</td>
						<td><?php echo h($collection['Collection']['modified']); ?>&nbsp;</td>
						<td><?php echo h($collection['Collection']['date_completed']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $collection['Collection']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $collection['Collection']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $collection['Collection']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $collection['Collection']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			</div>
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