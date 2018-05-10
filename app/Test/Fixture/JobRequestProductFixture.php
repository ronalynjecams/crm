<?php
/**
 * JobRequestProduct Fixture
 */
class JobRequestProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'quotation_product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'job_request_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'date_prs' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'deadline_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'date_accomplished' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'job_request_type_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'po_raw_request_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'quotation_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'image' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'date_received_production' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_forwarded_production' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_deleted' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'quotation_product_id' => 1,
			'user_id' => 1,
			'client_id' => 1,
			'job_request_id' => 1,
			'date_prs' => '2018-04-18 09:19:15',
			'deadline_date' => '2018-04-18',
			'date_accomplished' => '2018-04-18 09:19:15',
			'job_request_type_id' => 1,
			'po_raw_request_id' => 1,
			'quotation_id' => 1,
			'image' => 'Lorem ipsum dolor sit amet',
			'date_received_production' => '2018-04-18 09:19:15',
			'date_forwarded_production' => '2018-04-18 09:19:15',
			'date_deleted' => '2018-04-18 09:19:15',
			'product_id' => 1,
			'created' => '2018-04-18 09:19:15',
			'modified' => '2018-04-18 09:19:15'
		),
	);

}
