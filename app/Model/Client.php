<?php
App::uses('AppModel', 'Model');
/**
 * Client Model
 *
 * @property User $User
 */
class Client extends AppModel {


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
		'Team' => array(
			'className' => 'Team',
			'foreignKey' => 'team_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'ClientIndustry' => array(
			'className' => 'ClientIndustry',
			'foreignKey' => 'client_industry_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
