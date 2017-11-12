<div class="prodInvLocationProperties index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Prod Inv Location Properties'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Prod Inv Location Property'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Prod Inv Locations'), array('controller' => 'prod_inv_locations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Prod Inv Location'), array('controller' => 'prod_inv_locations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Prod Inv Conditions'), array('controller' => 'prod_inv_conditions', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Prod Inv Condition'), array('controller' => 'prod_inv_conditions', 'action' => 'add'), array('escape' => false)); ?> </li>
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
						<th><?php echo $this->Paginator->sort('prod_inv_location_id'); ?></th>
						<th><?php echo $this->Paginator->sort('qty'); ?></th>
						<th><?php echo $this->Paginator->sort('property'); ?></th>
						<th><?php echo $this->Paginator->sort('value'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($prodInvLocationProperties as $prodInvLocationProperty): ?>
					<tr>
						<td><?php echo h($prodInvLocationProperty['ProdInvLocationProperty']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($prodInvLocationProperty['ProdInvLocation']['id'], array('controller' => 'prod_inv_locations', 'action' => 'view', $prodInvLocationProperty['ProdInvLocation']['id'])); ?>
		</td>
						<td><?php echo h($prodInvLocationProperty['ProdInvLocationProperty']['qty']); ?>&nbsp;</td>
						<td><?php echo h($prodInvLocationProperty['ProdInvLocationProperty']['property']); ?>&nbsp;</td>
						<td><?php echo h($prodInvLocationProperty['ProdInvLocationProperty']['value']); ?>&nbsp;</td>
						<td><?php echo h($prodInvLocationProperty['ProdInvLocationProperty']['created']); ?>&nbsp;</td>
						<td><?php echo h($prodInvLocationProperty['ProdInvLocationProperty']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $prodInvLocationProperty['ProdInvLocationProperty']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $prodInvLocationProperty['ProdInvLocationProperty']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $prodInvLocationProperty['ProdInvLocationProperty']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $prodInvLocationProperty['ProdInvLocationProperty']['id'])); ?>
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