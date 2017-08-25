<div class="collections form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit Collection'); ?></h1>
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

																<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('Collection.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('Collection.id'))); ?></li>
																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Collections'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotations'), array('controller' => 'quotations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation'), array('controller' => 'quotations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Banks'), array('controller' => 'banks', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Bank'), array('controller' => 'banks', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Collection Schedules'), array('controller' => 'collection_schedules', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Collection Schedule'), array('controller' => 'collection_schedules', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('Collection', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('quotation_id', array('class' => 'form-control', 'placeholder' => 'Quotation Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('user_id', array('class' => 'form-control', 'placeholder' => 'User Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('bank_id', array('class' => 'form-control', 'placeholder' => 'Bank Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('type', array('class' => 'form-control', 'placeholder' => 'Type'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('amount_paid', array('class' => 'form-control', 'placeholder' => 'Amount Paid'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('with_held', array('class' => 'form-control', 'placeholder' => 'With Held'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('payment_mode', array('class' => 'form-control', 'placeholder' => 'Payment Mode'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('check_number', array('class' => 'form-control', 'placeholder' => 'Check Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('check_date', array('class' => 'form-control', 'placeholder' => 'Check Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('date_deleted', array('class' => 'form-control', 'placeholder' => 'Date Deleted'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('date_updated', array('class' => 'form-control', 'placeholder' => 'Date Updated'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('date_completed', array('class' => 'form-control', 'placeholder' => 'Date Completed'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
