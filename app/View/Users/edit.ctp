<?php
if($UserIn['User']['role']=="proprietor") { ?>
<div id="content-container">
	<div class="users form">
	
		<div class="page-title">
			<div class="col-md-12">
				<div class="page-header">
					<h1><?php echo __('Edit User'); ?></h1>
				</div>
			</div>
		</div>
	
	
	
		<div class="page-content">
			<div class="col-md-3">
				<div class="actions">
					<div class="panel panel-default">
						<div class="panel-heading"> <h3 class="panel-title">Actions</h3></div>
							<div class="panel-body">
								<ul class="nav nav-pills nav-stacked">
	
																	<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('User.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
																	<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Users'), array('action' => 'index'), array('escape' => false)); ?></li>
															</ul>
							</div>
						</div>
					</div>			
			</div><!-- end col md 3 -->
			<div class="col-md-9">
				<?php echo $this->Form->create('User', array('role' => 'form')); ?>
	
					<div class="form-group">
						<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
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
	
			</div><!-- end col md 12 -->
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