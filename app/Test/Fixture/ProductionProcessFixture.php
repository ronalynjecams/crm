<?php
/**
 * ProductionProcess Fixture
 */
class ProductionProcessFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'production_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'production_section_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'start_work' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'end_work' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'expected_start' => array('type' => 'date', 'null' => true, 'default' => null),
		'expected_end' => array('type' => 'date', 'null' => true, 'default' => null),
		'total_qty_assigned' => array('type' => 'float', 'null' => false, 'default' => '0.000000', 'length' => '10,6', 'unsigned' => false),
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
			'production_section_id' => 1,
			'user_id' => 1,
			'start_work' => '2017-12-02 10:01:51',
			'end_work' => '2017-12-02 10:01:51',
			'expected_start' => '2017-12-02',
			'expected_end' => '2017-12-02',
			'total_qty_assigned' => 1
		),
	);

}
