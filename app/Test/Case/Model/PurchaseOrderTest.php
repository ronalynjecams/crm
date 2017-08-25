<?php
App::uses('PurchaseOrder', 'Model');

/**
 * PurchaseOrder Test Case
 */
class PurchaseOrderTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.purchase_order',
		'app.supplier',
		'app.supplier_tag',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.client',
		'app.team',
		'app.agent_status',
		'app.po_product',
		'app.product_source',
		'app.quotation_product',
		'app.quotation',
		'app.job_request',
		'app.jr_product',
		'app.quotation_term',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.quotation_product_property',
		'app.prod_inv_location',
		'app.inv_location',
		'app.inv_log'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PurchaseOrder = ClassRegistry::init('PurchaseOrder');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PurchaseOrder);

		parent::tearDown();
	}

}
