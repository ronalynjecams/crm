<?php
/**
 * JobRequestAssignment Fixture
 */
class JobRequestAssignmentFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'job_request_product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'job_request_floorplan_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'designer_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'sales_executive' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'assigned_by' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'quotation_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'assigned_task' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'job_request_revision_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'date_rejected' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'job_request_product_id' => 1,
			'job_request_floorplan_id' => 1,
			'designer_id' => 1,
			'sales_executive' => 'Lorem ipsum dolor sit amet',
			'assigned_by' => 'Lorem ipsum dolor sit amet',
			'client_id' => 1,
			'quotation_id' => 1,
			'assigned_task' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'job_request_revision_id' => 1,
			'date_rejected' => '2018-04-18 10:02:57',
			'created' => '2018-04-18 10:02:57',
			'modified' => '2018-04-18 10:02:57'
		),
	);

}
