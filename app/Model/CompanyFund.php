<?php
App::uses('AppModel', 'Model');
/**
 * CompanyFund Model
 *
 */
class CompanyFund extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'amount' => array(
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
