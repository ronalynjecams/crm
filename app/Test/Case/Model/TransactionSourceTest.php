<?php
App::uses('TransactionSource', 'Model');

/**
 * TransactionSource Test Case
 */
class TransactionSourceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.transaction_source',
		'app.mode'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TransactionSource = ClassRegistry::init('TransactionSource');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TransactionSource);

		parent::tearDown();
	}

}
