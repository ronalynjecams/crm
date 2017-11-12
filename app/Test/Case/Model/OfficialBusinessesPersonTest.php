<?php
App::uses('OfficialBusinessesPerson', 'Model');

/**
 * OfficialBusinessesPerson Test Case
 */
class OfficialBusinessesPersonTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.official_businesses_person',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.client',
		'app.team',
		'app.agent_status',
		'app.social_profile',
		'app.official_business',
		'app.official_business_report'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->OfficialBusinessesPerson = ClassRegistry::init('OfficialBusinessesPerson');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->OfficialBusinessesPerson);

		parent::tearDown();
	}

}
