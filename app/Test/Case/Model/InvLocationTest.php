<?php
App::uses('InvLocation', 'Model');

/**
 * InvLocation Test Case
 */
class InvLocationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.inv_location',
		'app.inv_log'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InvLocation = ClassRegistry::init('InvLocation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InvLocation);

		parent::tearDown();
	}

}
