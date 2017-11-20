<?php
App::uses('AppController', 'Controller');
/**
 * PaymentRequests Controller
 *
 * @property PaymentRequest $PaymentRequest
 * @property PaginatorComponent $Paginator
 */
class PaymentRequestsController extends AppController {

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
		$this->PaymentRequest->recursive = 0;
		$this->set('paymentRequests', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PaymentRequest->exists($id)) {
			throw new NotFoundException(__('Invalid payment request'));
		}
		$options = array('conditions' => array('PaymentRequest.' . $this->PaymentRequest->primaryKey => $id));
		$this->set('paymentRequest', $this->PaymentRequest->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PaymentRequest->create();
			if ($this->PaymentRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The payment request has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment request could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->PaymentRequest->User->find('list');
		$suppliers = $this->PaymentRequest->Supplier->find('list');
		$this->set(compact('users', 'suppliers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PaymentRequest->exists($id)) {
			throw new NotFoundException(__('Invalid payment request'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PaymentRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The payment request has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment request could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PaymentRequest.' . $this->PaymentRequest->primaryKey => $id));
			$this->request->data = $this->PaymentRequest->find('first', $options);
		}
		$users = $this->PaymentRequest->User->find('list');
		$suppliers = $this->PaymentRequest->Supplier->find('list');
		$this->set(compact('users', 'suppliers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PaymentRequest->id = $id;
		if (!$this->PaymentRequest->exists()) {
			throw new NotFoundException(__('Invalid payment request'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentRequest->delete()) {
			$this->Session->setFlash(__('The payment request has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The payment request could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function all_list() {
		$type = $this->params['url']['type'];
		$status = $this->params['url']['status'];
		$this->set(compact('type','status'));
		
		$this->loadModel('PaymentRequest');
		$this->loadModel('PaymentRequestLog');
		$this->loadModel('PaymentRequestCheque');
		$this->loadModel('Bank');
		$this->loadModel('User');
		$this->loadModel('Payee');
		
		$payment_requests = $this->PaymentRequest->find('all', ['conditions'=>
									['PaymentRequest.type'=>$type,
									 'PaymentRequest.status'=>$status]]);
		$this->set(compact('payment_requests'));
		
		$payment_request_logs = [];
		$payment_request_logs_released=[];
		
		foreach($payment_requests as $payment_request) {
			$payment_request_id = $payment_request['PaymentRequest']['id'];
			if($status=='pending') {
				$payment_request_id = $payment_request['PaymentRequest']['id'];
				$this->PaymentRequestLog->recursive = -1;
				$payment_request_logs[$payment_request_id] = $this->PaymentRequestLog->find('all',
					['conditions'=>
					['PaymentRequestLog.payment_request_id'=>$payment_request_id],
					['fields'=>['PaymentRequestLog.created']]]);
			}
			
			if($type!='cheque') {
				$this->PaymentRequestLog->recursive = -1;
				$payment_request_logs_released[$payment_request_id] = $this->PaymentRequestLog->find('all',
					['conditions'=>
					['PaymentRequestLog.payment_request_id'=>$payment_request_id,
					 'PaymentRequestLog.status'=>'released'],
					['fields'=>['PaymentRequestLog.created']]]);
			}
			
			$payment_request_cheques[$payment_request_id] = $this->PaymentRequestCheque->find('all',
					['conditions'=>
					['PaymentRequestCheque.payment_request_id'=>$payment_request_id,
					 'PaymentRequestCheque.status'=>'released']]);
		}
		
		$this->Bank->recursive = -1;
		$banks = $this->Bank->find('all');
		
	    $this->User->recursive = -1;
	    $users = $this->User->find('all');
	   
	    $payees = $this->Payee->find('all');
	    
		$this->set(compact('payment_request_logs',
						   'payment_request_logs_released',
						   'payment_request_cheques',
						   'banks', 'users', 'payees'));
	}
	
	public function add_request() {
		$this->autoRender = false;
		$this->response->type('text');
		
		$data = $this->request->data;
		$payee_id = $data['payee_id'];
		$amount = $data['amount'];
		$requested_by = $data['requested_by'];
		$purpose = $data['purpose'];
		$type = $data['type'];
		$status = $data['status'];
		$userin = $this->Auth->user('id');
		
		if($payee_id==0) {
			$payee = $userin;
		}
		else {
			$payee = $payee_id;
		}
		
		$data_array = ['user_id'=>$payee,
					   'requested_amount'=>$amount,
					   'requested_by'=>$requested_by,
					   'purpose'=>$purpose,
					   'status'=>$status,
					   'type'=>$type,
					   'inserted_by'=>$userin];
					   
		$this->loadModel('PaymentRequest');
		$this->loadModel('PaymentRequestLog');
		
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$DS_PaymentRequestLog = $this->PaymentRequestLog->getDataSource();
		
		$this->PaymentRequest->create();
		$this->PaymentRequest->set($data_array);
		
		if($this->PaymentRequest->save()) {
			$payment_request_id = $this->PaymentRequest->getLastInsertId();
			$payment_request_log = ['payment_request_id'=>$payment_request_id,
									'user_id'=>$payee,
									'status'=>$status];
			$DS_PaymentRequestLog->begin();
			$this->PaymentRequestLog->set($payment_request_log);
			
			if($this->PaymentRequestLog->save()) {
				$DS_PaymentRequestLog->commit();
				$DS_PaymentRequest->commit();
			}
			else {
				$DS_PaymentRequest->rollback();
			}
				
			return json_encode($data_array);
		}
		else {
			return json_encode("Error in saving request");
		}
		$DS_PaymentRequestLog->commit();
		$DS_PaymentRequest->commit();
		
		exit;
	}
	
	public function my_list() {
		$type=$this->params['url']['type'];
		$status=$this->params['url']['status'];
		$userin=$this->Auth->user('id');
		
		$this->loadModel('PaymentRequest');
		$this->loadModel('PaymentRequestLog');
		$this->loadModel('PaymentRequestCheque');
		
		$my_payment_requests = $this->PaymentRequest->find('all', ['conditions'=>
			['PaymentRequest.inserted_by'=>$userin,
			 'PaymentRequest.status'=>$status]]);

		$payment_request_logs = [];
		foreach($my_payment_requests as $my_payment_request) {
			$payment_request = $my_payment_request['PaymentRequest'];
			$payment_request_id = $payment_request['id'];
			
			$this->PaymentRequestLog->recursive = -1;
			$payment_request_logs[$payment_request_id] = $this->PaymentRequestLog->find('all',
				['conditions'=>
				['payment_request_id'=>$payment_request_id,
				 'status'=>'released']]);
				 
			$payment_request_cheques[$payment_request_id] = $this->PaymentRequestCheque->find('all',
				['conditions'=>
				['PaymentRequestCheque.payment_request_id'=>$payment_request_id,
				 'PaymentRequestCheque.status'=>'released']]);
		}
		
		$this->set(compact('type', 'status', 'my_payment_requests',
						   'payment_request_logs'));
	}
}