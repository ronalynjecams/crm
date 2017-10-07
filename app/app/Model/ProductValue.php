<?php
App::uses('AppModel', 'Model');
/**
 * ProductValue Model
 *
 * @property ProductProperty $ProductProperty
 */
class ProductValue extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'ProductProperty' => array(
			'className' => 'ProductProperty',
			'foreignKey' => 'product_property_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
