<?php
App::uses('DrPaper', 'Model');

/**
 * DrPaper Test Case
 */
class DrPaperTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.dr_paper'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->DrPaper = ClassRegistry::init('DrPaper');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->DrPaper);

		parent::tearDown();
	}

}
