<div class="prodInvConditions view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Prod Inv Condition'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Prod Inv Condition'), array('action' => 'edit', $prodInvCondition['ProdInvCondition']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Prod Inv Condition'), array('action' => 'delete', $prodInvCondition['ProdInvCondition']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $prodInvCondition['ProdInvCondition']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Prod Inv Conditions'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Prod Inv Condition'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Prod Inv Location Properties'), array('controller' => 'prod_inv_location_properties', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Prod Inv Location Property'), array('controller' => 'prod_inv_location_properties', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($prodInvCondition['ProdInvCondition']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Prod Inv Location Property'); ?></th>
		<td>
			<?php echo $this->Html->link($prodInvCondition['ProdInvLocationProperty']['id'], array('controller' => 'prod_inv_location_properties', 'action' => 'view', $prodInvCondition['ProdInvLocationProperty']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product'); ?></th>
		<td>
			<?php echo $this->Html->link($prodInvCondition['Product']['name'], array('controller' => 'products', 'action' => 'view', $prodInvCondition['Product']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($prodInvCondition['ProdInvCondition']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Conditions'); ?></th>
		<td>
			<?php echo h($prodInvCondition['ProdInvCondition']['conditions']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($prodInvCondition['ProdInvCondition']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($prodInvCondition['ProdInvCondition']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

