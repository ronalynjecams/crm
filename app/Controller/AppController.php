<?php

App::uses('Controller', 'Controller');

//session_start();
//ob_start();
class AppController extends Controller {

    public $uses = ['User'];
    public $components = array(
        'RequestHandler',
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'users',
                'action' => 'complete_profile'
            ),
            'logoutRedirect' => array(
                'controller' => 'users',
                'action' => 'login'
//                'home'
            ),
            'authenticate' => array(
                'Form' => array(
                    'passwordHasher' => 'Blowfish'
                )
            ),
        )
    );

    public function beforeFilter() {
        parent::beforeFilter();
        $this->layout = 'bootstrap';
        $this->Auth->allow('add', 'view', 'logout', 'login', 'social_login','social_endpoint');

        $this->set('authUser', $this->Auth->user());
        $this->set('userID', $this->Auth->user('id'));
        $this->set('userRole', $this->Auth->user('role'));

//		if($this->Auth->user('id')) { 
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $this->Auth->user('id')));
        $this->set('UserIn', $this->User->find('first', $options));
//                }
        //count pending and revised job requests group by job_request_id
//                where status != ongoing and !=accomplished
        $this->loadModel('JobRequest');
        $jr_head_count_left_side = $this->JobRequest->find('count', array(
        'conditions' => array('JobRequest.status !=' => 'pending' 
            )));
        $this->set(compact('jr_head_count_left_side'));  
        
        $this->loadModel('Quotation');
        $moved_quote_count_left_side = $this->Quotation->find('count', array(
        'conditions' => array('Quotation.status' => 'moved' 
            )));
        $this->set(compact('moved_quote_count_left_side'));  
        
//        if($this->Auth->user('role') == 'new'){
//            return $this->redirect('/users/login?profile=incomplete');
//        }
    }

}
