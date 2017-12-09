<?php
/**
 * ProductionLog Fixture
 */
class ProductionLogFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'production_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'production_process_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'production_carpenter_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'status' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'production_id' => 1,
			'production_process_id' => 1,
			'production_carpenter_id' => 1,
			'status' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1
		),
	);

}
