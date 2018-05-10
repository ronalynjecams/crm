<?php
App::uses('TaskDetail', 'Model');

/**
 * TaskDetail Test Case
 */
class TaskDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.task_detail',
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
		$this->TaskDetail = ClassRegistry::init('TaskDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->TaskDetail);

		parent::tearDown();
	}

}
