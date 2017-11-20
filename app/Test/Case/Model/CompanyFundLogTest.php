<?php
App::uses('CompanyFundLog', 'Model');

/**
 * CompanyFundLog Test Case
 */
class CompanyFundLogTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.company_fund_log'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CompanyFundLog = ClassRegistry::init('CompanyFundLog');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CompanyFundLog);

		parent::tearDown();
	}

}
