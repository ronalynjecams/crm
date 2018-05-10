<?php

App::uses('AppController', 'Controller');
//Configure::write('debug', 0);
/**
 * Users Controller
 *
 * @property User $User
 * @property PaginatorComponent $Paginator
 */
// session_start();
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
        $this->Auth->allow('login', 'add', 'social_login', 'social_endpoint', 'phpinfopr');
    }

    /**
     * index method
     *
     * @return void
     */
     
    public function phpinfopr(){
        echo phpinfo();
    }
     
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
// pr(phpinfo());

        if ($this->Auth->user('id')) {
//			$this->redirect('/users/dashboard'); 
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
            } else if ($this->Auth->user('role') == 'hr_head') {
                return $this->redirect('/users/dashboard_hr_head');
            } else if ($this->Auth->user('role') == 'logistics_head') {
                return $this->redirect('/users/dashboard_logistics_head');
            } else if ($this->Auth->user('role') == 'fitout_facilitator') {
                return $this->redirect('/users/dashboard_fitout');
            } else if ($this->Auth->user('role') == 'it_staff') {
                return $this->redirect('/users/dashboard_it_staff');
            } else if ($this->Auth->user('role') == 'admin_staff') {
                return $this->redirect('/users/dashboard_admin_staff');
            }  else if ($this->Auth->user('role') == 'proprietor') {
                return $this->redirect('/users/dashboard_proprietor');
            }   else if ($this->Auth->user('role') == 'accounting_head') {
                    return $this->redirect('/users/dashboard_accounting_head');
            }  else if ($this->Auth->user('role') == 'sales_manager') {
                    return $this->redirect('/users/dashboard_sales_manager');
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
                } else if ($this->Auth->user('role') == 'hr_head') {
                    return $this->redirect('/users/dashboard_hr_head');
                } else if ($this->Auth->user('role') == 'logistics_head') {
                    return $this->redirect('/users/dashboard_logistics_head');
                } else if ($this->Auth->user('role') == 'fitout_facilitator') {
                    return $this->redirect('/users/dashboard_fitout');
                } else if ($this->Auth->user('role') == 'it_staff') {
                    return $this->redirect('/users/dashboard_it_staff');
                } else if ($this->Auth->user('role') == 'admin_staff') {
                    return $this->redirect('/users/dashboard_admin_staff');
                }  else if ($this->Auth->user('role') == 'proprietor') {
                    return $this->redirect('/users/dashboard_proprietor');
                }  else if ($this->Auth->user('role') == 'accounting_head') {
                    return $this->redirect('/users/dashboard_accounting_head');
                }   else if ($this->Auth->user('role') == 'sales_manager') {
                    return $this->redirect('/users/dashboard_sales_manager');
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
        $user_id = $this->Auth->user('id');
        
        $month = date('F');
        $year = date('Y');
        $today = date('F d, Y');
        
        $yearly = $this->agent_total('yearly', $user_id);
        $monthly = $this->agent_total('monthly', $user_id);
        $daily = $this->agent_total('daily', $user_id);
        
        $this->set(compact('month', 'year', 'today', 'yearly', 'monthly', 'daily'));
    }
    
    public function dashboard_sales_manager() {
        $this->loadModel('Team');
        $user_id = $this->Auth->user('id');
        $team_id = "";
        $this->Team->recursive = -1;
        $team = $this->Team->findByTeamManager($user_id);
        if($team) $team_id = $team['Team']['id'];
        $month = date('F');
        $year = date('Y');
        $today = date('F d, Y');
        
        $yearly = $this->team_total('yearly', $team_id);
        $monthly = $this->team_total('monthly', $team_id);
        $daily = $this->team_total('daily', $team_id);
        
        $this->set(compact('month', 'year', 'today', 'yearly', 'monthly', 'daily', 'team'));
        
        // $this->loadModel('Quotation');
        // $get_quotations = [];
        // $this->Quotation->recursive = -1;
        // foreach($get_users as $ret_users) {
        //     $agent_status = $ret_users['AgentStatus'];
        //     $agent_status_id = $agent_status['id'];
        //     $user_id = $agent_status['user_id'];
            
        //     $get_quotations[$agent_status_id] = $this->Quotation->find('all',
        //         ['conditions'=>['Quotation.user_id'=>$user_id]]);
        // }
        
        // $this->set(compact('get_quotations'));
        
        $this->loadModel('AgentStatus');
        $get_agent_statuses = $this->AgentStatus->find('all');
        
        $this->loadModel('User');
        $get_users_tmp = $this->User->find('all',
            ['conditions'=>['active'=>1,
                            'role'=>'sales_executive']]);
        
        $sales_agents = [];          
        foreach($get_agent_statuses as $ret_agent_statuses) {
            $agent_status = $ret_agent_statuses['AgentStatus'];
            $team = $ret_agent_statuses['Team'];
            $team_sales_manager_id = $team['team_manager'];
            
            if($team_sales_manager_id==$user_id) {
                $sales_agents[] = $agent_status['user_id'];
            }
        }
        
        $get_users = [];
        $this->User->recursive = -1;
        foreach($get_users_tmp as $ret_users_tmp) {
            $user_tmp = $ret_users_tmp['User'];
            $ret_users_tmp_id = $user_tmp['id'];
            
            if(in_array($ret_users_tmp_id, $sales_agents)) {
                $get_users[] = $this->User->findById($ret_users_tmp_id);
            }
        }
        
        $this->set(compact('get_users'));
        $this->loadModel('Quotation');
        $this->loadModel('AgentStatus');
        
        $get_quotations = [];
        $get_agent_status = [];
        $current_mo = date("m");
        
        $this->Quotation->recursive = -1;
        foreach($get_users as $ret_users) {
            $user_id = $ret_users['User']['id'];
            
            $get_quotations[$user_id] = $this->Quotation->find('all',
                ['conditions'=>['Quotation.user_id'=>$user_id,
                                'AND'=>
                                        [['YEAR(date_moved)' => date('Y')],
                                        ['MONTH(date_moved)' => $current_mo]],
                                     'OR'=>
                                        [['Quotation.status'=>'approved'],
                                         ['Quotation.status'=>'processed']]]]);
            
            $get_agent_status[$user_id] = $this->AgentStatus->find('all',
                ['conditions'=>['AgentStatus.user_id'=>$user_id]]);
        }
        
        $this->set(compact('get_quotations', 'get_agent_status'));
    }

    public function dashboard_proprietor() {
        $month = date('F');
        $year = date('Y');
        $today = date('F d, Y');
        
        $yearly = $this->yearly_total();
        $monthly = $this->monthly_total();
        $daily = $this->daily_total();
        
        $team_daily = $this->team_total('daily');
        $team_monthly = $this->team_total('monthly');
        $team_yearly = $this->team_total('yearly');
        // echo $today; exit;
        // $this->loadModel('Quotation');
        // $passed_status = $this->params['url']['status'];
        
        // $status1 = $this->quotation1($passed_status);
        // #pr($status1);
        
        
        //  $passed_month = $this->params['url']['month'];
        //  $status2 = $this->quotation2($passed_status, $passed_month);
        //  pr($status2);
         
        //  $passed_year = $this->params['url']['year'];
        //  $status3 = $this->quotation3($passed_status, $passed_year);
        //  //pr($status3);
        
        // // $status4 = $this->quotation4();
        // $this->set('status1', $status1);
        $this->set(compact('month', 'year', 'today', 'yearly', 'monthly', 'daily', 'team_daily', 'team_monthly', 'team_yearly'));
        
        // $get_users = $this->AgentStatus->find('all');
        
        $this->loadModel('User');
        $get_users = $this->User->find('all',
            ['conditions'=>['active'=>1,
                            'role'=>'sales_executive']]);
            
        $this->set(compact('get_users'));
            
        $this->loadModel('Quotation');
        $this->loadModel('AgentStatus');
        
        $get_quotations = [];
        $get_agent_status = [];
        $current_mo = date("m");
        $this->Quotation->recursive = -1;
        foreach($get_users as $ret_users) {
            $user_id = $ret_users['User']['id'];
            
            $get_quotations[$user_id] = $this->Quotation->find('all',
                ['conditions' =>
                    ['Quotation.user_id'=>$user_id,
                     'AND'=>
                        [['YEAR(date_moved)' => date('Y')],
                        ['MONTH(date_moved)' => $current_mo]],
                     'OR'=>
                        [['Quotation.status'=>'approved'],
                         ['Quotation.status'=>'processed']]]]);
            
            $get_agent_status[$user_id] = $this->AgentStatus->find('all',
                ['conditions'=>['AgentStatus.user_id'=>$user_id]]);
        }
        
        $this->set(compact('get_quotations', 'get_agent_status'));
    }
    
    public function quotation1($passed_status){
        $this->loadModel('Quotation');
		//array('ongoing','pending','moved','approved','processed','revised','lost','deleted','void','accounting_moved');
	
         if($passed_status == 'approved' || $passed_status == 'processed'){
        
                $status1 = $this->Quotation->find('all', array(
                'conditions'=>['Quotation.status'=>[$passed_status]],
                'fields' => ['SUM(Quotation.grand_total)']
                )
                ); 
                 $this->set(compact('status1'));
                return $status1;
         }
        
    }
    
    public function quotation2($passed_status, $passed_month){
        $this->loadModel('Quotation');
         
        //condition to validate status
        
                $status2 = $this->Quotation->find('all', array(
                'conditions'=>['Quotation.status'=>$passed_status, 'MONTH(Quotation.date_moved)'=>$passed_month],
                'fields' => ['SUM(Quotation.grand_total)']
                )
                ); 
                $this->set(compact('status2'));
                return $status2;
    }
    
    public function quotation3($passed_status, $passed_year){
        $this->loadModel('Quotation');
        
        //condition to validate status
        
                $status3 = $this->Quotation->find('all', array(
                'conditions'=>['Quotation.status'=>$passed_status, 'YEAR(Quotation.date_moved)'=>$passed_year],
                'fields' => ['SUM(Quotation.grand_total)']
                )
                ); 
                $this->set(compact('status3'));
                return $status3;
        
    }
    
        public function quotation4(){
        $this->loadModel('Quotation');
        
		$passed_status = $this->params['url']['status'];
		$passed_date = $this->params['url']['date'];
         
        //condition to validate status
        
                $status4 = $this->Quotation->find('all', array(
                'conditions'=>['Quotation.status'=>$passed_status, 'CURDATE(Quotation.date_moved)'=>$passed_date],
                'fields' => ['SUM(Quotation.grand_total)']
                )
                ); 
                
                $this->set(compact('status4'));
                return $status4;

        
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
            // pr("sadasdas");
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
        if ($this->Auth->user('role') == 'new') {

//            $this->Auth->logout();
//            if ($this->Auth->logout()) {
            return $this->redirect('/users/login_error?status=incomplete');

//            }
        } else {
            // if ($this->Auth->user('role') == 'sales_executive') {
            //     return $this->redirect('/users/dashboard_sales');
            // } else if ($this->Auth->user('role') == 'marketing_staff') {
            //     return $this->redirect('/users/dashboard_marketing');
            // } else if ($this->Auth->user('role') == 'super_admin') {
            //     return $this->redirect('/users/dashboard_super_admin');
            // } else if ($this->Auth->user('role') == 'design_head') {
            //     return $this->redirect('/users/dashboard_design_head');
            // } else if ($this->Auth->user('role') == 'designer') {
            //     return $this->redirect('/users/dashboard_designer');
            // } else if ($this->Auth->user('role') == 'supply_staff') {
            //     return $this->redirect('/users/dashboard_supply');
            // } else if ($this->Auth->user('role') == 'raw_head') {
            //     return $this->redirect('/users/dashboard_raw');
            // } else if ($this->Auth->user('role') == 'warehouse_head_raw') {
            //     return $this->redirect('/users/dashboard_warehouse_raw');
            // } else if ($this->Auth->user('role') == 'warehouse_head_supply') {
            //     return $this->redirect('/users/dashboard_warehouse_supply');
            // } else if ($this->Auth->user('role') == 'collection_officer') {
            //     return $this->redirect('/users/dashboard_collection_officer');
            // } else if ($this->Auth->user('role') == 'production_head') {
            //     return $this->redirect('/users/dashboard_production_head');
            // } else if ($this->Auth->user('role') == 'hr_head') {
            //     return $this->redirect('/users/hr_head');
            // }  //////////////////new admin staff dashboard
            //   else if ($this->Auth->user('role') == 'admin_staff') {
            //     return $this->redirect('/users/dashboard_admin_staff');
            // } 
            
            //copied from login action
            
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
            } else if ($this->Auth->user('role') == 'hr_head') {
                return $this->redirect('/users/dashboard_hr_head');
            } else if ($this->Auth->user('role') == 'logistics_head') {
                return $this->redirect('/users/dashboard_logistics_head');
            } else if ($this->Auth->user('role') == 'fitout_facilitator') {
                return $this->redirect('/users/dashboard_fitout');
            } else if ($this->Auth->user('role') == 'it_staff') {
                return $this->redirect('/users/dashboard_it_staff');
            } else if ($this->Auth->user('role') == 'admin_staff') {
                return $this->redirect('/users/dashboard_admin_staff');
            }  else if ($this->Auth->user('role') == 'proprietor') {
                return $this->redirect('/users/dashboard_proprietor');
            }   else if ($this->Auth->user('role') == 'accounting_head') {
                    return $this->redirect('/users/dashboard_accounting_head');
            }  else if ($this->Auth->user('role') == 'sales_manager') {
                    return $this->redirect('/users/dashboard_sales_manager');
            } 
        }
// 
        //if user role != new
//            redirect to what page depending on dept
    }

    public function login_error() {
        $status = $this->params['url']['status'];
        if ($status == 'incomplete') {
            $this->Session->setFlash(__('Please contact HR Department for profile completion'));
        }
    }

     // MARK: OFFLINE MODIFICATION
    public function incomplete_profile() {
        $this->loadModel('Position');
        $this->loadModel('Department');
        $this->loadModel('Role');
        $this->loadModel('Team');
        $teams = $this->Team->find('all');
        $users = $this->User->find('all', ['conditions' => ['User.role' => 'new']]);


        $roles = $this->Role->find('all');
//        pr($roles);exit;
        $positions = $this->Position->find('all');
        $departments = $this->Department->find('all');
        $this->set(compact('users', 'positions', 'departments', 'roles', 'teams'));
    }

    public function update_role() {

        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $user_id = $data['user_id'];
        $role = $data['role'];
        $position_id = $data['position_id'];
        $department_id = $data['department_id'];

        $user_set = [
            'role' => $role,
            'position_id' => $position_id,
            'department_id' => $department_id,
        ];

        $DS_User = $this->User->getDataSource();
        $DS_User->begin();
        $this->User->id = $user_id;
        $this->User->set($user_set);
        if ($this->User->save()) {
            echo json_encode($data);

            if($role=="Sales Executive" || $role=="Sales Manager") {
                $this->loadModel('AgentStatus');
                $DS_AgentStatus = $this->AgentStatus->getDataSource();
                $DS_AgentStatus->begin();

                $quota = $data['quota'];
                $team = $data['team'];

                $agentstatus_set = ['quota'=>$quota,
                                    'user_id'=>$user_id,
                                    'team_id'=>$team];
                $this->AgentStatus->set($agentstatus_set);
                if($this->AgentStatus->save()) {
                    $DS_AgentStatus->commit();
                    $DS_User->commit();
                }
                else {
                    $DS_User->rollback();
                }
            }
            else {
                $DS_User->commit();
            }
        } else {
            echo json_encode('invalid data');
        }

        exit;
    }
    // MARK: END OF OFFLINE MODIFICATION

    public function dashboard_marketing() {
        
    }

    public function dashboard_super_admin() {
        
    }

    public function dashboard_it_staff() {
        
    }

    public function dashboard_design_head() {
        
    }

    public function dashboard_designer() {
        
    }

    public function dashboard_supply() {
        
    }

    public function dashboard_raw() {
        
    }

    public function dashboard_warehouse_raw() {
        
    }

    public function dashboard_warehouse_supply() {
        
    }

    public function dashboard_collection_officer() {
        
    }

    public function dashboard_production_head() {
        
    }

    public function dashboard_hr_head() {
        
    }

    public function dashboard_logistics_head() {
        
    }

    public function dashboard_fitout() {
        
    }
    
    public function it_staff() {
        
    }
    
    public function dashboard_admin_staff(){
        
    }
    
    public function try_functions($type = null, $team = null){
        pr($this->team_total($type, $team)); 
        // pr($this->agent_total($type, $user_id, $team));
        exit;
    }
    
    public function refererss(){
        // pr($_SERVER["HTTP_REFERER"]); exit;
        $this->redirect('/');
    }
    
}