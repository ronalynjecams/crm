<div class="productSourceProperties form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Product Source Property'); ?></h1>
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

																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Product Source Properties'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Product Sources'), array('controller' => 'product_sources', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product Source'), array('controller' => 'product_sources', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('ProductSourceProperty', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('property', array('class' => 'form-control', 'placeholder' => 'Property'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('value', array('class' => 'form-control', 'placeholder' => 'Value'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('product_source_id', array('class' => 'form-control', 'placeholder' => 'Product Source Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('qty', array('class' => 'form-control', 'placeholder' => 'Qty'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
