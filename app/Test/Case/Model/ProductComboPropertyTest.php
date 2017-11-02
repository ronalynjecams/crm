<?php
App::uses('ProductComboProperty', 'Model');

/**
 * ProductComboProperty Test Case
 */
class ProductComboPropertyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_combo_property',
		'app.product_combo',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.unit',
		'app.inventory_job_order',
		'app.inventory_product',
		'app.purchase_order_product',
		'app.supplier_product'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProductComboProperty = ClassRegistry::init('ProductComboProperty');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductComboProperty);

		parent::tearDown();
	}

}
