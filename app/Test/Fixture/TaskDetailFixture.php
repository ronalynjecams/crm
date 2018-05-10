<?php
/**
 * TaskDetail Fixture
 */
class TaskDetailFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'task_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'subtask_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'start_datetime' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'finished_datetime' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'subtask_id' => 1,
			'start_datetime' => '2018-02-14 20:23:04',
			'finished_datetime' => '2018-02-14 20:23:04',
			'notes' => 'Lorem ipsum dolor sit amet',
			'created' => '2018-02-14',
			'modified' => '2018-02-14'
		),
	);

}
