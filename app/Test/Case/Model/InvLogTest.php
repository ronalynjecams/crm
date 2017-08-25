<?php
App::uses('InvLog', 'Model');

/**
 * InvLog Test Case
 */
class InvLogTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.inv_log',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.inv_location',
		'app.quotation_product',
		'app.quotation',
		'app.client',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.team',
		'app.agent_status',
		'app.job_request',
		'app.jr_product',
		'app.quotation_term',
		'app.quotation_product_property'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InvLog = ClassRegistry::init('InvLog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InvLog);

		parent::tearDown();
	}

}
