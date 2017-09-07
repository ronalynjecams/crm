<?php
App::uses('AppModel', 'Model');
/**
 * DeliveryPaper Model
 *
 * @property DrPaper $DrPaper
 * @property Quotation $Quotation
 */
class DeliveryPaper extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'dr_paper_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'quotation_id' => array(
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
		'DrPaper' => array(
			'className' => 'DrPaper',
			'foreignKey' => 'dr_paper_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Quotation' => array(
			'className' => 'Quotation',
			'foreignKey' => 'quotation_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
