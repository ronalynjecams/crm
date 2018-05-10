<div class="prodInvLocationProperties view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Prod Inv Location Property'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Prod Inv Location Property'), array('action' => 'edit', $prodInvLocationProperty['ProdInvLocationProperty']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Prod Inv Location Property'), array('action' => 'delete', $prodInvLocationProperty['ProdInvLocationProperty']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $prodInvLocationProperty['ProdInvLocationProperty']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Prod Inv Location Properties'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Prod Inv Location Property'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Prod Inv Locations'), array('controller' => 'prod_inv_locations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Prod Inv Location'), array('controller' => 'prod_inv_locations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Prod Inv Conditions'), array('controller' => 'prod_inv_conditions', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Prod Inv Condition'), array('controller' => 'prod_inv_conditions', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($prodInvLocationProperty['ProdInvLocationProperty']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Prod Inv Location'); ?></th>
		<td>
			<?php echo $this->Html->link($prodInvLocationProperty['ProdInvLocation']['id'], array('controller' => 'prod_inv_locations', 'action' => 'view', $prodInvLocationProperty['ProdInvLocation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($prodInvLocationProperty['ProdInvLocationProperty']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Property'); ?></th>
		<td>
			<?php echo h($prodInvLocationProperty['ProdInvLocationProperty']['property']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Value'); ?></th>
		<td>
			<?php echo h($prodInvLocationProperty['ProdInvLocationProperty']['value']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo time_elapsed_string($prodInvLocationProperty['ProdInvLocationProperty']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo time_elapsed_string($prodInvLocationProperty['ProdInvLocationProperty']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
			</div>
		</div><!-- end col md 9 -->

	</div>
</div>

<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Prod Inv Conditions'); ?></h3>
	<?php if (!empty($prodInvLocationProperty['ProdInvCondition'])): ?>
	<div class="table-responsive">
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Prod Inv Location Property Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Conditions'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($prodInvLocationProperty['ProdInvCondition'] as $prodInvCondition): ?>
		<tr>
			<td><?php echo $prodInvCondition['id']; ?></td>
			<td><?php echo $prodInvCondition['prod_inv_location_property_id']; ?></td>
			<td><?php echo $prodInvCondition['product_id']; ?></td>
			<td><?php echo $prodInvCondition['qty']; ?></td>
			<td><?php echo $prodInvCondition['conditions']; ?></td>
			<td><?php echo time_elapsed_string($prodInvCondition['created']); ?></td>
			<td><?php echo time_elapsed_string($prodInvCondition['modified']); ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'prod_inv_conditions', 'action' => 'view', $prodInvCondition['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'prod_inv_conditions', 'action' => 'edit', $prodInvCondition['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'prod_inv_conditions', 'action' => 'delete', $prodInvCondition['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $prodInvCondition['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</div>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Prod Inv Condition'), array('controller' => 'prod_inv_conditions', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
