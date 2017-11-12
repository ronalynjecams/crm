<?php
App::uses('OfficialBusinessReport', 'Model');

/**
 * OfficialBusinessReport Test Case
 */
class OfficialBusinessReportTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.official_business_report',
		'app.official_business',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.client',
		'app.team',
		'app.agent_status',
		'app.social_profile'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OfficialBusinessReport = ClassRegistry::init('OfficialBusinessReport');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OfficialBusinessReport);

		parent::tearDown();
	}

}
