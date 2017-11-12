<?php
App::uses('BillMonitoring', 'Model');

/**
 * BillMonitoring Test Case
 */
class BillMonitoringTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bill_monitoring',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.client',
		'app.team',
		'app.agent_status',
		'app.social_profile',
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
		'app.job_request',
		'app.jr_product',
		'app.quotation_term',
		'app.collection',
		'app.bank',
		'app.collection_schedule',
		'app.quotation_product_property',
		'app.delivery_sched_product',
		'app.delivery_schedule'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->BillMonitoring = ClassRegistry::init('BillMonitoring');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BillMonitoring);

		parent::tearDown();
	}

}
