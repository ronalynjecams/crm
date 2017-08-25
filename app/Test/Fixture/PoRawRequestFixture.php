<?php
/**
 * PoRawRequest Fixture
 */
class PoRawRequestFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'quotation_product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'jr_product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'qty' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'date_needed' => array('type' => 'datetime', 'null' => false, 'default' => null),
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
			'quotation_product_id' => 1,
			'jr_product_id' => 1,
			'product_id' => 1,
			'user_id' => 1,
			'qty' => 1,
			'date_needed' => '2017-08-25 22:21:13',
			'created' => '2017-08-25 22:21:13',
			'modified' => '2017-08-25 22:21:13'
		),
	);

}
