<?php
/**
 * EmployeeDetail Fixture
 */
class EmployeeDetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'last_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'first_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'nick_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'expected_salary' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'mobile_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'citizenship' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'position_applied' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'religion' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'birth_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'birth_place' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'sss' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => false),
		'pag_ibig' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => false),
		'philhealth' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => false),
		'tin' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 20, 'unsigned' => false),
		'present_municipality' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'present_city' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'present_province' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'present_zip_code' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'provincial_municipality' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'provincial_city' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'provincial_province' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'provincial_zip_code' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'emergency_name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'emergency_address' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'emegency_mobile_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'father_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'father_birth_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'father_occupation' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'father_employer' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'father_mobile_number' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'father_address' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mother_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mother_birth_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'mother_occupation' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mother_employer' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mother_mobile_number' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'mother_address' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'spouse_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'spouse_birth_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'spouse_occupation' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'spouse_employer' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'spouse_mobile_number' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'spouse_address' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'children_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'children_birth_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'children_occupation' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'children_employer' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'children_mobiler_number' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'children_address' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'educational_school_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'educational_location' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'educational_major_degree' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'educational_years' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'work_exp_employer' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'work_exp_address' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'work_exp_phone_no' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'work_exp_supervisor' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'work_exp_salary' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'work_exp_job_title' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'work_exp_reason' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ref_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ref_occupation' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ref_company_name' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ref_address' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 100, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ref_phone_no' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ref_email' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ref_years_acquainted' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'last_name' => 'Lorem ipsum dolor sit amet',
			'first_name' => 'Lorem ipsum dolor sit amet',
			'nick_name' => 'Lorem ipsum dolor sit amet',
			'expected_salary' => 1,
			'mobile_number' => 'Lorem ipsum dolor sit amet',
			'citizenship' => 'Lorem ipsum dolor sit amet',
			'position_applied' => 'Lorem ipsum dolor sit amet',
			'religion' => 'Lorem ipsum dolor sit amet',
			'birth_date' => '2018-01-20',
			'birth_place' => 'Lorem ipsum dolor sit amet',
			'sss' => 1,
			'pag_ibig' => 1,
			'philhealth' => 1,
			'tin' => 1,
			'present_municipality' => 'Lorem ipsum dolor sit amet',
			'present_city' => 'Lorem ipsum dolor sit amet',
			'present_province' => 'Lorem ipsum dolor sit amet',
			'present_zip_code' => 1,
			'provincial_municipality' => 'Lorem ipsum dolor sit amet',
			'provincial_city' => 'Lorem ipsum dolor sit amet',
			'provincial_province' => 'Lorem ipsum dolor sit amet',
			'provincial_zip_code' => 1,
			'emergency_name' => 'Lorem ipsum dolor sit amet',
			'emergency_address' => 'Lorem ipsum dolor sit amet',
			'emegency_mobile_number' => 'Lorem ipsum dolor sit amet',
			'father_name' => 'Lorem ipsum dolor sit amet',
			'father_birth_date' => '2018-01-20',
			'father_occupation' => 'Lorem ipsum dolor sit amet',
			'father_employer' => 'Lorem ipsum dolor sit amet',
			'father_mobile_number' => 'Lorem ipsum dolor sit amet',
			'father_address' => 'Lorem ipsum dolor sit amet',
			'mother_name' => 'Lorem ipsum dolor sit amet',
			'mother_birth_date' => '2018-01-20',
			'mother_occupation' => 'Lorem ipsum dolor sit amet',
			'mother_employer' => 'Lorem ipsum dolor sit amet',
			'mother_mobile_number' => 'Lorem ipsum dolor sit amet',
			'mother_address' => 'Lorem ipsum dolor sit amet',
			'spouse_name' => 'Lorem ipsum dolor sit amet',
			'spouse_birth_date' => '2018-01-20',
			'spouse_occupation' => 'Lorem ipsum dolor sit amet',
			'spouse_employer' => 'Lorem ipsum dolor sit amet',
			'spouse_mobile_number' => 'Lorem ipsum dolor sit amet',
			'spouse_address' => 'Lorem ipsum dolor sit amet',
			'children_name' => 'Lorem ipsum dolor sit amet',
			'children_birth_date' => '2018-01-20',
			'children_occupation' => 'Lorem ipsum dolor sit amet',
			'children_employer' => 'Lorem ipsum dolor sit amet',
			'children_mobiler_number' => 'Lorem ipsum dolor sit amet',
			'children_address' => 'Lorem ipsum dolor sit amet',
			'educational_school_name' => 'Lorem ipsum dolor sit amet',
			'educational_location' => 'Lorem ipsum dolor sit amet',
			'educational_major_degree' => 'Lorem ipsum dolor sit amet',
			'educational_years' => 1,
			'work_exp_employer' => 'Lorem ipsum dolor sit amet',
			'work_exp_address' => 'Lorem ipsum dolor sit amet',
			'work_exp_phone_no' => 'Lorem ipsum dolor sit amet',
			'work_exp_supervisor' => 'Lorem ipsum dolor sit amet',
			'work_exp_salary' => 1,
			'work_exp_job_title' => 'Lorem ipsum dolor sit amet',
			'work_exp_reason' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'ref_name' => 'Lorem ipsum dolor sit amet',
			'ref_occupation' => 'Lorem ipsum dolor sit amet',
			'ref_company_name' => 'Lorem ipsum dolor sit amet',
			'ref_address' => 'Lorem ipsum dolor sit amet',
			'ref_phone_no' => 'Lorem ipsum dolor sit amet',
			'ref_email' => 'Lorem ipsum dolor sit amet',
			'ref_years_acquainted' => 1
		),
	);

}
