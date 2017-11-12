<div class="clientServiceProducts form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit Client Service Product'); ?></h1>
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

																<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('ClientServiceProduct.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('ClientServiceProduct.id'))); ?></li>
																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Client Service Products'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Products'), array('controller' => 'products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product'), array('controller' => 'products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotation Products'), array('controller' => 'quotation_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation Product'), array('controller' => 'quotation_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Product Combos'), array('controller' => 'product_combos', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product Combo'), array('controller' => 'product_combos', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('ClientServiceProduct', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('product_id', array('class' => 'form-control', 'placeholder' => 'Product Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('quotation_product_id', array('class' => 'form-control', 'placeholder' => 'Quotation Product Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('qty', array('class' => 'form-control', 'placeholder' => 'Qty'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('product_combo_id', array('class' => 'form-control', 'placeholder' => 'Product Combo Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('processed_qty', array('class' => 'form-control', 'placeholder' => 'Processed Qty'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('delivered_qty', array('class' => 'form-control', 'placeholder' => 'Delivered Qty'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('pullout_qty', array('class' => 'form-control', 'placeholder' => 'Pullout Qty'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('expected_demo_data', array('class' => 'form-control', 'placeholder' => 'Expected Demo Data'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('expected_pullout_date', array('class' => 'form-control', 'placeholder' => 'Expected Pullout Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('pullout_data', array('class' => 'form-control', 'placeholder' => 'Pullout Data'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
