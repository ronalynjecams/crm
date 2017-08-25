<?php
App::uses('SupplierTag', 'Model');

/**
 * SupplierTag Test Case
 */
class SupplierTagTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.supplier_tag',
		'app.supplier'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->SupplierTag = ClassRegistry::init('SupplierTag');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->SupplierTag);

		parent::tearDown();
	}

}
