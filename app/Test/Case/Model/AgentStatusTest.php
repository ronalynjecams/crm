<?php
App::uses('AgentStatus', 'Model');

/**
 * AgentStatus Test Case
 */
class AgentStatusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.agent_status',
		'app.user',
		'app.position',
		'app.notification',
		'app.creator',
		'app.department',
		'app.client',
		'app.team'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AgentStatus = ClassRegistry::init('AgentStatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AgentStatus);

		parent::tearDown();
	}

}
