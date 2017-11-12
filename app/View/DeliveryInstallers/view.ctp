<div class="deliveryInstallers view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Delivery Installer'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Delivery Installer'), array('action' => 'edit', $deliveryInstaller['DeliveryInstaller']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Delivery Installer'), array('action' => 'delete', $deliveryInstaller['DeliveryInstaller']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $deliveryInstaller['DeliveryInstaller']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Delivery Installers'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Delivery Installer'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Delivery Iteneraries'), array('controller' => 'delivery_iteneraries', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Delivery Itenerary'), array('controller' => 'delivery_iteneraries', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($deliveryInstaller['DeliveryInstaller']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Delivery Itenerary'); ?></th>
		<td>
			<?php echo $this->Html->link($deliveryInstaller['DeliveryItenerary']['id'], array('controller' => 'delivery_iteneraries', 'action' => 'view', $deliveryInstaller['DeliveryItenerary']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($deliveryInstaller['User']['id'], array('controller' => 'users', 'action' => 'view', $deliveryInstaller['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($deliveryInstaller['DeliveryInstaller']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($deliveryInstaller['DeliveryInstaller']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
		</div>
		</div><!-- end col md 9 -->

	</div>
</div>

