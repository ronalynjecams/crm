<div class="jobRequestRevisions form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Job Request Revision'); ?></h1>
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

																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Request Revisions'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Request Products'), array('controller' => 'job_request_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Product'), array('controller' => 'job_request_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Request Types'), array('controller' => 'job_request_types', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Type'), array('controller' => 'job_request_types', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Job Request Assignments'), array('controller' => 'job_request_assignments', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Job Request Assignment'), array('controller' => 'job_request_assignments', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('JobRequestRevision', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('job_request_product_id', array('class' => 'form-control', 'placeholder' => 'Job Request Product Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('job_request_type_id', array('class' => 'form-control', 'placeholder' => 'Job Request Type Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('deadline_date', array('class' => 'form-control', 'placeholder' => 'Deadline Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('estimated_finish', array('class' => 'form-control', 'placeholder' => 'Estimated Finish'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('actual_date_finished', array('class' => 'form-control', 'placeholder' => 'Actual Date Finished'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('product_id', array('class' => 'form-control', 'placeholder' => 'Product Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
