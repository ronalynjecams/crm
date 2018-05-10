<div id="content-container">
<div class="vehicles form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Vehicle'); ?></h1>
			</div>
		</div>
	</div>



	<!--<div class="row">-->
	<!--	<div class="col-md-3">-->
	<!--		<div class="actions">-->
	<!--			<div class="panel panel-default">-->
	<!--				<div class="panel-heading">Actions</div>-->
	<!--					<div class="panel-body">-->
	<!--						<ul class="nav nav-pills nav-stacked">-->

	<!--															<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Vehicles'), array('action' => 'index'), array('escape' => false)); ?></li>-->
	<!--								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Delivery Iteneraries'), array('controller' => 'delivery_iteneraries', 'action' => 'index'), array('escape' => false)); ?> </li>-->
	<!--	<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Delivery Itenerary'), array('controller' => 'delivery_iteneraries', 'action' => 'add'), array('escape' => false)); ?> </li>-->
	<!--						</ul>-->
	<!--					</div>-->
	<!--				</div>-->
	<!--			</div>			-->
	<!--	</div><!-- end col md 3 -->-->
		<div class="col-md-9">
			<?php echo $this->Form->create('Vehicle', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('plate_number', array('class' => 'form-control', 'placeholder' => 'Plate Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('brand', array('class' => 'form-control', 'placeholder' => 'Brand'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('type', array('class' => 'form-control', 'placeholder' => 'jecams or transportify'));?>
					<?php
				// 	$form->input('tree_id', array('options' => $trees));
					// echo $this->Form->input('type', array('options' => array('jecams','transportify'), 'class' => 'form-control', 'placeholder' => 'Type'));
					?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
</div>
