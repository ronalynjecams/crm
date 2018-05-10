<?php
App::uses('Subtask', 'Model');

/**
 * Subtask Test Case
 */
class SubtaskTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.subtask',
		'app.task',
		'app.department',
		'app.user',
		'app.position',
		'app.notification',
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
		$this->Subtask = ClassRegistry::init('Subtask');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Subtask);

		parent::tearDown();
	}

}
