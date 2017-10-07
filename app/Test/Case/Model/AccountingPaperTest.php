<?php
App::uses('AccountingPaper', 'Model');

/**
 * AccountingPaper Test Case
 */
class AccountingPaperTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.accounting_paper',
		'app.collection_paper'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AccountingPaper = ClassRegistry::init('AccountingPaper');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AccountingPaper);

		parent::tearDown();
	}

}
