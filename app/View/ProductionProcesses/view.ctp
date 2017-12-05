<div class="productionProcesses view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Production Process'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Production Process'), array('action' => 'edit', $productionProcess['ProductionProcess']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Production Process'), array('action' => 'delete', $productionProcess['ProductionProcess']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productionProcess['ProductionProcess']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Production Processes'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Production Process'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Productions'), array('controller' => 'productions', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Production'), array('controller' => 'productions', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Production Sections'), array('controller' => 'production_sections', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Production Section'), array('controller' => 'production_sections', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Production Carpenters'), array('controller' => 'production_carpenters', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Production Carpenter'), array('controller' => 'production_carpenters', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($productionProcess['ProductionProcess']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Production'); ?></th>
		<td>
			<?php echo $this->Html->link($productionProcess['Production']['id'], array('controller' => 'productions', 'action' => 'view', $productionProcess['Production']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Production Section'); ?></th>
		<td>
			<?php echo $this->Html->link($productionProcess['ProductionSection']['name'], array('controller' => 'production_sections', 'action' => 'view', $productionProcess['ProductionSection']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($productionProcess['User']['id'], array('controller' => 'users', 'action' => 'view', $productionProcess['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Start Work'); ?></th>
		<td>
			<?php echo h($productionProcess['ProductionProcess']['start_work']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('End Work'); ?></th>
		<td>
			<?php echo h($productionProcess['ProductionProcess']['end_work']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Expected Start'); ?></th>
		<td>
			<?php echo h($productionProcess['ProductionProcess']['expected_start']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Expected End'); ?></th>
		<td>
			<?php echo h($productionProcess['ProductionProcess']['expected_end']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($productionProcess['ProductionProcess']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Total Qty Assigned'); ?></th>
		<td>
			<?php echo h($productionProcess['ProductionProcess']['total_qty_assigned']); ?>
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
	<h3><?php echo __('Related Production Carpenters'); ?></h3>
	<?php if (!empty($productionProcess['ProductionCarpenter'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Production Process Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Qty Assigned'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($productionProcess['ProductionCarpenter'] as $productionCarpenter): ?>
		<tr>
			<td><?php echo $productionCarpenter['id']; ?></td>
			<td><?php echo $productionCarpenter['production_process_id']; ?></td>
			<td><?php echo $productionCarpenter['user_id']; ?></td>
			<td><?php echo $productionCarpenter['qty_assigned']; ?></td>
			<td><?php echo $productionCarpenter['status']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'production_carpenters', 'action' => 'view', $productionCarpenter['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'production_carpenters', 'action' => 'edit', $productionCarpenter['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'production_carpenters', 'action' => 'delete', $productionCarpenter['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productionCarpenter['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Production Carpenter'), array('controller' => 'production_carpenters', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Production Logs'); ?></h3>
	<?php if (!empty($productionProcess['ProductionLog'])): ?>
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
	<?php foreach ($productionProcess['ProductionLog'] as $productionLog): ?>
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
