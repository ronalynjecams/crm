<div class="quotationProducts view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Quotation Product'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Quotation Product'), array('action' => 'edit', $quotationProduct['QuotationProduct']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Quotation Product'), array('action' => 'delete', $quotationProduct['QuotationProduct']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $quotationProduct['QuotationProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotation Products'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation Product'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotation Product Properties'), array('controller' => 'quotation_product_properties', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation Product Property'), array('controller' => 'quotation_product_properties', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($quotationProduct['QuotationProduct']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation'); ?></th>
		<td>
			<?php echo $this->Html->link($quotationProduct['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $quotationProduct['Quotation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product'); ?></th>
		<td>
			<?php echo $this->Html->link($quotationProduct['Product']['name'], array('controller' => 'products', 'action' => 'view', $quotationProduct['Product']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Image'); ?></th>
		<td>
			<?php echo h($quotationProduct['QuotationProduct']['image']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Price'); ?></th>
		<td>
			<?php echo h($quotationProduct['QuotationProduct']['price']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($quotationProduct['QuotationProduct']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($quotationProduct['QuotationProduct']['type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Other Info'); ?></th>
		<td>
			<?php echo h($quotationProduct['QuotationProduct']['other_info']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Edited Amount'); ?></th>
		<td>
			<?php echo h($quotationProduct['QuotationProduct']['edited_amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Sale'); ?></th>
		<td>
			<?php echo h($quotationProduct['QuotationProduct']['sale']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($quotationProduct['QuotationProduct']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($quotationProduct['QuotationProduct']['modified']); ?>
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
	<h3><?php echo __('Related Quotation Product Properties'); ?></h3>
	<?php if (!empty($quotationProduct['QuotationProductProperty'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Quotation Product Id'); ?></th>
		<th><?php echo __('Property'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Product Property Id'); ?></th>
		<th><?php echo __('Product Value Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($quotationProduct['QuotationProductProperty'] as $quotationProductProperty): ?>
		<tr>
			<td><?php echo $quotationProductProperty['id']; ?></td>
			<td><?php echo $quotationProductProperty['quotation_product_id']; ?></td>
			<td><?php echo $quotationProductProperty['property']; ?></td>
			<td><?php echo $quotationProductProperty['value']; ?></td>
			<td><?php echo $quotationProductProperty['product_property_id']; ?></td>
			<td><?php echo $quotationProductProperty['product_value_id']; ?></td>
			<td><?php echo $quotationProductProperty['created']; ?></td>
			<td><?php echo $quotationProductProperty['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'quotation_product_properties', 'action' => 'view', $quotationProductProperty['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'quotation_product_properties', 'action' => 'edit', $quotationProductProperty['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'quotation_product_properties', 'action' => 'delete', $quotationProductProperty['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $quotationProductProperty['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation Product Property'), array('controller' => 'quotation_product_properties', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
