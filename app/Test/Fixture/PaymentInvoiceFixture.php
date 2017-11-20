<?php
/**
 * PaymentInvoice Fixture
 */
class PaymentInvoiceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'payment_request_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'amount' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'with_held_amount' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'ewt_amount' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'tax_amount' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'reference_number' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'purchase_order_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'valid_purchase' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => '1,0'),
		'reference_date' => array('type' => 'date', 'null' => false, 'default' => null),
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
			'payment_request_id' => 1,
			'amount' => 1,
			'with_held_amount' => 1,
			'ewt_amount' => 1,
			'tax_amount' => 1,
			'reference_number' => 'Lorem ipsum dolor sit amet',
			'purchase_order_id' => 1,
			'user_id' => 1,
			'valid_purchase' => 1,
			'reference_date' => '2017-11-17'
		),
	);

}
