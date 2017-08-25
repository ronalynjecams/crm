<div class="prodInvLocationProperties form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit Prod Inv Location Property'); ?></h1>
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

																<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('ProdInvLocationProperty.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('ProdInvLocationProperty.id'))); ?></li>
																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Prod Inv Location Properties'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Prod Inv Locations'), array('controller' => 'prod_inv_locations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Prod Inv Location'), array('controller' => 'prod_inv_locations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Prod Inv Conditions'), array('controller' => 'prod_inv_conditions', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Prod Inv Condition'), array('controller' => 'prod_inv_conditions', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('ProdInvLocationProperty', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('prod_inv_location_id', array('class' => 'form-control', 'placeholder' => 'Prod Inv Location Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('qty', array('class' => 'form-control', 'placeholder' => 'Qty'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('property', array('class' => 'form-control', 'placeholder' => 'Property'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('value', array('class' => 'form-control', 'placeholder' => 'Value'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
