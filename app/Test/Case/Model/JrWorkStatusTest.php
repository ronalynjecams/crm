<?php
App::uses('JrWorkStatus', 'Model');

/**
 * JrWorkStatus Test Case
 */
class JrWorkStatusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.jr_work_status',
		'app.jr_product',
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
		'app.quotation_term',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.quotation_product_property'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->JrWorkStatus = ClassRegistry::init('JrWorkStatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->JrWorkStatus);

		parent::tearDown();
	}

}
