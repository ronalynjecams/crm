<?php
/**
 * Production Fixture
 */
class ProductionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'quotation_product_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'jr_product_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'total_qty' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'remarks' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'jr_product_id' => 1,
			'client_id' => 1,
			'total_qty' => 1,
			'remarks' => 'Lorem ipsum dolor sit amet',
			'product_id' => 1
		),
	);

}
