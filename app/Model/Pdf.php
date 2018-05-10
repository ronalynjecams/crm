<?php
App::uses('AppModel', 'Model');
/**
 * Pdf Model
 *
 */
class Pdf extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
 
    public $actsAs = array('Containable');
    
	public $validate = array(
		'name' => array(
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
}
