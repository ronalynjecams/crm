<?php
App::uses('JrUpload', 'Model');

/**
 * JrUpload Test Case
 */
class JrUploadTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.jr_upload',
		'app.jr_product',
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
		'app.quotation_term',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value',
		'app.quotation_product_property'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->JrUpload = ClassRegistry::init('JrUpload');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->JrUpload);

		parent::tearDown();
	}

}
