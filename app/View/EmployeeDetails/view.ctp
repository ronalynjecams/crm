<div class="employeeDetails view">
	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Employee Detail'); ?></h1>
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
									<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-edit"></span>&nbsp&nbsp;Edit Employee Detail'), array('action' => 'edit', $employeeDetail['EmployeeDetail']['id']), array('escape' => false)); ?> </li>
		<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete Employee Detail'), array('action' => 'delete', $employeeDetail['EmployeeDetail']['id']), array('escape' => false), __('Are you sure you want to delete # %s?', $employeeDetail['EmployeeDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp&nbsp;List Employee Details'), array('action' => 'index'), array('escape' => false)); ?> </li>
		<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-plus"></span>&nbsp&nbsp;New Employee Detail'), array('action' => 'add'), array('escape' => false)); ?> </li>
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
			<?php echo h($employeeDetail['EmployeeDetail']['id']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Last Name'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['last_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Middle Name'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['middle_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Nick Name'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['nick_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Expected Salary'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['expected_salary']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Mobile Number'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['mobile_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Citizenship'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['citizenship']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Position Applied'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['position_applied']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Religion'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['religion']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Gender'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['gender']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Birth Date'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['birth_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Civil Status'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['civil_status']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Birth Place'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['birth_place']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Sss'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['sss']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Pag Ibig'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['pag_ibig']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Philhealth'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['philhealth']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Tin'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['tin']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Present Municipality'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['present_municipality']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Present City'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['present_city']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Present Province'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['present_province']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Present Zip Code'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['present_zip_code']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Provincial Municipality'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['provincial_municipality']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Provincial City'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['provincial_city']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Provincial Province'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['provincial_province']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Provincial Zip Code'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['provincial_zip_code']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Emergency Name'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['emergency_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Emergency Address'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['emergency_address']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Emegency Mobile Number'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['emegency_mobile_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Father Name'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['father_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Father Birth Date'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['father_birth_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Father Occupation'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['father_occupation']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Father Employer'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['father_employer']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Father Mobile Number'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['father_mobile_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Father Address'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['father_address']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Mother Name'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['mother_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Mother Birth Date'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['mother_birth_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Mother Occupation'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['mother_occupation']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Mother Employer'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['mother_employer']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Mother Mobile Number'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['mother_mobile_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Mother Address'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['mother_address']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Spouse Name'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['spouse_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Spouse Birth Date'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['spouse_birth_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Spouse Occupation'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['spouse_occupation']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Spouse Employer'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['spouse_employer']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Spouse Mobile Number'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['spouse_mobile_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Spouse Address'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['spouse_address']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Children Name'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['children_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Children Birth Date'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['children_birth_date']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Children Occupation'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['children_occupation']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Children Mobile Number'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['children_mobile_number']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Children Address'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['children_address']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Educational Type'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['educational_type']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Educational School Name'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['educational_school_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Educational Location'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['educational_location']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Educational Major Degree'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['educational_major_degree']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Educational Years'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['educational_years']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Work Exp Employer'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['work_exp_employer']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Work Exp Address'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['work_exp_address']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Work Exp Phone No'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['work_exp_phone_no']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Work Exp Supervisor'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['work_exp_supervisor']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Work Exp Salary'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['work_exp_salary']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Work Exp Job Title'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['work_exp_job_title']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Work Exp Reason'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['work_exp_reason']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ref Name'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['ref_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ref Occupation'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['ref_occupation']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ref Company Name'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['ref_company_name']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ref Address'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['ref_address']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ref Phone No'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['ref_phone_no']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ref Email'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['ref_email']); ?>
			&nbsp;
		</td>
</tr>
<tr>
		<th><?php echo __('Ref Years Acquainted'); ?></th>
		<td>
			<?php echo h($employeeDetail['EmployeeDetail']['ref_years_acquainted']); ?>
			&nbsp;
		</td>
</tr>
				</tbody>
			</table>

		</div><!-- end col md 9 -->

	</div>
</div>

