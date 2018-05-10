<?php
App::uses('InventoryStatus', 'Model');

/**
 * InventoryStatus Test Case
 */
class InventoryStatusTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.inventory_status',
		'app.inventory_product_detail',
		'app.inventory_product_log'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InventoryStatus = ClassRegistry::init('InventoryStatus');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InventoryStatus);

		parent::tearDown();
	}

}
