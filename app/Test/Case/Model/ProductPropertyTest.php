<?php
App::uses('ProductProperty', 'Model');

/**
 * ProductProperty Test Case
 */
class ProductPropertyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_property',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_value'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductProperty = ClassRegistry::init('ProductProperty');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductProperty);

		parent::tearDown();
	}

}
