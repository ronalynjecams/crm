<?php
/**
 * JrProduct Fixture
 */
class JrProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'quotation_product_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => 'designer_assigne'),
		'job_request_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'date_assigned' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'date_ongoing' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'floor_plan_details' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'deadline' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'status' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'quotation_product_id' => 1,
			'user_id' => 1,
			'job_request_id' => 1,
			'date_assigned' => '2017-07-27 17:11:00',
			'date_ongoing' => '2017-07-27 17:11:00',
			'floor_plan_details' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'deadline' => '2017-07-27 17:11:00',
			'status' => 1,
			'created' => 1,
			'modified' => '2017-07-27 17:11:00'
		),
	);

}
