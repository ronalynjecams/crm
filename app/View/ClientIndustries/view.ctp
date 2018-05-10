<div class="clientIndustries view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Client Industry'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Client Industry'), array('action' => 'edit', $clientIndustry['ClientIndustry']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Client Industry'), array('action' => 'delete', $clientIndustry['ClientIndustry']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $clientIndustry['ClientIndustry']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Client Industries'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client Industry'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($clientIndustry['ClientIndustry']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Name'); ?></th>
		<td>
			<?php echo h($clientIndustry['ClientIndustry']['name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($clientIndustry['ClientIndustry']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($clientIndustry['ClientIndustry']['modified']); ?>
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
	<h3><?php echo __('Related Clients'); ?></h3>
	<?php if (!empty($clientIndustry['Client'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Lead'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Contact Person'); ?></th>
		<th><?php echo __('Position'); ?></th>
		<th><?php echo __('Address'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Tin Number'); ?></th>
		<th><?php echo __('Contact Number'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th><?php echo __('Owner Marketing'); ?></th>
		<th><?php echo __('Date Forwarded'); ?></th>
		<th><?php echo __('Original Owner'); ?></th>
		<th><?php echo __('Date Transfered'); ?></th>
		<th><?php echo __('Team Id'); ?></th>
		<th><?php echo __('Client Industry Id'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($clientIndustry['Client'] as $client): ?>
		<tr>
			<td><?php echo $client['id']; ?></td>
			<td><?php echo $client['user_id']; ?></td>
			<td><?php echo $client['lead']; ?></td>
			<td><?php echo $client['name']; ?></td>
			<td><?php echo $client['contact_person']; ?></td>
			<td><?php echo $client['position']; ?></td>
			<td><?php echo $client['address']; ?></td>
			<td><?php echo $client['email']; ?></td>
			<td><?php echo $client['tin_number']; ?></td>
			<td><?php echo $client['contact_number']; ?></td>
			<td><?php echo $client['created']; ?></td>
			<td><?php echo $client['modified']; ?></td>
			<td><?php echo $client['owner_marketing']; ?></td>
			<td><?php echo $client['date_forwarded']; ?></td>
			<td><?php echo $client['original_owner']; ?></td>
			<td><?php echo $client['date_transfered']; ?></td>
			<td><?php echo $client['team_id']; ?></td>
			<td><?php echo $client['client_industry_id']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'clients', 'action' => 'view', $client['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'clients', 'action' => 'edit', $client['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'clients', 'action' => 'delete', $client['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $client['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
