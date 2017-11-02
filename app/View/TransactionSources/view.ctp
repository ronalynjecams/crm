<div class="transactionSources view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Transaction Source'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Transaction Source'), array('action' => 'edit', $transactionSource['TransactionSource']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Transaction Source'), array('action' => 'delete', $transactionSource['TransactionSource']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $transactionSource['TransactionSource']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Transaction Sources'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Transaction Source'), array('action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($transactionSource['TransactionSource']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Reference Num'); ?></th>
		<td>
			<?php echo h($transactionSource['TransactionSource']['reference_num']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Reference Type'); ?></th>
		<td>
			<?php echo h($transactionSource['TransactionSource']['reference_type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Mode'); ?></th>
		<td>
			<?php echo h($transactionSource['TransactionSource']['mode']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Mode Num'); ?></th>
		<td>
			<?php echo h($transactionSource['TransactionSource']['mode_num']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($transactionSource['TransactionSource']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($transactionSource['TransactionSource']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

