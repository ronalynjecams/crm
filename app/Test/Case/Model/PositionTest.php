<?php
App::uses('Position', 'Model');

/**
 * Position Test Case
 */
class PositionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.position',
		'app.notification',
		'app.creator',
		'app.user',
		'app.department',
		'app.client',
		'app.lead'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Position = ClassRegistry::init('Position');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Position);

		parent::tearDown();
	}

}
