<?php
App::uses('AppModel', 'Model');
/**
 * PaymentReplenishedDetail Model
 *
 * @property PaymentReplenishment $PaymentReplenishment
 * @property PaymentRequest $PaymentRequest
 */
class PaymentReplenishedDetail extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'payment_replenishment_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'payment_request_id' => array(
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
		'PaymentReplenishment' => array(
			'className' => 'PaymentReplenishment',
			'foreignKey' => 'payment_replenishment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'PaymentRequest' => array(
			'className' => 'PaymentRequest',
			'foreignKey' => 'payment_request_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
