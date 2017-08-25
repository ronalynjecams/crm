<?php
/**
 * Collection Fixture
 */
class CollectionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'quotation_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'bank_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'amount_paid' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '50,6', 'unsigned' => false),
		'with_held' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '50,6', 'unsigned' => false),
		'check_number' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'check_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'date_deleted' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_updated' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'date_completed' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'quotation_id' => 1,
			'user_id' => 1,
			'bank_id' => 1,
			'amount_paid' => 1,
			'with_held' => 1,
			'check_number' => 'Lorem ipsum dolor sit amet',
			'check_date' => '2017-08-09',
			'date_deleted' => '2017-08-09 00:08:55',
			'date_updated' => '2017-08-09 00:08:55',
			'created' => '2017-08-09 00:08:55',
			'modified' => '2017-08-09 00:08:55',
			'date_completed' => '2017-08-09 00:08:55'
		),
	);

}
