<div class="officialBusinesses view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Official Business'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Official Business'), array('action' => 'edit', $officialBusiness['OfficialBusiness']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Official Business'), array('action' => 'delete', $officialBusiness['OfficialBusiness']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $officialBusiness['OfficialBusiness']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Official Businesses'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Official Business'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Official Business Reports'), array('controller' => 'official_business_reports', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Official Business Report'), array('controller' => 'official_business_reports', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($officialBusiness['OfficialBusiness']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Mode'); ?></th>
		<td>
			<?php echo h($officialBusiness['OfficialBusiness']['mode']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Purpose'); ?></th>
		<td>
			<?php echo h($officialBusiness['OfficialBusiness']['purpose']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Expected Departure'); ?></th>
		<td>
			<?php echo h($officialBusiness['OfficialBusiness']['expected_departure']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($officialBusiness['OfficialBusiness']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($officialBusiness['User']['id'], array('controller' => 'users', 'action' => 'view', $officialBusiness['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Client'); ?></th>
		<td>
			<?php echo $this->Html->link($officialBusiness['Client']['name'], array('controller' => 'clients', 'action' => 'view', $officialBusiness['Client']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Company Name'); ?></th>
		<td>
			<?php echo h($officialBusiness['OfficialBusiness']['company_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Service Request'); ?></th>
		<td>
			<?php echo h($officialBusiness['OfficialBusiness']['service_request']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Approved By'); ?></th>
		<td>
			<?php echo h($officialBusiness['OfficialBusiness']['approved_by']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Approved Date'); ?></th>
		<td>
			<?php echo time_elapsed_string($officialBusiness['OfficialBusiness']['approved_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Hr Approved By'); ?></th>
		<td>
			<?php echo h($officialBusiness['OfficialBusiness']['hr_approved_by']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Hr Approved Date'); ?></th>
		<td>
			<?php echo time_elapsed_string($officialBusiness['OfficialBusiness']['hr_approved_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Arrived Jecams'); ?></th>
		<td>
			<?php echo time_elapsed_string($officialBusiness['OfficialBusiness']['arrived_jecams']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo time_elapsed_string($officialBusiness['OfficialBusiness']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo time_elapsed_string($officialBusiness['OfficialBusiness']['modified']); ?>
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
	<h3><?php echo __('Related Official Business Reports'); ?></h3>
	<?php if (!empty($officialBusiness['OfficialBusinessReport'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Report'); ?></th>
		<th><?php echo __('Official Business Id'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($officialBusiness['OfficialBusinessReport'] as $officialBusinessReport): ?>
		<tr>
			<td><?php echo $officialBusinessReport['id']; ?></td>
			<td><?php echo $officialBusinessReport['report']; ?></td>
			<td><?php echo $officialBusinessReport['official_business_id']; ?></td>
			<td><?php echo time_elapsed_string($officialBusinessReport['created']); ?></td>
			<td><?php echo time_elapsed_string($officialBusinessReport['modified']); ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'official_business_reports', 'action' => 'view', $officialBusinessReport['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'official_business_reports', 'action' => 'edit', $officialBusinessReport['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'official_business_reports', 'action' => 'delete', $officialBusinessReport['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $officialBusinessReport['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Official Business Report'), array('controller' => 'official_business_reports', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
