<?php
App::uses('PaymentReplenishedDetail', 'Model');

/**
 * PaymentReplenishedDetail Test Case
 */
class PaymentReplenishedDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.payment_replenished_detail',
		'app.payment_replenishment',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.client',
		'app.team',
		'app.agent_status',
		'app.social_profile',
		'app.payment_request',
		'app.supplier',
		'app.supplier_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PaymentReplenishedDetail = ClassRegistry::init('PaymentReplenishedDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PaymentReplenishedDetail);

		parent::tearDown();
	}

}
