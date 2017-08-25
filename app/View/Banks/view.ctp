<div class="banks view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Bank'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Bank'), array('action' => 'edit', $bank['Bank']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Bank'), array('action' => 'delete', $bank['Bank']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $bank['Bank']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Banks'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Bank'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Collections'), array('controller' => 'collections', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Collection'), array('controller' => 'collections', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($bank['Bank']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($bank['Bank']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Display Name'); ?></th>
		<td>
			<?php echo h($bank['Bank']['display_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($bank['Bank']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($bank['Bank']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Collections'); ?></h3>
	<?php if (!empty($bank['Collection'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Quotation Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Bank Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Amount Paid'); ?></th>
		<th><?php echo __('With Held'); ?></th>
		<th><?php echo __('Payment Mode'); ?></th>
		<th><?php echo __('Check Number'); ?></th>
		<th><?php echo __('Check Date'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Date Deleted'); ?></th>
		<th><?php echo __('Date Updated'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Date Completed'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($bank['Collection'] as $collection): ?>
		<tr>
			<td><?php echo $collection['id']; ?></td>
			<td><?php echo $collection['quotation_id']; ?></td>
			<td><?php echo $collection['user_id']; ?></td>
			<td><?php echo $collection['bank_id']; ?></td>
			<td><?php echo $collection['type']; ?></td>
			<td><?php echo $collection['amount_paid']; ?></td>
			<td><?php echo $collection['with_held']; ?></td>
			<td><?php echo $collection['payment_mode']; ?></td>
			<td><?php echo $collection['check_number']; ?></td>
			<td><?php echo $collection['check_date']; ?></td>
			<td><?php echo $collection['status']; ?></td>
			<td><?php echo $collection['date_deleted']; ?></td>
			<td><?php echo $collection['date_updated']; ?></td>
			<td><?php echo $collection['created']; ?></td>
			<td><?php echo $collection['modified']; ?></td>
			<td><?php echo $collection['date_completed']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'collections', 'action' => 'view', $collection['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'collections', 'action' => 'edit', $collection['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'collections', 'action' => 'delete', $collection['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $collection['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Collection'), array('controller' => 'collections', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
