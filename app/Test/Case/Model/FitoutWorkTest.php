<?php
App::uses('FitoutWork', 'Model');

/**
 * FitoutWork Test Case
 */
class FitoutWorkTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fitout_work',
		'app.client',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.social_profile',
		'app.team',
		'app.agent_status',
		'app.fitout_person',
		'app.fitout_qoute',
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
		'app.collection',
		'app.bank',
		'app.collection_schedule',
		'app.fitout_report',
		'app.fitout_report_comment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FitoutWork = ClassRegistry::init('FitoutWork');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FitoutWork);

		parent::tearDown();
	}

}
