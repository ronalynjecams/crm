<div class="collectionPapers index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Collection Papers'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Collection Paper'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Accounting Papers'), array('controller' => 'accounting_papers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Accounting Paper'), array('controller' => 'accounting_papers', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('ref_number'); ?></th>
						<th><?php echo $this->Paginator->sort('ref_date'); ?></th>
						<th><?php echo $this->Paginator->sort('amount'); ?></th>
						<th><?php echo $this->Paginator->sort('accounting_paper_id'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('quotation_id'); ?></th>
						<th><?php echo $this->Paginator->sort('collection_id'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($collectionPapers as $collectionPaper): ?>
					<tr>
						<td><?php echo h($collectionPaper['CollectionPaper']['id']); ?>&nbsp;</td>
						<td><?php echo h($collectionPaper['CollectionPaper']['ref_number']); ?>&nbsp;</td>
						<td><?php echo h($collectionPaper['CollectionPaper']['ref_date']); ?>&nbsp;</td>
						<td><?php echo h($collectionPaper['CollectionPaper']['amount']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($collectionPaper['AccountingPaper']['name'], array('controller' => 'accounting_papers', 'action' => 'view', $collectionPaper['AccountingPaper']['id'])); ?>
		</td>
						<td><?php echo h($collectionPaper['CollectionPaper']['status']); ?>&nbsp;</td>
						<td><?php echo h($collectionPaper['CollectionPaper']['created']); ?>&nbsp;</td>
						<td><?php echo h($collectionPaper['CollectionPaper']['modified']); ?>&nbsp;</td>
						<td><?php echo h($collectionPaper['CollectionPaper']['user_id']); ?>&nbsp;</td>
						<td><?php echo h($collectionPaper['CollectionPaper']['quotation_id']); ?>&nbsp;</td>
						<td><?php echo h($collectionPaper['CollectionPaper']['collection_id']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $collectionPaper['CollectionPaper']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $collectionPaper['CollectionPaper']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $collectionPaper['CollectionPaper']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $collectionPaper['CollectionPaper']['id'])); ?>
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