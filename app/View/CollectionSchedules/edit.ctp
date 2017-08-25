<div class="collectionSchedules form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit Collection Schedule'); ?></h1>
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

																<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('CollectionSchedule.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('CollectionSchedule.id'))); ?></li>
																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Collection Schedules'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Collections'), array('controller' => 'collections', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Collection'), array('controller' => 'collections', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('CollectionSchedule', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('quotation_id', array('class' => 'form-control', 'placeholder' => 'Quotation Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('collection_id', array('class' => 'form-control', 'placeholder' => 'Collection Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('user_id', array('class' => 'form-control', 'placeholder' => 'User Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('created_by', array('class' => 'form-control', 'placeholder' => 'Created By'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('onhand', array('class' => 'form-control', 'placeholder' => 'Onhand'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('officer_remarks', array('class' => 'form-control', 'placeholder' => 'Officer Remarks'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('agent_instruction', array('class' => 'form-control', 'placeholder' => 'Agent Instruction'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
