<?php
App::uses('PulloutLog', 'Model');

/**
 * PulloutLog Test Case
 */
class PulloutLogTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pullout_log',
		'app.pullout'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PulloutLog = ClassRegistry::init('PulloutLog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PulloutLog);

		parent::tearDown();
	}

}
