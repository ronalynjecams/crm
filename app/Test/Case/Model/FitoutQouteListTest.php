<?php
App::uses('FitoutQouteList', 'Model');

/**
 * FitoutQouteList Test Case
 */
class FitoutQouteListTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.fitout_qoute_list',
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
		$this->FitoutQouteList = ClassRegistry::init('FitoutQouteList');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->FitoutQouteList);

		parent::tearDown();
	}

}
