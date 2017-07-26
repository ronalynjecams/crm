<div class="quotationProductProperties view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Quotation Product Property'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Quotation Product Property'), array('action' => 'edit', $quotationProductProperty['QuotationProductProperty']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Quotation Product Property'), array('action' => 'delete', $quotationProductProperty['QuotationProductProperty']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $quotationProductProperty['QuotationProductProperty']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotation Product Properties'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation Product Property'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotation Products'), array('controller' => 'quotation_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation Product'), array('controller' => 'quotation_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Properties'), array('controller' => 'product_properties', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Property'), array('controller' => 'product_properties', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Values'), array('controller' => 'product_values', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Value'), array('controller' => 'product_values', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($quotationProductProperty['QuotationProductProperty']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation Product'); ?></th>
		<td>
			<?php echo $this->Html->link($quotationProductProperty['QuotationProduct']['id'], array('controller' => 'quotation_products', 'action' => 'view', $quotationProductProperty['QuotationProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Property'); ?></th>
		<td>
			<?php echo h($quotationProductProperty['QuotationProductProperty']['property']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Value'); ?></th>
		<td>
			<?php echo h($quotationProductProperty['QuotationProductProperty']['value']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product Property'); ?></th>
		<td>
			<?php echo $this->Html->link($quotationProductProperty['ProductProperty']['name'], array('controller' => 'product_properties', 'action' => 'view', $quotationProductProperty['ProductProperty']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product Value'); ?></th>
		<td>
			<?php echo $this->Html->link($quotationProductProperty['ProductValue']['id'], array('controller' => 'product_values', 'action' => 'view', $quotationProductProperty['ProductValue']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($quotationProductProperty['QuotationProductProperty']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($quotationProductProperty['QuotationProductProperty']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

