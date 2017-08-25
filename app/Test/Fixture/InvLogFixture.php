<?php
/**
 * InvLog Fixture
 */
class InvLogFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'inv_location_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'qty' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'released_to' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'received_from' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'quotation_product_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'inv_location_id' => 1,
			'qty' => 1,
			'released_to' => 1,
			'received_from' => 1,
			'quotation_product_id' => 1,
			'created' => '2017-08-11 22:01:46',
			'modified' => '2017-08-11 22:01:46'
		),
	);

}
