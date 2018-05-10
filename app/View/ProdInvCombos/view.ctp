<div class="prodInvCombos view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Prod Inv Combo'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Prod Inv Combo'), array('action' => 'edit', $prodInvCombo['ProdInvCombo']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Prod Inv Combo'), array('action' => 'delete', $prodInvCombo['ProdInvCombo']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $prodInvCombo['ProdInvCombo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Prod Inv Combos'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Prod Inv Combo'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Prod Inv Locations'), array('controller' => 'prod_inv_locations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Prod Inv Location'), array('controller' => 'prod_inv_locations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Prod Inv Location Properties'), array('controller' => 'prod_inv_location_properties', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Prod Inv Location Property'), array('controller' => 'prod_inv_location_properties', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($prodInvCombo['ProdInvCombo']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Prod Inv Location'); ?></th>
		<td>
			<?php echo $this->Html->link($prodInvCombo['ProdInvLocation']['id'], array('controller' => 'prod_inv_locations', 'action' => 'view', $prodInvCombo['ProdInvLocation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($prodInvCombo['ProdInvCombo']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($prodInvCombo['ProdInvCombo']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($prodInvCombo['ProdInvCombo']['modified']); ?>
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
	<h3><?php echo __('Related Prod Inv Location Properties'); ?></h3>
	<?php if (!empty($prodInvCombo['ProdInvLocationProperty'])): ?>
	<div class="table-responsive">
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Prod Inv Location Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Property'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Prod Inv Combo Id'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($prodInvCombo['ProdInvLocationProperty'] as $prodInvLocationProperty): ?>
		<tr>
			<td><?php echo $prodInvLocationProperty['id']; ?></td>
			<td><?php echo $prodInvLocationProperty['prod_inv_location_id']; ?></td>
			<td><?php echo $prodInvLocationProperty['qty']; ?></td>
			<td><?php echo $prodInvLocationProperty['property']; ?></td>
			<td><?php echo $prodInvLocationProperty['value']; ?></td>
			<td><?php echo time_elapsed_string($prodInvLocationProperty['created']); ?></td>
			<td><?php echo time_elapsed_string($prodInvLocationProperty['modified']); ?></td>
			<td><?php echo $prodInvLocationProperty['prod_inv_combo_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'prod_inv_location_properties', 'action' => 'view', $prodInvLocationProperty['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'prod_inv_location_properties', 'action' => 'edit', $prodInvLocationProperty['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'prod_inv_location_properties', 'action' => 'delete', $prodInvLocationProperty['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $prodInvLocationProperty['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</div>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Prod Inv Location Property'), array('controller' => 'prod_inv_location_properties', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
