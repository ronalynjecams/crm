<?php
App::uses('AppModel', 'Model');
/**
 * TempProductProperty Model
 *
 * @property TempProduct $TempProduct
 */
class TempProductProperty extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'TempProduct' => array(
			'className' => 'TempProduct',
			'foreignKey' => 'temp_product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
	
	public $hasMany = array(
		'TempProductValue' => array(
			'className' => 'TempProductValue',
			'foreignKey' => 'Temp_product_property_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);
}
