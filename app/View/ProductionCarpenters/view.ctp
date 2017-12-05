<div class="productionCarpenters view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Production Carpenter'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Production Carpenter'), array('action' => 'edit', $productionCarpenter['ProductionCarpenter']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Production Carpenter'), array('action' => 'delete', $productionCarpenter['ProductionCarpenter']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productionCarpenter['ProductionCarpenter']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Production Carpenters'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Production Carpenter'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Production Processes'), array('controller' => 'production_processes', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Production Process'), array('controller' => 'production_processes', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Production Logs'), array('controller' => 'production_logs', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Production Log'), array('controller' => 'production_logs', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($productionCarpenter['ProductionCarpenter']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Production Process'); ?></th>
		<td>
			<?php echo $this->Html->link($productionCarpenter['ProductionProcess']['id'], array('controller' => 'production_processes', 'action' => 'view', $productionCarpenter['ProductionProcess']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($productionCarpenter['User']['id'], array('controller' => 'users', 'action' => 'view', $productionCarpenter['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty Assigned'); ?></th>
		<td>
			<?php echo h($productionCarpenter['ProductionCarpenter']['qty_assigned']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($productionCarpenter['ProductionCarpenter']['status']); ?>
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
	<h3><?php echo __('Related Production Logs'); ?></h3>
	<?php if (!empty($productionCarpenter['ProductionLog'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Production Id'); ?></th>
		<th><?php echo __('Production Process Id'); ?></th>
		<th><?php echo __('Production Carpenter Id'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($productionCarpenter['ProductionLog'] as $productionLog): ?>
		<tr>
			<td><?php echo $productionLog['id']; ?></td>
			<td><?php echo $productionLog['production_id']; ?></td>
			<td><?php echo $productionLog['production_process_id']; ?></td>
			<td><?php echo $productionLog['production_carpenter_id']; ?></td>
			<td><?php echo $productionLog['type']; ?></td>
			<td><?php echo $productionLog['status']; ?></td>
			<td><?php echo $productionLog['user_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'production_logs', 'action' => 'view', $productionLog['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'production_logs', 'action' => 'edit', $productionLog['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'production_logs', 'action' => 'delete', $productionLog['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productionLog['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Production Log'), array('controller' => 'production_logs', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
