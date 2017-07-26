<?php
/**
 * Quotation Fixture
 */
class QuotationFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'quote_number' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'client_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'team_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'job_request_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'subject' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'terms_info' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'sub_total' => array('type' => 'decimal', 'null' => false, 'default' => '0.000000', 'length' => '13,6', 'unsigned' => false),
		'installation_charge' => array('type' => 'decimal', 'null' => false, 'default' => '0.000000', 'length' => '13,6', 'unsigned' => false),
		'delivery_charge' => array('type' => 'decimal', 'null' => false, 'default' => '0.000000', 'length' => '13,6', 'unsigned' => false),
		'discount' => array('type' => 'decimal', 'null' => false, 'default' => '0.000000', 'length' => '13,6', 'unsigned' => false),
		'grand_total' => array('type' => 'decimal', 'null' => false, 'default' => '0.000000', 'length' => '13,6', 'unsigned' => false),
		'validity_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'bill_address' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'bill_geolocation' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'bill_latitude' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'bill_longitude' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ship_address' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ship_geolocation' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ship_latitude' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ship_longitude' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'target_delivery' => array('type' => 'date', 'null' => false, 'default' => null),
		'date_moved' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'date_approved' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'quote_number' => 1,
			'client_id' => 1,
			'team_id' => 1,
			'user_id' => 1,
			'job_request_id' => 1,
			'subject' => 'Lorem ipsum dolor sit amet',
			'terms_info' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'sub_total' => '',
			'installation_charge' => '',
			'delivery_charge' => '',
			'discount' => '',
			'grand_total' => '',
			'validity_date' => '2017-07-18',
			'bill_address' => 'Lorem ipsum dolor sit amet',
			'bill_geolocation' => 'Lorem ipsum dolor sit amet',
			'bill_latitude' => 'Lorem ipsum dolor sit amet',
			'bill_longitude' => 'Lorem ipsum dolor sit amet',
			'ship_address' => 'Lorem ipsum dolor sit amet',
			'ship_geolocation' => 'Lorem ipsum dolor sit amet',
			'ship_latitude' => 'Lorem ipsum dolor sit amet',
			'ship_longitude' => 'Lorem ipsum dolor sit amet',
			'target_delivery' => '2017-07-18',
			'date_moved' => '2017-07-18 08:36:44',
			'date_approved' => '2017-07-18 08:36:44',
			'created' => '2017-07-18 08:36:44',
			'modified' => '2017-07-18 08:36:44'
		),
	);

}
