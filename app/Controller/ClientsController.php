<?php

App::uses('AppController', 'Controller');

/**
 * Clients Controller
 *
 * @property Client $Client
 * @property PaginatorComponent $Paginator
 */
class ClientsController extends AppController {

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

//
    public function beforeFilter() {
        parent::beforeFilter();
//		$this->Auth->allow('add_leads');
    }

    /**
     * index method
     *
     * @return void
     */
    public function index() {
        $this->Client->recursive = 0;
        $this->set('clients', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Client->exists($id)) {
            throw new NotFoundException(__('Invalid client'));
        }
        $options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
        $this->set('client', $this->Client->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Client->create();
            if ($this->Client->save($this->request->data)) {
                $this->Session->setFlash(__('The client has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The client could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $users = $this->Client->User->find('list');
        $leads = $this->Client->Lead->find('list');
        $this->set(compact('users', 'leads'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->Client->exists($id)) {
            throw new NotFoundException(__('Invalid client'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Client->save($this->request->data)) {
                $this->Session->setFlash(__('The client has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The client could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('Client.' . $this->Client->primaryKey => $id));
            $this->request->data = $this->Client->find('first', $options);
        }
        $users = $this->Client->User->find('list');
        $leads = $this->Client->Lead->find('list');
        $this->set(compact('users', 'leads'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Client->id = $id;
        if (!$this->Client->exists()) {
            throw new NotFoundException(__('Invalid client'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->Client->delete()) {
            $this->Session->setFlash(__('The client has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The client could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function leads() {

        $this->loadModel('AgentStatus');
        $this->loadModel('Users');

//            $this->User->recursive = 3;
        $agents = $this->AgentStatus->find('all', array(
            'conditions' => array('User.role' => 'sales_executive', 'User.active' => 1),
            'group' => array('AgentStatus.user_id')));
//            pr($agents);exit;
        $this->set(compact('agents'));

        if ($this->Auth->user('role') == 'sales_executive') {
            $options = array('conditions' => array('Client.lead' => 1, 'Client.user_id' => $this->Auth->user('id')));
            $this->set('leads', $this->Client->find('all', $options));
        } else if ($this->Auth->user('role') == 'marketing_staff') {
            $options = array('conditions' => array('Client.lead' => 1, 'Client.user_id' => 0, 'Client.owner_marketing' => $this->Auth->user('id')));
            $this->set('leads', $this->Client->find('all', $options));
        } else if ($this->Auth->user('role') == 'sales_manager') {
            $this->loadModel('AgentStatus');
            $stats = $this->AgentStatus->find('first',[
                'conditions'=>[
                    'AgentStatus.user_id' => $this->Auth->user('id'),
                    'AgentStatus.date_to' => NULL
                    
                    ]
                ]);
            $options = array('conditions' => array('Client.lead' => 1, 'Client.team_id'=>$stats['AgentStatus']['team_id']));
            $this->set('leads', $this->Client->find('all', $options));
        }
        
        
        $this->loadModel('ClientIndustry');
        $industries = $this->ClientIndustry->find('all');
        $this->set(compact('industries')); 
//            else if(sales coordinator dapat per team din)
//            else if(sales manager dapat per team din)
//            else if(marketing head , accounting and proprietor dapat lahat)
    }

    public function add_leads() {
        $this->loadModel('AgentStatus');
        $this->autoRender = false;
        $data = $this->request->data;


        $agentStat = $this->AgentStatus->find('all', array(
            'conditions' => array('AgentStatus.user_id' => $this->Auth->user('id')),
            'fields' => array('MAX(AgentStatus.id) AS id')
        ));
        $current_team = $this->AgentStatus->findById($agentStat[0][0]['id']);


        if ($this->Auth->user('role') == 'sales_executive') {
            $user_id = $this->Auth->user('id');
            $owner_marketing = 0;
            $team_id = $current_team['AgentStatus']['team_id'];
        } else {
            $user_id = 0;
            $owner_marketing = $this->Auth->user('id');
            $team_id = 0;
        }
        $name = strtoupper($data['name']);
        $contact_person = $data['contact_person'];
        $position = $data['position'];
        $address = $data['address'];
        $email = $data['email'];
        $contact_number = $data['contact_number'];
        $tin_number = $data['tin_number'];
        $client_industry_id = $data['client_industry_id'];

        if ($data['type'] == 'lead') {
            $lead = 1;
        } else {
            $lead = 0;
        }

        //check if company name exist for the current user
        $check = $this->Client->find('count', array(
            'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Client.name' => $name)));
        if ($check == 0) {
            $this->Client->create();
            $this->Client->set(array(
                "user_id" => $user_id,
                "name" => $name,
                "contact_person" => $contact_person,
                "position" => $position,
                "address" => $address,
                "email" => $email,
                "contact_number" => $contact_number,
                "tin_number" => $tin_number,
                "lead" => $lead,
                "owner_marketing" => $owner_marketing,
                "team_id" => $team_id,
                "client_industry_id" => $client_industry_id,
            ));
            if ($this->Client->save()) {
                echo json_encode($this->request->data);
            }
            else {
                echo "Client Did not saved";
            }
        }
        else {
            echo "Client Already Exists";
        }
    }

    public function clients() {
        $this->loadModel('User');
        if ($this->Auth->user('role') == 'sales_executive') {
            $options = array('conditions' => array('Client.lead' => 0, 'Client.user_id'=>$this->Auth->user('id')));
            $this->set('clients', $this->Client->find('all', $options));
        }else if ($this->Auth->user('role') == 'sales_manager') {
            $this->loadModel('AgentStatus');
            $stats = $this->AgentStatus->find('first',[
                'conditions'=>[
                    'AgentStatus.user_id' => $this->Auth->user('id'),
                    'AgentStatus.date_to' => NULL
                    
                    ]
                ]);
            $options = array('conditions' => array('Client.lead' => 0, 'Client.team_id'=>$stats['AgentStatus']['team_id']));
            $this->set('clients', $this->Client->find('all', $options));
            // pr($this->Client->User->find('all', $options));
        }else if ($this->Auth->user('role') == 'admin_staff' || $this->Auth->user('role') == 'marketing_staff') {
            $this->set('clients', $this->Client->find('all'));
            // pr($this->Client->find('all'));
        }
        
        $this->loadModel('ClientIndustry');
        $industries = $this->ClientIndustry->find('all');
        $this->set(compact('industries')); 
//            else if(marketing dapat per user din)
//            else if(sales coordinator dapat per team din)
//            else if(sales manager dapat per team din)
//            else if(accounting and proprietor dapat lahat)
    }

    public function get_lead_info() {

        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $id = $this->request->query['id'];
            $this->Client->recursive = -1;
            $lead = $this->Client->findById($id);
            return (json_encode($lead['Client']));
            exit;
        }
    }

    public function transfer_leads() {
        $this->autoRender = false;
        $data = $this->request->data;
        $agent_id = $data['agent_id'];
        $lead_id = $data['lead_tr_id'];

        $this->Client->id = $lead_id;
        $this->Client->set(array('user_id' => $agent_id));
        if ($this->Client->save()) {
            return (json_encode(['status' => 'success']));
        }
        exit;
    }

    public function my_client_info() {

        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $id = $this->request->query['id'];
            $this->Client->recursive = -1;
            $lead = $this->Client->findById($id);
            return (json_encode($lead['Client']));
            exit;
        }
    }

    public function update_leads() {
        $this->autoRender = false;
        $this->response->type('json');
        $dd = $this->request->data;
        $id = $dd['id'];

        if ($this->request->is(array('post', 'put'))) {
            if ($this->Client->save($this->request->data)) {
                return (json_encode($this->request->data));
            } else {
                return (json_encode($this->request->data));
            }
        } else {
            return (json_encode($this->request->data));
        }
        exit;
    }
    
    
    public function check_client_existence(){
        $this->autoRender = false;
        $this->response->type('json'); 
        $dd = $this->request->data;
        $name = $dd['name'];
        // $name = 'mae';
        
        // pr($name);
        $check = $this->Client->find('all', array(
            // 'contain' => array(
            //     'User'=> array(
            //         'conditions' => array('User.active'=>1, 'User.id !='=>$this->Auth->user('id')), 
            //     )
            // ),
            'conditions'=>array(
//                'Client.name'=>'1'
                // 'Client.name LIKE '=>'%'.$name.'%',
                'Client.name LIKE '=>$name.'%',
                // 'Client.name'=>$name,
                'Client.user_id !='=>$this->Auth->user('id')
            ),
            // 'fields' => array('User.first_name'),
        ));
        // pr($check);exit;
        $a = [];
        foreach($check as $agents){
            $detail = $agents['User']['first_name'].' : '.$agents['Client']['name'];
            array_push($a,$detail);
        }
//        
        $a = array_unique($a);
        $cc = implode(", ", $a);
        // pr($cc); exit;
         return (json_encode($cc)); 
    }
    
    

}
