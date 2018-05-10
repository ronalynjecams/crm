<?php
App::uses('InventoryTransaction', 'Model');

/**
 * InventoryTransaction Test Case
 */
class InventoryTransactionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.inventory_transaction',
		'app.client',
		'app.user',
		'app.position',
		'app.notification',
		'app.department',
		'app.social_profile',
		'app.team',
		'app.agent_status',
		'app.inventory_product_log'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->InventoryTransaction = ClassRegistry::init('InventoryTransaction');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->InventoryTransaction);

		parent::tearDown();
	}

}
