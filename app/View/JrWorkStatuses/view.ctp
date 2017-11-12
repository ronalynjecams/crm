<div class="jrWorkStatuses view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Jr Work Status'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Jr Work Status'), array('action' => 'edit', $jrWorkStatus['JrWorkStatus']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Jr Work Status'), array('action' => 'delete', $jrWorkStatus['JrWorkStatus']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jrWorkStatus['JrWorkStatus']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Jr Work Statuses'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Jr Work Status'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Jr Products'), array('controller' => 'jr_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Jr Product'), array('controller' => 'jr_products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($jrWorkStatus['JrWorkStatus']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($jrWorkStatus['JrWorkStatus']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Minutes'); ?></th>
		<td>
			<?php echo h($jrWorkStatus['JrWorkStatus']['minutes']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($jrWorkStatus['JrWorkStatus']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($jrWorkStatus['JrWorkStatus']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Jr Product'); ?></th>
		<td>
			<?php echo $this->Html->link($jrWorkStatus['JrProduct']['id'], array('controller' => 'jr_products', 'action' => 'view', $jrWorkStatus['JrProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
			</div>
		</div><!-- end col md 9 -->

	</div>
</div>

