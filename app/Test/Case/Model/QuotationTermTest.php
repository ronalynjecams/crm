<?php
App::uses('QuotationTerm', 'Model');

/**
 * QuotationTerm Test Case
 */
class QuotationTermTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.quotation_term',
		'app.collection',
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
		'app.quotation_product',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.quotation_product_property',
		'app.bank',
		'app.collection_schedule'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->QuotationTerm = ClassRegistry::init('QuotationTerm');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->QuotationTerm);

		parent::tearDown();
	}

}
