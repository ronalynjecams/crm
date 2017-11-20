<?php
/**
 * PaymentRequest Fixture
 */
class PaymentRequestFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'requested_amount' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'purpose' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'released_amount' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'liquidated_amount' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'reimbursed_amount' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'returned_amount' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'ewt_released' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'ewt_returned' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'replenished_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'supplier_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'inserted_by' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'requested_amount' => 1,
			'purpose' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1,
			'released_amount' => 1,
			'liquidated_amount' => 1,
			'reimbursed_amount' => 1,
			'returned_amount' => 1,
			'ewt_released' => '2017-11-17 10:05:36',
			'ewt_returned' => '2017-11-17 10:05:36',
			'replenished_date' => '2017-11-17 10:05:36',
			'created' => '2017-11-17 10:05:36',
			'modified' => '2017-11-17 10:05:36',
			'supplier_id' => 1,
			'inserted_by' => 1
		),
	);

}
