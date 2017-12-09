<?php
App::uses('AppModel', 'Model');
/**
 * DeliverySchedProduct Model
 *
 * @property DeliverySchedule $DeliverySchedule
 * @property QuotationProduct $QuotationProduct
 */
class DeliverySchedProduct extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'delivery_schedule_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'quotation_product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'DeliverySchedule' => array(
			'className' => 'DeliverySchedule',
			'foreignKey' => 'delivery_schedule_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		// 'Product' => array(
		// 	'className' => 'Product',
		// 	'foreignKey' => 'product_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// ),
		// 'QuotationProduct' => array(
		// 	'className' => 'QuotationProduct',
		// 	'foreignKey' => 'quotation_product_id',
		// 	'conditions' => '',
		// 	'fields' => '',
		// 	'order' => ''
		// )
	);
}
