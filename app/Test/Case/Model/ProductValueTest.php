<?php
App::uses('ProductValue', 'Model');

/**
 * ProductValue Test Case
 */
class ProductValueTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_value',
		'app.product_property',
		'app.product',
		'app.sub_category',
		'app.category'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductValue = ClassRegistry::init('ProductValue');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductValue);

		parent::tearDown();
	}

}
