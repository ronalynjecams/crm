<?php
App::uses('BillAccount', 'Model');

/**
 * BillAccount Test Case
 */
class BillAccountTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bill_account',
		'app.bill'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BillAccount = ClassRegistry::init('BillAccount');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BillAccount);

		parent::tearDown();
	}

}
