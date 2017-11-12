<?php
/**
 * OfficialBusiness Fixture
 */
class OfficialBusinessFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'purpose' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'expected_departure' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'company_name' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'approved_by' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'approved_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'hr_approved_by' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'hr_approved_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'arrived_jecams' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'purpose' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'expected_departure' => '2017-11-11 08:21:44',
			'user_id' => 1,
			'client_id' => 1,
			'company_name' => 'Lorem ipsum dolor sit amet',
			'approved_by' => 1,
			'approved_date' => '2017-11-11 08:21:44',
			'hr_approved_by' => 1,
			'hr_approved_date' => '2017-11-11 08:21:44',
			'arrived_jecams' => '2017-11-11 08:21:44',
			'created' => '2017-11-11 08:21:44',
			'modified' => '2017-11-11 08:21:44'
		),
	);

}
