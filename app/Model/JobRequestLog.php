<?php
App::uses('AppModel', 'Model');
/**
 * JobRequestLog Model
 *
 * @property User $User
 * @property JobRequest $JobRequest
 * @property JobRequestProduct $JobRequestProduct
 * @property JobRequestAssignment $JobRequestAssignment
 * @property QuotationProduct $QuotationProduct
 * @property JobRequestRevision $JobRequestRevision
 */
class JobRequestLog extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'user_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'job_request_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'job_request_floorplan_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'job_request_product_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'job_request_assignment_id' => array(
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
		'job_request_revision_id' => array(
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
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'JobRequest' => array(
			'className' => 'JobRequest',
			'foreignKey' => 'job_request_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'JobRequestFloorplan' => array(
			'className' => 'JobRequestFloorplan',
			'foreignKey' => 'job_request_floorplan_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'JobRequestProduct' => array(
			'className' => 'JobRequestProduct',
			'foreignKey' => 'job_request_product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'JobRequestAssignment' => array(
			'className' => 'JobRequestAssignment',
			'foreignKey' => 'job_request_assignment_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'QuotationProduct' => array(
			'className' => 'QuotationProduct',
			'foreignKey' => 'quotation_product_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'JobRequestRevision' => array(
			'className' => 'JobRequestRevision',
			'foreignKey' => 'job_request_revision_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
