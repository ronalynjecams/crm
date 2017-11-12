<div class="billMonitorings form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Bill Monitoring'); ?></h1>
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

																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Bill Monitorings'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Bills'), array('controller' => 'bills', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Bill'), array('controller' => 'bills', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('BillMonitoring', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('receipt_reference_num', array('class' => 'form-control', 'placeholder' => 'Receipt Reference Num'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('payment_mode', array('class' => 'form-control', 'placeholder' => 'Payment Mode'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('billing_date_from', array('class' => 'form-control', 'placeholder' => 'Billing Date From'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('billing_date_to', array('class' => 'form-control', 'placeholder' => 'Billing Date To'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('user_id', array('class' => 'form-control', 'placeholder' => 'User Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('bill_id', array('class' => 'form-control', 'placeholder' => 'Bill Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('paid_by', array('class' => 'form-control', 'placeholder' => 'Paid By'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('receipt_date', array('class' => 'form-control', 'placeholder' => 'Receipt Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
