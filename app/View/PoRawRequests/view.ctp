<div class="poRawRequests view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Po Raw Request'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Po Raw Request'), array('action' => 'edit', $poRawRequest['PoRawRequest']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Po Raw Request'), array('action' => 'delete', $poRawRequest['PoRawRequest']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $poRawRequest['PoRawRequest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Po Raw Requests'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Po Raw Request'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotation Products'), array('controller' => 'quotation_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation Product'), array('controller' => 'quotation_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Jr Products'), array('controller' => 'jr_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Jr Product'), array('controller' => 'jr_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Po Raw Request Properties'), array('controller' => 'po_raw_request_properties', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Po Raw Request Property'), array('controller' => 'po_raw_request_properties', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($poRawRequest['PoRawRequest']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation Product'); ?></th>
		<td>
			<?php echo $this->Html->link($poRawRequest['QuotationProduct']['id'], array('controller' => 'quotation_products', 'action' => 'view', $poRawRequest['QuotationProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Jr Product'); ?></th>
		<td>
			<?php echo $this->Html->link($poRawRequest['JrProduct']['id'], array('controller' => 'jr_products', 'action' => 'view', $poRawRequest['JrProduct']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Product'); ?></th>
		<td>
			<?php echo $this->Html->link($poRawRequest['Product']['name'], array('controller' => 'products', 'action' => 'view', $poRawRequest['Product']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($poRawRequest['User']['id'], array('controller' => 'users', 'action' => 'view', $poRawRequest['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Qty'); ?></th>
		<td>
			<?php echo h($poRawRequest['PoRawRequest']['qty']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($poRawRequest['PoRawRequest']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Needed'); ?></th>
		<td>
			<?php echo h($poRawRequest['PoRawRequest']['date_needed']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($poRawRequest['PoRawRequest']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($poRawRequest['PoRawRequest']['modified']); ?>
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
	<h3><?php echo __('Related Po Raw Request Properties'); ?></h3>
	<?php if (!empty($poRawRequest['PoRawRequestProperty'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Po Raw Request Id'); ?></th>
		<th><?php echo __('Property'); ?></th>
		<th><?php echo __('Value'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($poRawRequest['PoRawRequestProperty'] as $poRawRequestProperty): ?>
		<tr>
			<td><?php echo $poRawRequestProperty['id']; ?></td>
			<td><?php echo $poRawRequestProperty['po_raw_request_id']; ?></td>
			<td><?php echo $poRawRequestProperty['property']; ?></td>
			<td><?php echo $poRawRequestProperty['value']; ?></td>
			<td><?php echo $poRawRequestProperty['created']; ?></td>
			<td><?php echo $poRawRequestProperty['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'po_raw_request_properties', 'action' => 'view', $poRawRequestProperty['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'po_raw_request_properties', 'action' => 'edit', $poRawRequestProperty['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'po_raw_request_properties', 'action' => 'delete', $poRawRequestProperty['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $poRawRequestProperty['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Po Raw Request Property'), array('controller' => 'po_raw_request_properties', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
