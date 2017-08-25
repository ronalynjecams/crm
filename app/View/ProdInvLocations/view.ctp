<div class="prodInvLocations view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Prod Inv Location'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Prod Inv Location'), array('action' => 'edit', $prodInvLocation['ProdInvLocation']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Prod Inv Location'), array('action' => 'delete', $prodInvLocation['ProdInvLocation']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $prodInvLocation['ProdInvLocation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Prod Inv Locations'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Prod Inv Location'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inv Locations'), array('controller' => 'inv_locations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inv Location'), array('controller' => 'inv_locations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Sources'), array('controller' => 'product_sources', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Source'), array('controller' => 'product_sources', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($prodInvLocation['ProdInvLocation']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Inv Location'); ?></th>
		<td>
			<?php echo $this->Html->link($prodInvLocation['InvLocation']['name'], array('controller' => 'inv_locations', 'action' => 'view', $prodInvLocation['InvLocation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product'); ?></th>
		<td>
			<?php echo $this->Html->link($prodInvLocation['Product']['name'], array('controller' => 'products', 'action' => 'view', $prodInvLocation['Product']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($prodInvLocation['ProdInvLocation']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($prodInvLocation['ProdInvLocation']['modified']); ?>
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
	<h3><?php echo __('Related Product Sources'); ?></h3>
	<?php if (!empty($prodInvLocation['ProductSource'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Quotation Product Id'); ?></th>
		<th><?php echo __('Qty'); ?></th>
		<th><?php echo __('Source'); ?></th>
		<th><?php echo __('Quotation Id'); ?></th>
		<th><?php echo __('Purchase Order Id'); ?></th>
		<th><?php echo __('Prod Inv Location Id'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($prodInvLocation['ProductSource'] as $productSource): ?>
		<tr>
			<td><?php echo $productSource['id']; ?></td>
			<td><?php echo $productSource['quotation_product_id']; ?></td>
			<td><?php echo $productSource['qty']; ?></td>
			<td><?php echo $productSource['source']; ?></td>
			<td><?php echo $productSource['quotation_id']; ?></td>
			<td><?php echo $productSource['purchase_order_id']; ?></td>
			<td><?php echo $productSource['prod_inv_location_id']; ?></td>
			<td><?php echo $productSource['status']; ?></td>
			<td><?php echo $productSource['created']; ?></td>
			<td><?php echo $productSource['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'product_sources', 'action' => 'view', $productSource['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'product_sources', 'action' => 'edit', $productSource['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'product_sources', 'action' => 'delete', $productSource['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $productSource['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product Source'), array('controller' => 'product_sources', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
