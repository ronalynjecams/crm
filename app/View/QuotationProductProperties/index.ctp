<div class="quotationProductProperties index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Quotation Product Properties'); ?></h1>
			</div>
		</div><!-- end col md 12 -->
	</div><!-- end row -->



	<div class="row">

		<div class="col-md-3">
			<div class="actions">
				<div class="panel panel-default">
					<div class="panel-heading">Actions</div>
						<div class="panel-body">
							<ul class="nav nav-pills nav-stacked">
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation Product Property'), array('action' => 'add'), array('escape' => false)); ?></li>
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Quotation Products'), array('controller' => 'quotation_products', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Quotation Product'), array('controller' => 'quotation_products', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Product Properties'), array('controller' => 'product_properties', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product Property'), array('controller' => 'product_properties', 'action' => 'add'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Product Values'), array('controller' => 'product_values', 'action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Product Value'), array('controller' => 'product_values', 'action' => 'add'), array('escape' => false)); ?> </li>
							</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<div class="table-responsive">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('quotation_product_id'); ?></th>
						<th><?php echo $this->Paginator->sort('property'); ?></th>
						<th><?php echo $this->Paginator->sort('value'); ?></th>
						<th><?php echo $this->Paginator->sort('product_property_id'); ?></th>
						<th><?php echo $this->Paginator->sort('product_value_id'); ?></th>
						<th><?php echo $this->Paginator->sort('created'); ?></th>
						<th><?php echo $this->Paginator->sort('modified'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($quotationProductProperties as $quotationProductProperty): ?>
					<tr>
						<td><?php echo h($quotationProductProperty['QuotationProductProperty']['id']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($quotationProductProperty['QuotationProduct']['id'], array('controller' => 'quotation_products', 'action' => 'view', $quotationProductProperty['QuotationProduct']['id'])); ?>
		</td>
						<td><?php echo h($quotationProductProperty['QuotationProductProperty']['property']); ?>&nbsp;</td>
						<td><?php echo h($quotationProductProperty['QuotationProductProperty']['value']); ?>&nbsp;</td>
								<td>
			<?php echo $this->Html->link($quotationProductProperty['ProductProperty']['name'], array('controller' => 'product_properties', 'action' => 'view', $quotationProductProperty['ProductProperty']['id'])); ?>
		</td>
								<td>
			<?php echo $this->Html->link($quotationProductProperty['ProductValue']['id'], array('controller' => 'product_values', 'action' => 'view', $quotationProductProperty['ProductValue']['id'])); ?>
		</td>
						<td><?php echo h($quotationProductProperty['QuotationProductProperty']['created']); ?>&nbsp;</td>
						<td><?php echo h($quotationProductProperty['QuotationProductProperty']['modified']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $quotationProductProperty['QuotationProductProperty']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $quotationProductProperty['QuotationProductProperty']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $quotationProductProperty['QuotationProductProperty']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $quotationProductProperty['QuotationProductProperty']['id'])); ?>
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