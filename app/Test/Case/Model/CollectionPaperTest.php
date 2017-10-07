<?php
App::uses('CollectionPaper', 'Model');

/**
 * CollectionPaper Test Case
 */
class CollectionPaperTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.collection_paper',
		'app.accounting_paper'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CollectionPaper = ClassRegistry::init('CollectionPaper');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CollectionPaper);

		parent::tearDown();
	}

}
