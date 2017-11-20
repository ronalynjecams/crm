<div class="paymentRequestCheques form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Payment Request Cheque'); ?></h1>
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

																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Payment Request Cheques'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Payment Requests'), array('controller' => 'payment_requests', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Payment Request'), array('controller' => 'payment_requests', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Payees'), array('controller' => 'payees', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Payee'), array('controller' => 'payees', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Banks'), array('controller' => 'banks', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Bank'), array('controller' => 'banks', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('PaymentRequestCheque', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('payment_request_id', array('class' => 'form-control', 'placeholder' => 'Payment Request Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('cheque_number', array('class' => 'form-control', 'placeholder' => 'Cheque Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('payee_id', array('class' => 'form-control', 'placeholder' => 'Payee Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('cheque_date', array('class' => 'form-control', 'placeholder' => 'Cheque Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('void_reason', array('class' => 'form-control', 'placeholder' => 'Void Reason'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('bank_id', array('class' => 'form-control', 'placeholder' => 'Bank Id'));?>
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
