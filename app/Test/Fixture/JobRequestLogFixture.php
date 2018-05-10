<?php
/**
 * JobRequestLog Fixture
 */
class JobRequestLogFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'job_request_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'job_request_product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'job_request_assignment_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'quotation_product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'job_request_revision_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'user_id' => 1,
			'job_request_id' => 1,
			'job_request_product_id' => 1,
			'job_request_assignment_id' => 1,
			'quotation_product_id' => 1,
			'job_request_revision_id' => 1,
			'created' => '2018-04-18 10:11:23',
			'modified' => '2018-04-18 10:11:23'
		),
	);

}
