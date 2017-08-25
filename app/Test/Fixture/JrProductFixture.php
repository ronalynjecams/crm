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
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => 'designer_id'),
		'date_assigned' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'deadline' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'job_request_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'floor_plan_details' => array('type' => 'text', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date_ongoing' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'date_declined' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'modified' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'date_assigned' => '2017-07-30 07:14:31',
			'deadline' => '2017-07-30 07:14:31',
			'job_request_id' => 1,
			'floor_plan_details' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'date_ongoing' => '2017-07-30 07:14:31',
			'date_declined' => '2017-07-30 07:14:31',
			'created' => 1,
			'modified' => 1
		),
	);

}
