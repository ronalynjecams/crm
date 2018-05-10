<div class="jobRequestAssignments form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Job Request Assignment'); ?></h1>
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

																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Request Assignments'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Request Products'), array('controller' => 'job_request_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Product'), array('controller' => 'job_request_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Request Floorplans'), array('controller' => 'job_request_floorplans', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Floorplan'), array('controller' => 'job_request_floorplans', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Clients'), array('controller' => 'clients', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client'), array('controller' => 'clients', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Request Revisions'), array('controller' => 'job_request_revisions', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Revision'), array('controller' => 'job_request_revisions', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('JobRequestAssignment', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('job_request_product_id', array('class' => 'form-control', 'placeholder' => 'Job Request Product Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('job_request_floorplan_id', array('class' => 'form-control', 'placeholder' => 'Job Request Floorplan Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('designer', array('class' => 'form-control', 'placeholder' => 'Designer'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('sales_executive', array('class' => 'form-control', 'placeholder' => 'Sales Executive'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('assigned_by', array('class' => 'form-control', 'placeholder' => 'Assigned By'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('client_id', array('class' => 'form-control', 'placeholder' => 'Client Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('quotation_id', array('class' => 'form-control', 'placeholder' => 'Quotation Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('assigned_task', array('class' => 'form-control', 'placeholder' => 'Assigned Task'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('job_request_revision_id', array('class' => 'form-control', 'placeholder' => 'Job Request Revision Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('date_rejected', array('class' => 'form-control', 'placeholder' => 'Date Rejected'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
