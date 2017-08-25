<?php
App::uses('PoRawRequest', 'Model');

/**
 * PoRawRequest Test Case
 */
class PoRawRequestTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.po_raw_request',
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
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.quotation_product_property',
		'app.po_raw_request_property'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PoRawRequest = ClassRegistry::init('PoRawRequest');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PoRawRequest);

		parent::tearDown();
	}

}
