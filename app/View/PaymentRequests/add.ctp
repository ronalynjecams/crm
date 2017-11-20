<div class="paymentRequests form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Payment Request'); ?></h1>
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

																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Payment Requests'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('controller' => 'users', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New User'), array('controller' => 'users', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Suppliers'), array('controller' => 'suppliers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Supplier'), array('controller' => 'suppliers', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('PaymentRequest', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('type', array('class' => 'form-control', 'placeholder' => 'Type'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('requested_amount', array('class' => 'form-control', 'placeholder' => 'Requested Amount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('purpose', array('class' => 'form-control', 'placeholder' => 'Purpose'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('user_id', array('class' => 'form-control', 'placeholder' => 'User Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('released_amount', array('class' => 'form-control', 'placeholder' => 'Released Amount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('liquidated_amount', array('class' => 'form-control', 'placeholder' => 'Liquidated Amount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('reimbursed_amount', array('class' => 'form-control', 'placeholder' => 'Reimbursed Amount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('returned_amount', array('class' => 'form-control', 'placeholder' => 'Returned Amount'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ewt_released', array('class' => 'form-control', 'placeholder' => 'Ewt Released'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ewt_returned', array('class' => 'form-control', 'placeholder' => 'Ewt Returned'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('replenished_date', array('class' => 'form-control', 'placeholder' => 'Replenished Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('supplier_id', array('class' => 'form-control', 'placeholder' => 'Supplier Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('inserted_by', array('class' => 'form-control', 'placeholder' => 'Inserted By'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
