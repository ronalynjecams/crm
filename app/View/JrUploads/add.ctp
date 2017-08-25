<div class="jrUploads form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Add Jr Upload'); ?></h1>
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

																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Jr Uploads'), array('action' => 'index'), array('escape' => false)); ?></li>
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Jr Products'), array('controller' => 'jr_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Jr Product'), array('controller' => 'jr_products', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('JrUpload', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('jr_product_id', array('class' => 'form-control', 'placeholder' => 'Jr Product Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('file', array('class' => 'form-control', 'placeholder' => 'File'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('viewed', array('class' => 'form-control', 'placeholder' => 'Viewed'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
