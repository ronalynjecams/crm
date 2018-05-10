<div class="deliveryPapers index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Delivery Papers'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Delivery Paper'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Delivery Schedules'), array('controller' => 'delivery_schedules', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Delivery Schedule'), array('controller' => 'delivery_schedules', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('dr_paper_id'); ?></th>
						<th><?php echo $this->Paginator->sort('quotation_id'); ?></th>
						<th><?php echo $this->Paginator->sort('date_needed'); ?></th>
						<th><?php echo $this->Paginator->sort('date_acquired'); ?></th>
						<th><?php echo $this->Paginator->sort('date_processed'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($deliveryPapers as $deliveryPaper): ?>
					<tr>
						<td><?php echo h($deliveryPaper['DeliveryPaper']['id']); ?>&nbsp;</td>
						<td><?php echo h($deliveryPaper['DeliveryPaper']['dr_paper_id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($deliveryPaper['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $deliveryPaper['Quotation']['id'])); ?>
		</td>
						<td><?php echo h($deliveryPaper['DeliveryPaper']['date_needed']); ?>&nbsp;</td>
						<td><?php echo time_elapsed_string($deliveryPaper['DeliveryPaper']['date_acquired']); ?>&nbsp;</td>
						<td><?php echo time_elapsed_string($deliveryPaper['DeliveryPaper']['date_processed']); ?>&nbsp;</td>
						<td><?php echo h($deliveryPaper['DeliveryPaper']['status']); ?>&nbsp;</td>
						<td><?php echo time_elapsed_string($deliveryPaper['DeliveryPaper']['created']); ?>&nbsp;</td>
						<td><?php echo time_elapsed_string($deliveryPaper['DeliveryPaper']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $deliveryPaper['DeliveryPaper']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $deliveryPaper['DeliveryPaper']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $deliveryPaper['DeliveryPaper']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $deliveryPaper['DeliveryPaper']['id'])); ?>
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