<?php
App::uses('ProdInvLocation', 'Model');

/**
 * ProdInvLocation Test Case
 */
class ProdInvLocationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.prod_inv_location',
		'app.inv_location',
		'app.inv_log',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.product_source',
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
		'app.purchase_order'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ProdInvLocation = ClassRegistry::init('ProdInvLocation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ProdInvLocation);

		parent::tearDown();
	}

}
