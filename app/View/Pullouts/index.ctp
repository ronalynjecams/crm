<div class="pullouts index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Pullouts'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Pullout'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Client Services'), array('controller' => 'client_services', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client Service'), array('controller' => 'client_services', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Client Service Products'), array('controller' => 'client_service_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client Service Product'), array('controller' => 'client_service_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Pullout Logs'), array('controller' => 'pullout_logs', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Pullout Log'), array('controller' => 'pullout_logs', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('type'); ?></th>
						<th><?php echo $this->Paginator->sort('status'); ?></th>
						<th><?php echo $this->Paginator->sort('delivered_qty'); ?></th>
						<th><?php echo $this->Paginator->sort('date_delivered'); ?></th>
						<th><?php echo $this->Paginator->sort('pullout_qty'); ?></th>
						<th><?php echo $this->Paginator->sort('qty_success'); ?></th>
						<th><?php echo $this->Paginator->sort('expected_pullout_date'); ?></th>
						<th><?php echo $this->Paginator->sort('pullout_date'); ?></th>
						<th><?php echo $this->Paginator->sort('delivery_mode'); ?></th>
						<th><?php echo $this->Paginator->sort('reference_product_number'); ?></th>
						<th><?php echo $this->Paginator->sort('reference_number'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($pullouts as $pullout): ?>
					<tr>
						<td><?php echo h($pullout['Pullout']['id']); ?>&nbsp;</td>
						<td><?php echo h($pullout['Pullout']['type']); ?>&nbsp;</td>
						<td><?php echo h($pullout['Pullout']['status']); ?>&nbsp;</td>
						<td><?php echo h($pullout['Pullout']['delivered_qty']); ?>&nbsp;</td>
						<td><?php echo h($pullout['Pullout']['date_delivered']); ?>&nbsp;</td>
						<td><?php echo h($pullout['Pullout']['pullout_qty']); ?>&nbsp;</td>
						<td><?php echo h($pullout['Pullout']['qty_success']); ?>&nbsp;</td>
						<td><?php echo h($pullout['Pullout']['expected_pullout_date']); ?>&nbsp;</td>
						<td><?php echo h($pullout['Pullout']['pullout_date']); ?>&nbsp;</td>
						<td><?php echo h($pullout['Pullout']['delivery_mode']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($pullout['ClientServiceProduct']['id'], array('controller' => 'client_service_products', 'action' => 'view', $pullout['ClientServiceProduct']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($pullout['ClientService']['id'], array('controller' => 'client_services', 'action' => 'view', $pullout['ClientService']['id'])); ?>
		</td>
						<td><?php echo h($pullout['Pullout']['created']); ?>&nbsp;</td>
						<td><?php echo h($pullout['Pullout']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $pullout['Pullout']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $pullout['Pullout']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $pullout['Pullout']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $pullout['Pullout']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

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