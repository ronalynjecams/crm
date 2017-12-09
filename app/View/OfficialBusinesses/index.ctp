<div class="officialBusinesses index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Official Businesses'); ?></h1>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->



	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Official Business'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Official Business Reports'), array('controller' => 'official_business_reports', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Official Business Report'), array('controller' => 'official_business_reports', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<div class="table-responsive">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('mode'); ?></th>
						<th><?php echo $this->Paginator->sort('purpose'); ?></th>
						<th><?php echo $this->Paginator->sort('expected_departure'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('user_id'); ?></th>
						<th><?php echo $this->Paginator->sort('client_id'); ?></th>
						<th><?php echo $this->Paginator->sort('company_name'); ?></th>
						<th><?php echo $this->Paginator->sort('service_request'); ?></th>
						<th><?php echo $this->Paginator->sort('approved_by'); ?></th>
						<th><?php echo $this->Paginator->sort('approved_date'); ?></th>
						<th><?php echo $this->Paginator->sort('hr_approved_by'); ?></th>
						<th><?php echo $this->Paginator->sort('hr_approved_date'); ?></th>
						<th><?php echo $this->Paginator->sort('arrived_jecams'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($officialBusinesses as $officialBusiness): ?>
					<tr>
						<td><?php echo h($officialBusiness['OfficialBusiness']['id']); ?>&nbsp;</td>
						<td><?php echo h($officialBusiness['OfficialBusiness']['mode']); ?>&nbsp;</td>
						<td><?php echo h($officialBusiness['OfficialBusiness']['purpose']); ?>&nbsp;</td>
						<td><?php echo h($officialBusiness['OfficialBusiness']['expected_departure']); ?>&nbsp;</td>
						<td><?php echo h($officialBusiness['OfficialBusiness']['status']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($officialBusiness['User']['id'], array('controller' => 'users', 'action' => 'view', $officialBusiness['User']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($officialBusiness['Client']['name'], array('controller' => 'clients', 'action' => 'view', $officialBusiness['Client']['id'])); ?>
		</td>
						<td><?php echo h($officialBusiness['OfficialBusiness']['company_name']); ?>&nbsp;</td>
						<td><?php echo h($officialBusiness['OfficialBusiness']['service_request']); ?>&nbsp;</td>
						<td><?php echo h($officialBusiness['OfficialBusiness']['approved_by']); ?>&nbsp;</td>
						<td><?php echo h($officialBusiness['OfficialBusiness']['approved_date']); ?>&nbsp;</td>
						<td><?php echo h($officialBusiness['OfficialBusiness']['hr_approved_by']); ?>&nbsp;</td>
						<td><?php echo h($officialBusiness['OfficialBusiness']['hr_approved_date']); ?>&nbsp;</td>
						<td><?php echo h($officialBusiness['OfficialBusiness']['arrived_jecams']); ?>&nbsp;</td>
						<td><?php echo h($officialBusiness['OfficialBusiness']['created']); ?>&nbsp;</td>
						<td><?php echo h($officialBusiness['OfficialBusiness']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $officialBusiness['OfficialBusiness']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $officialBusiness['OfficialBusiness']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $officialBusiness['OfficialBusiness']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $officialBusiness['OfficialBusiness']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>
			</div>
			<p>
				<small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></small>
			</p>

			<?php
			$params = $this->Paginator->params();
			if ($params['pageCount'] > 1) {
			?>
			<ul class="pagination pagination-sm">
				<?php
					echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false));
					echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a'));
					echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false));
				?>
			</ul>
			<?php } ?>

		</div> <!-- end col md 9 -->
	</div><!-- end row -->


</div><!-- end containing of content -->