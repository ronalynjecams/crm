<?php
App::uses('ProductCombo', 'Model');

/**
 * ProductCombo Test Case
 */
class ProductComboTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.product_combo',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.unit',
		'app.inventory_job_order',
		'app.inventory_product',
		'app.product_combo_property',
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
		$this->ProductCombo = ClassRegistry::init('ProductCombo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProductCombo);

		parent::tearDown();
	}

}
