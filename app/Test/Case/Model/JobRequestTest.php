<?php
App::uses('JobRequest', 'Model');

/**
 * JobRequest Test Case
 */
class JobRequestTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.job_request',
		'app.user',
		'app.position',
		'app.notification',
		'app.creator',
		'app.department',
		'app.client',
		'app.team',
		'app.agent_status',
		'app.jr_product',
		'app.quotation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->JobRequest = ClassRegistry::init('JobRequest');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->JobRequest);

		parent::tearDown();
	}

}
