<?php
App::uses('AppModel', 'Model');
/**
 * InventoryJobOrder Model
 *
 * @property ProductCombo $ProductCombo
 */
class InventoryJobOrder extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'product_combo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'qty' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'processed_qty' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'reference_num' => array(
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
		'ProductCombo' => array(
			'className' => 'ProductCombo',
			'foreignKey' => 'product_combo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
		'PurchaseOrder' => array(
			'className' => 'PurchaseOrder',
			'foreignKey' => 'reference_num',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
		'Quotation' => array(
			'className' => 'Quotation',
			'foreignKey' => 'reference_num',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		
		'ClientService' => array(
			'className' => 'ClientService',
			'foreignKey' => 'reference_num',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
