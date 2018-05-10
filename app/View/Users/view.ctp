<?php
if($UserIn['User']['role']=="proprietor") { ?>
<div id="content-container">
	<div class="users view">
		<div id="page-title">
			<div class="col-md-12">
				<div class="page-header">
					<h1><?php echo __('User'); ?></h1>
				</div>
			</div>
		</div>
	
		<div id="page-content">
	
			<div class="col-md-3">
				<div class="actions">
					<div class="panel panel-default">
						<div class="panel-heading"><h3 class="panel-title">Actions</h3></div>
							<div class="panel-body">
								<ul class="nav nav-pills nav-stacked">
										<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit User'), array('action' => 'edit', $user['User']['id']), array('escape' => false)); ?> </li>
			<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete User'), array('action' => 'delete', $user['User']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
			<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Users'), array('action' => 'index'), array('escape' => false)); ?> </li>
			<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New User'), array('action' => 'add'), array('escape' => false)); ?> </li>
								</ul>
							</div><!-- end body -->
					</div><!-- end panel -->
				</div><!-- end actions -->
			</div><!-- end col md 3 -->
	
			<div class="col-md-9">		
			<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" class="table table-striped">
					<tbody>
					<tr>
			<th><?php echo __('Id'); ?></th>
			<td>
				<?php echo h($user['User']['id']); ?>
				&nbsp;
			</td>
	</tr>
	<tr>
			<th><?php echo __('Username'); ?></th>
			<td>
				<?php echo h($user['User']['username']); ?>
				&nbsp;
			</td>
	</tr>
	<tr>
			<th><?php echo __('Password'); ?></th>
			<td>
				<?php echo h($user['User']['password']); ?>
				&nbsp;
			</td>
	</tr>
	<tr>
			<th><?php echo __('Role'); ?></th>
			<td>
				<?php echo h($user['User']['role']); ?>
				&nbsp;
			</td>
	</tr>
	<tr>
			<th><?php echo __('Position Id'); ?></th>
			<td>
				<?php echo h($user['User']['position_id']); ?>
				&nbsp;
			</td>
	</tr>
	<tr>
			<th><?php echo __('Department Id'); ?></th>
			<td>
				<?php echo h($user['User']['department_id']); ?>
				&nbsp;
			</td>
	</tr>
	<tr>
			<th><?php echo __('Active'); ?></th>
			<td>
				<?php echo h($user['User']['active']); ?>
				&nbsp;
			</td>
	</tr>
	<tr>
			<th><?php echo __('Created'); ?></th>
			<td>
				<?php echo h($user['User']['created']); ?>
				&nbsp;
			</td>
	</tr>
	<tr>
			<th><?php echo __('Modified'); ?></th>
			<td>
				<?php echo h($user['User']['modified']); ?>
				&nbsp;
			</td>
	</tr>
					</tbody>
				</table>
				</div>
			</div><!-- end col md 9 -->
	
		</div>
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