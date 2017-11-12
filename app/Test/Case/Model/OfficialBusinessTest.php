<?php
App::uses('OfficialBusiness', 'Model');

/**
 * OfficialBusiness Test Case
 */
class OfficialBusinessTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.official_business',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.client',
		'app.team',
		'app.agent_status',
		'app.social_profile',
		'app.official_business_report'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OfficialBusiness = ClassRegistry::init('OfficialBusiness');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OfficialBusiness);

		parent::tearDown();
	}

}
