<div class="collectionPapers view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Collection Paper'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Collection Paper'), array('action' => 'edit', $collectionPaper['CollectionPaper']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Collection Paper'), array('action' => 'delete', $collectionPaper['CollectionPaper']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $collectionPaper['CollectionPaper']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Collection Papers'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Collection Paper'), array('action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Accounting Papers'), array('controller' => 'accounting_papers', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Accounting Paper'), array('controller' => 'accounting_papers', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">			
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<tbody>
				<tr>
		<th><?php echo __('Id'); ?></th>
		<td>
			<?php echo h($collectionPaper['CollectionPaper']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ref Number'); ?></th>
		<td>
			<?php echo h($collectionPaper['CollectionPaper']['ref_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ref Date'); ?></th>
		<td>
			<?php echo h($collectionPaper['CollectionPaper']['ref_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Amount'); ?></th>
		<td>
			<?php echo h($collectionPaper['CollectionPaper']['amount']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Accounting Paper'); ?></th>
		<td>
			<?php echo $this->Html->link($collectionPaper['AccountingPaper']['name'], array('controller' => 'accounting_papers', 'action' => 'view', $collectionPaper['AccountingPaper']['id'])); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Status'); ?></th>
		<td>
			<?php echo h($collectionPaper['CollectionPaper']['status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Created'); ?></th>
		<td>
			<?php echo h($collectionPaper['CollectionPaper']['created']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Modified'); ?></th>
		<td>
			<?php echo h($collectionPaper['CollectionPaper']['modified']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

