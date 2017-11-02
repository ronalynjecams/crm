<?php
App::uses('PurchaseOrderProduct', 'Model');

/**
 * PurchaseOrderProduct Test Case
 */
class PurchaseOrderProductTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.purchase_order_product',
		'app.product_combo',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.unit',
		'app.inventory_job_order',
		'app.inventory_product',
		'app.inv_location',
		'app.inv_log',
		'app.quotation_product',
		'app.quotation',
		'app.client',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.social_profile',
		'app.team',
		'app.agent_status',
		'app.job_request',
		'app.jr_product',
		'app.quotation_term',
		'app.collection',
		'app.bank',
		'app.collection_schedule',
		'app.quotation_product_property',
		'app.delivery_sched_product',
		'app.delivery_schedule',
		'app.product_combo_property',
		'app.supplier_product',
		'app.supplier',
		'app.supplier_tag',
		'app.purchase_order',
		'app.po_product',
		'app.po_product_property',
		'app.product_source',
		'app.prod_inv_location',
		'app.prod_inv_combo',
		'app.prod_inv_location_property',
		'app.prod_inv_condition',
		'app.product_source_property',
		'app.transaction'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PurchaseOrderProduct = ClassRegistry::init('PurchaseOrderProduct');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PurchaseOrderProduct);

		parent::tearDown();
	}

}
