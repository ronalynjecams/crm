<div class="employeeDetails index">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Employee Details'); ?></h1>
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
								<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp;&nbsp;New Employee Detail'), array('action' => 'add'), array('escape' => false)); ?></li>
													</ul>
						</div><!-- end body -->
				</div><!-- end panel -->
			</div><!-- end actions -->
		</div><!-- end col md 3 -->

		<div class="col-md-9">
			<table cellpadding="0" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th><?php echo $this->Paginator->sort('id'); ?></th>
						<th><?php echo $this->Paginator->sort('last_name'); ?></th>
						<th><?php echo $this->Paginator->sort('middle_name'); ?></th>
						<th><?php echo $this->Paginator->sort('nick_name'); ?></th>
						<th><?php echo $this->Paginator->sort('expected_salary'); ?></th>
						<th><?php echo $this->Paginator->sort('mobile_number'); ?></th>
						<th><?php echo $this->Paginator->sort('citizenship'); ?></th>
						<th><?php echo $this->Paginator->sort('position_applied'); ?></th>
						<th><?php echo $this->Paginator->sort('religion'); ?></th>
						<th><?php echo $this->Paginator->sort('gender'); ?></th>
						<th><?php echo $this->Paginator->sort('birth_date'); ?></th>
						<th><?php echo $this->Paginator->sort('civil_status'); ?></th>
						<th><?php echo $this->Paginator->sort('birth_place'); ?></th>
						<th><?php echo $this->Paginator->sort('sss'); ?></th>
						<th><?php echo $this->Paginator->sort('pag_ibig'); ?></th>
						<th><?php echo $this->Paginator->sort('philhealth'); ?></th>
						<th><?php echo $this->Paginator->sort('tin'); ?></th>
						<th><?php echo $this->Paginator->sort('present_municipality'); ?></th>
						<th><?php echo $this->Paginator->sort('present_city'); ?></th>
						<th><?php echo $this->Paginator->sort('present_province'); ?></th>
						<th><?php echo $this->Paginator->sort('present_zip_code'); ?></th>
						<th><?php echo $this->Paginator->sort('provincial_municipality'); ?></th>
						<th><?php echo $this->Paginator->sort('provincial_city'); ?></th>
						<th><?php echo $this->Paginator->sort('provincial_province'); ?></th>
						<th><?php echo $this->Paginator->sort('provincial_zip_code'); ?></th>
						<th><?php echo $this->Paginator->sort('emergency_name'); ?></th>
						<th><?php echo $this->Paginator->sort('emergency_address'); ?></th>
						<th><?php echo $this->Paginator->sort('emegency_mobile_number'); ?></th>
						<th><?php echo $this->Paginator->sort('father_name'); ?></th>
						<th><?php echo $this->Paginator->sort('father_birth_date'); ?></th>
						<th><?php echo $this->Paginator->sort('father_occupation'); ?></th>
						<th><?php echo $this->Paginator->sort('father_employer'); ?></th>
						<th><?php echo $this->Paginator->sort('father_mobile_number'); ?></th>
						<th><?php echo $this->Paginator->sort('father_address'); ?></th>
						<th><?php echo $this->Paginator->sort('mother_name'); ?></th>
						<th><?php echo $this->Paginator->sort('mother_birth_date'); ?></th>
						<th><?php echo $this->Paginator->sort('mother_occupation'); ?></th>
						<th><?php echo $this->Paginator->sort('mother_employer'); ?></th>
						<th><?php echo $this->Paginator->sort('mother_mobile_number'); ?></th>
						<th><?php echo $this->Paginator->sort('mother_address'); ?></th>
						<th><?php echo $this->Paginator->sort('spouse_name'); ?></th>
						<th><?php echo $this->Paginator->sort('spouse_birth_date'); ?></th>
						<th><?php echo $this->Paginator->sort('spouse_occupation'); ?></th>
						<th><?php echo $this->Paginator->sort('spouse_employer'); ?></th>
						<th><?php echo $this->Paginator->sort('spouse_mobile_number'); ?></th>
						<th><?php echo $this->Paginator->sort('spouse_address'); ?></th>
						<th><?php echo $this->Paginator->sort('children_name'); ?></th>
						<th><?php echo $this->Paginator->sort('children_birth_date'); ?></th>
						<th><?php echo $this->Paginator->sort('children_occupation'); ?></th>
						<th><?php echo $this->Paginator->sort('children_mobile_number'); ?></th>
						<th><?php echo $this->Paginator->sort('children_address'); ?></th>
						<th><?php echo $this->Paginator->sort('educational_type'); ?></th>
						<th><?php echo $this->Paginator->sort('educational_school_name'); ?></th>
						<th><?php echo $this->Paginator->sort('educational_location'); ?></th>
						<th><?php echo $this->Paginator->sort('educational_major_degree'); ?></th>
						<th><?php echo $this->Paginator->sort('educational_years'); ?></th>
						<th><?php echo $this->Paginator->sort('work_exp_employer'); ?></th>
						<th><?php echo $this->Paginator->sort('work_exp_address'); ?></th>
						<th><?php echo $this->Paginator->sort('work_exp_phone_no'); ?></th>
						<th><?php echo $this->Paginator->sort('work_exp_supervisor'); ?></th>
						<th><?php echo $this->Paginator->sort('work_exp_salary'); ?></th>
						<th><?php echo $this->Paginator->sort('work_exp_job_title'); ?></th>
						<th><?php echo $this->Paginator->sort('work_exp_reason'); ?></th>
						<th><?php echo $this->Paginator->sort('ref_name'); ?></th>
						<th><?php echo $this->Paginator->sort('ref_occupation'); ?></th>
						<th><?php echo $this->Paginator->sort('ref_company_name'); ?></th>
						<th><?php echo $this->Paginator->sort('ref_address'); ?></th>
						<th><?php echo $this->Paginator->sort('ref_phone_no'); ?></th>
						<th><?php echo $this->Paginator->sort('ref_email'); ?></th>
						<th><?php echo $this->Paginator->sort('ref_years_acquainted'); ?></th>
						<th class="actions"></th>
					</tr>
				</thead>
				<tbody>
				<?php foreach ($employeeDetails as $employeeDetail): ?>
					<tr>
						<td><?php echo h($employeeDetail['EmployeeDetail']['id']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['last_name']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['middle_name']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['nick_name']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['expected_salary']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['mobile_number']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['citizenship']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['position_applied']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['religion']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['gender']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['birth_date']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['civil_status']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['birth_place']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['sss']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['pag_ibig']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['philhealth']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['tin']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['present_municipality']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['present_city']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['present_province']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['present_zip_code']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['provincial_municipality']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['provincial_city']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['provincial_province']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['provincial_zip_code']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['emergency_name']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['emergency_address']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['emegency_mobile_number']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['father_name']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['father_birth_date']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['father_occupation']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['father_employer']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['father_mobile_number']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['father_address']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['mother_name']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['mother_birth_date']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['mother_occupation']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['mother_employer']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['mother_mobile_number']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['mother_address']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['spouse_name']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['spouse_birth_date']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['spouse_occupation']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['spouse_employer']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['spouse_mobile_number']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['spouse_address']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['children_name']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['children_birth_date']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['children_occupation']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['children_mobile_number']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['children_address']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['educational_type']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['educational_school_name']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['educational_location']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['educational_major_degree']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['educational_years']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['work_exp_employer']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['work_exp_address']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['work_exp_phone_no']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['work_exp_supervisor']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['work_exp_salary']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['work_exp_job_title']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['work_exp_reason']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['ref_name']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['ref_occupation']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['ref_company_name']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['ref_address']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['ref_phone_no']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['ref_email']); ?>&nbsp;</td>
						<td><?php echo h($employeeDetail['EmployeeDetail']['ref_years_acquainted']); ?>&nbsp;</td>
						<td class="actions">
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-search"></span>', array('action' => 'view', $employeeDetail['EmployeeDetail']['id']), array('escape' => false)); ?>
							<?php echo $this->Html->link('<span class="glyphicon glyphicon-edit"></span>', array('action' => 'edit', $employeeDetail['EmployeeDetail']['id']), array('escape' => false)); ?>
							<?php echo $this->Form->postLink('<span class="glyphicon glyphicon-remove"></span>', array('action' => 'delete', $employeeDetail['EmployeeDetail']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $employeeDetail['EmployeeDetail']['id'])); ?>
						</td>
					</tr>
				<?php endforeach; ?>
				</tbody>
			</table>

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