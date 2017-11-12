<div class="poProductProperties view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Po Product Property'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Po Product Property'), array('action' => 'edit', $poProductProperty['PoProductProperty']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Po Product Property'), array('action' => 'delete', $poProductProperty['PoProductProperty']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $poProductProperty['PoProductProperty']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Po Product Properties'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Po Product Property'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Po Products'), array('controller' => 'po_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Po Product'), array('controller' => 'po_products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($poProductProperty['PoProductProperty']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Po Product'); ?></th>
		<td>
			<?php echo $this->Html->link($poProductProperty['PoProduct']['id'], array('controller' => 'po_products', 'action' => 'view', $poProductProperty['PoProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Property'); ?></th>
		<td>
			<?php echo h($poProductProperty['PoProductProperty']['property']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Value'); ?></th>
		<td>
			<?php echo h($poProductProperty['PoProductProperty']['value']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($poProductProperty['PoProductProperty']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($poProductProperty['PoProductProperty']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
			</div>
		</div><!-- end col md 9 -->

	</div>
</div>

