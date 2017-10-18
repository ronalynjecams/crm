<?php
App::uses('FitoutPerson', 'Model');

/**
 * FitoutPerson Test Case
 */
class FitoutPersonTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fitout_person',
		'app.fitout_work',
		'app.client',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.social_profile',
		'app.team',
		'app.agent_status',
		'app.fitout_quote',
		'app.fitout_report',
		'app.fitout_report_comment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FitoutPerson = ClassRegistry::init('FitoutPerson');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FitoutPerson);

		parent::tearDown();
	}

}
