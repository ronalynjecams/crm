<?php
App::uses('EmployeeDetail', 'Model');

/**
 * EmployeeDetail Test Case
 */
class EmployeeDetailTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.employee_detail'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->EmployeeDetail = ClassRegistry::init('EmployeeDetail');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->EmployeeDetail);

		parent::tearDown();
	}

}
