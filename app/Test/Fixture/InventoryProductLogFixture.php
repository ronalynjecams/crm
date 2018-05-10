<?php
/**
 * InventoryProductLog Fixture
 */
class InventoryProductLogFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'inventory_product_details_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'inventory_status_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'inventory_transaction_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'qty' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
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
			'inventory_product_details_id' => 1,
			'inventory_status_id' => 1,
			'inventory_transaction_id' => 1,
			'user_id' => 1,
			'qty' => 1,
			'created' => '2018-04-28 13:01:22',
			'modified' => '2018-04-28 13:01:22'
		),
	);

}
