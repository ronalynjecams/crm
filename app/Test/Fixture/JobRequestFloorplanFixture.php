<?php
/**
 * JobRequestFloorplan Fixture
 */
class JobRequestFloorplanFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'quotation_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'job_request_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'deadline_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'date_prs' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_accomplished' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'job_request_type_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'po_raw_request_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'date_received_production' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_forwarded_production' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'description' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'image' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'quotation_id' => 1,
			'client_id' => 1,
			'user_id' => 1,
			'job_request_id' => 1,
			'deadline_date' => '2018-04-18 09:54:43',
			'date_prs' => '2018-04-18 09:54:43',
			'date_accomplished' => '2018-04-18 09:54:43',
			'job_request_type_id' => 1,
			'po_raw_request_id' => 1,
			'date_received_production' => '2018-04-18 09:54:43',
			'date_forwarded_production' => '2018-04-18 09:54:43',
			'description' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'image' => 'Lorem ipsum dolor sit amet',
			'created' => '2018-04-18 09:54:43',
			'modified' => '2018-04-18 09:54:43'
		),
	);

}
