<?php
App::uses('AppModel', 'Model');
/**
 * TempProductValue Model
 *
 * @property TempProductProperty $TempProductProperty
 */
class TempProductValue extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'TempProductProperty' => array(
			'className' => 'TempProductProperty',
			'foreignKey' => 'temp_product_property_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
