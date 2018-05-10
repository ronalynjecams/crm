<div class="pullouts form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit Pullout'); ?></h1>
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

																<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('Pullout.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('Pullout.id'))); ?></li>
																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Pullouts'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Client Services'), array('controller' => 'client_services', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client Service'), array('controller' => 'client_services', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Client Service Products'), array('controller' => 'client_service_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Client Service Product'), array('controller' => 'client_service_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Pullout Logs'), array('controller' => 'pullout_logs', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Pullout Log'), array('controller' => 'pullout_logs', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('Pullout', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('type', array('class' => 'form-control', 'placeholder' => 'Type'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('status', array('class' => 'form-control', 'placeholder' => 'Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('delivered_qty', array('class' => 'form-control', 'placeholder' => 'Delivered Qty'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('date_delivered', array('class' => 'form-control', 'placeholder' => 'Date Delivered'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('pullout_qty', array('class' => 'form-control', 'placeholder' => 'Pullout Qty'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('qty_success', array('class' => 'form-control', 'placeholder' => 'Qty Success'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('expected_pullout_date', array('class' => 'form-control', 'placeholder' => 'Expected Pullout Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('pullout_date', array('class' => 'form-control', 'placeholder' => 'Pullout Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('delivery_mode', array('class' => 'form-control', 'placeholder' => 'Delivery Mode'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('reference_product_number', array('class' => 'form-control', 'placeholder' => 'Reference Product Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('reference_number', array('class' => 'form-control', 'placeholder' => 'Reference Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
