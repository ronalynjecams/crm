<?php
App::uses('FitoutQuote', 'Model');

/**
 * FitoutQuote Test Case
 */
class FitoutQuoteTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fitout_quote',
		'app.qoutation',
		'app.fitout_work',
		'app.client',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.social_profile',
		'app.team',
		'app.agent_status',
		'app.fitout_person',
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
		$this->FitoutQuote = ClassRegistry::init('FitoutQuote');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FitoutQuote);

		parent::tearDown();
	}

}
