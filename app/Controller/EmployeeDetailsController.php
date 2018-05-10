<?php
App::uses('AppController', 'Controller');

/**
 * EmployeeDetails Controller
 *
 * @property EmployeeDetail $EmployeeDetail
 * @property PaginatorComponent $Paginator
 */
class EmployeeDetailsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');
	public function beforeFilter() {
	    parent::beforeFilter();
        $this->layout = 'bootstrap';
	    $this->Auth->allow('add', 'save_employee_details');
	}

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->EmployeeDetail->recursive = 0;
		$this->set('employeeDetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->EmployeeDetail->exists($id)) {
			throw new NotFoundException(__('Invalid employee detail'));
		}
		$options = array('conditions' => array('EmployeeDetail.' . $this->EmployeeDetail->primaryKey => $id));
		$this->set('employeeDetail', $this->EmployeeDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->EmployeeDetail->exists($id)) {
			throw new NotFoundException(__('Invalid employee detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->EmployeeDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The employee detail has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The employee detail could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('EmployeeDetail.' . $this->EmployeeDetail->primaryKey => $id));
			$this->request->data = $this->EmployeeDetail->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->EmployeeDetail->id = $id;
		if (!$this->EmployeeDetail->exists()) {
			throw new NotFoundException(__('Invalid employee detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->EmployeeDetail->delete()) {
			$this->Session->setFlash(__('The employee detail has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The employee detail could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function save_employee_details() {
		$this->autoRender = false;
		$data = $this->request->data;
		$data_array = (array) json_decode($data);
		$tab1 = (array) $data_array['tab1'];
		$tab2 = (array) $data_array['tab2'];
		$tab3 = (array) $data_array['tab3'];
		$tab4 = (array) $data_array['tab4'];
		
		// TAB 1
		$last_name = $tab1['lastname'];
		$middle_name = $tab1['middlename'];
		$expected_salary = $tab1['expected_salary'];
		$mobile_number = $tab1['mobile_no'];
		$citizenship = $tab1['citizenship'];
		$nick_name = $tab1['nickname'];
		$position_applied = $tab1['position_applied'];
		$religion = $tab1['religion'];
		$gender = $tab1['gender'];
		$birth_date = $tab1['birthdate'];
		$civil_status = $tab1['civil_status'];
		$birth_place = $tab1['birthplace'];
		$sss = $tab1['sss'];
		$pag_ibig = $tab1['pagibig'];
		$philhealth = $tab1['philhealth'];
		$tin = $tab1['tin_number'];
		$present_municipality = $tab1['present_address'];
		$present_city = $tab1['present_city'];
		$present_province = $tab1['present_province'];
		$present_zip_code = $tab1['present_zip'];
		$provincial_municipality = $present_municipality;
		$provincial_city = $present_city;
		$provincial_province = $present_province;
		$provincial_zip_code = $present_zip_code;
		if($tab1['same_address']==true) {
			$provincial_municipality = $tab1['provincial_address'];
			$provincial_city = $tab1['provincial_city'];
			$provincial_province = $tab1['provincial_province'];
			$provincial_zip_code = $tab1['provincial_zip'];
		}
		// TAB 2
		$emergency_name = $tab2['emergency_name'];
		$emergency_address = $tab2['emergency_address'];
		$emergency_mobile_number = $tab2['emergency_mobile'];
		$father_name = $tab2['fathers_name'];
		$father_birth_date = $tab2['fathers_bday'];
		$father_occupation = $tab2['fathers_occupation'];
		$father_employer = $tab2['fathers_employer'];
		$father_mobile_number = $tab2['fathers_mobile'];
		$father_address = $tab2['fathers_address'];
		$mother_name = $tab2['mothers_name'];
		$mother_birth_date = $tab2['mothers_bday'];
		$mother_occupation = $tab2['mothers_occupation'];
		$mother_employer = $tab2['mothers_employer'];
		$mother_mobile_number = $tab2['mothers_mobile'];
		$mother_address = $tab2['mothers_address'];
		$spouse_name = $tab2['spouse_name'];
		$spouse_birth_date = $tab2['spouse_bday'];
		$spouse_occupation = $tab2['spouse_occupation'];
		$spouse_employer = $tab2['spouse_employer'];
		$spouse_mobile_number = $tab2['spouse_mobile'];
		$spouse_address = $tab2['spouse_address'];
		$children_name = json_encode((array)$tab2['added_child_name']);
		$children_birth_date = json_encode((array)$tab2['added_child_bday']);
		$children_occupation = json_encode((array)$tab2['added_child_occupation']);
		$children_mobile_number = json_encode((array)$tab2['added_child_mobile']);
		$children_address = json_encode((array)$tab2['added_child_address']);
		// TAB 3
		$added_type = (array)$tab3['added_type'];
		$added_school = (array)$tab3['added_school'];
		$added_location = (array)$tab3['added_location'];
		$added_degree = (array)$tab3['added_degree'];
		$added_years = (array)$tab3['added_years'];
		$educational_type = json_encode(array_merge($added_type, (array)$tab3['type']));
		$educational_school_name = json_encode(array_merge($added_school, (array)$tab3['school']));
		$educational_location = json_encode(array_merge($added_location, (array)$tab3['location']));
		$educational_major_degree = json_encode(array_merge($added_degree, (array)$tab3['degree']));
		$educational_years = json_encode(array_merge($added_years, (array)$tab3['years']));
		// TAB 4
		$work_exp_employer = $tab4['employer_name'];
		$work_exp_address = $tab4['employer_address'];
		$work_exp_phone_no = $tab4['employer_phone'];
		$work_exp_supervisor = $tab4['employer_supervisor'];
		$work_exp_salary = $tab4['employer_salary'];
		$work_exp_job_title = $tab4['employer_job'];
		$work_exp_reason = $tab4['employer_reason'];
		$added_ref_name = (array)$tab4['added_ref_name'];
		$added_ref_occupation = (array)$tab4['added_ref_occupation'];
		$added_ref_company = (array)$tab4['added_ref_company'];
		$added_ref_address = (array)$tab4['added_ref_address'];
		$added_ref_phone = (array)$tab4['added_ref_phone'];
		$added_ref_email = (array)$tab4['added_ref_email'];
		$added_ref_years = (array)$tab4['added_ref_years'];
		$ref_name = array_merge($added_ref_name, (array)$tab4['ref_name']);
		$ref_occupation = array_merge($added_ref_occupation, (array)$tab4['ref_occupation']);
		$ref_company_name = array_merge($added_ref_company, (array)$tab4['ref_company']);
		$ref_address = array_merge($added_ref_address, (array)$tab4['ref_address']);
		$ref_phone_no = array_merge($added_ref_phone, (array)$tab4['ref_phone']);
		$ref_email = array_merge($added_ref_email, (array)$tab4['ref_email']);
		$ref_years_acquainted = array_merge($added_ref_years, (array)$tab4['ref_years']);

		$employee_details_set = ['last_name'=> $last_name,
								'middle_name'=> $middle_name,
								'nick_name'=> $nick_name,
								'expected_salary'=> $expected_salary,
								'mobile_number'=> $mobile_number,
								'citizenship'=> $citizenship,
								'position_applied'=> $position_applied,
								'religion'=> $religion,
								'gender'=> $gender,
								'birth_date'=> $birth_date,
								'civil_status'=> $civil_status,
								'birth_place'=> $birth_place,
								'sss'=> $sss,
								'pag_ibig'=> $pag_ibig,
								'philhealth'=> $philhealth,
								'tin'=> $tin,
								'present_municipality'=> $present_municipality,
								'present_city'=> $present_city,
								'present_province'=> $present_province,
								'present_zip_code'=> $present_zip_code,
								'provincial_municipality'=> $provincial_municipality,
								'provincial_city'=> $provincial_city,
								'provincial_province'=> $provincial_province,
								'provincial_zip_code'=> $provincial_zip_code,
								'emergency_name'=> $emergency_name,
								'emergency_address'=> $emergency_address,
								'emergency_mobile_number'=> $emergency_mobile_number,
								'father_name'=> $father_name,
								'father_birth_date'=> $father_birth_date,
								'father_occupation'=> $father_occupation,
								'father_employer'=> $father_employer,
								'father_mobile_number'=> $father_mobile_number,
								'father_address'=> $father_address,
								'mother_name'=> $mother_name,
								'mother_birth_date'=> $mother_birth_date,
								'mother_occupation'=> $mother_occupation,
								'mother_mobile_number'=> $mother_mobile_number,
								'mother_address'=> $mother_address,
								'spouse_name'=> $spouse_name,
								'spouse_birth_date'=> $spouse_birth_date,
								'spouse_occupation'=> $spouse_occupation,
								'spouse_employer'=> $spouse_employer,
								'spouse_mobile_number'=> $spouse_mobile_number,
								'spouse_address'=> $spouse_address,
								'children_name'=> $children_name,
								'children_birth_date'=> $children_birth_date,
								'children_occupation'=> $children_occupation,
								'children_mobile_number'=> $children_mobile_number,
								'children_address'=> $children_address,
								'educational_type'=> $educational_type,
								'educational_shchool_name'=> $educational_school_name,
								'educational_location'=> $educational_location,
								'educational_major_degree'=> $educational_major_degree,
								'educational_years'=> $educational_years,
								'work_exp_employer'=> json_encode($work_exp_employer),
								'work_exp_address'=> json_encode($work_exp_address),
								'work_exp_phone_no'=> json_encode($work_exp_phone_no),
								'work_exp_supervisor'=> json_encode($work_exp_supervisor),
								'work_exp_salary'=> json_encode($work_exp_salary),
								'work_exp_job_title'=> json_encode($work_exp_job_title),
								'work_exp_reason'=> json_encode($work_exp_reason),
								'ref_name'=> json_encode($ref_name),
								'ref_occupation'=> json_encode($ref_occupation),
								'ref_company_name'=> json_encode($ref_company_name),
								'ref_address'=> json_encode($ref_address),
								'ref_phone_no'=> json_encode($ref_phone_no),
								'ref_email'=> json_encode($ref_email),
								'ref_years_acquainted'=> json_encode($ref_years_acquainted)];
		
		$this->EmployeeDetail->create();
		$this->EmployeeDetail->set($employee_details_set);
		if($this->EmployeeDetail->save()) {
			echo "EmployeeDetail successfully saved!";
		}
		else {
			echo "Error in EmployeeDetail";
			$dbo = $this->EmployeeDetail->getDatasource();
			$logs = $dbo->getLog();
			$lastLog = end($logs['log']);
			echo json_encode($lastLog);
		}
		return json_encode($employee_details_set);
	}
}
