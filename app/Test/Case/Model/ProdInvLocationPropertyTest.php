<?php
App::uses('ProdInvLocationProperty', 'Model');

/**
 * ProdInvLocationProperty Test Case
 */
class ProdInvLocationPropertyTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.prod_inv_location_property',
		'app.prod_inv_location',
		'app.inv_location',
		'app.inv_log',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.quotation_product',
		'app.quotation',
		'app.client',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.team',
		'app.agent_status',
		'app.job_request',
		'app.jr_product',
		'app.quotation_term',
		'app.quotation_product_property',
		'app.product_source',
		'app.purchase_order',
		'app.supplier',
		'app.supplier_tag',
		'app.po_product',
		'app.po_product_property',
		'app.prod_inv_condition'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProdInvLocationProperty = ClassRegistry::init('ProdInvLocationProperty');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProdInvLocationProperty);

		parent::tearDown();
	}

}
