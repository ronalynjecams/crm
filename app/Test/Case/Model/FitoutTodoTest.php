<?php
App::uses('FitoutTodo', 'Model');

/**
 * FitoutTodo Test Case
 */
class FitoutTodoTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fitout_todo',
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
		$this->FitoutTodo = ClassRegistry::init('FitoutTodo');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FitoutTodo);

		parent::tearDown();
	}

}
