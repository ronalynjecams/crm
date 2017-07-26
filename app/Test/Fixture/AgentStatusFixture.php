<?php
/**
 * AgentStatus Fixture
 */
class AgentStatusFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'quota' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'unsigned' => false),
		'team_id' => array('type' => 'integer', 'null' => true, 'default' => null, 'length' => 22, 'unsigned' => false),
		'date_from' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_to' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'quota' => 'Lorem ipsum dolor sit amet',
			'user_id' => 1,
			'team_id' => 1,
			'date_from' => '2017-07-16 16:36:01',
			'date_to' => '2017-07-16 16:36:01',
			'created' => '2017-07-16 16:36:01',
			'modified' => '2017-07-16 16:36:01'
		),
	);

}
