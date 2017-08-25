<?php
/**
 * ProductSourceProperty Fixture
 */
class ProductSourcePropertyFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'property' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'value' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'product_source_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'qty' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '50,6', 'unsigned' => false),
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
			'property' => 'Lorem ipsum dolor sit amet',
			'value' => 'Lorem ipsum dolor sit amet',
			'product_source_id' => 1,
			'qty' => 1,
			'created' => '2017-08-19 00:30:34',
			'modified' => '2017-08-19 00:30:34'
		),
	);

}
