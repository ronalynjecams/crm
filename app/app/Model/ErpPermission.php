<?php
App::uses('AppModel', 'Model');
/**
 * ErpPermission Model
 *
 * @property PermissionUser $PermissionUser
 */
class ErpPermission extends AppModel {


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'PermissionUser' => array(
			'className' => 'PermissionUser',
			'foreignKey' => 'erp_permission_id',
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
