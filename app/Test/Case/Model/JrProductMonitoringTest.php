<?php
App::uses('JrProductMonitoring', 'Model');

/**
 * JrProductMonitoring Test Case
 */
class JrProductMonitoringTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.jr_product_monitoring',
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
		$this->JrProductMonitoring = ClassRegistry::init('JrProductMonitoring');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->JrProductMonitoring);

		parent::tearDown();
	}

}
