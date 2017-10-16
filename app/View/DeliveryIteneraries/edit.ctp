<div class="deliveryIteneraries form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit Delivery Itenerary'); ?></h1>
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

																<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('DeliveryItenerary.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('DeliveryItenerary.id'))); ?></li>
																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Delivery Iteneraries'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Delivery Schedules'), array('controller' => 'delivery_schedules', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Delivery Schedule'), array('controller' => 'delivery_schedules', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Vehicles'), array('controller' => 'vehicles', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Vehicle'), array('controller' => 'vehicles', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Delivery Installers'), array('controller' => 'delivery_installers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Delivery Installer'), array('controller' => 'delivery_installers', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('DeliveryItenerary', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('delivery_schedule_id', array('class' => 'form-control', 'placeholder' => 'Delivery Schedule Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('vehicle_id', array('class' => 'form-control', 'placeholder' => 'Vehicle Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('booking_code', array('class' => 'form-control', 'placeholder' => 'Booking Code'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('amount', array('class' => 'form-control', 'placeholder' => 'Amount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('driver', array('class' => 'form-control', 'placeholder' => 'Driver'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('expected_start', array('class' => 'form-control', 'placeholder' => 'Expected Start'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('actual_start', array('class' => 'form-control', 'placeholder' => 'Actual Start'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('end_work', array('class' => 'form-control', 'placeholder' => 'End Work'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('type', array('class' => 'form-control', 'placeholder' => 'Type'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('remarks', array('class' => 'form-control', 'placeholder' => 'Remarks'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('departure', array('class' => 'form-control', 'placeholder' => 'Departure'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('arrival', array('class' => 'form-control', 'placeholder' => 'Arrival'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('client_id', array('class' => 'form-control', 'placeholder' => 'Client Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('requested_by', array('class' => 'form-control', 'placeholder' => 'Requested By'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('request_note', array('class' => 'form-control', 'placeholder' => 'Request Note'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('processed_by', array('class' => 'form-control', 'placeholder' => 'Processed By'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
