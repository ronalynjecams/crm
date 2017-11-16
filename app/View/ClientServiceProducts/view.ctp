<div class="clientServiceProducts view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Client Service Product'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Client Service Product'), array('action' => 'edit', $clientServiceProduct['ClientServiceProduct']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Client Service Product'), array('action' => 'delete', $clientServiceProduct['ClientServiceProduct']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $clientServiceProduct['ClientServiceProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Client Service Products'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client Service Product'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotation Products'), array('controller' => 'quotation_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation Product'), array('controller' => 'quotation_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Product Combos'), array('controller' => 'product_combos', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product Combo'), array('controller' => 'product_combos', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($clientServiceProduct['ClientServiceProduct']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product'); ?></th>
		<td>
			<?php echo $this->Html->link($clientServiceProduct['Product']['name'], array('controller' => 'products', 'action' => 'view', $clientServiceProduct['Product']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation Product'); ?></th>
		<td>
			<?php echo $this->Html->link($clientServiceProduct['QuotationProduct']['id'], array('controller' => 'quotation_products', 'action' => 'view', $clientServiceProduct['QuotationProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($clientServiceProduct['ClientServiceProduct']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product Combo'); ?></th>
		<td>
			<?php echo $this->Html->link($clientServiceProduct['ProductCombo']['id'], array('controller' => 'product_combos', 'action' => 'view', $clientServiceProduct['ProductCombo']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Processed Qty'); ?></th>
		<td>
			<?php echo h($clientServiceProduct['ClientServiceProduct']['processed_qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Delivered Qty'); ?></th>
		<td>
			<?php echo h($clientServiceProduct['ClientServiceProduct']['delivered_qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Pullout Qty'); ?></th>
		<td>
			<?php echo h($clientServiceProduct['ClientServiceProduct']['pullout_qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Expected Demo Data'); ?></th>
		<td>
			<?php echo h($clientServiceProduct['ClientServiceProduct']['expected_demo_data']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Expected Pullout Date'); ?></th>
		<td>
			<?php echo h($clientServiceProduct['ClientServiceProduct']['expected_pullout_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Pullout Data'); ?></th>
		<td>
			<?php echo h($clientServiceProduct['ClientServiceProduct']['pullout_data']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($clientServiceProduct['ClientServiceProduct']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($clientServiceProduct['ClientServiceProduct']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
		</div>
		</div><!-- end col md 9 -->

	</div>
</div>

