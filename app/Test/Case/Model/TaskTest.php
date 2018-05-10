<?php
App::uses('Task', 'Model');

/**
 * Task Test Case
 */
class TaskTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.task',
		'app.department',
		'app.user',
		'app.position',
		'app.notification',
		'app.client',
		'app.team',
		'app.agent_status',
		'app.social_profile',
		'app.subtask'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Task = ClassRegistry::init('Task');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Task);

		parent::tearDown();
	}

}
