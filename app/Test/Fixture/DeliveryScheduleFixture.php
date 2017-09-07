<?php
/**
 * DeliverySchedule Fixture
 */
class DeliveryScheduleFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'delivery_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'requested_qty' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'actual_qty' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'quotation_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'approved_by' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'delivery_date' => '2017-09-05',
			'requested_qty' => 1,
			'actual_qty' => 1,
			'quotation_id' => 1,
			'approved_by' => 1,
			'created' => '2017-09-05 20:59:40',
			'modified' => '2017-09-05 20:59:40'
		),
	);

}
