<?php
/**
 * InventoryTransaction Fixture
 */
class InventoryTransactionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'reference_num' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'reference_type' => array('type' => 'string', 'null' => true, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'type_num' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'type' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'released_to' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'released_by' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'request_qty' => array('type' => 'float', 'null' => false, 'default' => '0.00', 'length' => '11,2', 'unsigned' => false),
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
			'reference_num' => 1,
			'reference_type' => 'Lorem ipsum dolor sit amet',
			'type_num' => 1,
			'type' => 'Lorem ipsum dolor sit amet',
			'client_id' => 1,
			'user_id' => 1,
			'released_to' => 1,
			'released_by' => 1,
			'request_qty' => 1,
			'created' => '2018-04-28 12:57:47',
			'modified' => '2018-04-28 12:57:47'
		),
	);

}
