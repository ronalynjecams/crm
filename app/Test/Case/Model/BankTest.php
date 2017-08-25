<?php
App::uses('Bank', 'Model');

/**
 * Bank Test Case
 */
class BankTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bank',
		'app.collection'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Bank = ClassRegistry::init('Bank');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Bank);

		parent::tearDown();
	}

}
