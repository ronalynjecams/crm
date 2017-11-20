<?php
/**
 * PaymentRequestCheque Fixture
 */
class PaymentRequestChequeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'payment_request_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'cheque_number' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'payee_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'cheque_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'void_reason' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'bank_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'cheque_number' => 1,
			'payee_id' => 1,
			'cheque_date' => '2017-11-17 10:25:52',
			'void_reason' => 'Lorem ipsum dolor sit amet',
			'bank_id' => 1
		),
	);

}
