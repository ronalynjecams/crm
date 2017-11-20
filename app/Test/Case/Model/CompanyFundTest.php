<?php
App::uses('CompanyFund', 'Model');

/**
 * CompanyFund Test Case
 */
class CompanyFundTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.company_fund'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CompanyFund = ClassRegistry::init('CompanyFund');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CompanyFund);

		parent::tearDown();
	}

}
