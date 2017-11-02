<?php
/**
 * TransactionSource Fixture
 */
class TransactionSourceFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'reference_num' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
		'mode_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false, 'comment' => 'po_id or inv_prod_id'),
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
			'reference_num' => 1,
			'mode_id' => 1,
			'created' => '2017-11-02 13:12:23',
			'modified' => '2017-11-02 13:12:23'
		),
	);

}
