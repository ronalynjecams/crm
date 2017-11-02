<?php
/**
 * PurchaseOrderProduct Fixture
 */
class PurchaseOrderProductFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'product_combo_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'purchase_order_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'list_price' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,6', 'unsigned' => false),
		'qty' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,6', 'unsigned' => false),
		'reference_num' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'transaction_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'additional' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => '1 or 0'),
		'processed_qty' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'supplier_product_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'product_combo_id' => 1,
			'purchase_order_id' => 1,
			'list_price' => 1,
			'qty' => 1,
			'reference_num' => 1,
			'transaction_id' => 1,
			'user_id' => 1,
			'additional' => 1,
			'processed_qty' => 1,
			'supplier_product_id' => 1,
			'created' => '2017-11-02 12:56:37',
			'modified' => '2017-11-02 12:56:37'
		),
	);

}
