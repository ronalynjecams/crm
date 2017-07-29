<div class="jobRequests view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Job Request'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Job Request'), array('action' => 'edit', $jobRequest['JobRequest']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Job Request'), array('action' => 'delete', $jobRequest['JobRequest']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jobRequest['JobRequest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Job Requests'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Job Request'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Jr Products'), array('controller' => 'jr_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Jr Product'), array('controller' => 'jr_products', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($jobRequest['JobRequest']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Jr Number'); ?></th>
		<td>
			<?php echo h($jobRequest['JobRequest']['jr_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($jobRequest['JobRequest']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($jobRequest['JobRequest']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($jobRequest['JobRequest']['modified']); ?>
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
	<h3><?php echo __('Related Jr Products'); ?></h3>
	<?php if (!empty($jobRequest['JrProduct'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Quotation Product Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Job Request Id'); ?></th>
		<th><?php echo __('Date Assigned'); ?></th>
		<th><?php echo __('Date Ongoing'); ?></th>
		<th><?php echo __('Floor Plan Details'); ?></th>
		<th><?php echo __('Deadline'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($jobRequest['JrProduct'] as $jrProduct): ?>
		<tr>
			<td><?php echo $jrProduct['id']; ?></td>
			<td><?php echo $jrProduct['quotation_product_id']; ?></td>
			<td><?php echo $jrProduct['user_id']; ?></td>
			<td><?php echo $jrProduct['job_request_id']; ?></td>
			<td><?php echo $jrProduct['date_assigned']; ?></td>
			<td><?php echo $jrProduct['date_ongoing']; ?></td>
			<td><?php echo $jrProduct['floor_plan_details']; ?></td>
			<td><?php echo $jrProduct['deadline']; ?></td>
			<td><?php echo $jrProduct['status']; ?></td>
			<td><?php echo $jrProduct['created']; ?></td>
			<td><?php echo $jrProduct['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'jr_products', 'action' => 'view', $jrProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'jr_products', 'action' => 'edit', $jrProduct['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'jr_products', 'action' => 'delete', $jrProduct['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $jrProduct['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Jr Product'), array('controller' => 'jr_products', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
<div class="related row">
	<div class="col-md-12">
	<h3><?php echo __('Related Quotations'); ?></h3>
	<?php if (!empty($jobRequest['Quotation'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table table-striped">
	<thead>
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Quote Number'); ?></th>
		<th><?php echo __('Client Id'); ?></th>
		<th><?php echo __('Team Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Job Request Id'); ?></th>
		<th><?php echo __('Subject'); ?></th>
		<th><?php echo __('Status'); ?></th>
		<th><?php echo __('Terms Info'); ?></th>
		<th><?php echo __('Sub Total'); ?></th>
		<th><?php echo __('Installation Charge'); ?></th>
		<th><?php echo __('Delivery Charge'); ?></th>
		<th><?php echo __('Discount'); ?></th>
		<th><?php echo __('Grand Total'); ?></th>
		<th><?php echo __('Type'); ?></th>
		<th><?php echo __('Validity Date'); ?></th>
		<th><?php echo __('Bill Ship Address'); ?></th>
		<th><?php echo __('Bill Address'); ?></th>
		<th><?php echo __('Bill Geolocation'); ?></th>
		<th><?php echo __('Bill Latitude'); ?></th>
		<th><?php echo __('Bill Longitude'); ?></th>
		<th><?php echo __('Ship Address'); ?></th>
		<th><?php echo __('Ship Geolocation'); ?></th>
		<th><?php echo __('Ship Latitude'); ?></th>
		<th><?php echo __('Ship Longitude'); ?></th>
		<th><?php echo __('Target Delivery'); ?></th>
		<th><?php echo __('Date Moved'); ?></th>
		<th><?php echo __('Date Approved'); ?></th>
		<th><?php echo __('Delivery Mode'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"></th>
	</tr>
	<thead>
	<tbody>
	<?php foreach ($jobRequest['Quotation'] as $quotation): ?>
		<tr>
			<td><?php echo $quotation['id']; ?></td>
			<td><?php echo $quotation['quote_number']; ?></td>
			<td><?php echo $quotation['client_id']; ?></td>
			<td><?php echo $quotation['team_id']; ?></td>
			<td><?php echo $quotation['user_id']; ?></td>
			<td><?php echo $quotation['job_request_id']; ?></td>
			<td><?php echo $quotation['subject']; ?></td>
			<td><?php echo $quotation['status']; ?></td>
			<td><?php echo $quotation['terms_info']; ?></td>
			<td><?php echo $quotation['sub_total']; ?></td>
			<td><?php echo $quotation['installation_charge']; ?></td>
			<td><?php echo $quotation['delivery_charge']; ?></td>
			<td><?php echo $quotation['discount']; ?></td>
			<td><?php echo $quotation['grand_total']; ?></td>
			<td><?php echo $quotation['type']; ?></td>
			<td><?php echo $quotation['validity_date']; ?></td>
			<td><?php echo $quotation['bill_ship_address']; ?></td>
			<td><?php echo $quotation['bill_address']; ?></td>
			<td><?php echo $quotation['bill_geolocation']; ?></td>
			<td><?php echo $quotation['bill_latitude']; ?></td>
			<td><?php echo $quotation['bill_longitude']; ?></td>
			<td><?php echo $quotation['ship_address']; ?></td>
			<td><?php echo $quotation['ship_geolocation']; ?></td>
			<td><?php echo $quotation['ship_latitude']; ?></td>
			<td><?php echo $quotation['ship_longitude']; ?></td>
			<td><?php echo $quotation['target_delivery']; ?></td>
			<td><?php echo $quotation['date_moved']; ?></td>
			<td><?php echo $quotation['date_approved']; ?></td>
			<td><?php echo $quotation['delivery_mode']; ?></td>
			<td><?php echo $quotation['created']; ?></td>
			<td><?php echo $quotation['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-search"></span>'), array('controller' => 'quotations', 'action' => 'view', $quotation['id']), array('escape' => false)); ?>
				<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>'), array('controller' => 'quotations', 'action' => 'edit', $quotation['id']), array('escape' => false)); ?>
				<?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>'), array('controller' => 'quotations', 'action' => 'delete', $quotation['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $quotation['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</tbody>
	</table>
<?php endif; ?>

	<div class="actions">
		<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false, 'class' => 'btn btn-default')); ?> 
	</div>
	</div><!-- end col md 12 -->
</div>
