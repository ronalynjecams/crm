<div class="transactionSources index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Transaction Sources'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Transaction Source'), array('action' => 'add'), array('escape' => false)); ?></li>
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
						<th><?php echo $this->Paginator->sort('reference_num'); ?></th>
						<th><?php echo $this->Paginator->sort('reference_type'); ?></th>
						<th><?php echo $this->Paginator->sort('mode'); ?></th>
						<th><?php echo $this->Paginator->sort('mode_num'); ?></th>
						<th><?php echo $this->Paginator->sort('product_combo_id'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($transactionSources as $transactionSource): ?>
					<tr>
						<td><?php echo h($transactionSource['TransactionSource']['id']); ?>&nbsp;</td>
						<td><?php echo h($transactionSource['TransactionSource']['reference_num']); ?>&nbsp;</td>
						<td><?php echo h($transactionSource['TransactionSource']['reference_type']); ?>&nbsp;</td>
						<td><?php echo h($transactionSource['TransactionSource']['mode']); ?>&nbsp;</td>
						<td><?php echo h($transactionSource['TransactionSource']['mode_num']); ?>&nbsp;</td>
						<td><?php echo h($transactionSource['TransactionSource']['product_combo_id']); ?>&nbsp;</td>
						<td><?php echo time_elapsed_string($transactionSource['TransactionSource']['created']); ?>&nbsp;</td>
						<td><?php echo time_elapsed_string($transactionSource['TransactionSource']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $transactionSource['TransactionSource']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $transactionSource['TransactionSource']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $transactionSource['TransactionSource']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $transactionSource['TransactionSource']['id'])); ?>
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