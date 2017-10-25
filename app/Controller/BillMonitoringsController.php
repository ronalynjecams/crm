<?php
App::uses('AppController', 'Controller');
/**
 * BillMonitorings Controller
 *
 * @property BillMonitoring $BillMonitoring
 * @property PaginatorComponent $Paginator
 */
class BillMonitoringsController extends AppController {

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
		$this->BillMonitoring->recursive = 0;
		$this->set('billMonitorings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->BillMonitoring->exists($id)) {
			throw new NotFoundException(__('Invalid bill monitoring'));
		}
		$options = array('conditions' => array('BillMonitoring.' . $this->BillMonitoring->primaryKey => $id));
		$this->set('billMonitoring', $this->BillMonitoring->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->BillMonitoring->create();
			if ($this->BillMonitoring->save($this->request->data)) {
				$this->Session->setFlash(__('The bill monitoring has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bill monitoring could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->BillMonitoring->User->find('list');
		$bills = $this->BillMonitoring->Bill->find('list');
		$this->set(compact('users', 'bills'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->BillMonitoring->exists($id)) {
			throw new NotFoundException(__('Invalid bill monitoring'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->BillMonitoring->save($this->request->data)) {
				$this->Session->setFlash(__('The bill monitoring has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bill monitoring could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('BillMonitoring.' . $this->BillMonitoring->primaryKey => $id));
			$this->request->data = $this->BillMonitoring->find('first', $options);
		}
		$users = $this->BillMonitoring->User->find('list');
		$bills = $this->BillMonitoring->Bill->find('list');
		$this->set(compact('users', 'bills'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->BillMonitoring->id = $id;
		if (!$this->BillMonitoring->exists()) {
			throw new NotFoundException(__('Invalid bill monitoring'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->BillMonitoring->delete()) {
			$this->Session->setFlash(__('The bill monitoring has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The bill monitoring could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function view_monitoring(){

		$monitorings = $this->BillMonitoring->find('all');
		$this->loadModel('BillAccount');
		$this->loadModel('User');
		$billaccounts = $this->BillAccount->find('all');
		$users = $this->User->find('all');
		
			
		
		// foreach($monitorings as )
		/** needs to use push array in order to show paid_by values.  
		*////
		
		
		/*
		 $this->BillMonitoring->recursive = -1;
		 $mons = $this->BillMonitoring->find('all', array(
		 						'joins' => array(array(
		 							'table' => 'users',
                                   'alias' => 'PaidByUser',
                                  'type' => 'INNER',
                                   'conditions' => array('BillMonitoring.paid_by = PaidByUser.id')))));
		pr($mons);
		*/
		
		
		$this->set(compact('monitorings', 'billaccounts', 'users'));
	}
	
	public function add_monitoring(){ 
		$this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
        
        $bill_date_from = $data['datefrom'];
        $bill_date_to = $data['dateto'];
        $user_id = $this->Auth->user('id');
        $bill_id = $data['billaccount'];
        $bill_amount = $data['billamount'];
        $bill_ref_no = $data['bill_ref_no'];
        $payment_mode = $data['payment_mode'];


      if($this->request->is('post')){
        
            $this->BillMonitoring->create(); 
            $this->BillMonitoring->set(array(
            	'billing_date_from' => $bill_date_from,
            	'billing_date_to' => $bill_date_to,
                'user_id' => $user_id,
                'bill_id' => $bill_id,
                'bill_amount' => $bill_amount,
                'receipt_reference_num' => $bill_ref_no,
                'payment_mode' => $payment_mode
                
            ));
            
            if ($this->BillMonitoring->save()) {
            	/*
                echo json_encode($bill_date_from);
                echo json_encode($bill_date_to);
                echo json_encode($user_id);
                echo json_encode($bill_id);
                echo json_encode($bill_amount);
                echo json_encode($bill_ref_no);
                echo json_encode($payment_mode);
                echo json_encode($receipt_date);
                */
                
                echo json_encode($this->request->data);
            }
            
              exit;
            
        }
        
	}
	
	
	public function edit_payment(){
		
		$this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        
        $id = $data['id'];
        $ubill_ref_no = $data['ubill_ref_no'];
        $upayment_method = $data['upayment_mode'];
        $upaid_by = $data['upaid_by'];
        $ureceipt_date = $data['ureceipt_date'];

        
        	$this->BillMonitoring->set(array(
        		
        		"id" => $data['id'],
                "receipt_reference_num" => $ubill_ref_no,
                "payment_mode" => $upayment_method,
                "paid_by" => $upaid_by,
                "paid" => 1,
                "receipt_date" => $ureceipt_date
            ));
        
        
        if ($this->request->is(array('post', 'put'))) {

            if ($this->BillMonitoring->save($this->request->data)) {
                return (json_encode($this->request->data));
            } else {
                return (json_encode($this->request->data));
            }
            
        } else {
            return (json_encode());
        }
	}
	
	
}
