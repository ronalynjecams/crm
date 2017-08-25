<div class="collectionSchedules index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Collection Schedules'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Collection Schedule'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Collections'), array('controller' => 'collections', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Collection'), array('controller' => 'collections', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('quotation_id'); ?></th>
						<th><?php echo $this->Paginator->sort('collection_id'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('created_by'); ?></th>
						<th><?php echo $this->Paginator->sort('onhand'); ?></th>
						<th><?php echo $this->Paginator->sort('officer_remarks'); ?></th>
						<th><?php echo $this->Paginator->sort('agent_instruction'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($collectionSchedules as $collectionSchedule): ?>
					<tr>
						<td><?php echo h($collectionSchedule['CollectionSchedule']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($collectionSchedule['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $collectionSchedule['Quotation']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($collectionSchedule['Collection']['id'], array('controller' => 'collections', 'action' => 'view', $collectionSchedule['Collection']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($collectionSchedule['User']['id'], array('controller' => 'users', 'action' => 'view', $collectionSchedule['User']['id'])); ?>
		</td>
						<td><?php echo h($collectionSchedule['CollectionSchedule']['created_by']); ?>&nbsp;</td>
						<td><?php echo h($collectionSchedule['CollectionSchedule']['onhand']); ?>&nbsp;</td>
						<td><?php echo h($collectionSchedule['CollectionSchedule']['officer_remarks']); ?>&nbsp;</td>
						<td><?php echo h($collectionSchedule['CollectionSchedule']['agent_instruction']); ?>&nbsp;</td>
						<td><?php echo h($collectionSchedule['CollectionSchedule']['created']); ?>&nbsp;</td>
						<td><?php echo h($collectionSchedule['CollectionSchedule']['modified']); ?>&nbsp;</td>
						<td><?php echo h($collectionSchedule['CollectionSchedule']['status']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $collectionSchedule['CollectionSchedule']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $collectionSchedule['CollectionSchedule']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $collectionSchedule['CollectionSchedule']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $collectionSchedule['CollectionSchedule']['id'])); ?>
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