<div class="clientServiceProperties view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Client Service Property'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Client Service Property'), array('action' => 'edit', $clientServiceProperty['ClientServiceProperty']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Client Service Property'), array('action' => 'delete', $clientServiceProperty['ClientServiceProperty']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $clientServiceProperty['ClientServiceProperty']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Client Service Properties'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client Service Property'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Client Service Products'), array('controller' => 'client_service_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client Service Product'), array('controller' => 'client_service_products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($clientServiceProperty['ClientServiceProperty']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Client Service Product'); ?></th>
		<td>
			<?php echo $this->Html->link($clientServiceProperty['ClientServiceProduct']['id'], array('controller' => 'client_service_products', 'action' => 'view', $clientServiceProperty['ClientServiceProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Property'); ?></th>
		<td>
			<?php echo h($clientServiceProperty['ClientServiceProperty']['property']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Value'); ?></th>
		<td>
			<?php echo h($clientServiceProperty['ClientServiceProperty']['value']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($clientServiceProperty['ClientServiceProperty']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($clientServiceProperty['ClientServiceProperty']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>	
		</div>
		</div><!-- end col md 9 -->

	</div>
</div>

