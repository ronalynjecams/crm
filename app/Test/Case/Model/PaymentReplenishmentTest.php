<?php
App::uses('PaymentReplenishment', 'Model');

/**
 * PaymentReplenishment Test Case
 */
class PaymentReplenishmentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.payment_replenishment',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.client',
		'app.team',
		'app.agent_status',
		'app.social_profile'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PaymentReplenishment = ClassRegistry::init('PaymentReplenishment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PaymentReplenishment);

		parent::tearDown();
	}

}
