<?php
App::uses('QuotationProduct', 'Model');

/**
 * QuotationProduct Test Case
 */
class QuotationProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		'app.quotation_product_property'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QuotationProduct = ClassRegistry::init('QuotationProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QuotationProduct);

		parent::tearDown();
	}

}
