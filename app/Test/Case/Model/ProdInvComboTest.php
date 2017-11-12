<?php
App::uses('ProdInvCombo', 'Model');

/**
 * ProdInvCombo Test Case
 */
class ProdInvComboTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.prod_inv_combo',
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
		'app.prod_inv_location_property',
		'app.prod_inv_condition',
		'app.product_source',
		'app.purchase_order',
		'app.supplier',
		'app.supplier_tag',
		'app.po_product',
		'app.po_product_property',
		'app.product_source_property'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProdInvCombo = ClassRegistry::init('ProdInvCombo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProdInvCombo);

		parent::tearDown();
	}

}
