<div class="productionSections view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Production Section'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Production Section'), array('action' => 'edit', $productionSection['ProductionSection']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Production Section'), array('action' => 'delete', $productionSection['ProductionSection']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productionSection['ProductionSection']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Production Sections'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Production Section'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Production Processes'), array('controller' => 'production_processes', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Production Process'), array('controller' => 'production_processes', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($productionSection['ProductionSection']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($productionSection['ProductionSection']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($productionSection['User']['id'], array('controller' => 'users', 'action' => 'view', $productionSection['User']['id'])); ?>
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
	<h3><?php echo __('Related Production Processes'); ?></h3>
	<?php if (!empty($productionSection['ProductionProcess'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Production Id'); ?></th>
		<th><?php echo __('Production Section Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Start Work'); ?></th>
		<th><?php echo __('End Work'); ?></th>
		<th><?php echo __('Expected Start'); ?></th>
		<th><?php echo __('Expected End'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Total Qty Assigned'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($productionSection['ProductionProcess'] as $productionProcess): ?>
		<tr>
			<td><?php echo $productionProcess['id']; ?></td>
			<td><?php echo $productionProcess['production_id']; ?></td>
			<td><?php echo $productionProcess['production_section_id']; ?></td>
			<td><?php echo $productionProcess['user_id']; ?></td>
			<td><?php echo time_elapsed_string($productionProcess['start_work']); ?></td>
			<td><?php echo time_elapsed_string($productionProcess['end_work']); ?></td>
			<td><?php echo $productionProcess['expected_start']; ?></td>
			<td><?php echo $productionProcess['expected_end']; ?></td>
			<td><?php echo $productionProcess['status']; ?></td>
			<td><?php echo $productionProcess['total_qty_assigned']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'production_processes', 'action' => 'view', $productionProcess['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'production_processes', 'action' => 'edit', $productionProcess['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'production_processes', 'action' => 'delete', $productionProcess['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productionProcess['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Production Process'), array('controller' => 'production_processes', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
