<?php
App::uses('AppController', 'Controller');
/**
 * OfficialBusinesses Controller
 *
 * @property OfficialBusiness $OfficialBusiness
 * @property PaginatorComponent $Paginator
 */
class OfficialBusinessesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->OfficialBusiness->recursive = 0;
		$this->set('officialBusinesses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->OfficialBusiness->exists($id)) {
			throw new NotFoundException(__('Invalid official business'));
		}
		$options = array('conditions' => array('OfficialBusiness.' . $this->OfficialBusiness->primaryKey => $id));
		$this->set('officialBusiness', $this->OfficialBusiness->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->OfficialBusiness->create();
			if ($this->OfficialBusiness->save($this->request->data)) {
				$this->Session->setFlash(__('The official business has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The official business could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->OfficialBusiness->User->find('list');
		$clients = $this->OfficialBusiness->Client->find('list');
		$this->set(compact('users', 'clients'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->OfficialBusiness->exists($id)) {
			throw new NotFoundException(__('Invalid official business'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->OfficialBusiness->save($this->request->data)) {
				$this->Session->setFlash(__('The official business has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The official business could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('OfficialBusiness.' . $this->OfficialBusiness->primaryKey => $id));
			$this->request->data = $this->OfficialBusiness->find('first', $options);
		}
		$users = $this->OfficialBusiness->User->find('list');
		$clients = $this->OfficialBusiness->Client->find('list');
		$this->set(compact('users', 'clients'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->OfficialBusiness->id = $id;
		if (!$this->OfficialBusiness->exists()) {
			throw new NotFoundException(__('Invalid official business'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->OfficialBusiness->delete()) {
			$this->Session->setFlash(__('The official business has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The official business could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function my_list(){
		$this->loadModel('OfficialBusiness');
		$this->loadModel('OfficialBusinessPeople');
		$this->loadModel('OfficialBusinessReport');
		$this->loadModel('Client');
		$this->loadModel('User');
		$this->loadModel('Team');
		 
		$passed_mode = $this->params['url']['mode'];
		$passed_status = $this->params['url']['status'];
        
        $users = $this->User->find('all'); // list all users
        // $clients = $this->Client->find('all'); // list all clients
        
        $this->OfficialBusinessReport->recursive=4;
        $my_official_business_lists = $this->OfficialBusinessReport->find('all', ['conditions'=>['OfficialBusiness.mode'=>$passed_mode, 'OfficialBusiness.status'=>$passed_status]]);
        $this->set(compact('my_official_business_lists', 'users'));

        // debug($my_official_business_lists);
	}
	
	
	public function all_list(){
		$this->loadModel('OfficialBusinessReport');
		$this->loadModel('Client');
		$this->loadModel('User');
		 
		$passed_mode = $this->params['url']['mode'];
		$passed_status = $this->params['url']['status'];
        
        $this->OfficialBusinessReport->recursive=4;
        $all_official_business_lists = $this->OfficialBusinessReport->find('all', ['conditions'=>['OfficialBusiness.mode'=>$passed_mode, 'OfficialBusiness.status'=>$passed_status]]); 
        $this->set(compact('all_official_business_lists'));

	}
	
	public function update_status($id=null){
		$this->loadModel('User');
		
		$this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
        
        $ob_id = $data['id'];
    	$user_id = $this->Auth->user('id');
    	$datetime = date('Y-m-d H:i:s');
        
        $edit_TS = $this->OfficialBusiness->getDataSource();
        $edit_TS->begin();
        
        $this->OfficialBusiness->id = $ob_id;
        
        $this->OfficialBusiness->set(array(
				'status' => "approved",
				'approved_by' => $user_id,
				'approved_date' => $datetime
        ));
        
        $edit_processed = $this->OfficialBusiness->save();
        if($edit_processed){
            $edit_TS->commit();
            echo json_encode($ob_id);
        }else{
            $edit_TS->rollback();
        }
        exit;
	}

	public function approve($id=null){
		$this->loadModel('User');
		
		$this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
        
        $ob_id = $data['id'];
    	$user_id = $this->Auth->user('id');
    	$datetime = date('Y-m-d H:i:s');
        
        $edit_TS = $this->OfficialBusiness->getDataSource();
        $edit_TS->begin();
        
        $this->OfficialBusiness->id = $ob_id;
        
        $this->OfficialBusiness->set(array(
				'status' => "hr_approved",
				'hr_approved_by' => $user_id,
				'hr_approved_date' => $datetime
        ));
        
        $edit_processed = $this->OfficialBusiness->save();
        if($edit_processed){
            $edit_TS->commit();
            echo json_encode($ob_id);
        }else{
            $edit_TS->rollback();
        }
        exit;
        
	}
    
	public function add_ob_sales(){
        
        $this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
        
        $mode = $data['mode'];
        $user = json_encode($data['user']);
        $exp_date = $data['exp_date'];
        $exp_time = $data['exp_time'];
        $status = "pending";
		$client = $data['client'];
        $svrequest = $data['svrequest'];
        $purpose = $data['purpose'];
        
        
        $combined_DT = date('Y-m-d H:i:s', strtotime("$exp_date $exp_time"));

        if($this->request->is('post')){
				
			$OB_TS = $this->OfficialBusiness->getDataSource();
			$OB_TS->begin();    
			
			$this->OfficialBusiness->create();
			
			$this->OfficialBusiness->set(array(
				'mode' => $mode,
				'user_id' => $user,
				'expected_departure' => $combined_DT,
				'status' => $status,
				'service_request' => $svrequest,
				'client_id' => $client,
				'purpose' => $purpose
            ));
            
            $save = $this->OfficialBusiness->save();
			if($save){
				$OB_TS->commit();
				echo json_encode($this->request->data); 
				
			}else{
				$OB_TS->rollback();
				return json_encode(['ob' => $user, 'status' => 'error']);
			}
			exit;
		}
	}
	
	public function add_ob_users(){
        
        $this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
        
        $mode = $data['mode'];
        $user = json_encode($data['user']);
        $exp_date = $data['exp_date'];
        $exp_time = $data['exp_time'];
		$company = $data['company'];
		
        $svrequest = $data['svrequest'];
        $purpose = $data['purpose'];
        $status = "pending";
        $combined_DT = date('Y-m-d H:i:s', strtotime("$exp_date $exp_time"));


        if($this->request->is('post')){
				
			$OB_TS = $this->OfficialBusiness->getDataSource();
			$OB_TS->begin();
			
			$this->OfficialBusiness->create();
			
			$this->OfficialBusiness->set(array(
				'mode' => $mode,
				'user_id' => $user,
				'expected_departure' =>  $combined_DT,
				'status' => $status,
				'company_name' => $company,
				'purpose' => $purpose
            ));
            
            $save = $this->OfficialBusiness->save();
            
			if($save){
				$OB_TS->commit();
				echo json_encode($this->request->data); 
				
			}else{
				$OB_TS->rollback();
				return json_encode(['ob' => $user, 'status' => 'error']);
			}
			exit;
		}

	}
	
}
