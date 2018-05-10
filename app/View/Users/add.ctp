<?php
if($UserIn['User']['role']=="proprietor") { ?>
<div id="content-container">
	<div class="users form">
		<div id="page-title">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header">
						<h1><?php echo __('Add User'); ?></h1>
					</div>
				</div>
			</div>
		</div>
	
	
	
		<div id="page-content">
			<?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('action' => 'index'), array('escape' => false)); ?></li>
			<?php echo $this->Form->create('User', array('role' => 'form')); ?>
	
				<div class="form-group">
					<?php echo $this->Form->input('first_name', array('class' => 'form-control', 'placeholder' => 'First Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('last_name', array('class' => 'form-control', 'placeholder' => 'Last Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('username', array('class' => 'form-control', 'placeholder' => 'Username'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('password', array('class' => 'form-control', 'placeholder' => 'Password'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('role', array('class' => 'form-control', 'placeholder' => 'Role'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('position_id', array('class' => 'form-control', 'placeholder' => 'Position Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('department_id', array('class' => 'form-control', 'placeholder' => 'Department Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('active', array('class' => 'form-control', 'placeholder' => 'Active'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>
		</div><!-- end row -->
	</div>
</div>
<?php
}
else {
	echo '
	<div id="content-container">
		<div id="page-title">
		<h1 class="page-header text-overflow">Welcome '.$UserIn['User']['first_name'].' !</h1></div>
	</div>
	';
}
?>