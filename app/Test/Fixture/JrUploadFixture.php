<?php
/**
 * JrUpload Fixture
 */
class JrUploadFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'jr_product_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'file' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'viewed' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'indexes' => array(
			
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
			'jr_product_id' => 1,
			'file' => 1,
			'created' => '2017-08-24 21:00:01',
			'modified' => '2017-08-24 21:00:01',
			'viewed' => 1
		),
	);

}
