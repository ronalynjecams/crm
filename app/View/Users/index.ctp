<?php
$role = $UserIn['User']['role'];

if($role=='proprietor' || $role=='super_admin') {
?>

<div id="content-container">
	<div class="users index">
	
		<div id="page-title">
			<div class="col-md-12">
				<div class="page-header">
					<h1><?php echo __('Users'); ?></h1>
				</div>
			</div><!-- end col md 12 -->
		</div><!-- end row -->
	
	
	
		<div id="page-content">
			<div class="table-responsive">
				<table cellpadding="0" cellspacing="0" class="table table-striped table-responsive">
					<thead>
						<tr>
							<th><?php echo $this->Paginator->sort('id'); ?></th>
							<th><?php echo $this->Paginator->sort('username'); ?></th>
							<th><?php echo $this->Paginator->sort('password'); ?></th>
							<th><?php echo $this->Paginator->sort('role'); ?></th>
							<th><?php echo $this->Paginator->sort('position_id'); ?></th>
							<th><?php echo $this->Paginator->sort('department_id'); ?></th>
							<th><?php echo $this->Paginator->sort('active'); ?></th>
							<th><?php echo $this->Paginator->sort('created'); ?></th>
							<th><?php echo $this->Paginator->sort('modified'); ?></th>
							<th class="actions"></th>
						</tr>
					</thead>
					<tbody>
					<?php foreach ($users as $user): ?>
						<tr>
							<td><?php echo h($user['User']['id']); ?>&nbsp;</td>
							<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
							<td><?php echo h($user['User']['password']); ?>&nbsp;</td>
							<td><?php echo h($user['User']['role']); ?>&nbsp;</td>
							<td><?php echo h($user['User']['position_id']); ?>&nbsp;</td>
							<td><?php echo h($user['User']['department_id']); ?>&nbsp;</td>
							<td><?php echo h($user['User']['active']); ?>&nbsp;</td>
							<td><?php echo h($user['User']['created']); ?>&nbsp;</td>
							<td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
							<td class="actions">
								<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $user['User']['id']), array('escape' => false)); ?>
								<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $user['User']['id']), array('escape' => false)); ?>
								<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $user['User']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
							</td>
						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
				</div>
				<p>
					<small><?php echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));?></small>
				</p>
	
				<?php
				$params = $this->Paginator->params();
				if ($params['pageCount'] > 1) {
				?>
				<ul class="pagination pagination-sm">
					<?php
						echo $this->Paginator->prev('&larr; Previous', array('class' => 'prev','tag' => 'li','escape' => false), '<a onclick="return false;">&larr; Previous</a>', array('class' => 'prev disabled','tag' => 'li','escape' => false));
						echo $this->Paginator->numbers(array('separator' => '','tag' => 'li','currentClass' => 'active','currentTag' => 'a'));
						echo $this->Paginator->next('Next &rarr;', array('class' => 'next','tag' => 'li','escape' => false), '<a onclick="return false;">Next &rarr;</a>', array('class' => 'next disabled','tag' => 'li','escape' => false));
					?>
				</ul>
				<?php } ?>
	
			</div> <!-- end col md 9 -->
		</div><!-- end row -->


</div><!-- end containing of content -->
<?php
}
else {
	echo "
	<div id='content-container'>
		<div id='page-title'>
			<h1 class='page-header text-overflow'>Welcome ".$UserIn['User']['first_name']." !</h1>
		</div>
	</div>
	";
}
?>