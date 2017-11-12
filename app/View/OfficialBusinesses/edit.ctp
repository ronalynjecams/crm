<div class="officialBusinesses form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit Official Business'); ?></h1>
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

																<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('OfficialBusiness.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('OfficialBusiness.id'))); ?></li>
																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Official Businesses'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Official Business Reports'), array('controller' => 'official_business_reports', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Official Business Report'), array('controller' => 'official_business_reports', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('OfficialBusiness', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('mode', array('class' => 'form-control', 'placeholder' => 'Mode'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('purpose', array('class' => 'form-control', 'placeholder' => 'Purpose'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('expected_departure', array('class' => 'form-control', 'placeholder' => 'Expected Departure'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('user_id', array('class' => 'form-control', 'placeholder' => 'User Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('client_id', array('class' => 'form-control', 'placeholder' => 'Client Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('company_name', array('class' => 'form-control', 'placeholder' => 'Company Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('service_request', array('class' => 'form-control', 'placeholder' => 'Service Request'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('approved_by', array('class' => 'form-control', 'placeholder' => 'Approved By'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('approved_date', array('class' => 'form-control', 'placeholder' => 'Approved Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('hr_approved_by', array('class' => 'form-control', 'placeholder' => 'Hr Approved By'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('hr_approved_date', array('class' => 'form-control', 'placeholder' => 'Hr Approved Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('arrived_jecams', array('class' => 'form-control', 'placeholder' => 'Arrived Jecams'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
