<?php
App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
/**
 * User Model
 *
 */
class User extends AppModel {

	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash(
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	} 


	// The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Position' => array(
			'className' => 'Position',
			'foreignKey' => 'position_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		),
		'Department' => array(
			'className' => 'Department',
			'foreignKey' => 'department_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Client' => array(
			'className' => 'Client',
			'foreignKey' => 'user_id',
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
                'SocialProfile' => array(
                    'className' => 'SocialProfile',
                )
	);
        
        public function createFromSocialProfile($incomingProfile){
	    // check to ensure that we are not using an email that already exists
	    $existingUser = $this->find('first', array(
	        'conditions' => array('email' => $incomingProfile['SocialProfile']['email'])));
	     
	    if($existingUser){
	        // this email address is already associated to a member
	        return $existingUser;
	    }
	     
	    // brand new user
	    $socialUser['User']['email'] = $incomingProfile['SocialProfile']['email'];
	    $socialUser['User']['username'] = strtolower(str_replace(' ', '_',$incomingProfile['SocialProfile']['display_name']));
	    $socialUser['User']['first_name'] = $incomingProfile['SocialProfile']['first_name'];
	    $socialUser['User']['last_name'] = $incomingProfile['SocialProfile']['last_name'];
	    $socialUser['User']['role'] = 'new'; 
	    $socialUser['User']['picture'] = $incomingProfile['SocialProfile']['picture'];
	    // $socialUser['User']['role'] = 'bishop'; // by default all social logins will have a role of bishop
                $socialUser['User']['password'] = "J3c@ms|nc"; // although it technically means nothing, we still need a password for social. setting it to something random like the current time..
	    $socialUser['User']['created'] = date('Y-m-d h:i:s');
	    $socialUser['User']['modified'] = date('Y-m-d h:i:s');
	     
	    // save and store our ID
	    $this->save($socialUser);
	    $socialUser['User']['id'] = $this->id;
//	    
//	    $hash = md5(rand(0,1000));
//		$this->Verilink->create();
//		$this->Verilink->set([
//			'user_id'=>$this->id,
//			'rand'=>$hash, 
//			'type'=>'new'
//		]);
//			
//		$this->Verilink->save();
	     
	    return $socialUser;
	}

}
