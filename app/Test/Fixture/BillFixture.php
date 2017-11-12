<?php
/**
 * Bill Fixture
 */
class BillFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'account_number' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'jecams_amount' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '50,6', 'unsigned' => false),
		'bill_account_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'inv_location_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'account_number' => 1,
			'jecams_amount' => 1,
			'bill_account_id' => 1,
			'inv_location_id' => 1,
			'created' => '2017-10-20 13:00:40',
			'modified' => '2017-10-20 13:00:40'
		),
	);

}
