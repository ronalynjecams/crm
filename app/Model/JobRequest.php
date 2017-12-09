<?php
App::uses('AppModel', 'Model');
/**
 * JobRequest Model
 *
 * @property User $User
 * @property JrProduct $JrProduct
 * @property Quotation $Quotation
 */
class JobRequest extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'jr_number' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		) 
	);

	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */ 

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'JrProduct' => array(
			'className' => 'JrProduct',
			'foreignKey' => 'job_request_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		),
		'Quotation' => array(
			'className' => 'Quotation',
			'foreignKey' => 'job_request_id',
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
