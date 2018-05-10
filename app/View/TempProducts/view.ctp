<div class="tempProducts view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Temp Product'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Temp Product'), array('action' => 'edit', $tempProduct['TempProduct']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Temp Product'), array('action' => 'delete', $tempProduct['TempProduct']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $tempProduct['TempProduct']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Temp Products'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Temp Product'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Sub Categories'), array('controller' => 'sub_categories', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Sub Category'), array('controller' => 'sub_categories', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Temp Product Properties'), array('controller' => 'temp_product_properties', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Temp Product Property'), array('controller' => 'temp_product_properties', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($tempProduct['TempProduct']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User Id'); ?></th>
		<td>
			<?php echo h($tempProduct['TempProduct']['user_id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($tempProduct['TempProduct']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Image'); ?></th>
		<td>
			<?php echo h($tempProduct['TempProduct']['image']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Sub Category'); ?></th>
		<td>
			<?php echo $this->Html->link($tempProduct['SubCategory']['name'], array('controller' => 'sub_categories', 'action' => 'view', $tempProduct['SubCategory']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($tempProduct['TempProduct']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($tempProduct['TempProduct']['modified']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Other Info'); ?></th>
		<td>
			<?php echo h($tempProduct['TempProduct']['other_info']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($tempProduct['TempProduct']['type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Sale Price'); ?></th>
		<td>
			<?php echo h($tempProduct['TempProduct']['sale_price']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($tempProduct['TempProduct']['status']); ?>
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
	<h3><?php echo __('Related Temp Product Properties'); ?></h3>
	<?php if (!empty($tempProduct['TempProductProperty'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Temp Product Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($tempProduct['TempProductProperty'] as $tempProductProperty): ?>
		<tr>
			<td><?php echo $tempProductProperty['id']; ?></td>
			<td><?php echo $tempProductProperty['name']; ?></td>
			<td><?php echo $tempProductProperty['temp_product_id']; ?></td>
			<td><?php echo $tempProductProperty['created']; ?></td>
			<td><?php echo $tempProductProperty['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'temp_product_properties', 'action' => 'view', $tempProductProperty['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'temp_product_properties', 'action' => 'edit', $tempProductProperty['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'temp_product_properties', 'action' => 'delete', $tempProductProperty['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $tempProductProperty['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Temp Product Property'), array('controller' => 'temp_product_properties', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
