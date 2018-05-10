<?php
App::uses('InventoryProductLog', 'Model');

/**
 * InventoryProductLog Test Case
 */
class InventoryProductLogTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.inventory_product_log',
		'app.inventory_product_details',
		'app.inventory_status',
		'app.inventory_product_detail',
		'app.product_combo',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.unit',
		'app.inventory_job_order',
		'app.purchase_order',
		'app.supplier',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.client',
		'app.team',
		'app.agent_status',
		'app.social_profile',
		'app.supplier_tag',
		'app.purchase_order_product',
		'app.supplier_product',
		'app.product_source',
		'app.quotation_product',
		'app.quotation',
		'app.job_request',
		'app.job_request_product',
		'app.job_request_type',
		'app.job_request_floorplan',
		'app.po_raw_request',
		'app.jr_product',
		'app.po_raw_request_property',
		'app.job_request_assignment',
		'app.job_request_revision',
		'app.quotation_term',
		'app.collection',
		'app.bank',
		'app.collection_schedule',
		'app.quotation_product_property',
		'app.delivery_sched_product',
		'app.delivery_schedule',
		'app.prod_inv_location',
		'app.inv_location',
		'app.inv_log',
		'app.prod_inv_combo',
		'app.prod_inv_location_property',
		'app.prod_inv_condition',
		'app.product_source_property',
		'app.client_service',
		'app.inventory_product',
		'app.product_combo_property',
		'app.inventory_transaction'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InventoryProductLog = ClassRegistry::init('InventoryProductLog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InventoryProductLog);

		parent::tearDown();
	}

}
