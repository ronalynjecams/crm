<?php
/**
 * ProductCombo Fixture
 */
class ProductComboFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'ordering' => array('type' => 'integer', 'null' => true, 'default' => '0', 'unsigned' => false),
		'unit_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'min_stock_level' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'product_id' => 1,
			'ordering' => 1,
			'unit_id' => 1,
			'min_stock_level' => 1,
			'created' => '2017-11-02 12:35:06',
			'modified' => '2017-11-02 12:35:06'
		),
	);

}
