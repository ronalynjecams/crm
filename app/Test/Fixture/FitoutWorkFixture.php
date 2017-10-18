<?php
/**
 * FitoutWork Fixture
 */
class FitoutWorkFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'expected_start' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'deadline' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'date_accomplished' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'agents_remarks' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 45, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
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
			'expected_start' => '2017-10-17 15:40:45',
			'deadline' => '2017-10-17 15:40:45',
			'client_id' => 1,
			'date_accomplished' => '2017-10-17 15:40:45',
			'user_id' => 1,
			'agents_remarks' => 'Lorem ipsum dolor sit amet',
			'created' => '2017-10-17 15:40:45',
			'modified' => '2017-10-17 15:40:45'
		),
	);

}
