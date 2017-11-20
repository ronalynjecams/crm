<?php
/**
 * StatementOfAccount Fixture
 */
class StatementOfAccountFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'soa_number' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'quotation_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'contract_amount' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'collected_amount' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'with_held_amount' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'balance' => array('type' => 'float', 'null' => false, 'default' => '0', 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'soa_number' => 1,
			'quotation_id' => 1,
			'contract_amount' => 1,
			'collected_amount' => 1,
			'with_held_amount' => 1,
			'balance' => 1,
			'user_id' => 1,
			'created' => '2017-11-16 08:42:40',
			'modified' => '2017-11-16 08:42:40'
		),
	);

}
