<?php
App::uses('AdditionalImage', 'Model');

/**
 * AdditionalImage Test Case
 */
class AdditionalImageTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.additional_image',
		'app.product',
		'app.sub_category',
		'app.category',
		'app.product_property',
		'app.product_value'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->AdditionalImage = ClassRegistry::init('AdditionalImage');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->AdditionalImage);

		parent::tearDown();
	}

}
