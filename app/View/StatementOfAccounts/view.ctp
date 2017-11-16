<div class="statementOfAccounts view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Statement Of Account'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Statement Of Account'), array('action' => 'edit', $statementOfAccount['StatementOfAccount']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Statement Of Account'), array('action' => 'delete', $statementOfAccount['StatementOfAccount']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $statementOfAccount['StatementOfAccount']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Statement Of Accounts'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Statement Of Account'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">	
		<div class="table-responsive">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($statementOfAccount['StatementOfAccount']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Soa Number'); ?></th>
		<td>
			<?php echo h($statementOfAccount['StatementOfAccount']['soa_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation'); ?></th>
		<td>
			<?php echo $this->Html->link($statementOfAccount['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $statementOfAccount['Quotation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Contract Amount'); ?></th>
		<td>
			<?php echo h($statementOfAccount['StatementOfAccount']['contract_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Collected Amount'); ?></th>
		<td>
			<?php echo h($statementOfAccount['StatementOfAccount']['collected_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('With Held Amount'); ?></th>
		<td>
			<?php echo h($statementOfAccount['StatementOfAccount']['with_held_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Balance'); ?></th>
		<td>
			<?php echo h($statementOfAccount['StatementOfAccount']['balance']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($statementOfAccount['User']['id'], array('controller' => 'users', 'action' => 'view', $statementOfAccount['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($statementOfAccount['StatementOfAccount']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($statementOfAccount['StatementOfAccount']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
		</div>
		</div><!-- end col md 9 -->

	</div>
</div>

