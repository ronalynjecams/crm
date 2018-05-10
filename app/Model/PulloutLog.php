<?php
App::uses('AppModel', 'Model');
/**
 * PulloutLog Model
 *
 * @property Pullout $Pullout
 */
class PulloutLog extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'pullout_id' => array(
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
		'Pullout' => array(
			'className' => 'Pullout',
			'foreignKey' => 'pullout_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
