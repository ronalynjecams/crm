<?php
App::uses('PaymentRequestCategory', 'Model');

/**
 * PaymentRequestCategory Test Case
 */
class PaymentRequestCategoryTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.payment_request_category',
		'app.payment_request',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.client',
		'app.team',
		'app.agent_status',
		'app.social_profile',
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
		$this->PaymentRequestCategory = ClassRegistry::init('PaymentRequestCategory');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PaymentRequestCategory);

		parent::tearDown();
	}

}
