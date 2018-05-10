<div class="employeeDetails form">

	<div class="row">
		<div class="col-md-12">
			<div class="page-header">
				<h1><?php echo __('Edit Employee Detail'); ?></h1>
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

																<li><?php echo $this->Form->postLink(__('<span class="glyphicon glyphicon-remove"></span>&nbsp;&nbsp;Delete'), array('action' => 'delete', $this->Form->value('EmployeeDetail.id')), array('escape' => false), __('Are you sure you want to delete # %s?', $this->Form->value('EmployeeDetail.id'))); ?></li>
																<li><?php echo $this->Html->link(__('<span class="glyphicon glyphicon-list"></span>&nbsp;&nbsp;List Employee Details'), array('action' => 'index'), array('escape' => false)); ?></li>
														</ul>
						</div>
					</div>
				</div>			
		</div><!-- end col md 3 -->
		<div class="col-md-9">
			<?php echo $this->Form->create('EmployeeDetail', array('role' => 'form')); ?>

				<div class="form-group">
					<?php echo $this->Form->input('id', array('class' => 'form-control', 'placeholder' => 'Id'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('last_name', array('class' => 'form-control', 'placeholder' => 'Last Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('middle_name', array('class' => 'form-control', 'placeholder' => 'Middle Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('nick_name', array('class' => 'form-control', 'placeholder' => 'Nick Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('expected_salary', array('class' => 'form-control', 'placeholder' => 'Expected Salary'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('mobile_number', array('class' => 'form-control', 'placeholder' => 'Mobile Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('citizenship', array('class' => 'form-control', 'placeholder' => 'Citizenship'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('position_applied', array('class' => 'form-control', 'placeholder' => 'Position Applied'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('religion', array('class' => 'form-control', 'placeholder' => 'Religion'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('gender', array('class' => 'form-control', 'placeholder' => 'Gender'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('birth_date', array('class' => 'form-control', 'placeholder' => 'Birth Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('civil_status', array('class' => 'form-control', 'placeholder' => 'Civil Status'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('birth_place', array('class' => 'form-control', 'placeholder' => 'Birth Place'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('sss', array('class' => 'form-control', 'placeholder' => 'Sss'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('pag_ibig', array('class' => 'form-control', 'placeholder' => 'Pag Ibig'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('philhealth', array('class' => 'form-control', 'placeholder' => 'Philhealth'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('tin', array('class' => 'form-control', 'placeholder' => 'Tin'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('present_municipality', array('class' => 'form-control', 'placeholder' => 'Present Municipality'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('present_city', array('class' => 'form-control', 'placeholder' => 'Present City'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('present_province', array('class' => 'form-control', 'placeholder' => 'Present Province'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('present_zip_code', array('class' => 'form-control', 'placeholder' => 'Present Zip Code'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('provincial_municipality', array('class' => 'form-control', 'placeholder' => 'Provincial Municipality'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('provincial_city', array('class' => 'form-control', 'placeholder' => 'Provincial City'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('provincial_province', array('class' => 'form-control', 'placeholder' => 'Provincial Province'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('provincial_zip_code', array('class' => 'form-control', 'placeholder' => 'Provincial Zip Code'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('emergency_name', array('class' => 'form-control', 'placeholder' => 'Emergency Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('emergency_address', array('class' => 'form-control', 'placeholder' => 'Emergency Address'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('emegency_mobile_number', array('class' => 'form-control', 'placeholder' => 'Emegency Mobile Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('father_name', array('class' => 'form-control', 'placeholder' => 'Father Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('father_birth_date', array('class' => 'form-control', 'placeholder' => 'Father Birth Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('father_occupation', array('class' => 'form-control', 'placeholder' => 'Father Occupation'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('father_employer', array('class' => 'form-control', 'placeholder' => 'Father Employer'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('father_mobile_number', array('class' => 'form-control', 'placeholder' => 'Father Mobile Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('father_address', array('class' => 'form-control', 'placeholder' => 'Father Address'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('mother_name', array('class' => 'form-control', 'placeholder' => 'Mother Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('mother_birth_date', array('class' => 'form-control', 'placeholder' => 'Mother Birth Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('mother_occupation', array('class' => 'form-control', 'placeholder' => 'Mother Occupation'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('mother_employer', array('class' => 'form-control', 'placeholder' => 'Mother Employer'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('mother_mobile_number', array('class' => 'form-control', 'placeholder' => 'Mother Mobile Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('mother_address', array('class' => 'form-control', 'placeholder' => 'Mother Address'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('spouse_name', array('class' => 'form-control', 'placeholder' => 'Spouse Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('spouse_birth_date', array('class' => 'form-control', 'placeholder' => 'Spouse Birth Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('spouse_occupation', array('class' => 'form-control', 'placeholder' => 'Spouse Occupation'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('spouse_employer', array('class' => 'form-control', 'placeholder' => 'Spouse Employer'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('spouse_mobile_number', array('class' => 'form-control', 'placeholder' => 'Spouse Mobile Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('spouse_address', array('class' => 'form-control', 'placeholder' => 'Spouse Address'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('children_name', array('class' => 'form-control', 'placeholder' => 'Children Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('children_birth_date', array('class' => 'form-control', 'placeholder' => 'Children Birth Date'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('children_occupation', array('class' => 'form-control', 'placeholder' => 'Children Occupation'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('children_mobile_number', array('class' => 'form-control', 'placeholder' => 'Children Mobile Number'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('children_address', array('class' => 'form-control', 'placeholder' => 'Children Address'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('educational_type', array('class' => 'form-control', 'placeholder' => 'Educational Type'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('educational_school_name', array('class' => 'form-control', 'placeholder' => 'Educational School Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('educational_location', array('class' => 'form-control', 'placeholder' => 'Educational Location'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('educational_major_degree', array('class' => 'form-control', 'placeholder' => 'Educational Major Degree'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('educational_years', array('class' => 'form-control', 'placeholder' => 'Educational Years'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('work_exp_employer', array('class' => 'form-control', 'placeholder' => 'Work Exp Employer'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('work_exp_address', array('class' => 'form-control', 'placeholder' => 'Work Exp Address'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('work_exp_phone_no', array('class' => 'form-control', 'placeholder' => 'Work Exp Phone No'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('work_exp_supervisor', array('class' => 'form-control', 'placeholder' => 'Work Exp Supervisor'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('work_exp_salary', array('class' => 'form-control', 'placeholder' => 'Work Exp Salary'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('work_exp_job_title', array('class' => 'form-control', 'placeholder' => 'Work Exp Job Title'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('work_exp_reason', array('class' => 'form-control', 'placeholder' => 'Work Exp Reason'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ref_name', array('class' => 'form-control', 'placeholder' => 'Ref Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ref_occupation', array('class' => 'form-control', 'placeholder' => 'Ref Occupation'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ref_company_name', array('class' => 'form-control', 'placeholder' => 'Ref Company Name'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ref_address', array('class' => 'form-control', 'placeholder' => 'Ref Address'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ref_phone_no', array('class' => 'form-control', 'placeholder' => 'Ref Phone No'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ref_email', array('class' => 'form-control', 'placeholder' => 'Ref Email'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->input('ref_years_acquainted', array('class' => 'form-control', 'placeholder' => 'Ref Years Acquainted'));?>
				</div>
				<div class="form-group">
					<?php echo $this->Form->submit(__('Submit'), array('class' => 'btn btn-default')); ?>
				</div>

			<?php echo $this->Form->end() ?>

		</div><!-- end col md 12 -->
	</div><!-- end row -->
</div>
