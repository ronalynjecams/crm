<div class="quotations view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Quotation'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Quotation'), array('action' => 'edit', $quotation['Quotation']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Quotation'), array('action' => 'delete', $quotation['Quotation']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $quotation['Quotation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Quotations'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Quotation'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Teams'), array('controller' => 'teams', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Team'), array('controller' => 'teams', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($quotation['Quotation']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Quote Number'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['quote_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Client'); ?></th>
		<td>
			<?php echo $this->Html->link($quotation['Client']['name'], array('controller' => 'clients', 'action' => 'view', $quotation['Client']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Team'); ?></th>
		<td>
			<?php echo $this->Html->link($quotation['Team']['name'], array('controller' => 'teams', 'action' => 'view', $quotation['Team']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('User'); ?></th>
		<td>
			<?php echo $this->Html->link($quotation['User']['id'], array('controller' => 'users', 'action' => 'view', $quotation['User']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Job Request Id'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['job_request_id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Subject'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['subject']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Terms Info'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['terms_info']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Sub Total'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['sub_total']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Installation Charge'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['installation_charge']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Delivery Charge'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['delivery_charge']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Discount'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['discount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Grand Total'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['grand_total']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Type'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Validity Date'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['validity_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Bill Address'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['bill_address']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Bill Geolocation'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['bill_geolocation']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Bill Latitude'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['bill_latitude']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Bill Longitude'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['bill_longitude']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ship Address'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['ship_address']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ship Geolocation'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['ship_geolocation']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ship Latitude'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['ship_latitude']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ship Longitude'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['ship_longitude']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Target Delivery'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['target_delivery']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Moved'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['date_moved']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Date Approved'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['date_approved']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Delivery Mode'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['delivery_mode']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($quotation['Quotation']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

