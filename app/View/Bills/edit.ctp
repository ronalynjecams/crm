<div class="bills form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit Bill'); ?></h1>
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

																<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('Bill.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('Bill.id'))); ?></li>
																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Bills'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Bill Accounts'), array('controller' => 'bill_accounts', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Bill Account'), array('controller' => 'bill_accounts', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Inv Locations'), array('controller' => 'inv_locations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inv Location'), array('controller' => 'inv_locations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Bill Monitorings'), array('controller' => 'bill_monitorings', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Bill Monitoring'), array('controller' => 'bill_monitorings', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('Bill', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('account_number', array('class' => 'form-control', 'placeholder' => 'Account Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('billing_status', array('class' => 'form-control', 'placeholder' => 'Billing Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('jecams_amount', array('class' => 'form-control', 'placeholder' => 'Jecams Amount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('payment_type', array('class' => 'form-control', 'placeholder' => 'Payment Type'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('bill_account_id', array('class' => 'form-control', 'placeholder' => 'Bill Account Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('inv_location_id', array('class' => 'form-control', 'placeholder' => 'Inv Location Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
