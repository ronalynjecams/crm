<?php
App::uses('Pullout', 'Model');

/**
 * Pullout Test Case
 */
class PulloutTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pullout',
		'app.pullout_log'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Pullout = ClassRegistry::init('Pullout');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Pullout);

		parent::tearDown();
	}

}
