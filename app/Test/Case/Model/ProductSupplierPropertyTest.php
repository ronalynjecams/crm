<?php
App::uses('ProductSupplierProperty', 'Model');

/**
 * ProductSupplierProperty Test Case
 */
class ProductSupplierPropertyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_supplier_property',
		'app.product_supplier',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.supplier',
		'app.supplier_tag'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductSupplierProperty = ClassRegistry::init('ProductSupplierProperty');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductSupplierProperty);

		parent::tearDown();
	}

}
