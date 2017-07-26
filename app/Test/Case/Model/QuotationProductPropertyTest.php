<?php
App::uses('QuotationProductProperty', 'Model');

/**
 * QuotationProductProperty Test Case
 */
class QuotationProductPropertyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.quotation_product_property',
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
		'app.product_value'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QuotationProductProperty = ClassRegistry::init('QuotationProductProperty');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QuotationProductProperty);

		parent::tearDown();
	}

}
