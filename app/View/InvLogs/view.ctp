<div class="invLogs view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Inv Log'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Inv Log'), array('action' => 'edit', $invLog['InvLog']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Inv Log'), array('action' => 'delete', $invLog['InvLog']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $invLog['InvLog']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inv Logs'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inv Log'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Inv Locations'), array('controller' => 'inv_locations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Inv Location'), array('controller' => 'inv_locations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotation Products'), array('controller' => 'quotation_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation Product'), array('controller' => 'quotation_products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($invLog['InvLog']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product'); ?></th>
		<td>
			<?php echo $this->Html->link($invLog['Product']['name'], array('controller' => 'products', 'action' => 'view', $invLog['Product']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Inv Location'); ?></th>
		<td>
			<?php echo $this->Html->link($invLog['InvLocation']['name'], array('controller' => 'inv_locations', 'action' => 'view', $invLog['InvLocation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($invLog['InvLog']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Released To'); ?></th>
		<td>
			<?php echo h($invLog['InvLog']['released_to']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Received From'); ?></th>
		<td>
			<?php echo h($invLog['InvLog']['received_from']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation Product'); ?></th>
		<td>
			<?php echo $this->Html->link($invLog['QuotationProduct']['id'], array('controller' => 'quotation_products', 'action' => 'view', $invLog['QuotationProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($invLog['InvLog']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($invLog['InvLog']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
			</div>
		</div><!-- end col md 9 -->

	</div>
</div>

