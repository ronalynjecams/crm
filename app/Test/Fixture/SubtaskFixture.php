<?php
/**
 * Subtask Fixture
 */
class SubtaskFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'task_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'subtask' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'start_datetime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'finished_datetime' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'deadline' => array('type' => 'date', 'null' => false, 'default' => null),
		'notes' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'created' => array('type' => 'date', 'null' => true, 'default' => null),
		'modified' => array('type' => 'date', 'null' => true, 'default' => null),
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
			'task_id' => 1,
			'subtask' => 'Lorem ipsum dolor sit amet',
			'start_datetime' => '2018-01-24 13:45:54',
			'finished_datetime' => '2018-01-24 13:45:54',
			'deadline' => '2018-01-24',
			'notes' => 'Lorem ipsum dolor sit amet',
			'created' => '2018-01-24',
			'modified' => '2018-01-24'
		),
	);

}
