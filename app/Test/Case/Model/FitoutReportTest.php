<?php
App::uses('FitoutReport', 'Model');

/**
 * FitoutReport Test Case
 */
class FitoutReportTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fitout_report',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.client',
		'app.team',
		'app.agent_status',
		'app.social_profile',
		'app.fitout_work',
		'app.fitout_person',
		'app.fitout_quote',
		'app.fitout_report_comment'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FitoutReport = ClassRegistry::init('FitoutReport');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FitoutReport);

		parent::tearDown();
	}

}
