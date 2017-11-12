<?php
/**
 * ClientService Fixture
 */
class ClientServiceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'processed_by' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'service_code' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'date', 'null' => false, 'default' => null),
		'modified' => array('type' => 'date', 'null' => false, 'default' => null),
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
			'client_id' => 1,
			'user_id' => 1,
			'processed_by' => 1,
			'service_code' => 'Lorem ipsum dolor sit amet',
			'created' => '2017-11-06',
			'modified' => '2017-11-06'
		),
	);

}
