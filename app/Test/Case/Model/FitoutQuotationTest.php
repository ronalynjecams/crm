<?php
App::uses('FitoutQuotation', 'Model');

/**
 * FitoutQuotation Test Case
 */
class FitoutQuotationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fitout_quotation',
		'app.qoutation',
		'app.fitout_work',
		'app.client',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.social_profile',
		'app.team',
		'app.agent_status',
		'app.fitout_person',
		'app.fitout_quote',
		'app.fitout_report',
		'app.fitout_report_comment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FitoutQuotation = ClassRegistry::init('FitoutQuotation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FitoutQuotation);

		parent::tearDown();
	}

}
