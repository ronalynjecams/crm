<?php
App::uses('ErpPermission', 'Model');

/**
 * ErpPermission Test Case
 */
class ErpPermissionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.erp_permission',
		'app.permission_user'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->ErpPermission = ClassRegistry::init('ErpPermission');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->ErpPermission);

		parent::tearDown();
	}

}
