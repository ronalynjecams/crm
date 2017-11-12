<?php
/**
 * BillMonitoring Fixture
 */
class BillMonitoringFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'receipt_reference_num' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'billing_date_from' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'billing_date_to' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => 'created_by'),
		'bill_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'paid_by' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => 'user_id '),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'receipt_date' => array('type' => 'date', 'null' => true, 'default' => null, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'receipt_date' => array('column' => 'receipt_date', 'unique' => 0)
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
			'receipt_reference_num' => 'Lorem ipsum dolor sit amet',
			'billing_date_from' => '2017-10-20 13:01:03',
			'billing_date_to' => '2017-10-20 13:01:03',
			'user_id' => 1,
			'bill_id' => 1,
			'paid_by' => 1,
			'created' => '2017-10-20 13:01:03',
			'modified' => '2017-10-20 13:01:03',
			'receipt_date' => '2017-10-20'
		),
	);

}
