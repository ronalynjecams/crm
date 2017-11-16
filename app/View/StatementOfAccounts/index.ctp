<div class="statementOfAccounts index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Statement Of Accounts'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Statement Of Account'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('soa_number'); ?></th>
						<th><?php echo $this->Paginator->sort('quotation_id'); ?></th>
						<th><?php echo $this->Paginator->sort('contract_amount'); ?></th>
						<th><?php echo $this->Paginator->sort('collected_amount'); ?></th>
						<th><?php echo $this->Paginator->sort('with_held_amount'); ?></th>
						<th><?php echo $this->Paginator->sort('balance'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($statementOfAccounts as $statementOfAccount): ?>
					<tr>
						<td><?php echo h($statementOfAccount['StatementOfAccount']['id']); ?>&nbsp;</td>
						<td><?php echo h($statementOfAccount['StatementOfAccount']['soa_number']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($statementOfAccount['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $statementOfAccount['Quotation']['id'])); ?>
		</td>
						<td><?php echo h($statementOfAccount['StatementOfAccount']['contract_amount']); ?>&nbsp;</td>
						<td><?php echo h($statementOfAccount['StatementOfAccount']['collected_amount']); ?>&nbsp;</td>
						<td><?php echo h($statementOfAccount['StatementOfAccount']['with_held_amount']); ?>&nbsp;</td>
						<td><?php echo h($statementOfAccount['StatementOfAccount']['balance']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($statementOfAccount['User']['id'], array('controller' => 'users', 'action' => 'view', $statementOfAccount['User']['id'])); ?>
		</td>
						<td><?php echo h($statementOfAccount['StatementOfAccount']['created']); ?>&nbsp;</td>
						<td><?php echo h($statementOfAccount['StatementOfAccount']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $statementOfAccount['StatementOfAccount']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $statementOfAccount['StatementOfAccount']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $statementOfAccount['StatementOfAccount']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $statementOfAccount['StatementOfAccount']['id'])); ?>
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