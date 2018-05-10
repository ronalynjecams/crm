<div class="inventoryProductDetails form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Inventory Product Detail'); ?></h1>
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

																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Inventory Product Details'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Product Combos'), array('controller' => 'product_combos', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product Combo'), array('controller' => 'product_combos', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Inv Locations'), array('controller' => 'inv_locations', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inv Location'), array('controller' => 'inv_locations', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Inventory Statuses'), array('controller' => 'inventory_statuses', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Inventory Status'), array('controller' => 'inventory_statuses', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Suppliers'), array('controller' => 'suppliers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Supplier'), array('controller' => 'suppliers', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('InventoryProductDetail', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('product_combo_id', array('class' => 'form-control', 'placeholder' => 'Product Combo Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('inv_location_id', array('class' => 'form-control', 'placeholder' => 'Inv Location Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('inventory_status_id', array('class' => 'form-control', 'placeholder' => 'Inventory Status Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('supplier_id', array('class' => 'form-control', 'placeholder' => 'Supplier Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('min_stock_level', array('class' => 'form-control', 'placeholder' => 'Min Stock Level'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('max_stock_level', array('class' => 'form-control', 'placeholder' => 'Max Stock Level'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('qty', array('class' => 'form-control', 'placeholder' => 'Qty'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('initial_qty', array('class' => 'form-control', 'placeholder' => 'Initial Qty'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('qr_code', array('class' => 'form-control', 'placeholder' => 'Qr Code'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('qr_image', array('class' => 'form-control', 'placeholder' => 'Qr Image'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
