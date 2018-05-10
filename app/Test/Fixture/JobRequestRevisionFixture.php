<?php
/**
 * JobRequestRevision Fixture
 */
class JobRequestRevisionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'job_request_pending_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'job_request_type_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'deadline_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'estimated_finish' => array('type' => 'date', 'null' => false, 'default' => null),
		'actual_date_finished' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'job_request_pending_id' => 1,
			'job_request_type_id' => 1,
			'deadline_date' => '2018-04-18 09:59:56',
			'estimated_finish' => '2018-04-18',
			'actual_date_finished' => '2018-04-18 09:59:56',
			'product_id' => 1,
			'created' => '2018-04-18 09:59:56',
			'modified' => '2018-04-18 09:59:56'
		),
	);

}
