<?php
/**
 * DeliveryPaper Fixture
 */
class DeliveryPaperFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'delivery_schedule_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'quotation_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'date_needed' => array('type' => 'date', 'null' => true, 'default' => null),
		'date_acquired' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'date_processed' => array('type' => 'datetime', 'null' => true, 'default' => null),
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
			'delivery_schedule_id' => 1,
			'quotation_id' => 1,
			'date_needed' => '2017-09-08',
			'date_acquired' => '2017-09-08 01:13:37',
			'date_processed' => '2017-09-08 01:13:37',
			'created' => '2017-09-08 01:13:37',
			'modified' => '2017-09-08 01:13:37'
		),
	);

}
