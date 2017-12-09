<div class="transactionSources form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Transaction Source'); ?></h1>
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

																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Transaction Sources'), array('action' => 'index'), array('escape' => false)); ?></li>
														</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('TransactionSource', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('reference_num', array('class' => 'form-control', 'placeholder' => 'Reference Num'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('reference_type', array('class' => 'form-control', 'placeholder' => 'Reference Type'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('mode', array('class' => 'form-control', 'placeholder' => 'Mode'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('mode_num', array('class' => 'form-control', 'placeholder' => 'Mode Num'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('product_combo_id', array('class' => 'form-control', 'placeholder' => 'Product Combo Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
