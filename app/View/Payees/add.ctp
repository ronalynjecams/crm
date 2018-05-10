
      <div id="content-container">
<div class="payees form">

	<div class="row">
		 <div class="col-md-2">  
	 </div> 
		<div class="col-md-9">
			<div class="page-header">
				<h1><?php echo __('Add Payee'); ?></h1>
			</div>
		</div>
	</div>



	<div class="row">
		 <div class="col-md-2">  
	 </div> 
		<div class="col-md-9">
			<?php echo $this->Form->create('Payee', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('name', array('class' => 'form-control', 'placeholder' => 'Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
</div>
