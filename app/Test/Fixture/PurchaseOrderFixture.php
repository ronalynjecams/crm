<?php
/**
 * PurchaseOrder Fixture
 */
class PurchaseOrderFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'supplier_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'po_number' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'discount' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '50,6', 'unsigned' => false),
		'vat_amount' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '50,6', 'unsigned' => false),
		'ewt_amount' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '50,6', 'unsigned' => false),
		'void_date' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'void_reason' => array('type' => 'text', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'with_held' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '50,6', 'unsigned' => false),
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
			'supplier_id' => 1,
			'user_id' => 1,
			'po_number' => 'Lorem ipsum dolor sit amet',
			'discount' => 1,
			'vat_amount' => 1,
			'ewt_amount' => 1,
			'void_date' => '2017-08-11 22:32:38',
			'void_reason' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
			'with_held' => 1,
			'created' => '2017-08-11 22:32:38',
			'modified' => '2017-08-11 22:32:38'
		),
	);

}
