<?php

App::uses('AppController', 'Controller');
//Configure::write('debug', 0);
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
session_start();
ob_start();

class UsersController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator', 'Hybridauth');
    public $uses = ['User', 'SocialProfile', 'Role', 'Position', 'Department', 'Team', 'AgentStatus'];

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('login', 'add', 'social_login', 'social_endpoint');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->Paginator->paginate());
    }

    ///

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->User->create();
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => '/index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }

        $positions = $this->Position->find('list');
        $departments = $this->Department->find('list');
        $this->set(compact('departments', 'positions'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
            $this->request->data = $this->User->find('first', $options);
        }
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('The user has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The user could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function login() {
        if ($this->Auth->user('id')) {
//			$this->redirect('/users/dashboard'); 
            if ($this->Auth->user('role') == 'sales_executive') {
                return $this->redirect('/users/dashboard_sales');
            } else if ($this->Auth->user('role') == 'marketing_staff') {
                return $this->redirect('/users/dashboard_marketing');
            } else if ($this->Auth->user('role') == 'super_admin') {
                return $this->redirect('/users/dashboard_super_admin');
            } else if ($this->Auth->user('role') == 'it_staff') {
                return $this->redirect('/users/dashboard_it_staff');
            } else if ($this->Auth->user('role') == 'design_head') {
                return $this->redirect('/users/dashboard_design_head');
            } else if ($this->Auth->user('role') == 'designer') {
                return $this->redirect('/users/dashboard_designer');
            } else if ($this->Auth->user('role') == 'supply_staff') {
                return $this->redirect('/users/dashboard_supply');
            } else if ($this->Auth->user('role') == 'raw_head') {
                return $this->redirect('/users/dashboard_raw');
            } else if ($this->Auth->user('role') == 'warehouse_head_raw') {
                return $this->redirect('/users/dashboard_warehouse_raw');
            } else if ($this->Auth->user('role') == 'warehouse_head_supply') {
                return $this->redirect('/users/dashboard_warehouse_supply');
            } else if ($this->Auth->user('role') == 'collection_officer') {
                return $this->redirect('/users/dashboard_collection_officer');
            } else if ($this->Auth->user('role') == 'production_head') {
                return $this->redirect('/users/dashboard_production_head');
            }
        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {

                if ($this->Auth->user('role') == 'sales_executive') {
                    return $this->redirect('/users/dashboard_sales');
                } else if ($this->Auth->user('role') == 'marketing_staff') {
                    return $this->redirect('/users/dashboard_marketing');
                } else if ($this->Auth->user('role') == 'super_admin') {
                    return $this->redirect('/users/dashboard_super_admin');
                } else if ($this->Auth->user('role') == 'design_head') {
                    return $this->redirect('/users/dashboard_design_head');
                } else if ($this->Auth->user('role') == 'designer') {
                    return $this->redirect('/users/dashboard_designer');
                } else if ($this->Auth->user('role') == 'supply_staff') {
                    return $this->redirect('/users/dashboard_supply');
                } else if ($this->Auth->user('role') == 'raw_head') {
                    return $this->redirect('/users/dashboard_raw');
                } else if ($this->Auth->user('role') == 'warehouse_head_raw') {
                    return $this->redirect('/users/dashboard_warehouse_raw');
                } else if ($this->Auth->user('role') == 'warehouse_head_supply') {
                    return $this->redirect('/users/dashboard_warehouse_supply');
                } else if ($this->Auth->user('role') == 'collection_officer') {
                    return $this->redirect('/users/dashboard_collection_officer');
                } else if ($this->Auth->user('role') == 'production_head') {
                    return $this->redirect('/users/dashboard_production_head');
                }
            }

            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        return $this->redirect($this->Auth->logout());
    }

    public function dashboard() {
        
    }

    public function dashboard_sales() {
        
    }

    public function demo_icons() {
        
    }

    public function social_login($provider) {
        if ($this->Hybridauth->connect($provider)) {
            $this->_successfulHybridauth($provider, $this->Hybridauth->user_profile);
        } else {
            // error
            $this->Session->setFlash($this->Hybridauth->error);
            $this->redirect($this->Auth->loginAction);
        }
    }
 
    private function _successfulHybridauth($provider, $incomingProfile) {

        // #1 - check if user already authenticated using this provider before
        $this->SocialProfile->recursive = -1;
        $existingProfile = $this->SocialProfile->find('first', array(
            'conditions' => array('social_network_id' => $incomingProfile['SocialProfile']['social_network_id'], 'social_network_name' => $provider)
        ));

        if ($existingProfile) {
            // #2 - if an existing profile is available, then we set the user as connected and log them in
            $user = $this->User->find('first', array(
                'conditions' => array('User.id' => $existingProfile['SocialProfile']['user_id'])
            ));
//	        pr($user);exit;
            if ($user['User']['active'] == 1) {
                $this->_doSocialLogin($user, true);
            } else {
                $this->Session->setFlash('This account is not active anymore.', 'default', ['class' => 'message login-error']);
                $this->redirect('/users/login');
            }
        } else {

            // New profile.
            if ($this->Auth->loggedIn()) {
                // user is already logged-in , attach profile to logged in user.
                // create social profile linked to current user
                $incomingProfile['SocialProfile']['user_id'] = $this->Auth->user('id');
                $this->SocialProfile->save($incomingProfile);

                $this->Session->setFlash('Your ' . $incomingProfile['SocialProfile']['social_network_name'] . ' account is now linked to your account.');
                $this->redirect($this->Auth->redirectUrl());
            } else {
                // no-one logged and no profile, must be a registration.
                $user = $this->User->createFromSocialProfile($incomingProfile);
                $incomingProfile['SocialProfile']['user_id'] = $user['User']['id'];
                $this->SocialProfile->save($incomingProfile);

                // log in with the newly created user
                $this->_doSocialLogin($user);
            }
        }
    }

    public function social_endpoint($provider = "Google") {
//            pr("sadasdas");
        $this->Hybridauth->processEndpoint();
    }

    private function _doSocialLogin($user, $returning = false) {


        if ($this->Auth->login($user['User'])) {
            if ($returning) {
                // $this->Session->setFlash(__('Welcome back, '. $this->Auth->user('username')));
            } else {
                $this->Session->setFlash(__('Welcome to our community, ' . $this->Auth->user('username')));
            }
 
            $this->redirect($this->Auth->loginRedirect);
        } else {
            $this->Session->setFlash(__('Unknown Error could not verify the user: ' . $this->Auth->user('username')));
        }
    }

    public function complete_profile() {
        //if user role==new
//        if ($this->Auth->user('role') == 'new') {
//
//            $this->Auth->logout();
//            if ($this->Auth->logout()) {
//                return $this->redirect('/users/incomplete_profile');
//            }
//        }else{
//            $this->login();
//        }
 
        //if user role != new
//            redirect to what page depending on dept
    }
    
    public function hr_info(){
        
    }

}
