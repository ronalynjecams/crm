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
		$this->loadModel('Bill');
		$this->loadModel('BillAccount');
		$this->loadModel('BillMonitoring');
		$this->loadModel('User');
		
		$this->BillMonitoring->recursive=3; //-1
		$monitorings = $this->BillMonitoring->find('all');
		// pr($monitorings);
	
		
		$this->Bill->recursive=2;
		$billaccounts = $this->BillAccount->Bill->find('all');
		// pr($billaccounts);
		
// 		$this->User->recursive=4;
		$users = $this->User->find('all');
		
		
// 		pr($monitorings); exit;
	// $jr_arr = [];
 //   	foreach($monitorings as $sel){ 
 //   		if(!in_array($sel['Bill']['id'], $jr_arr)){
 //   		array_push($jr_arr, $sel['Bill']['id']); 
 //   		pr($jr_arr);
 //   		}
 //   	}


	
		//  $this->BillMonitoring->recursive = 4;
		//  $mons = $this->BillMonitoring->find('all', array(
		//  						'joins' => array(array(
		//  							'table' => 'users',
  //                                 'alias' => 'PaidByUser',
  //                                'type' => 'INNER',
  //                                 'conditions' => array('BillMonitoring.paid_by = PaidByUser.id')))));
		// pr($mons);
	
		
		// MARK: OFFLINE MODIFICATION
		$this->loadModel('PaymentRequestCategory');
		$get_categories = $this->PaymentRequestCategory->find('all');
		
		$this->set(compact('monitorings', 'users', 'billaccounts', 'get_categories'));
		// MARK: END OF OFFLINE MODIFICATION
	}
	
	public function add_monitoring(){ 
		$this->autoRender = false;
        $data = $this->request->data;
        
        $bill_date_from = $data['datefrom'];
        $bill_date_to = $data['dateto'];
        $user_id = $this->Auth->user('id');
        $bill_id = $data['billaccount'];
        $category = $data['category'];
        $bill_amount = $data['billamount'];
        $bill_ref_no = $data['bill_ref_no'];
        $payment_mode = $data['payment_mode'];


      if($this->request->is('post')){
		// MARK: OFFLINE MODIFICATION
    	$DS_BillMonitoring = $this->BillMonitoring->getDataSource();
    	$DS_BillMonitoring->begin();
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
        	echo json_encode("BillMonitoring saved");
   			$this->loadModel('Bill');
        	$get_bill = $this->Bill->findById($bill_id);
        	$account_name = $get_bill['BillAccount']['name'];
        	$inv_location = $get_bill['InvLocation']['name'];
        	$ret_purpose = "Bill for ".$account_name." ".$inv_location;

        	// $this->loadModel('PaymentRequest');
        	// $DS_PaymentRequest = $this->PaymentRequest->getDataSource();
        	// $DS_PaymentRequest->begin();

        	// if($payment_mode != "online") {
            	// if($payment_mode == 'cash') {
            	// 	$payment_request_set = ['type'=>'cash',
            	// 							'payment_request_category_id'=>$category,
            	// 							'requested_amount'=>$bill_amount,
            	// 							'purpose'=>$ret_purpose,
            	// 							'user_id'=>$user_id,
            	// 							'status'=>'pending',
            	// 							'inserted_by'=>$user_id];
            	// }
            	// else {
            	// 	$payment_request_set = ['type'=>'cheque',
            	// 							'payment_request_category_id'=>$category,
            	// 							'requested_amount'=>$bill_amount,
            	// 							'purpose'=>$ret_purpose,
            	// 							'user_id'=>$user_id,
            	// 							'status'=>'pending',
            	// 							'inserted_by'=>$user_id];
            	// }

            	// $this->PaymentRequest->create();
            	// $this->PaymentRequest->set($payment_request_set);
            	// if($this->PaymentRequest->save()) {
            		// echo json_encode("Payment Request Saved");
     //       		$ins_payment_request_id = $this->PaymentRequest->getLastInsertId();
            		
     //       		$this->loadModel('PaymentRequestLog');
     //       		$DS_PaymentRequestLog = $this->PaymentRequestLog->getDataSource();

     //       		$payment_request_log_set = ['payment_request_id'=>$ins_payment_request_id,
     //       									'user_id'=>$user_id,
     //       									'status'=>'pending'];

     //       		$this->PaymentRequestLog->create();
					// $this->PaymentRequestLog->set($payment_request_log_set);
					// if($this->PaymentRequestLog->save()) {
					// 	echo json_encode("Payment Request Log saved");
					// 	$DS_PaymentRequestLog->commit();
	    //         		$DS_PaymentRequest->commit();
	    //         		$DS_BillMonitoring->commit();
	    //         	}
	    //         	else {
	    //         		echo json_encode("Error in PaymentRequestLog");
	    //         		$DS_PaymentRequestLog->rollback();
	    //         		$DS_PaymentRequest->rollback();
	    //         		$DS_BillMonitoring->rollback();
	    //         	}
            	// }
            	// else {
            	// 	echo json_encode("Error in PaymentRequest");
            	// 	$DS_PaymentRequest->rollback();
            	// 	$DS_BillMonitoring->rollback();
            	// }
         //   }
        	// else {
        		$DS_BillMonitoring->commit();
        	// }
        }
        else {
        	echo json_encode('Error in BillMonitoring');
        	$DS_BillMonitoring->rollback();
        }
        // MARK: END OF OFFLINE MODIFICATION
      }
      echo "Execution done.";
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
	
	public function check_print_monitoring(){
		
		$billFrom = $this->request->data['datefrom'];
		$billTo = $this->request->data['dateto'];
		
		$option['conditions'] = ['billing_date_from BETWEEN ? and ?' => [$billFrom, $billTo]];
		$this->BillMonitoring->recursive = -1;
		$bills = $this->BillMonitoring->find('all', $option);
		if($bills){
			echo "success";
		} else{
			echo "error";
		}
		exit;
		
	}
}