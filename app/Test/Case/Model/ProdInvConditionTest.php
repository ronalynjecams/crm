<?php
App::uses('ProdInvCondition', 'Model');

/**
 * ProdInvCondition Test Case
 */
class ProdInvConditionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.prod_inv_condition',
		'app.prod_inv_location_property',
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
		$this->ProdInvCondition = ClassRegistry::init('ProdInvCondition');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProdInvCondition);

		parent::tearDown();
	}

}
