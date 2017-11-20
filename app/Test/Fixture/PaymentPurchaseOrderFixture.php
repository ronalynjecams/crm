<?php
/**
 * PaymentPurchaseOrder Fixture
 */
class PaymentPurchaseOrderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'payment_request_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'purchase_order_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'po_amount_request' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
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
			'payment_request_id' => 1,
			'purchase_order_id' => 1,
			'po_amount_request' => 1,
			'created' => '2017-11-17 10:42:28',
			'modified' => '2017-11-17 10:42:28'
		),
	);

}
