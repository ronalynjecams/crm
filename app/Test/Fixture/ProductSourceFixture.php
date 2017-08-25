<?php
/**
 * ProductSource Fixture
 */
class ProductSourceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'quotation_product_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'qty' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'quotation_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'purchase_order_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'prod_inv_location_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'quotation_product_id' => 1,
			'qty' => 1,
			'quotation_id' => 1,
			'purchase_order_id' => 1,
			'prod_inv_location_id' => 1,
			'created' => '2017-08-11 22:01:00',
			'modified' => '2017-08-11 22:01:00'
		),
	);

}
