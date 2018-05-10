<?php
App::uses('JobRequestFloorplan', 'Model');

/**
 * JobRequestFloorplan Test Case
 */
class JobRequestFloorplanTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.job_request_floorplan',
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
		'app.quotation_product',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.quotation_product_property',
		'app.delivery_sched_product',
		'app.delivery_schedule',
		'app.quotation_term',
		'app.collection',
		'app.bank',
		'app.collection_schedule',
		'app.job_request_type',
		'app.job_request_product',
		'app.po_raw_request',
		'app.product_combo',
		'app.unit',
		'app.inventory_job_order',
		'app.purchase_order',
		'app.supplier',
		'app.supplier_tag',
		'app.purchase_order_product',
		'app.supplier_product',
		'app.product_source',
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
		'app.po_raw_request_property',
		'app.job_request_revision',
		'app.job_request_assignment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->JobRequestFloorplan = ClassRegistry::init('JobRequestFloorplan');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->JobRequestFloorplan);

		parent::tearDown();
	}

}
