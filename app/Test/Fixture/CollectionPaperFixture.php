<?php
/**
 * CollectionPaper Fixture
 */
class CollectionPaperFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'ref_number' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'latin1_swedish_ci', 'charset' => 'latin1'),
		'ref_date' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'amount' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,6', 'unsigned' => false),
		'accounting_paper_id' => array('type' => 'integer', 'null' => false, 'default' => '0', 'unsigned' => false),
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
			'ref_number' => 'Lorem ipsum dolor sit amet',
			'ref_date' => '2017-10-08 01:31:02',
			'amount' => 1,
			'accounting_paper_id' => 1,
			'created' => '2017-10-08 01:31:02',
			'modified' => '2017-10-08 01:31:02'
		),
	);

}
