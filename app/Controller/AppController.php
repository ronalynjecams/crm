<?php

App::uses('Controller', 'Controller');

class AppController extends Controller {

    public $uses = ['User'];
    public $components = array(
        'RequestHandler',
        'Session',
        'Auth' => array(
            'loginRedirect' => array(
                'controller' => 'posts',
                'action' => 'index'
            ),
            'logoutRedirect' => array(
                'controller' => 'pages',
                'action' => 'display',
                'home'
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
        $this->Auth->allow('add', 'view', 'logout', 'login');

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
    }

}
