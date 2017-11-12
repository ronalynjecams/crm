<div class="poProducts view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Po Product'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Po Product'), array('action' => 'edit', $poProduct['PoProduct']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Po Product'), array('action' => 'delete', $poProduct['PoProduct']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $poProduct['PoProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Po Products'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Po Product'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Purchase Orders'), array('controller' => 'purchase_orders', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Purchase Order'), array('controller' => 'purchase_orders', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Po Product Properties'), array('controller' => 'po_product_properties', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Po Product Property'), array('controller' => 'po_product_properties', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($poProduct['PoProduct']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product'); ?></th>
		<td>
			<?php echo $this->Html->link($poProduct['Product']['name'], array('controller' => 'products', 'action' => 'view', $poProduct['Product']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Purchase Order'); ?></th>
		<td>
			<?php echo $this->Html->link($poProduct['PurchaseOrder']['id'], array('controller' => 'purchase_orders', 'action' => 'view', $poProduct['PurchaseOrder']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Price'); ?></th>
		<td>
			<?php echo h($poProduct['PoProduct']['price']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($poProduct['PoProduct']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($poProduct['PoProduct']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($poProduct['PoProduct']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation Product Id'); ?></th>
		<td>
			<?php echo h($poProduct['PoProduct']['quotation_product_id']); ?>
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
	<h3><?php echo __('Related Po Product Properties'); ?></h3>
	<?php if (!empty($poProduct['PoProductProperty'])): ?>
	<div class="table-responsive">
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Po Product Id'); ?></th>
		<th><?php echo __('Property'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($poProduct['PoProductProperty'] as $poProductProperty): ?>
		<tr>
			<td><?php echo $poProductProperty['id']; ?></td>
			<td><?php echo $poProductProperty['po_product_id']; ?></td>
			<td><?php echo $poProductProperty['property']; ?></td>
			<td><?php echo $poProductProperty['value']; ?></td>
			<td><?php echo $poProductProperty['created']; ?></td>
			<td><?php echo $poProductProperty['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'po_product_properties', 'action' => 'view', $poProductProperty['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'po_product_properties', 'action' => 'edit', $poProductProperty['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'po_product_properties', 'action' => 'delete', $poProductProperty['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $poProductProperty['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</div>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Po Product Property'), array('controller' => 'po_product_properties', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
