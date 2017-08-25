<div class="quotations form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Quotation'); ?></h1>
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

																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotations'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Teams'), array('controller' => 'teams', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Team'), array('controller' => 'teams', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('Quotation', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('quote_number', array('class' => 'form-control', 'placeholder' => 'Quote Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('client_id', array('class' => 'form-control', 'placeholder' => 'Client Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('team_id', array('class' => 'form-control', 'placeholder' => 'Team Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('user_id', array('class' => 'form-control', 'placeholder' => 'User Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('job_request_id', array('class' => 'form-control', 'placeholder' => 'Job Request Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('subject', array('class' => 'form-control', 'placeholder' => 'Subject'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('terms_info', array('class' => 'form-control', 'placeholder' => 'Terms Info'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('sub_total', array('class' => 'form-control', 'placeholder' => 'Sub Total'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('installation_charge', array('class' => 'form-control', 'placeholder' => 'Installation Charge'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('delivery_charge', array('class' => 'form-control', 'placeholder' => 'Delivery Charge'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('discount', array('class' => 'form-control', 'placeholder' => 'Discount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('grand_total', array('class' => 'form-control', 'placeholder' => 'Grand Total'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('type', array('class' => 'form-control', 'placeholder' => 'Type'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('validity_date', array('class' => 'form-control', 'placeholder' => 'Validity Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('bill_ship_address', array('class' => 'form-control', 'placeholder' => 'Bill Ship Address'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('bill_address', array('class' => 'form-control', 'placeholder' => 'Bill Address'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('bill_geolocation', array('class' => 'form-control', 'placeholder' => 'Bill Geolocation'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('bill_latitude', array('class' => 'form-control', 'placeholder' => 'Bill Latitude'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('bill_longitude', array('class' => 'form-control', 'placeholder' => 'Bill Longitude'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ship_address', array('class' => 'form-control', 'placeholder' => 'Ship Address'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ship_geolocation', array('class' => 'form-control', 'placeholder' => 'Ship Geolocation'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ship_latitude', array('class' => 'form-control', 'placeholder' => 'Ship Latitude'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ship_longitude', array('class' => 'form-control', 'placeholder' => 'Ship Longitude'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('target_delivery', array('class' => 'form-control', 'placeholder' => 'Target Delivery'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('date_moved', array('class' => 'form-control', 'placeholder' => 'Date Moved'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('date_approved', array('class' => 'form-control', 'placeholder' => 'Date Approved'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('delivery_mode', array('class' => 'form-control', 'placeholder' => 'Delivery Mode'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
