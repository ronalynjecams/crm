<?php
App::uses('JrProduct', 'Model');

/**
 * JrProduct Test Case
 */
class JrProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.jr_product',
		'app.quotation_product',
		'app.quotation',
		'app.client',
		'app.user',
		'app.position',
		'app.notification',
		'app.creator',
		'app.department',
		'app.team',
		'app.agent_status',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.quotation_product_property',
		'app.job_request'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->JrProduct = ClassRegistry::init('JrProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->JrProduct);

		parent::tearDown();
	}

}
