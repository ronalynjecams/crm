<?php
App::uses('ClientService', 'Model');

/**
 * ClientService Test Case
 */
class ClientServiceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
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
		$this->ClientService = ClassRegistry::init('ClientService');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ClientService);

		parent::tearDown();
	}

}
