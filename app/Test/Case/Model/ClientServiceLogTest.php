<?php
App::uses('ClientServiceLog', 'Model');

/**
 * ClientServiceLog Test Case
 */
class ClientServiceLogTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.client_service_log',
		'app.client_service',
		'app.client',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.social_profile',
		'app.team',
		'app.agent_status'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ClientServiceLog = ClassRegistry::init('ClientServiceLog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientServiceLog);

		parent::tearDown();
	}

}
