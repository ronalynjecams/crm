<?php
/**
 * InventoryJobOrder Fixture
 */
class InventoryJobOrderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'product_combo_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'qty' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,6', 'unsigned' => false),
		'processed_qty' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
		'reference_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'qty' => 1,
			'processed_qty' => 1,
			'reference_id' => 1,
			'created' => '2017-11-02 12:36:24',
			'modified' => '2017-11-02 12:36:24'
		),
	);

}
