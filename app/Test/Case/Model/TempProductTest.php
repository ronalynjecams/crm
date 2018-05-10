<?php
App::uses('TempProduct', 'Model');

/**
 * TempProduct Test Case
 */
class TempProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.temp_product',
		'app.sub_category',
		'app.category',
		'app.product',
		'app.product_property',
		'app.product_value',
		'app.temp_product_property'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->TempProduct = ClassRegistry::init('TempProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TempProduct);

		parent::tearDown();
	}

}
