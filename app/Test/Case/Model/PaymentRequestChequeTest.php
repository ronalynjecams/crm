<?php
App::uses('PaymentRequestCheque', 'Model');

/**
 * PaymentRequestCheque Test Case
 */
class PaymentRequestChequeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.payment_request_cheque',
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
		'app.supplier_tag',
		'app.payee',
		'app.bank',
		'app.collection',
		'app.quotation',
		'app.job_request',
		'app.jr_product',
		'app.quotation_product',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.quotation_product_property',
		'app.delivery_sched_product',
		'app.delivery_schedule',
		'app.quotation_term',
		'app.collection_schedule'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PaymentRequestCheque = ClassRegistry::init('PaymentRequestCheque');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PaymentRequestCheque);

		parent::tearDown();
	}

}
