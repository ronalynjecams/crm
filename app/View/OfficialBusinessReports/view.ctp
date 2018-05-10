<div class="officialBusinessReports view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Official Business Report'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Official Business Report'), array('action' => 'edit', $officialBusinessReport['OfficialBusinessReport']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Official Business Report'), array('action' => 'delete', $officialBusinessReport['OfficialBusinessReport']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $officialBusinessReport['OfficialBusinessReport']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Official Business Reports'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Official Business Report'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Official Businesses'), array('controller' => 'official_businesses', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Official Business'), array('controller' => 'official_businesses', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($officialBusinessReport['OfficialBusinessReport']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Report'); ?></th>
		<td>
			<?php echo h($officialBusinessReport['OfficialBusinessReport']['report']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Official Business'); ?></th>
		<td>
			<?php echo $this->Html->link($officialBusinessReport['OfficialBusiness']['id'], array('controller' => 'official_businesses', 'action' => 'view', $officialBusinessReport['OfficialBusiness']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo time_elapsed_string($officialBusinessReport['OfficialBusinessReport']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo time_elapsed_string($officialBusinessReport['OfficialBusinessReport']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
		</div>
		</div><!-- end col md 9 -->

	</div>
</div>

