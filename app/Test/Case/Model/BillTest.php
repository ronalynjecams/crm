<?php
App::uses('Bill', 'Model');

/**
 * Bill Test Case
 */
class BillTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bill',
		'app.bill_account',
		'app.inv_location',
		'app.inv_log',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.quotation_product',
		'app.quotation',
		'app.client',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.social_profile',
		'app.team',
		'app.agent_status',
		'app.job_request',
		'app.jr_product',
		'app.quotation_term',
		'app.collection',
		'app.bank',
		'app.collection_schedule',
		'app.quotation_product_property',
		'app.delivery_sched_product',
		'app.delivery_schedule',
		'app.bill_monitoring'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Bill = ClassRegistry::init('Bill');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Bill);

		parent::tearDown();
	}

}
