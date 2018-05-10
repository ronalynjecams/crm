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
        
        if ($this->Auth->user('id')) {
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
            }  else if ($this->Auth->user('role') == 'proprietor_secretary') {
                return $this->redirect('/users/dashboard_proprietor_secretary');
            }   else if ($this->Auth->user('role') == 'accounting_head') {
                    return $this->redirect('/users/dashboard_accounting_head');
            }  else if ($this->Auth->user('role') == 'sales_manager') {
                    return $this->redirect('/users/dashboard_sales_manager');
            }  else if ($this->Auth->user('role') == 'sales_coordinator') {
                    return $this->redirect('/users/dashboard_sales_coordinator');
            } else if ($this->Auth->user('role') == 'cost_accountant') {
                    return $this->redirect('/users/dashboard_cost_accountant');
            } else if ($this->Auth->user('role') == 'plant_manager') {
                    return $this->redirect('/users/dashboard_plant_manager');
            }  else if ($this->Auth->user('role') == 'purchasing_supervisor') {
                    return $this->redirect('/users/dashboard_purchasing_supervisor');
            } 
                //////////ADONIS ARRIOLA/////
                else if ($this->Auth->user('role') == 'subcon_purchasing') {
                    return $this->redirect('/users/dashboard_subcon_purchasing');
                } 
                //////////ADONIS ARRIOLA/////
            
        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                
                $options = array('conditions' => array('User.' . $this->User->primaryKey => $this->Auth->user('id')));
                // $this->set('UserIn', $this->User->find('first', $options));
                $userss = $this->User->find('first', $options);
                $user_up = $userss['User'];
                $user_up['User'] = $userss['User'];
                $user_up['Position'] = $userss['Position'];
                $user_up['Department'] = $userss['Department'];
                $user_up['Client'] = $userss['Client'];
                $user_up['SocialProfile'] = $userss['SocialProfile'];
                $this->Session->write('Auth.User', $user_up);

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
                }  else if ($this->Auth->user('role') == 'proprietor_secretary') {
                    return $this->redirect('/users/dashboard_proprietor_secretary');
                }  else if ($this->Auth->user('role') == 'accounting_head') {
                    return $this->redirect('/users/dashboard_accounting_head');
                }  else if ($this->Auth->user('role') == 'sales_manager') {
                    return $this->redirect('/users/dashboard_sales_manager');
                } else if ($this->Auth->user('role') == 'sales_coordinator') {
                    return $this->redirect('/users/dashboard_sales_coordinator');
                } else if ($this->Auth->user('role') == 'cost_accountant') {
                    return $this->redirect('/users/dashboard_cost_accountant');
                } else if ($this->Auth->user('role') == 'plant_manager') {
                    return $this->redirect('/users/dashboard_plant_manager');
                }  else if ($this->Auth->user('role') == 'purchasing_supervisor') {
                    return $this->redirect('/users/dashboard_purchasing_supervisor');
                }
                //////////ADONIS ARRIOLA/////
                else if ($this->Auth->user('role') == 'subcon_purchasing') {
                    return $this->redirect('/users/dashboard_subcon_purchasing');
                } 
                else if ($this->Auth->user('role') == 'quantity_surveyor') {
                    return $this->redirect('/users/dashboard_quantity_surveyor');
                } 
                //////////ADONIS ARRIOLA/////
            }

            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() {
        $this->Hybridauth->logout();
        return $this->redirect($this->Auth->logout());
    }

    public function dashboard() {
        
    }
    
    public function dashboard_plant_manager() {
        
    }
    
    public function dashboard_purchasing_supervisor() {
        
    }
    
    public function dashboard_cost_accountant() {
        
    }
    
    public function dashboard_proprietor_secretary() {
        
    }
    
    public function dashboard_sales() {
        $user_id = $this->Auth->user('id');
        $user_role = $this->Auth->user('role');
        
        $month = date('F');
        $year = date('Y');
        $today = date('F d, Y');
        
        $yearly = $this->agent_total('yearly', $user_id);
        $monthly = $this->agent_total('monthly', $user_id);
        $daily = $this->agent_total('daily', $user_id);
        
        $get_quotations_count = $this->count_pending_approved($user_id, $user_role);
        $pending_counts  = $get_quotations_count[0];
        $approved_counts = $get_quotations_count[1];
        $get_quotation_pending = $get_quotations_count[2];
        $get_quotation_approved = $get_quotations_count[3];
        
        $date_now = date("Y-m-d");
        $pending_dates = [];
        foreach($get_quotation_pending as $ret_quotation_pending) {
            $quotation_obj_p = $ret_quotation_pending['Quotation'];
            $pending_date_tmp = date("Y-m-d", strtotime($quotation_obj_p['created']));
            $pending_dates[] = $pending_date_tmp;
        }
        
        $approved_dates = [];
        foreach($get_quotation_approved as $ret_quotation_approved) {
            $quotation_obj_a = $ret_quotation_approved['Quotation'];
            $approved_date_tmp = date("Y-m-d", strtotime($quotation_obj_a['created']));
            $approved_dates[] = $approved_date_tmp;
        }
        
        $quotation_dates = array_unique(array_merge($pending_dates, $approved_dates));
        $count_pending = array_count_values($pending_dates);
        $count_approved = array_count_values($approved_dates);
        
        $graph_data = [];
        $pending = [];
        $approved = [];
        
        if(!empty($quotation_dates)) {
            $quotation_dates_count = count($quotation_dates);
            if($quotation_dates_count>10) {
                $compare = 10;
            }
            else {
                $compare = $quotation_dates_count;
            }
            $index = 0;
            $li_tmp = 0;
            foreach($quotation_dates as $i => $qqq) {
                $loop_dates = date("Y-m-d", strtotime($quotation_dates[$i]));
                $loop_interval_tmp = date_diff(new DateTime($loop_dates), new DateTime($date_now));
                $loop_interval = $loop_interval_tmp->format("%a");
                
                if($loop_interval>=10) {
                    if((10 <= $loop_interval) && ($loop_interval <= 15)) {
                        $index = $i;
                        break;
                    }
                    else {
                        if($li_tmp>$loop_interval) {
                            $li_tmp = $loop_interval;
                            $index = $i;
                        }
                    }
                }
                else {
                    if($loop_interval==9) {
                        $index = $i;
                        break;
                    }
                    else {
                        $index = $i;
                        break;
                    }
                }
            }
            
            $date_range = date("m j Y",
                          mktime(0, 0, 0,
                          date("m",strtotime($quotation_dates[$index])),
                          date("d",strtotime($quotation_dates[$index])),
                          date("Y",strtotime($quotation_dates[$index]))));
        }
        else {
            $date_range = date("m j Y", mktime(0, 0, 0, date("m"), date("d")-10, date("Y")));
        }
        
        $date_range_tmp = date("Y-m-d", strtotime(str_replace(" ","/",$date_range)));
        $interval_tmp = date_diff(new DateTime($date_range_tmp), new DateTime($date_now));
        $interval = $interval_tmp->format("%a");
        
        $additional = 0;
        if($interval<10) {
            $additional = 10-$interval;
        }
        
        $ranges = [];
        sscanf($date_range,'%d %d %d',$m,$d,$y);
        for($i=0-$additional;$i<=$interval;$i++)
        {
            $ranges[] = date('Y-m-d',mktime(0,0,0,$m,$d+$i,$y));
        }
        
        foreach($ranges as $i=>$quotation_date) {
            $date_in_graph = date("M-d", strtotime($quotation_date));
            $pending[$i] = 0;
            $approved[$i] = 0;
            foreach($count_pending as $ip=>$pending_date_count) {
                if($ip==$quotation_date) {
                    $pending[$i] = $pending_date_count;
                }
            }
            
            foreach($count_approved as $ia=>$approved_date_count) {
                if($ia==$quotation_date) {
                    $approved[$i] = $approved_date_count;
                }
            }
            
            $graph_data[] = ['elapsed'=>$date_in_graph, 'pending'=>$pending[$i],
                             'approved'=>$approved[$i]];
        }
        $json_graph_data = json_encode($graph_data);
        
        $this->loadModel('AgentStatus');
        $get_team = $this->AgentStatus->find('first', ['conditions'=>
                        [
                            'AgentStatus.user_id'=>$user_id,
                            'AgentStatus.date_to'=>NULL,
                        ],
                             'order'=>'AgentStatus.created DESC',
                             'fields'=>'Team.id, Team.name']);
        $team_obj = $get_team['Team'];
        $team_id = $team_obj['id'];
        $team_name = $team_obj['name'];
        
        $this->set(compact('month', 'year', 'today', 'yearly', 'monthly', 'daily',
                           'pending_counts', 'approved_counts',
                           'team_id', 'team_name', 'user_id', 'user_role', 'json_graph_data'));
    }
    
    public function dashboard_sales_manager() {
        $this->loadModel('Team');
        $user_id = $this->Auth->user('id');
        $user_role = $this->Auth->user('role');
        $team_id = 0;
        $getteam = $this->AgentStatus->find('first', array(
                    'joins' => array(array('table' => 'users',
                              'alias' => 'Users',
                              'type' => 'INNER', 
                              'conditions' => array('User.id = AgentStatus.user_id'))),
                    'conditions'=>array(
                        'AgentStatus.date_to' => NULL,
                        'User.role' => 'sales_manager',
                        'AgentStatus.user_id' => $user_id,
                        )));
        if(!empty($getteam)) { $team_id = $getteam['Team']['id']; }
        
        $month = date('F');
        $year = date('Y');
        $today = date('F d, Y'); 
        
        $yearly = $this->team_total('yearly', $team_id);
        $monthly = $this->team_total('monthly', $team_id);
        $daily = $this->team_total('daily', $team_id);
        
        $this->set(compact('month', 'year', 'today', 'yearly', 'monthly', 'daily',
                          'getteam'));
                          
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
        
        $get_quotations = [];
        $get_agent_status = [];
        $current_mo = date("m");
        
        $this->Quotation->recursive = -1;
        foreach($get_users as $ret_users) {
            $user_id = $ret_users['User']['id'];
            
            $get_quotations[$user_id] = $this->Quotation->find('all',
                [
                    'conditions'=>[
                            'Quotation.user_id'=>$user_id
                        ]
                ]);
            
            $get_agent_status[$user_id] = $this->AgentStatus->find('all',
                ['conditions'=>[
                    'AgentStatus.user_id'=>$user_id,
                    'AgentStatus.date_to'=>NULL, 
                    ]]);
        }
        
        $this->set(compact('get_quotations', 'get_agent_status'));
        
        // ----------------- GRAPH DATA
        $get_quotations_count = $this->count_pending_approved($user_id, $user_role);
        $pending_counts  = $get_quotations_count[0];
        $approved_counts = $get_quotations_count[1];
        $get_quotation_pending = $get_quotations_count[2];
        $get_quotation_approved = $get_quotations_count[3];

        $date_now = date("Y-m-d");
        $pending_dates = [];
        foreach($get_quotation_pending as $ret_quotation_pending) {
            $quotation_obj_p = $ret_quotation_pending['Quotation'];
            $pending_date_tmp = date("Y-m-d", strtotime($quotation_obj_p['created']));
            $pending_dates[] = $pending_date_tmp;
        }
        
        $approved_dates = [];
        foreach($get_quotation_approved as $ret_quotation_approved) {
            $quotation_obj_a = $ret_quotation_approved['Quotation'];
            $approved_date_tmp = date("Y-m-d", strtotime($quotation_obj_a['date_moved']));
            $approved_dates[] = $approved_date_tmp;
        }
        
        $quotation_dates = array_unique(array_merge($pending_dates, $approved_dates));
        $count_pending = array_count_values($pending_dates);
        $count_approved = array_count_values($approved_dates);
        
        $graph_data = [];
        $pending = [];
        $approved = [];
        
        if(!empty($quotation_dates)) {
            $quotation_dates_count = count($quotation_dates);
            if($quotation_dates_count>10) {
                $compare = 10;
            }
            else {
                $compare = $quotation_dates_count;
            }
            $index = 0;
            $li_tmp = 0;
            foreach($quotation_dates as $i => $qqq) {
                $loop_dates = date("Y-m-d", strtotime($quotation_dates[$i]));
                $loop_interval_tmp = date_diff(new DateTime($loop_dates), new DateTime($date_now));
                $loop_interval = $loop_interval_tmp->format("%a");
                
                if($loop_interval>=10) {
                    if((10 <= $loop_interval) && ($loop_interval <= 15)) {
                        $index = $i;
                        break;
                    }
                    else {
                        if($li_tmp>$loop_interval) {
                            $li_tmp = $loop_interval;
                            $index = $i;
                        }
                    }
                }
                else {
                    if($loop_interval==9) {
                        $index = $i;
                        break;
                    }
                    else {
                        $index = $i;
                        break;
                    }
                }
            }
            
            $date_range = date("m j Y",
                          mktime(0, 0, 0,
                          date("m",strtotime($quotation_dates[$index])),
                          date("d",strtotime($quotation_dates[$index])),
                          date("Y",strtotime($quotation_dates[$index]))));
        }
        else {
            $date_range = date("m j Y", mktime(0, 0, 0, date("m"), date("d")-10, date("Y")));
        }
        
        $date_range_tmp = date("Y-m-d", strtotime(str_replace(" ","/",$date_range)));
        $interval_tmp = date_diff(new DateTime($date_range_tmp), new DateTime($date_now));
        $interval = $interval_tmp->format("%a");
        
        $additional = 0;
        if($interval<10) {
            $additional = 10-$interval;
        }
        
        $ranges = [];
        sscanf($date_range,'%d %d %d',$m,$d,$y);
        for($i=0-$additional;$i<=$interval;$i++)
        {
            $ranges[] = date('Y-m-d',mktime(0,0,0,$m,$d+$i,$y));
        }
        
        foreach($ranges as $i=>$quotation_date) {
            $date_in_graph = date("M-d", strtotime($quotation_date));
            $pending[$i] = 0;
            $approved[$i] = 0;
            foreach($count_pending as $ip=>$pending_date_count) {
                if($ip==$quotation_date) {
                    $pending[$i] = $pending_date_count;
                }
            }
            
            foreach($count_approved as $ia=>$approved_date_count) {
                if($ia==$quotation_date) {
                    $approved[$i] = $approved_date_count;
                }
            }
            
            $graph_data[] = ['elapsed'=>$date_in_graph, 'pending'=>$pending[$i],
                             'approved'=>$approved[$i]];
        }
        $json_graph_data = json_encode($graph_data);
        
        $this->set(compact('get_quotations', 'pending_counts', 'approved_counts',
                          'json_graph_data'));
    }
    
    public function dashboard_sales_coordinator() {
        $this->loadModel('Team');
        $user_id = $this->Auth->user('id');
        $user_role = $this->Auth->user('role');
        $team_id = 0;
        $this->Team->recursive = -1;
        $getteam = $this->Team->findByTeamManager($user_id);
        if(!empty($getteam)) { $team_id = $getteam['Team']['id']; }
        $month = date('F');
        $year = date('Y');
        $today = date('F d, Y');
        
        $yearly = $this->team_total('yearly', $team_id);
        $monthly = $this->team_total('monthly', $team_id);
        $daily = $this->team_total('daily', $team_id);
        
        $this->set(compact('month', 'year', 'today', 'yearly', 'monthly', 'daily',
                          'getteam'));
        
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
        
        $get_quotations = [];
        $get_agent_status = [];
        $current_mo = date("m");
        
        $this->Quotation->recursive = -1;
        foreach($get_users as $ret_users) {
            $user_id = $ret_users['User']['id'];
            
            $get_quotations[$user_id] = $this->Quotation->find('all',
                ['conditions'=>['Quotation.user_id'=>$user_id]]);
            
            $get_agent_status[$user_id] = $this->AgentStatus->find('all',
                ['conditions'=>[
                    'AgentStatus.user_id'=>$user_id,
                    'AgentStatus.date_to'=>NULL,
                    
                    ]]);
        }
        
        $this->set(compact('get_quotations', 'get_agent_status'));
        
        // ----------------- GRAPH DATA
        $get_quotations_count = $this->count_pending_approved($user_id, $user_role);
        $pending_counts  = $get_quotations_count[0];
        $approved_counts = $get_quotations_count[1];
        $get_quotation_pending = $get_quotations_count[2];
        $get_quotation_approved = $get_quotations_count[3];

        $date_now = date("Y-m-d");
        $pending_dates = [];
        foreach($get_quotation_pending as $ret_quotation_pending) {
            $quotation_obj_p = $ret_quotation_pending['Quotation'];
            $pending_date_tmp = date("Y-m-d", strtotime($quotation_obj_p['created']));
            $pending_dates[] = $pending_date_tmp;
        }
        
        $approved_dates = [];
        foreach($get_quotation_approved as $ret_quotation_approved) {
            $quotation_obj_a = $ret_quotation_approved['Quotation'];
            $approved_date_tmp = date("Y-m-d", strtotime($quotation_obj_a['created']));
            $approved_dates[] = $approved_date_tmp;
        }
        
        $quotation_dates = array_unique(array_merge($pending_dates, $approved_dates));
        $count_pending = array_count_values($pending_dates);
        $count_approved = array_count_values($approved_dates);
        
        $graph_data = [];
        $pending = [];
        $approved = [];
        
        if(!empty($quotation_dates)) {
            $quotation_dates_count = count($quotation_dates);
            if($quotation_dates_count>10) {
                $compare = 10;
            }
            else {
                $compare = $quotation_dates_count;
            }
            $index = 0;
            $li_tmp = 0;
            foreach($quotation_dates as $i => $qqq) {
                $loop_dates = date("Y-m-d", strtotime($quotation_dates[$i]));
                $loop_interval_tmp = date_diff(new DateTime($loop_dates), new DateTime($date_now));
                $loop_interval = $loop_interval_tmp->format("%a");
                
                if($loop_interval>=10) {
                    if((10 <= $loop_interval) && ($loop_interval <= 15)) {
                        $index = $i;
                        break;
                    }
                    else {
                        if($li_tmp>$loop_interval) {
                            $li_tmp = $loop_interval;
                            $index = $i;
                        }
                    }
                }
                else {
                    if($loop_interval==9) {
                        $index = $i;
                        break;
                    }
                    else {
                        $index = $i;
                        break;
                    }
                }
            }
            
            $date_range = date("m j Y",
                          mktime(0, 0, 0,
                          date("m",strtotime($quotation_dates[$index])),
                          date("d",strtotime($quotation_dates[$index])),
                          date("Y",strtotime($quotation_dates[$index]))));
        }
        else {
            $date_range = date("m j Y", mktime(0, 0, 0, date("m"), date("d")-10, date("Y")));
        }
        
        $date_range_tmp = date("Y-m-d", strtotime(str_replace(" ","/",$date_range)));
        $interval_tmp = date_diff(new DateTime($date_range_tmp), new DateTime($date_now));
        $interval = $interval_tmp->format("%a");
        
        $additional = 0;
        if($interval<10) {
            $additional = 10-$interval;
        }
        
        $ranges = [];
        sscanf($date_range,'%d %d %d',$m,$d,$y);
        for($i=0-$additional;$i<=$interval;$i++)
        {
            $ranges[] = date('Y-m-d',mktime(0,0,0,$m,$d+$i,$y));
        }
        
        foreach($ranges as $i=>$quotation_date) {
            $date_in_graph = date("M-d", strtotime($quotation_date));
            $pending[$i] = 0;
            $approved[$i] = 0;
            foreach($count_pending as $ip=>$pending_date_count) {
                if($ip==$quotation_date) {
                    $pending[$i] = $pending_date_count;
                }
            }
            
            foreach($count_approved as $ia=>$approved_date_count) {
                if($ia==$quotation_date) {
                    $approved[$i] = $approved_date_count;
                }
            }
            
            $graph_data[] = ['elapsed'=>$date_in_graph, 'pending'=>$pending[$i],
                             'approved'=>$approved[$i]];
        }
        $json_graph_data = json_encode($graph_data);
        
        $this->set(compact('get_quotations', 'pending_counts', 'approved_counts',
                          'json_graph_data'));
    }

    public function dashboard_proprietor() {
        // $month = date('F');
        // $year = date('Y');
        // $today = date('F d, Y');
        // $yearly = $this->yearly_total();
        // $monthly = $this->monthly_total();
        // $daily = $this->daily_total();
        
        // $team_daily = $this->team_total('daily');
        // $team_monthly = $this->team_total('monthly');
        // $team_yearly = $this->team_total('yearly');
        
        // $this->set(compact('month', 'year', 'today', 'yearly', 'monthly', 'daily',
        //                   'team_daily', 'team_monthly', 'team_yearly'));
        
        // $this->loadModel('User');
        // $get_users = $this->User->find('all',
        //     ['conditions'=>['active'=>1,
        //                     'role'=>'sales_executive']]);
            
        // $this->set(compact('get_users'));
            
        // $this->loadModel('Quotation');
        // $this->loadModel('AgentStatus');
        
        // $get_quotations = [];
        // $get_agent_status = [];
        // $current_mo = date("m");
        // $this->Quotation->recursive = -1;
        
        // foreach($get_users as $ret_users) {
        //     $user_id = $ret_users['User']['id'];
            
        //     $get_quotations[$user_id] = $this->Quotation->find('all',
        //         ['conditions' =>
        //             [
        //                 'Quotation.user_id'=>$user_id
        //             ]
        //         ]);
            
        //     $get_agent_status[$user_id] = $this->AgentStatus->find('all',
        //         ['conditions'=>[
        //             'AgentStatus.user_id'=>$user_id,
        //             'AgentStatus.date_to'=>NULL,
        //             ]]);
        // }
        
        // $this->set(compact('get_quotations', 'get_agent_status'));
        
        // // =====================================================
        // $user_id = $this->Auth->user('id');
        // $user_role = $this->Auth->user('role');

        // $get_quotations_count = $this->count_pending_approved($user_id, $user_role);
        // // pr($get_quotations_count);
        // $pending_counts  = $get_quotations_count[0];
        // $approved_counts = $get_quotations_count[1];
        // $moved_counts = $get_quotations_count[4];
        // $pending_accounting_counts = $get_quotations_count[5];
        // $get_quotation_pending = $get_quotations_count[2];
        // $get_quotation_approved = $get_quotations_count[3];
        
        // $date_now = date("Y-m-d");
        // $pending_dates = [];
        // foreach($get_quotation_pending as $ret_quotation_pending) {
        //     $quotation_obj_p = $ret_quotation_pending['Quotation'];
        //     $pending_date_tmp = date("Y-m-d", strtotime($quotation_obj_p['created']));
        //     $pending_dates[] = $pending_date_tmp;
        // }
        
        // $approved_dates = [];
        // foreach($get_quotation_approved as $ret_quotation_approved) {
        //     $quotation_obj_a = $ret_quotation_approved['Quotation'];
        //     $approved_date_tmp = date("Y-m-d", strtotime($quotation_obj_a['created']));
        //     $approved_dates[] = $approved_date_tmp;
        // }
        
        // $quotation_dates = array_unique(array_merge($pending_dates, $approved_dates));
        // $count_pending = array_count_values($pending_dates);
        // $count_approved = array_count_values($approved_dates);
        
        // $graph_data = [];
        // $pending = [];
        // $approved = [];
        // // pr($quotation_dates);
        // if(!empty($quotation_dates)) {
        //     $quotation_dates_count = count($quotation_dates);
        //     if($quotation_dates_count>10) {
        //         $compare = 10;
        //     }
        //     else {
        //         $compare = $quotation_dates_count;
        //     }
        //     $index = 0;
        //     $li_tmp = 0;
        //     foreach($quotation_dates as $i => $qqq) {
        //         $loop_dates = date("Y-m-d", strtotime($quotation_dates[$i]));
        //         $loop_interval_tmp = date_diff(new DateTime($loop_dates), new DateTime($date_now));
        //         $loop_interval = $loop_interval_tmp->format("%a");
                
        //         if($loop_interval>=10) {
        //             if((10 <= $loop_interval) && ($loop_interval <= 15)) {
        //                 $index = $i;
        //                 break;
        //             }
        //             else {
        //                 if($li_tmp>$loop_interval) {
        //                     $li_tmp = $loop_interval;
        //                     $index = $i;
        //                 }
        //             }
        //         }
        //         else {
        //             if($loop_interval==9) {
        //                 $index = $i;
        //                 break;
        //             }
        //             else {
        //                 $index = $i;
        //                 break;
        //             }
        //         }
        //     }
            
        //     $date_range = date("m j Y",
        //                   mktime(0, 0, 0,
        //                   date("m",strtotime($quotation_dates[$index])),
        //                   date("d",strtotime($quotation_dates[$index])),
        //                   date("Y",strtotime($quotation_dates[$index]))));
        // }
        // else {
        //     $date_range = date("m j Y", mktime(0, 0, 0, date("m"), date("d")-10, date("Y")));
        // }
        
        // $date_range_tmp = date("Y-m-d", strtotime(str_replace(" ","/",$date_range)));
        // $interval_tmp = date_diff(new DateTime($date_range_tmp), new DateTime($date_now));
        // $interval = $interval_tmp->format("%a");
        
        // $additional = 0;
        // if($interval<10) {
        //     $additional = 10-$interval;
        // }
        
        // $ranges = [];
        // sscanf($date_range,'%d %d %d',$m,$d,$y);
        // for($i=0-$additional;$i<=$interval;$i++)
        // {
        //     $ranges[] = date('Y-m-d',mktime(0,0,0,$m,$d+$i,$y));
        // }
        
        // foreach($ranges as $i=>$quotation_date) {
        //     $date_in_graph = date("M-d", strtotime($quotation_date));
        //     $pending[$i] = 0;
        //     $approved[$i] = 0;
        //     foreach($count_pending as $ip=>$pending_date_count) {
        //         if($ip==$quotation_date) {
        //             $pending[$i] = $pending_date_count;
        //         }
        //     }
            
        //     foreach($count_approved as $ia=>$approved_date_count) {
        //         if($ia==$quotation_date) {
        //             $approved[$i] = $approved_date_count;
        //         }
        //     }
            
        //     $graph_data[] = ['elapsed'=>$date_in_graph, 'pending'=>$pending[$i],
        //                      'approved'=>$approved[$i]];
        // }
        // $json_graph_data = json_encode($graph_data);
        
        // $this->loadModel('Payee');
        // $payees = $this->Payee->find('all');
        
        // $drivers = $this->User->find('all',[
        //     'conditions'=>['User.role' => 'driver']
        //     ]);
            
        // $date_today = date('Y-m-d');
        // $this->loadModel('CollectionSchedule'); 
        // $daily_collection_schedule = $this->CollectionSchedule->find('count',[
        //     'conditions'=>[
        //     'CollectionSchedule.collection_date' => $date_today,
        //     'CollectionSchedule.status !=' => 'cancelled'
        //     ]]);
        //     // pr($daily_collection_schedule);
        
        // $tteams = $this->Team->find('all');
        // pr($tteams);z
    
        // $this->set(compact('pending_accounting_counts',
        //                   'moved_counts',
        //                   'pending_counts',
        //                   'approved_counts',
        //                   'json_graph_data',
        //                   'payees',
        //                   'drivers',
        //                   'daily_collection_schedule',
        //                   'tteams'));
    }
    
    public function quotation1($passed_status){
        $this->loadModel('Quotation');
		//array('ongoing','pending','moved','approved','processed','revised','lost','deleted','void','accounting_moved');
	
         if($passed_status == 'approved' || $passed_status == 'processed' || $passed_status == 'approved_by_proprietor'){
        
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
	       // pr($user);exit;
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
            $options = array('conditions' => array('User.' . $this->User->primaryKey => $this->Auth->user('id')));
            // $this->set('UserIn', $this->User->find('first', $options));
            $userss = $this->User->find('first', $options);
            $user_up = $userss['User'];
            $user_up['User'] = $userss['User'];
            $user_up['Position'] = $userss['Position'];
            $user_up['Department'] = $userss['Department'];
            $user_up['Client'] = $userss['Client'];
            $user_up['SocialProfile'] = $userss['SocialProfile'];
            $this->Session->write('Auth.User', $user_up);
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
            }  else if ($this->Auth->user('role') == 'proprietor_secretary') {
                return $this->redirect('/users/dashboard_proprietor_secretary');
            }   else if ($this->Auth->user('role') == 'accounting_head') {
                    return $this->redirect('/users/dashboard_accounting_head');
            }  else if ($this->Auth->user('role') == 'sales_manager') {
                    return $this->redirect('/users/dashboard_sales_manager');
            }   else if ($this->Auth->user('role') == 'cost_accountant') {
                    return $this->redirect('/users/dashboard_cost_accountant');
            }    else if ($this->Auth->user('role') == 'plant_manager') {
                    return $this->redirect('/users/dashboard_plant_manager');
            }     else if ($this->Auth->user('role') == 'purchasing_supervisor') {
                    return $this->redirect('/users/dashboard_purchasing_supervisor');
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


        $roles = $this->Role->find('all', ['order'=>'Role.name ASC']);
        $positions = $this->Position->find('all', ['order'=>'Position.name ASC']);
        $departments = $this->Department->find('all', ['order'=>'Department.name ASC']);
        
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
        $department_name = $data['department_name'];
        $picture = $data['img_pp'];
        $signature = $data['img_sign'];

        $user_set = [
            'picture' => $picture,
            'signature'=> $signature,
            'role' => $role,
            'position_id' => $position_id,
            'department_id' => $department_id
        ];

        $DS_User = $this->User->getDataSource();
        $DS_User->begin();
        $this->User->id = $user_id;
        $this->User->set($user_set);
        if ($this->User->save()) {
            echo json_encode($data);

            $this->loadModel('AgentStatus');
            $DS_AgentStatus = $this->AgentStatus->getDataSource();
            $DS_AgentStatus->begin();
            
            if($department_name == "Sales Department") {
            $quota = $data['quota'];
            $team = $data['team'];
            $tin = $data['tin'];
            $date_now = date("Y-m-d H:i:s");

            $agentstatus_set = ['quota'=>$quota,
                                'user_id'=>$user_id,
                                'team_id'=>$team,
                                'date_from'=>$date_now,
                                'tin_number'=>$tin];
            }
            else {
                $agentstatus_set = ['user_id'=>$user_id];
            }
                                
            $this->AgentStatus->set($agentstatus_set);
            if($this->AgentStatus->save()) {
                $DS_AgentStatus->commit();
                $DS_User->commit();
            }
            else {
                $DS_AgentStatus->rollback();
                $DS_User->rollback();
            }
        } else {
            echo json_encode('invalid data');
        }

        exit;
    }
    // MARK: END OF OFFLINE MODIFICATION
    public function dashboard_accounting_head() {
        $this->loadModel('Payee');
        $payees = $this->Payee->find('all');
        $this->set(compact('payees'));
        
    }

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
        $drivers = $this->User->find('all',[
            'conditions'=>['User.role' => 'diver']
            ]);
        $this->set(compact('drivers'));
        
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
    
    public function edit_profile() {
        $id = $this->Auth->user('id');
        $this->loadModel('EmployeeDetail');
        $emp_det = $this->EmployeeDetail->findById(26);
        // pr(json_encode($emp_det));
        $this->set(compact('emp_det'));
    }
    
    public function update_signature() {
        $this->User->recursive = -1;
        $get_users = $this->User->find('all');
        $this->set(compact('get_users'));
    }
    
    public function sign_upload() {
		$this->autoRender = false;
		if($this->request->is('post'))
	    {
		     if(!empty($_FILES['Image']['name'])) {
	            $file = $_FILES['Image'];
	            $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
	            $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
	            $temp = explode(".", $file['name']);
	            $newfilename = $_FILES['Image']['name'];
	            if(in_array($ext, $arr_ext))
	            {
	            	echo json_encode("true");
	                if(move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/employee_signatures' . DS . $newfilename))
	                {
	                	echo json_encode("Image uploaded properly");
				        return json_encode($_FILES);
	                }
	            }
	            else {
	            	echo json_encode("false");
	            }
		    }
	    }
	}
	
	public function update_db_sign() {
        $this->autoRender = false;
        $data = $this->request->data;
        $user_id = $data['user_id'];
        $signature = $data['img_sign'];

        $user_set = [ 'signature'=> $signature ];

        $this->User->id = $user_id;
        $this->User->set($user_set);
        if ($this->User->save()) {
            return json_encode($data);
        } else {
            return json_encode('invalid data');
        }
        exit;
	}
	
	public function dashboard_subcon_purchasing(){
	    
	}
	public function dashboard_quantity_surveyor(){
	    
	}
	
	
}