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
		$uid = $this->Auth->user('id');
		$role = $this->Auth->user('role');
		$this->set(compact('type','status'));
		
		$this->loadModel('PaymentRequest');
		$this->loadModel('PaymentRequestLog');
		$this->loadModel('PaymentRequestCheque');
		$this->loadModel('Bank');
		$this->loadModel('User');
		$this->loadModel('Payee');
		
		if($role=="supply_staff" || $role=="raw_head" || $role=="subcon_purchasing") {
			$payment_requests = $this->PaymentRequest->find('all',
										['conditions'=>
											['PaymentRequest.type'=>$type,
											 'PaymentRequest.status'=>$status,
											 'PaymentRequest.inserted_by'=>$uid]
											//  ,
										 //'fields'=>['PaymentRequest.id', 
											// 		'PaymentRequest.payee_id',
											// 		'PaymentRequest.created']
										]);
		}
		else {
			$payment_requests = $this->PaymentRequest->find('all', ['conditions'=>
										['PaymentRequest.type'=>$type,
										 'PaymentRequest.status'=>$status]]);
		}
		
		// =====> MODIFICATION FOR SHOWING PO
		$ppos_obj = [];
		foreach($payment_requests as $each_payment_request) {
			$payment_request_obj = $each_payment_request['PaymentRequest'];
			$id = $payment_request_obj['id'];
			$supplier_id = $payment_request_obj['supplier_id'];
			
			$this->loadModel('PaymentPurchaseOrder');
			$ppos = $this->PaymentPurchaseOrder->find('all', ['conditions'=>
				['payment_request_id'=>$id]]);
			foreach($ppos as $eppos) {
				$ppos_obj[$id][] = $eppos;
			}
		}
		$this->set(compact('ppos_obj'));
		// =====> END OF SHOWING PO
		
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
	   
	    $payees = $this->Payee->find('all', ['order'=>'name ASC']);
	    
	    // MARK: OFFLINE MODIFICATION
		$this->loadModel('PaymentRequestCategory');
		$this->PaymentRequestCategory->recursive = -1;
		$get_categories = $this->PaymentRequestCategory->find('all');
		$this->set(compact('payment_request_logs',
						   'payment_request_logs_released',
						   'payment_request_cheques',
						   'banks', 'users', 'payees',
						   'get_categories', 'role'));
		// MARK: END OF OFFLINE MODIFICATION
	}
	
	public function add_request() {
		$this->autoRender = false;
		$this->response->type('text');
		
		$data = $this->request->data;
		$userin = $this->Auth->user('id');
		$category = $data['category'];
		$payee_id = $data['payee_id'];
		$amount = floatval($data['amount']);
		if($this->Auth->user('role')=='proprietor'
		   || $this->Auth->user('role')=='proprietor_secretary'
		   || $this->Auth->user('role')=='supply_staff'
		   || $this->Auth->user('role')=='raw_head') {
		   	echo "REQUESTED BY:";
			$requested_by = $data['requested_by'];
		}
		else {
			$requested_by = $userin;
		}
		$purpose = $data['purpose'];
		$type = $data['type'];
		$status = $data['status'];
		
		if($type=="pettycash") {
			$control_number = $data['control_number'];
			$data_array = ['control_number'=>$control_number,
						   'user_id'=>$requested_by,
						   'payee_id'=>$payee_id,
						   'requested_amount'=>$amount,
						   'payment_request_category_id'=>$category,
						   'requested_by'=>$requested_by,
						   'purpose'=>$purpose,
						   'status'=>'pending',
						   'type'=>$type,
						   'inserted_by'=>$userin];
		}
		else {
			$data_array = ['user_id'=>$requested_by,
						   'payee_id'=>$payee_id,
						   'requested_amount'=>$amount,
						   'payment_request_category_id'=>$category,
						   'requested_by'=>$requested_by,
						   'purpose'=>$purpose,
						   'status'=>'pending',
						   'type'=>$type,
						   'inserted_by'=>$userin];
		}
		echo json_encode($data_array);
		$this->loadModel('PaymentRequest');
		$this->loadModel('PaymentRequestLog');
		
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$this->PaymentRequest->create();
		$this->PaymentRequest->set($data_array);
		
		if($this->PaymentRequest->save()) {
			echo "PaymentRequest save";
			$payment_request_id = $this->PaymentRequest->getLastInsertId();
			$payment_request_log = ['payment_request_id'=>$payment_request_id,
									'user_id'=>$userin,
									'status'=>$status];
									
			$DS_PaymentRequestLog = $this->PaymentRequestLog->getDataSource();
			$DS_PaymentRequestLog->begin();
			$this->PaymentRequestLog->set($payment_request_log);
			
			if($this->PaymentRequestLog->save()) {
				$DS_PaymentRequestLog->commit();
				$DS_PaymentRequest->commit();
			}
			else {
				$DS_PaymentRequestLog->rollback();
				$DS_PaymentRequest->rollback();
			}
				
		}
		else {
			echo "Error in Payment Request";
			$DS_PaymentRequest->rollback();
		}
		return "done";
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
		$this->loadModel('User');
		
	    $payees = $this->Payee->find('all');
	    $type = $this->params['url']['type'];
	    
	    $this->Supplier->recursive = -1;
	    $suppliers = $this->Supplier->find('all', ['conditions'=>['status'=>'active'],
	    	'fields'=>['Supplier.id','Supplier.name']]);
	    	
	    $this->User->recursive = -1;
	    $users = $this->User->find('all');

	    $this->set(compact('payees','suppliers','type','users'));
	}

	public function get_po() {
		$this->autoRender = false;
		$this->response->type('json');
		$supplier_id = $this->request->data;
		$userin = $this->Auth->user('id');
		
		$this->loadModel("PaymentPurchaseOrder");
		$this->loadModel("PurchaseOrder");

		$this->PurchaseOrder->recursive = -1;
		$pos = $this->PurchaseOrder->find('all', ['conditions'=>
			['supplier_id'=>$supplier_id],
			'fields'=>['id', 'po_number', 'grand_total', 'payment_request']]);

		$valid_pos = [];
		foreach($pos as $each_pos) {
			$PurchaseOrder = $each_pos['PurchaseOrder'];
			$grand_total = $PurchaseOrder['grand_total'];
			$payment_request = $PurchaseOrder['payment_request'];
			
			if($payment_request==0) {
				$valid_pos[] = $each_pos;
			}
			else {
				if(floatval($payment_request)<floatval($grand_total)) {
					$valid_pos[] = $each_pos;
				}
			}
		}
		
		return json_encode($valid_pos);
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
		$user=$data['requested_by'];
		
		if($type=="pettycash") {
			$control_number = $data['control_number'];
			$create = ['type'=>$type,
					   'requested_amount'=>$requested_amount,
					   'user_id'=>$user,
					   'payee_id'=>$payee,
					   'inserted_by'=>$inserted_by,
					   'purpose'=>$purpose,
					   'status'=>$status,
					   'supplier_id'=>$supplier_id,
					   'control_number'=>$control_number];
		}
		else {
			$create = ['type'=>$type,
				   'requested_amount'=>$requested_amount,
				   'user_id'=>$user,
				   'payee_id'=>$payee,
				   'inserted_by'=>$inserted_by,
				   'purpose'=>$purpose,
				   'status'=>$status,
				   'supplier_id'=>$supplier_id];
		}
		
		$this->loadModel('PaymentRequestLog');
		$this->loadModel('PaymentPurchaseOrder');
		
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$this->PaymentRequest->create;
		$this->PaymentRequest->set($create);
		
		if($this->PaymentRequest->save()) {
			echo "PaymenRequest saved";
			$payment_request_id = $this->PaymentRequest->getLastInsertId();
			
			$isAllPurchaseOrderSave = [];
			$this->loadModel('PurchaseOrder');
			$DS_PurchaseOrder = $this->PurchaseOrder->getDataSource();
			$DS_PurchaseOrder->begin();
			
			$isAllPaymentPurchaseOrder = [];
			$DS_PaymentPurchaseOrder = $this->PaymentPurchaseOrder->getDataSource();
			$DS_PaymentPurchaseOrder->begin();

			for($c=0;$c<count($pos);$c++) {
				$po_id = $pos[$c];
				
				$data_payment_purchase_order = ['payment_request_id'=>$payment_request_id,
												'purchase_order_id'=>$po_id,
												'po_amount_request'=>$values[$c],
												'user_id'=>$userin];
				$this->PaymentPurchaseOrder->create();
				$this->PaymentPurchaseOrder->set($data_payment_purchase_order);
				if($this->PaymentPurchaseOrder->save()) {
					$isAllPaymentPurchaseOrder[] = "yes";
				}
				else {
					$isAllPaymentPurchaseOrder[] = "no";
				}
				
				$getPOAmount = $this->PurchaseOrder->findById($po_id, ['id', 'grand_total', 'payment_request']);
				$POAmount = $getPOAmount['PurchaseOrder']['grand_total'];
				$PO_payment_request = $getPOAmount['PurchaseOrder']['payment_request'];
				$total_requests = $PO_payment_request+$values[$c];
				echo "POAmount: ".gettype($POAmount);
				echo "RequestedAmount: ".gettype($total_requests);
				if(floatval($POAmount) > floatval($total_requests)) {
					$update = ['payment_request'=>$total_requests,
							   'status'=>'partial'];
				}
				else {
					$update = ['payment_request'=>$total_requests,
							   'status'=>'processed'];
				}
				echo "UPDATE: ";
				echo json_encode($update);
				$this->PurchaseOrder->id = $po_id;
				$this->PurchaseOrder->set($update);
				if($this->PurchaseOrder->save()) {
					echo "PurchaseOrder Payment Request is saved";
					$isAllPurchaseOrderSave[] = "yes";
				}
				else {
					$isAllPurchaseOrderSave[] = "no";
				}
			}

			if(in_array('no', $isAllPurchaseOrderSave) && in_array('no', $isAllPaymentPurchaseOrder)) {
				echo "Cannot save PurchaseOrder and PaymentPurchaseOrder. Error occurred.";
				$DS_PurchaseOrder->rollback();
				$DS_PaymentPurchaseOrder->rollback();
				$DS_PaymentRequestLog->rollback();
				$DS_PaymentRequest->rollback();
			}
			else {
				echo "No error in PurchaseOrder and PaymentPurchaseOrder";
				$payment_request_log = ['payment_request_id'=>$payment_request_id,
										'user_id'=>$user,
										'status'=>$status];
									
				$DS_PaymentRequestLog = $this->PaymentRequestLog->getDataSource();
				$DS_PaymentRequestLog->begin();
				$this->PaymentRequestLog->create();
				$this->PaymentRequestLog->set($payment_request_log);
				if($this->PaymentRequestLog->save()) {
					echo "PaymentRequestLog saved";
					$DS_PurchaseOrder->commit();
					$DS_PaymentPurchaseOrder->commit();
					$DS_PaymentRequestLog->commit();
					$DS_PaymentRequest->commit();
				}
				else {
					echo "Error in PaymentRequestLog";
					$DS_PurchaseOrder->rollback();
					$DS_PaymentPurchaseOrder->rollback();
					$DS_PaymentRequestLog->rollback();
					$DS_PaymentRequest->rollback();
				}
			}
		}
		else {
			echo "Error in PaymentRequest";
			$DS_PaymentRequest->rollback();
		}
		
		
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
		
		$this->loadModel('Bank');
		$this->Bank->recursive = -1;
		$banks = $this->Bank->find('all');
		
		$this->loadModel('Payee');
	    $payees = $this->Payee->find('all', ['order'=>'name ASC']);
		
		$this->set(compact('request_details', 'logs', 'ppos', 'withPO',
			'payment_invoices', 'payment_request_cheques', 'user_role',
			'payment_request_id', 'banks', 'payees'));
	}
	
	public function void() {
		$this->autoRender = false;
		
		$data = $this->request->data;
		$payment_request_cheque_id = $data['id'];
		$pr_id = $data['pr_id'];
		$remarks = $data['remarks'];
		
		$this->loadModel('PaymentRequestCheque');
		$DS_PaymentRequestCheque = $this->PaymentRequestCheque->getDataSource();
		$DS_PaymentRequestCheque->begin();
		
		$this->PaymentRequestCheque->id = $payment_request_cheque_id;
		$this->PaymentRequestCheque->set(['status'=>'void', 'void_reason'=>$remarks]);
		
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
		$pr_id = $this->request->data['id'];
		$status = $this->request->data['status'];
		
		$today = date("Y-m-d H:i:s"); 
		
		$this->loadModel('PaymentRequest');
		
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$this->PaymentRequest->id = $pr_id;
		
		if($status=="released") {
			$this->PaymentRequest->set(['ewt_released'=>$today]);
		}
		else if($status=="returned") {
			$this->PaymentRequest->set(['ewt_returned'=>$today]);
		}
		
		if($this->PaymentRequest->save()) {
			$DS_PaymentRequest->commit();
			return "PaymentRequest saved";
		}
		else {
			$DS_PaymentRequest->rollback();
			return "Error in update_ewt";
			exit;
		}
		
		return json_encode("Updated EWT @".$today);
	}
	
	public function liquidate() {
		$this->autoRender = false;
		
		$data = $this->request->data;
		$payment_request_id = $data['payment_request_id'];
		$amount = floatval($data['receipt_amount']);
		$with_held_amount = floatval($data['with_held']);
		$ewt_amount = floatval($data['ewt']);
		$tax_amount = floatval($data['tax']);
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
			$DS_PaymentInvoice->commit();
			return "Payment Invoice save";
		}
		else {
			$DS_PaymentInvoice->rollback();
			echo json_encode($payment_invoice_data);
			return json_encode("There was something wrong in saving PaymentInvoice");
		}
	}
	
	public function done_liquidation() {
		$this->autoRender = false;
		
		$today = date("Y-m-d H:m:s");
		$data = $this->request->data;
		$user_id = $this->Auth->user('id');
		$payment_request_id = $data['payment_request_id'];
		
		$this->loadModel('PaymentInvoice');
		$this->PaymentInvoice->recursive = -1;
		$PaymentInvoice = $this->PaymentInvoice->findAllByPaymentRequestId($payment_request_id);
		
		$liquidated_amount = 0;
		foreach($PaymentInvoice as $return_payment_invoice) {
			$PaymentInvoiceObject = $return_payment_invoice['PaymentInvoice'];
			$liquidated_amount += $PaymentInvoiceObject['amount'] + $PaymentInvoiceObject['with_held_amount'] + $PaymentInvoiceObject['ewt_amount'] + $PaymentInvoiceObject['tax_amount'];
		}
		
		$this->loadModel('PaymentRequest');
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$this->PaymentRequest->id = $payment_request_id;
		$this->PaymentRequest->set(['status'=>'liquidated',
									'liquidated_amount'=>$liquidated_amount,
									'liquidated_date'=>$today]);
		if($this->PaymentRequest->save()) {
			echo "PaymentRequest saved";
			$this->loadModel('PaymentRequestLog');
			$DS_PaymentRequestLog = $this->PaymentRequestLog->getDataSource();
			$DS_PaymentRequestLog->begin();
			
			$this->PaymentRequestLog->create();
			$this->PaymentRequestLog->set(['payment_request_id'=>$payment_request_id,
										   'user_id'=>$user_id,
										   'status'=>'liquidated']);
			
			if($this->PaymentRequestLog->save()) {
				echo "Payment Request Log saved";
				$DS_PaymentRequestLog->commit();
				$DS_PaymentRequest->commit();
			}
			else {
				echo "ERROR in PaymentRequestLog";
				$DS_PaymentRequestLog->rollback();
				$DS_PaymentRequest->rollback();
			}
		}
		else {
			echo "Error in PaymentRequest";
			$DS_PaymentRequest->rollback();
		}
		
		return json_encode($data);
	}
	
	public function close_liquidation() {
		$this->autoRender = false;
		
		$data = $this->request->data;
		$pr_id = $data['id'];
		$type = $data['type'];
		$amount = floatval($data['amount']);
		
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
		$type = strtolower($data['type']);
		$status = strtolower($data['status']);
		$userin = $this->Auth->user('id');
		$released_amount = $data['released_amount'];
		$today = date("Y-m-d H:i:s"); 
		
		$this->loadModel('PaymentRequest');
		$this->loadModel('PaymentRequestCheque');
		$this->loadModel('PaymentRequestLog');
		
		if($type!="cheque") {
			if($status=='released') {
				$data_payment_request = ['released_amount'=>$released_amount,
										 'status'=>$status,
										 'ewt_released'=>$today];
			}
			else {
				$data_payment_request = ['released_amount'=>$released_amount,
										 'status'=>$type,
										 'ewt_returned'=>$today];
			}
		}
		else {
			$payee_id = $data['selected_payee'];
			$select_bank = $data['select_bank'];
			$input_cheque_number = $data['input_cheque_number'];
			$input_cheque_date = $data['input_cheque_date'];
			if($status=='released') {
				$data_payment_request_cheques = [
										 'released_amount'=>$released_amount,
										 'payment_request_id'=>$payment_request_id,
										 'cheque_number'=>$input_cheque_number,
										 'payee_id'=>$payee_id,
										 'cheque_date'=>$input_cheque_date,
										 'bank_id'=>$select_bank,
										 'status'=>$status,
										 'ewt_released'=>$today];
										 
				$data_payment_request = ['status'=>$status,
										 'ewt_released'=>$today];
			}
			else {
				$data_payment_request_cheques = [
										 'released_amount'=>$released_amount,
										 'payment_request_id'=>$payment_request_id,
										 'cheque_number'=>$input_cheque_number,
										 'payee_id'=>$payee_id,
										 'cheque_date'=>$input_cheque_date,
										 'bank_id'=>$select_bank,
										 'status'=>$status,
										 'ewt_returned'=>$today];
										 
				$data_payment_request = ['status'=>$status,
										 'ewt_returned'=>$today];
			}
			
			$this->loadModel('PaymentRequestCheque');
			$DS_PaymentRequestCheque = $this->PaymentRequestCheque->getDataSource();
			$DS_PaymentRequestCheque->begin();
			$this->PaymentRequestCheque->create();
			$this->PaymentRequestCheque->set($data_payment_request_cheques);
			
			if($this->PaymentRequestCheque->save()) {
				$DS_PaymentRequestCheque->commit();
			}
			else {
				$DS_PaymentRequestCheque->rollback();
			}
			
		}
		
		$data_payment_request_log = ['payment_request_id'=>$payment_request_id,
									 'user_id'=>$userin,
									 'status'=>$status];
		
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
				// MAE's MODIFICATION FOR COMPANY FUND LOGS
				// ===============================================================>
				if($type=="pettycash") {
					$this->loadModel('CompanyFund');
					$get_company_fund = $this->CompanyFund->find('first', ['fields'=>'id, amount']);
					$CompanyFundId = $get_company_fund['CompanyFund']['id'];
					$CompanyFundAmount = $get_company_fund['CompanyFund']['amount'];
					
					if($CompanyFundAmount!=0 && $CompanyFundAmount!=null && $CompanyFundAmount!="") {
						$updated_amount = (double)$CompanyFundAmount-(double)$released_amount;
						echo $updated_amount;
						$DS_CompanyFund = $this->CompanyFund->getDataSource();
						$DS_CompanyFund->begin();
						
						$this->CompanyFund->id = $CompanyFundId;
						$this->CompanyFund->set(['amount'=>$updated_amount]);
						if($this->CompanyFund->save()) {
							echo "SAVE COMPANY FUND";
							$this->loadModel('CompanyFundLog');
							$DS_CompanyFundLog = $this->CompanyFundLog->getDataSource();
							$DS_CompanyFundLog->begin();
							
							$company_fund_log = ['source'=>'pettycash',
												 'amount'=>$released_amount,
												 'process'=>'debit',
												 'payment_request_id'=>$payment_request_id,
												 'user_id'=>$userin];
							
							$this->CompanyFundLog->create();
							$this->CompanyFundLog->set($company_fund_log);
							if($this->CompanyFundLog->save()) {
								echo "CompanyFundLog saved";
								$DS_CompanyFund->commit();
								$DS_CompanyFundLog->commit();
								$DS_PaymentRequestLog->commit();
								$DS_PaymentRequest->commit();
							}
							else {
								echo "ERROR IN COMPANY FUND LOG";
								$DS_CompanyFund->rollback();
								$DS_CompanyFundLog->rollback();
								$DS_PaymentRequestLog->rollback();
								$DS_PaymentRequest->rollback();
							}
						}
						else {
							echo "ERROR IN COMPANY FUND";
							$DS_CompanyFund->rollback();
						}
					}
					else {
						$DS_PaymentRequestLog->rollback();
						$DS_PaymentRequest->rollback();
					}
				}
				else {
					$DS_PaymentRequestLog->commit();
					$DS_PaymentRequest->commit();
				}
				// END OF COMPANY FUND LOG MODIFICATION
				// ===============================================================>
			}
			else {
				$DS_PaymentRequest->rollback();
			}
		}
		else {
			$DS_PaymentRequest->rollback();
		}
		
		return json_encode($data_payment_request);
	}
	
	public function action() {
		$this->autoRender = false;
		$data = $this->request->data;
		$id = $data['id'];
		$action = $data['action'];
		$supplier_id = $data['supplier_id'];
		$userin = $this->Auth->user('id');
		
		$dateTodayVerified = date("Y-m-d H:i:s");

		echo "PO ID".$supplier_id;
		
		$this->loadModel('PaymentRequest');
		$this->loadModel('PaymentRequestLog');
		
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$this->PaymentRequest->id = $id;
		$this->PaymentRequest->set(['status'=>$action, 'verified_date'=>$dateTodayVerified]);
		
		if($this->PaymentRequest->save()) {
			$DS_PaymentRequestLog = $this->PaymentRequestLog->getDataSource();
			$DS_PaymentRequestLog->begin();
			
			$this->PaymentRequestLog->create();
			$this->PaymentRequestLog->set(['payment_request_id'=>$id,
										   'user_id'=>$userin,
										   'status'=>$action]);
			if($this->PaymentRequestLog->save()) {
				if($supplier_id!=0) {
					$this->loadModel('PurchaseOrder');
					$DS_PurchaseOrder = $this->PurchaseOrder->getDataSource();
					$DS_PurchaseOrder->begin();
					
					$this->PurchaseOrder->id = $supplier_id;
					$this->PurchaseOrder->set(['payment_request'=>0]);
					if($this->PurchaseOrder->save()) {
						$DS_PurchaseOrder->commit();
						$DS_PaymentRequestLog->commit();
						$DS_PaymentRequest->commit();
					}
					else {
						$DS_PurchaseOrder->rollback();
						$DS_PaymentRequestLog->rollback();
						$DS_PaymentRequest->rollback();
					}
				}
				else {
					$DS_PaymentRequestLog->commit();
					$DS_PaymentRequest->commit();
				}
			}
			else {
				$DS_PaymentRequest->rollback();
			}
		}
		else {
			$DS_PaymentRequest->rollback();
		}
		
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
				}
				else {
					echo json_encode("Error in PaymentRequestLog save");
					$payment_request_log_save[] = false;
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
		    $ret_p_rep = [];
			// echo json_encode($get_p_replenishement);
			if(!empty($get_p_replenishement)) {
				$ret_p_rep = $get_p_replenishement[0]['PaymentReplenishment'];
			}

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
		
		// pr($payment_replenishments);
		$this->set(compact('payment_replenishments', 'status'));
	}
	
	public function view_replenishments() {
		$id = $this->params['url']['id'];
		
		$this->loadModel('PaymentReplenishedDetail');
		$this->PaymentReplenishedDetail->recursive = 2;
		$payment_replenished_detail = $this->PaymentReplenishedDetail->find('all',
			['conditions'=>['PaymentReplenishedDetail.payment_replenishment_id'=>$id],
			 'fields'=>[
			 	'PaymentReplenishedDetail.created,
			 	PaymentRequest.id,
			 	PaymentRequest.returned_amount,
			 	PaymentRequest.reimbursed_amount,
			 	PaymentRequest.requested_amount,
			 	PaymentRequest.released_amount,
			 	PaymentRequest.purpose,
			 	PaymentReplenishment.acknowledged_date,
			 	PaymentReplenishment.user_id,
			 	PaymentReplenishedDetail.id']]);
		
		$this->loadModel('PaymentReplenishment');
		$this->PaymentReplenishment->recursive = -1;
		$payment_replenishment = $this->PaymentReplenishment->findById($id);
		
		$this->set(compact('id','payment_replenished_detail','payment_replenishment'));
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
		$id = $this->request->data;
		$today = date("Y-m-d H:i:s");
		
		$this->loadModel('PaymentReplenishedDetail');
		$get_payment_replenished_detail = $this->PaymentReplenishedDetail->findAllByPaymentReplenishmentId($id,
			['fields'=>'PaymentRequest.id, PaymentRequest.released_amount, PaymentReplenishment.amount']);
		// echo json_encode($get_payment_replenished_detail);
		$this->loadModel('PaymentRequest');
		$DS_PaymentRequest = $this->PaymentRequest->getDataSource();
		$DS_PaymentRequest->begin();
		
		$this->loadModel('CompanyFundLog');
		$DS_CompanyFundLog = $this->CompanyFundLog->getDataSource();
		$DS_CompanyFundLog->begin();

		$total_released_amount = 0;
		$isSavedAll = true;
		foreach($get_payment_replenished_detail as $return_payment_replenished_detail) {
			$payment_request_id = $return_payment_replenished_detail['PaymentRequest']['id'];
			$released_amount = $return_payment_replenished_detail['PaymentRequest']['released_amount'];
			$total_released_amount += $released_amount;
			$this->PaymentRequest->id = $payment_request_id;
			$this->PaymentRequest->set(['status'=>'closed']);
			
			if($this->PaymentRequest->save()) {
				echo "PaymentRequest saved\n";
				$company_fund_log_set = ['source'=>'pettycash',
										 'amount'=>$released_amount,
										 'process'=>'credit',
										 'payment_request_id'=>$payment_request_id];
				$this->CompanyFundLog->create();
				$this->CompanyFundLog->set($company_fund_log_set);
				if($this->CompanyFundLog->save()) {
					echo "CompanyFundLog saved\n";
				}
				else {
					$isSavedAll = false;
				}
			}
			else {
				$isSavedAll = false;
			}
		}
		
		echo $total_released_amount;
		if($isSavedAll) {
			echo "PaymentRequest AND CompanyFundLog committed\n";
			
			$this->loadModel('PaymentReplenishment');
			$DS_PaymentReplenishment = $this->PaymentReplenishment->getDataSource();
			
			$data_payment_replenishment = ['acknowledged_date'=>$today];
			$DS_PaymentReplenishment->begin();
			$this->PaymentReplenishment->id = $id;
			$this->PaymentReplenishment->set($data_payment_replenishment);
			
			if($this->PaymentReplenishment->save()) {
				echo "PaymentReplenishment saved";
				$DS_PaymentReplenishment->commit();
				$DS_CompanyFundLog->commit();
				$DS_PaymentRequest->commit();
			}
			else {
				$DS_PaymentReplenishment->rollback();
				echo "Error in acknowledging replenishment.";
			}
		}
		else {
			echo "ERROR IN PAYMENT REQUEST AND COMPANYFUND LOG\n";
			$DS_CompanyFundLog->rollback();
			$DS_PaymentRequest->rollback();
		}
		return "\nEverything Done";
	}
	
	public function valid() {
		$this->autoRender = false;
		$this->loadModel('PaymentInvoice');
		
		$piid = $this->request->data['id'];
		$valid = $this->request->data['valid'];

		$DS_PaymentInvoice = $this->PaymentInvoice->getDataSource();
		$DS_PaymentInvoice->begin();
		$this->PaymentInvoice->id = $piid;
		$this->PaymentInvoice->set(['valid_purchase'=>$valid]);
		if($this->PaymentInvoice->save()) {
			$DS_PaymentInvoice->commit();
			return json_encode("Valid saved");
			exit;
		}
		else {
			$DS_PaymentInvoice->rollback();
			return "Error in saving valid";
			exit;
		}
	}
	
	public function check($type = null){
		$this->count_pending_pr($type);
		exit;
	}
	
	public function user_id_to_payee_id() {
		// date('y/m/d', strtotime('+2 weeks', strtotime('10/10/10')));
		$getPaymentRequests = $this->PaymentRequest->find('all');
		foreach($getPaymentRequests as $retPaymentRequests)  {
			$PaymentRequest = $retPaymentRequests['PaymentRequest'];
			$PaymentRequest_id = $PaymentRequest['id'];
			$PaymentRequest_user_id = $PaymentRequest['user_id'];
			
			echo $PaymentRequest_id."_".$PaymentRequest_user_id;
		}
		
		return "Executed Everything!";
	}
}