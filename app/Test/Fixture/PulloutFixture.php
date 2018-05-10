<?php
/**
 * Pullout Fixture
 */
class PulloutFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'delivered_qty' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '20,6', 'unsigned' => false),
		'date_delivered' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'expected_pullout_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'pullout_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'reference_number' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
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
			'delivered_qty' => 1,
			'date_delivered' => '2018-04-04 08:21:09',
			'expected_pullout_date' => '2018-04-04 08:21:09',
			'pullout_date' => '2018-04-04 08:21:09',
			'reference_number' => 1,
			'created' => '2018-04-04 08:21:09',
			'modified' => '2018-04-04 08:21:09'
		),
	);

}
