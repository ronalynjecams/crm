<?php
App::uses('FitoutReportComment', 'Model');

/**
 * FitoutReportComment Test Case
 */
class FitoutReportCommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fitout_report_comment',
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
		'app.fitout_quote'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->FitoutReportComment = ClassRegistry::init('FitoutReportComment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FitoutReportComment);

		parent::tearDown();
	}

}
