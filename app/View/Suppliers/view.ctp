<div class="suppliers view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Supplier'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Supplier'), array('action' => 'edit', $supplier['Supplier']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Supplier'), array('action' => 'delete', $supplier['Supplier']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $supplier['Supplier']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Suppliers'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Supplier'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Supplier Tags'), array('controller' => 'supplier_tags', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Supplier Tag'), array('controller' => 'supplier_tags', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($supplier['Supplier']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($supplier['Supplier']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Code'); ?></th>
		<td>
			<?php echo h($supplier['Supplier']['code']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($supplier['Supplier']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Contact Person'); ?></th>
		<td>
			<?php echo h($supplier['Supplier']['contact_person']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Contact Number'); ?></th>
		<td>
			<?php echo h($supplier['Supplier']['contact_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Email'); ?></th>
		<td>
			<?php echo h($supplier['Supplier']['email']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Address'); ?></th>
		<td>
			<?php echo h($supplier['Supplier']['address']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($supplier['Supplier']['type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Tin Number'); ?></th>
		<td>
			<?php echo h($supplier['Supplier']['tin_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Vatable'); ?></th>
		<td>
			<?php echo h($supplier['Supplier']['vatable']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($supplier['Supplier']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($supplier['Supplier']['modified']); ?>
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
	<h3><?php echo __('Related Supplier Tags'); ?></h3>
	<?php if (!empty($supplier['SupplierTag'])): ?>
	<div class="table-responsive">
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Supplier Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($supplier['SupplierTag'] as $supplierTag): ?>
		<tr>
			<td><?php echo $supplierTag['id']; ?></td>
			<td><?php echo $supplierTag['name']; ?></td>
			<td><?php echo $supplierTag['supplier_id']; ?></td>
			<td><?php echo $supplierTag['created']; ?></td>
			<td><?php echo $supplierTag['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'supplier_tags', 'action' => 'view', $supplierTag['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'supplier_tags', 'action' => 'edit', $supplierTag['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'supplier_tags', 'action' => 'delete', $supplierTag['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $supplierTag['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
	</div>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Supplier Tag'), array('controller' => 'supplier_tags', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
