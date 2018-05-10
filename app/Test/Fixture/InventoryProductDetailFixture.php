<?php
/**
 * InventoryProductDetail Fixture
 */
class InventoryProductDetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'product_combo_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'inv_location_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'inventory_status_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'supplier_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'min_stock_level' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'max_stock_level' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'qty' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'initial_qty' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
		'qr_code' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'qr_image' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'inv_location_id' => 1,
			'inventory_status_id' => 1,
			'supplier_id' => 1,
			'min_stock_level' => 1,
			'max_stock_level' => 1,
			'qty' => 1,
			'initial_qty' => 1,
			'qr_code' => 'Lorem ipsum dolor sit amet',
			'qr_image' => 'Lorem ipsum dolor sit amet',
			'created' => '2018-04-28 12:57:24',
			'modified' => '2018-04-28 12:57:24'
		),
	);

}
