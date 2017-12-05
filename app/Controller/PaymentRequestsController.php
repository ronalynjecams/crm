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

			$this->PaymentRequestLog->recursive = -1;
			$payment_request_logs[$payment_request_id] = $this->PaymentRequestLog->find('all',
				['conditions'=>
				['payment_request_id'=>$payment_request_id,
				 'status'=>$status],
				'fields'=>['created']]);
			
			$this->PaymentRequestLog->recursive = -1;
			$payment_request_logs_released[$payment_request_id] = $this->PaymentRequestLog->find('all',
				['conditions'=>
				['payment_request_id'=>$payment_request_id,
				 'status'=>'released'],
				 'fields'=>['created']]);
			
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
					   'status'=>'pending',
					   'type'=>$type,
					   'inserted_by'=>$userin];
					   
		$this->loadModel('PaymentRequest');
		$this->loadModel('PaymentRequestLog');
		
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$this->PaymentRequest->create();
		$this->PaymentRequest->set($data_array);
		
		if($this->PaymentRequest->save()) {
			$payment_request_id = $this->PaymentRequest->getLastInsertId();
			$payment_request_log = ['payment_request_id'=>$payment_request_id,
									'user_id'=>$payee,
									'status'=>$status];
									
			$DS_PaymentRequestLog = $this->PaymentRequestLog->getDataSource();
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
	
	public function po_request_add() {
		$this->loadModel('Payee');
		$this->loadModel('Supplier');
		
	    $payees = $this->Payee->find('all');
	    $type = $this->params['url']['type'];
	    
	    $this->Supplier->recursive = -1;
	    $suppliers = $this->Supplier->find('all', ['conditions'=>[],
	    	'fields'=>['Supplier.id','Supplier.name']]);

	    $this->set(compact('payees','suppliers','type'));
	}
	
	public function get_po() {
		$this->autoRender = false;
		$this->response->type('json');
		
		$supplier_id = $this->request->query['id'];
		$userin = $this->Auth->user('id');
		
		$this->loadModel("PaymentPurchaseOrder");
		$this->loadModel("PaymentRequest");
		$this->loadModel("PurchaseOrder");
		
		$this->PaymentRequest->recursive = -1;
		$get_payment_request = $this->PaymentRequest->find('all',
			['conditions'=>['PaymentRequest.inserted_by'=>$userin],
							'fields'=>['id']]);
							
		$purchase_order_ids = [];
		foreach($get_payment_request as $payment_request) {
			$pr_id = $payment_request['PaymentRequest']['id'];

			$this->PaymentPurchaseOrder->recursive = -1;
			$payment_pos = $this->PaymentPurchaseOrder->find('all',
				['conditions'=>['payment_request_id'=>$pr_id]]);
			
			foreach($payment_pos as $payment_po) {
				$purchase_order_ids[] =$payment_po['PaymentPurchaseOrder']['purchase_order_id'];	
			}
		}

		$this->PurchaseOrder->recursive = -1;
		$pos = $this->PurchaseOrder->find('all', ['conditions'=>
			['supplier_id'=>$supplier_id,
			 'NOT'=>['id'=>$purchase_order_ids]],
			'fields'=>['id', 'po_number']]);
			
		if(!empty($pos)) {
			$retVal = $pos;
		}
		else { $retVal = []; }
		
		return json_encode($retVal);
	}
	
	public function get_po_each() {
		$this->autoRender = false;
		$this->response->type('json');
		
		$this->loadModel('PurchaseOrder');
		
		$po_ids = $this->request->query['id'];
		$po_each = [];
		foreach($po_ids as $po_id) {
			$this->PurchaseOrder->recursive = -1;
			$po_each[] = $this->PurchaseOrder->findById($po_id, ['id','po_number','grand_total']);
		}
		
		return json_encode($po_each);
	}
	
	public function convert_to_words(){
		$amount = $this->params['url']['amount'];
		
		echo $this->convertNumber($amount);
		exit;
	}
	
	public function add_po_request() {
		$this->autoRender = false;
		$this->response->type('text');
		
		$data=$this->request->data;
		$userin=$this->Auth->user('id');
		$type=$data['type'];
		$requested_amount=$data['requested_amount'];
		$purpose=$data['purpose'];
		$status="pending";
		$supplier_id=$data['supplier'];
		$pos=$data['po'];
		$values=$data['values'];
		$inserted_by=$userin;
		$payee = $data['payee'];
		
		if($payee==0){ $user=$userin; }
		else { $user = $payee; }
		
		$create = ['type'=>$type,
				   'requested_amount'=>$requested_amount,
				   'user_id'=>$user,
				   'purpose'=>$purpose,
				   'status'=>$status,
				   'supplier_id'=>$supplier_id,
				   'inserted_by'=>$inserted_by];
				   
		
		$this->loadModel('PaymentRequest');
		$this->loadModel('PaymentRequestLog');
		$this->loadModel('PaymentPurchaseOrder');
		
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$this->PaymentRequest->create;
		$this->PaymentRequest->set($create);
		
		if($this->PaymentRequest->save()) {
			$payment_request_id = $this->PaymentRequest->getLastInsertId();
			
			$this->loadModel('PurchaseOrder');
			$DS_PurchaseOrder = $this->PurchaseOrder->getDataSource();
			$DS_PurchaseOrder->begin();
			
			$DS_PaymentPurchaseOrder = $this->PaymentPurchaseOrder->getDataSource();
			$DS_PaymentPurchaseOrder->begin();

			for($c=0;$c<count($pos);$c++) {
				$po_id = $pos[$c];
				$value = $values[$c];
				
				$data_payment_purchase_order = ['payment_request_id'=>$payment_request_id,
												'purchase_order_id'=>$po_id,
												'po_amount_request'=>$requested_amount];
				
				$this->PaymentPurchaseOrder->create();
				$this->PaymentPurchaseOrder->set($data_payment_purchase_order);
				$this->PaymentPurchaseOrder->save();
				
				$this->PurchaseOrder->recursive = -1;
				$purchase_order = $this->PurchaseOrder->findById($po_id);
				
				$paynent_request = $purchase_order['PurchaseOrder']['payment_request'];
				$total_payment_request = $value + $paynent_request;
				
				$update = ['payment_request'=>$total_payment_request];
						   
				$this->PurchaseOrder->id = $po_id;
				$this->PurchaseOrder->set($update);
				$this->PurchaseOrder->save();
			}

			if($DS_PurchaseOrder->commit()&&$DS_PaymentPurchaseOrder->commit()) {			
				$payment_request_log = ['payment_request_id'=>$payment_request_id,
									'user_id'=>$user,
									'status'=>$status];
									
				$DS_PaymentRequestLog = $this->PaymentRequestLog->getDataSource();
				$DS_PaymentRequestLog->begin();
				$this->PaymentRequestLog->set($payment_request_log);
				
				if($this->PaymentRequestLog->save()) {
					$DS_PaymentRequestLog->commit();
					$DS_PaymentRequest->commit();
				}
			}
			else {
				$DS_PaymentPurchaseOrder->rollback();
				$DS_PurchaseOrder->rollback();
				$DS_PaymentRequest->rollback();
			}
		}
		
		$DS_PaymentPurchaseOrder->commit();
		$DS_PaymentRequest->commit();
		$DS_PurchaseOrder->commit();
		$DS_PaymentRequestLog->commit();
		
		return json_encode("end");
	}
	
	public function view() {
		$user_role = $this->Auth->user('role');
		$payment_request_id = $this->params['url']['id'];
		
		$this->loadModel("PaymentRequest");
		$request_details = $this->PaymentRequest->find('all', ['conditions'=>
			['PaymentRequest.id'=>$payment_request_id]]);
		
		$this->loadModel("PaymentRequestLog");
		$logs = $this->PaymentRequestLog->find('all', ['conditions'=>
			['payment_request_id'=>$payment_request_id]]);
		
		$this->loadModel("PaymentPurchaseOrder");
		$ppos = $this->PaymentPurchaseOrder->find('all', ['conditions'=>
			['payment_request_id'=>$payment_request_id]]);
		
		$withPO = false;
		foreach($request_details as $request_detail) {
			$supplier_id = $request_detail['PaymentRequest']['supplier_id'];
			if($supplier_id != 0) { $withPO = true; }
			else { $withPO = false; }
		}
		
		$this->loadModel("PaymentInvoice");
		$this->PaymentInvoice->recursive = -1;
		$payment_invoices = $this->PaymentInvoice->find('all',
			['conditions'=>['payment_request_id'=>$payment_request_id]]);
		
		$this->loadModel("PaymentRequestCheque");
		$payment_request_cheques = $this->PaymentRequestCheque->find('all',
			['conditions'=>['payment_request_id'=>$payment_request_id]]);
		
		$this->set(compact('request_details', 'logs', 'ppos', 'withPO',
			'payment_invoices', 'payment_request_cheques', 'user_role',
			'payment_request_id'));
	}
	
	public function void() {
		$this->autoRender = false;
		
		$payment_request_cheque_id = $this->params['url']['id'];
		$pr_id = $this->params['url']['pr_id'];
		
		$this->loadModel('PaymentRequestCheque');
		$DS_PaymentRequestCheque = $this->PaymentRequestCheque->getDataSource();
		$DS_PaymentRequestCheque->begin();
		
		$this->PaymentRequestCheque->id = $payment_request_cheque_id;
		$this->PaymentRequestCheque->set(['status'=>'void']);
		
		if($this->PaymentRequestCheque->save()) {
			$this->loadModel('PaymentRequest');
			
			$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
			$DS_PaymentRequest->begin();
			
			$this->PaymentRequest->id = $pr_id;
			$this->PaymentRequest->set(['status'=>"approved"]);
			
			if($this->PaymentRequest->save()) {
				$DS_PaymentRequestCheque->commit();
				$DS_PaymentRequest->commit();
			}
			else {
				$DS_PaymentRequestCheque->rollback();
			}
		}
		$DS_PaymentRequestCheque->commit();
		$DS_PaymentRequest->commit();
		
		return json_encode("Everything was executed");
	}
	
	public function update_ewt() {
		$this->autoRender = false;
		$pr_id = $this->request->query['id'];
		$type = $this->request->query['type'];
		
		$today = date("Y-m-d H:i:s"); 
		
		$this->loadModel('PaymentRequest');
		
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$this->PaymentRequest->id = $pr_id;
		
		if($type=="release") {
			$this->PaymentRequest->set(['ewt_released'=>$today]);
		}
		else if($type=="return") {
			$this->PaymentRequest->set(['ewt_returned'=>$today]);
		}
		
		if($this->PaymentRequest->save()) {
			$DS_PaymentRequest->commit();
		}
		
		$DS_PaymentRequest->commit();
		return json_encode("Updated EWT @".$today);
	}
	
	public function liquidate() {
		$this->autoRender = false;
		
		$data = $this->request->data;
		$payment_request_id = $data['payment_request_id'];
		$amount = $data['receipt_amount'];
		$with_held_amount = $data['with_held'];
		$ewt_amount = $data['ewt'];
		$tax_amount = $data['tax'];
		$reference_number = $data['reference_number'];
		$reference_type = $data['type'];
		$purchase_order_id_tmp = $data['po_id'];
		$user_id = $this->Auth->user('id');
		$reference_date = $data['reference_date'];
		
		if($purchase_order_id_tmp=="") { $purchase_order_id = 0; }
		else { $purchase_order_id = $purchase_order_id_tmp; }
		
		$payment_invoice_data = ['payment_request_id'=>$payment_request_id,
								 'amount'=>$amount,
								 'with_held_amount'=>$with_held_amount,
								 'ewt_amount'=>$ewt_amount,
								 'tax_amount'=>$tax_amount,
								 'reference_number'=>$reference_number,
								 'reference_type'=>$reference_type,
								 'purchase_order_id'=>$purchase_order_id,
								 'user_id'=>$user_id,
								 'reference_date'=>$reference_date];
		
		$this->loadModel('PaymentInvoice');
		$DS_PaymentInvoice = $this->PaymentInvoice->getDataSource();
		$DS_PaymentInvoice->begin();
		
		$this->PaymentInvoice->create();
		$this->PaymentInvoice->set($payment_invoice_data);
		if($this->PaymentInvoice->save()) {
			$this->loadModel('PaymentRequest');
			$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
			$DS_PaymentRequest->begin();
			
			$this->PaymentRequest->id = $payment_request_id;
			$this->PaymentRequest->set(['status'=>'liquidated']);
			if($this->PaymentRequest->save()) {
				$this->loadModel('PaymentRequestLog');
				$DS_PaymentRequestLog = $this->PaymentRequestLog->getDataSource();
				$DS_PaymentRequestLog->begin();
				
				$this->PaymentRequestLog->create();
				$this->PaymentRequestLog->set(['payment_request_id'=>$payment_request_id,
											   'user_id'=>$user_id,
											   'status'=>'liquidated']);
				
				if($this->PaymentRequestLog->save()) {
					$DS_PaymentRequestLog->commit();
					$DS_PaymentRequest->commit();
					$DS_PaymentInvoice->commit();
					return json_encode($payment_invoice_data);
				}
				else {
					$DS_PaymentInvoice->rollback();
					$DS_PaymentRequest->rollback();
				}
			}
			else {
				$DS_PaymentInvoice->rollback();
			}
		}
		else {
			echo json_encode($payment_invoice_data);
			return json_encode("There was something wrong in saving PaymentInvoice");
		}
		
		$DS_PaymentInvoice->commit();
		$DS_PaymentRequest->commit();
		$DS_PaymentRequestLog->commit();
		
		return json_encode($data);
	}
	
	public function close_liquidation() {
		$this->autoRender = false;
		
		$data = $this->request->data;
		$pr_id = $data['id'];
		$type = $data['type'];
		$amount = $data['amount'];
		
		$this->loadModel('PaymentRequest');
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$this->PaymentRequest->id = $pr_id;
		
		if($type=='reimburse') {
			$data_pr = ['reimbursed_amount'=>$amount];
		}
		else if($type=='return') {
			$data_pr = ['returned_amount'=>$amount];
		}
		else {
			return json_encode("Unknown Type");
		}
		
		$this->PaymentRequest->set($data_pr);
		
		if($this->PaymentRequest->save()) {
			$DS_PaymentRequest->commit();
		}
		
		$DS_PaymentRequest->commit();
		
		return json_encode($data);
	}
	
	public function release() {
		// UNDER CONSTRUCTION
		$this->autoRender = false;
		
		$data = $this->request->data;
		$payment_request_id = $data['id'];
		$type = $data['type'];
		$userin = $this->Auth->user('id');
		
		$this->loadModel('PaymentRequest');
		$this->loadModel('PaymentRequestCheque');
		$this->loadModel('PaymentRequestLog');
		
		$DS_PaymentRequestCheque = $this->PaymentRequestCheque->getDataSource();
		
		if($type!="cheque") {
			$released_amount = $data['released_amount'];
			$data_payment_request = ['released_amount'=>$released_amount,
									 'status'=>'released'];
		}
		else {
			$select_bank = $data['select_bank'];
			$input_cheque_number = $data['input_cheque_number'];
			$input_cheque_date = $data['input_cheque_date'];
			$data_payment_request_cheques = ['payment_request_id'=>$payment_request_id,
									 'cheque_number'=>$input_cheque_number,
									 'payee_id'=>$userin,
									 'cheque_date'=>$input_cheque_date,
									 'bank_id'=>$select_bank,
									 'status'=>'released'];
			
			$DS_PaymentRequestCheque->begin();
			$this->PaymentRequestCheque->create();
			$this->PaymentRequestCheque->set($data_payment_request_cheques);
			
			if($this->PaymentRequestCheque->save()) {
				$DS_PaymentRequestCheque->commit();
			}
			
			$data_payment_request = ['status'=>'released'];
		}
		
		$data_payment_request_log = ['payment_request_id'=>$payment_request_id,
									 'user_id'=>$userin,
									 'status'=>'released'];
		
	    $DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$this->PaymentRequest->id = $payment_request_id;
		$this->PaymentRequest->set($data_payment_request);
		
		if($this->PaymentRequest->save()) {
			$DS_PaymentRequestLog = $this->PaymentRequestLog->getDataSource();
			$DS_PaymentRequestLog->begin();
			$this->PaymentRequestLog->create();
			$this->PaymentRequestLog->set($data_payment_request_log);
			
			if($this->PaymentRequestLog->save()) {
				$DS_PaymentRequestLog->commit();
				$DS_PaymentRequest->commit();
				$DS_PaymentRequestCheque->commit();
			}
			else {
				$DS_PaymentRequest->rollback();
				$DS_PaymentRequestCheque->rollback();
			}
		}
		else {
			$DS_PaymentRequestCheque->rollback();
		}
		
		$DS_PaymentRequestLog->commit();
		$DS_PaymentRequest->commit();
		$DS_PaymentRequestCheque->commit();
		
		return json_encode($data_payment_request);
	}
	
	public function action() {
		$this->autoRender = false;
		$data = $this->request->data;
		$id = $data['id'];
		$action = $data['action'];
		$userin = $this->Auth->user('id');
		
		$this->loadModel('PaymentRequest');
		$this->loadModel('PaymentRequestLog');
		
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$this->PaymentRequest->id = $id;
		$this->PaymentRequest->set(['status'=>$action]);
		
		if($this->PaymentRequest->save()) {
			$DS_PaymentRequestLog = $this->PaymentRequestLog->getDataSource();
			$DS_PaymentRequestLog->begin();
			
			$this->PaymentRequestLog->create();
			$this->PaymentRequestLog->set(['payment_request_id'=>$id,
										   'user_id'=>$userin,
										   'status'=>$action]);
			if($this->PaymentRequestLog->save()) {
				$DS_PaymentRequestLog->commit();
				$DS_PaymentRequest->commit();
			}
			else {
				$DS_PaymentRequest->rollback();
			}
		}
		
		$DS_PaymentRequestLog->commit();
		$DS_PaymentRequest->commit();
		return json_encode($data);
	}
	
	public function verify() {
		$this->autoRender = false;
		$data = $this->request->data;
		$payment_request_id = $data['id'];
		
		$this->loadModel('PaymentRequest');
		
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$this->PaymentRequest->id = $payment_request_id;
		$this->PaymentRequest->set(['status'=>'verified']);
		
		return json_encode($data);
	}

	
	public function replenish() {
		$this->autoRender = false;
		$userin = $this->Auth->user('id');
		$data = $this->request->data;
		
		$this->loadModel('PaymentRequest');
		$this->loadModel('PaymentReplenishedDetail');
		$this->loadModel('PaymentReplenishment');
		$this->loadModel('PaymentRequestLog');
		
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequestLog = $this->PaymentRequestLog->getDataSource();
		$DS_PaymentReplenishment = $this->PaymentReplenishment->getDataSource();
		$DS_PaymentReplenishedDetail = $this->PaymentReplenishedDetail->getDataSource();
		
		$total_amount = 0.000000;
		$payment_request_log_save[] = [];
		foreach($data as $id_amount) {
			$split_id_amount = explode(":",$id_amount);
			$id = $split_id_amount[0];
			$amount = $split_id_amount[1];
			$total_amount += $amount;
			$today = date("Y-m-d H:i:s");
			
			// PAYMENT REQUEST
			$DS_PaymentRequest->begin();
			$payment_request_set = ['status'=>'replenished',
							        'replenished_date'=>$today];
			
			$this->PaymentRequest->id = $id;
			$this->PaymentRequest->set($payment_request_set);
				
			if($this->PaymentRequest->save()) {
				// PAYMENT REQUEST LOG
				$data_payment_request_log = ['payment_request_id'=>$id,
											 'user_id'=>$userin,
											 'status'=>'replenished'];
				$DS_PaymentRequestLog->begin();
				$this->PaymentRequestLog->create();
				$this->PaymentRequestLog->set($data_payment_request_log);
				
				if($this->PaymentRequestLog->save()) {
					$payment_request_log_save[] = true;
					$DS_PaymentRequestLog->commit();
					$DS_PaymentRequest->commit();
				}
				else {
					echo json_encode("Error in PaymentRequestLog save");
					$payment_request_log_save[] = false;
					$DS_PaymentRequest->rollback();
				}
			}
		}
		
		$saved_request_log = true;
		if(in_array("false", $payment_request_log_save)) {
			$save_request_log="false";
		}
		
		if($saved_request_log) {
			$this->PaymentReplenishment->recursive = -1;
			$get_p_replenishement = $this->PaymentReplenishment->find('all',
				['conditions'=>['user_id'=>$userin,
							    'acknowledged_date'=>null]]);
				$ret_p_rep = $get_p_replenishement[0]['PaymentReplenishment'];

			if(!empty($get_p_replenishement)) {
				// PAYMENT REPLENISHMENT
				// UPDATE
				$ret_p_rep_amount = $ret_p_rep['amount'];
				$ins_total_amount = $ret_p_rep_amount + $total_amount;
				$data_payment_replenishment = ['amount'=>$ins_total_amount];
				
				$DS_PaymentReplenishment->begin();
				$this->PaymentReplenishment->id = $ret_p_rep['id'];
				$this->PaymentReplenishment->set($data_payment_replenishment);
			}
			else {
				// PAYMENT REPLENISHMENT
				// CREATE
				$data_payment_replenishment = ['amount'=>$total_amount,
											   'user_id'=>$userin];
				$DS_PaymentReplenishment->begin();
				$this->PaymentReplenishment->create();
				$this->PaymentReplenishment->set($data_payment_replenishment);
			}
			
			if($this->PaymentReplenishment->save()) {
				foreach($data as $id_amount) {
					$split_id_amount = explode(":",$id_amount);
					$id = $split_id_amount[0];
					
					// PAYMENT REPLENISHED DETAIL
					if(!empty($get_p_replenishement)) {
						$payment_replenishment_id = $ret_p_rep['id'];
					}
					else {
						$payment_replenishment_id = $this->PaymentReplenishment->getLastInsertId();
					}
					
					$data_payment_replenished_detail = ['payment_replenishment_id'=>$payment_replenishment_id,
														'payment_request_id'=>$id];
					$DS_PaymentReplenishedDetail->begin();
					$this->PaymentReplenishedDetail->create();
					$this->PaymentReplenishedDetail->set($data_payment_replenished_detail);
					if($this->PaymentReplenishedDetail->save()) {
						$DS_PaymentReplenishedDetail->commit();
						$DS_PaymentReplenishment->commit();
						$DS_PaymentRequestLog->commit();
						$DS_PaymentRequest->commit();
					}
					else {
						echo json_encode("Error in PaymentReplenishedDetail save");
						$DS_PaymentReplenishment->rollback();
						$DS_PaymentRequestLog->rollback();
						$DS_PaymentRequest->rollback();
					}
				}
			}
			else {
				echo json_encode("Error in PaymentReplenishment save");
				$DS_PaymentRequestLog->rollback();
				$DS_PaymentRequest->rollback();
			}
		}
		else {
			$DS_PaymentRequestLog->rollback();
			$DS_PaymentRequest->rollback();
		}
		
		
		return json_encode("Replenishment Done");
	}
	
	public function replenishments() {
		$status = $this->params['url']['status'];
		
		$this->loadModel('PaymentReplenishment');
		
		if($status=="pending") {
			$payment_replenishments = $this->PaymentReplenishment->find('all',
				['conditions'=>['acknowledged_date'=>null]]);
		}
		else {
			$payment_replenishments = $this->PaymentReplenishment->find('all',
				['conditions'=>['NOT'=>['acknowledged_date'=>null]]]);
		}
		
		$this->set(compact('payment_replenishments', 'status'));
	}
	
	public function view_replenishments() {
		$id = $this->params['url']['id'];
		
		$this->loadModel('PaymentReplenishedDetail');
		
		$payment_replenished_detail = $this->PaymentReplenishedDetail->find('all',
			['conditions'=>['payment_replenishment_id'=>$id]]);
		
		$this->loadModel('PaymentReplenishment');
		$this->PaymentReplenishment->recursive = -1;
		$payment_replenishment = $this->PaymentReplenishment->findById($id);
		
		$this->set(compact('id','payment_replenished_detail', 'payment_replenishment'));
	}
	
	public function delete_replenishment() {
		$this->autoRender = false;
		$id = $this->request->query['id'];
		
		$this->loadModel('PaymentReplenishedDetail');
		$DS_PaymentReplenishedDetail = $this->PaymentReplenishedDetail->getDataSource();
		$DS_PaymentReplenishedDetail->begin();
		
		$this->PaymentReplenishedDetail->id=$id;
		if($this->PaymentReplenishedDetail->delete()) {
			$DS_PaymentReplenishedDetail->commit();
		}
		else {
			return json_encode("Error in Deleting Payment Replenishment.");
		}
		
		$DS_PaymentReplenishedDetail->commit();
		return json_encode("Delete Replenishment Done");
		exit;
	}
	
	public function acknowledge_replenishment() {
		$this->autoRender = false;
		$id = $this->request->query['id'];
		$today = date("Y-m-d H:i:s");
		
		$this->loadModel('PaymentReplenishment');
		$DS_PaymentReplenishment = $this->PaymentReplenishment->getDataSource();
		
		$data_payment_replenishment = ['acknowledged_date'=>$today];
		$DS_PaymentReplenishment->begin();
		$this->PaymentReplenishment->id = $id;
		$this->PaymentReplenishment->set($data_payment_replenishment);
		
		if($this->PaymentReplenishment->save()) {
			$DS_PaymentReplenishment->commit();
		}
		else {
			return json_encode("Error in acknowledging replenishment.");
		}
		
		$DS_PaymentReplenishment->commit();
		return json_encode("Acknowledge Replenishment Done.");
		exit;
	}
}