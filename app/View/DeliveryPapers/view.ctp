<div class="deliveryPapers view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Delivery Paper'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Delivery Paper'), array('action' => 'edit', $deliveryPaper['DeliveryPaper']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Delivery Paper'), array('action' => 'delete', $deliveryPaper['DeliveryPaper']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $deliveryPaper['DeliveryPaper']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Delivery Papers'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Delivery Paper'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Delivery Schedules'), array('controller' => 'delivery_schedules', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Delivery Schedule'), array('controller' => 'delivery_schedules', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($deliveryPaper['DeliveryPaper']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Dr Paper Id'); ?></th>
		<td>
			<?php echo h($deliveryPaper['DeliveryPaper']['dr_paper_id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quotation'); ?></th>
		<td>
			<?php echo $this->Html->link($deliveryPaper['Quotation']['id'], array('controller' => 'quotations', 'action' => 'view', $deliveryPaper['Quotation']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Needed'); ?></th>
		<td>
			<?php echo h($deliveryPaper['DeliveryPaper']['date_needed']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Acquired'); ?></th>
		<td>
			<?php echo time_elapsed_string($deliveryPaper['DeliveryPaper']['date_acquired']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Processed'); ?></th>
		<td>
			<?php echo time_elapsed_string($deliveryPaper['DeliveryPaper']['date_processed']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($deliveryPaper['DeliveryPaper']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo time_elapsed_string($deliveryPaper['DeliveryPaper']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo time_elapsed_string($deliveryPaper['DeliveryPaper']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>
			</div>
		</div><!-- end col md 9 -->

	</div>
</div>

