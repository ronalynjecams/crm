<?php
/**
 * FitoutQoute Fixture
 */
class FitoutQouteFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'quotation_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'fitout_work_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'quotation_id' => 1,
			'fitout_work_id' => 1,
			'created' => '2017-10-17 15:21:45',
			'modified' => '2017-10-17 15:21:45'
		),
	);

}
