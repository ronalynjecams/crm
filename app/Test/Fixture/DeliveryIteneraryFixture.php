<?php
/**
 * DeliveryItenerary Fixture
 */
class DeliveryIteneraryFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'delivery_schedule_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'vehicle_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'booking_code' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'amount' => array('type' => 'float', 'null' => true, 'default' => null, 'length' => '13,6', 'unsigned' => false),
		'driver' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'expected_start' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'actual_start' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'end_work' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'remarks' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'departure' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'arrival' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'requested_by' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => 'user_id'),
		'request_note' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'processed_by' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'delivery_schedule_id' => 1,
			'vehicle_id' => 1,
			'booking_code' => 'Lorem ipsum dolor sit amet',
			'amount' => 1,
			'driver' => 'Lorem ipsum dolor sit amet',
			'expected_start' => '2017-10-11 22:39:28',
			'actual_start' => '2017-10-11 22:39:28',
			'end_work' => 1,
			'remarks' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'departure' => '2017-10-11 22:39:28',
			'arrival' => '2017-10-11 22:39:28',
			'created' => '2017-10-11 22:39:28',
			'modified' => '2017-10-11 22:39:28',
			'client_id' => 1,
			'requested_by' => 1,
			'request_note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'processed_by' => 1
		),
	);

}
