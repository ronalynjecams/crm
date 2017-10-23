<?php
App::uses('AppController', 'Controller');
/**
 * Bills Controller
 *
 * @property Bill $Bill
 * @property PaginatorComponent $Paginator
 */
class BillsController extends AppController {

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
		$this->Bill->recursive = 0;
		$this->set('bills', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Bill->exists($id)) {
			throw new NotFoundException(__('Invalid bill'));
		}
		$options = array('conditions' => array('Bill.' . $this->Bill->primaryKey => $id));
		$this->set('bill', $this->Bill->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Bill->create();
			if ($this->Bill->save($this->request->data)) {
				$this->Session->setFlash(__('The bill has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bill could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$billAccounts = $this->Bill->BillAccount->find('list');
		$invLocations = $this->Bill->InvLocation->find('list');
		$this->set(compact('billAccounts', 'invLocations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Bill->exists($id)) {
			throw new NotFoundException(__('Invalid bill'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Bill->save($this->request->data)) {
				$this->Session->setFlash(__('The bill has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bill could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Bill.' . $this->Bill->primaryKey => $id));
			$this->request->data = $this->Bill->find('first', $options);
		}
		$billAccounts = $this->Bill->BillAccount->find('list');
		$invLocations = $this->Bill->InvLocation->find('list');
		$this->set(compact('billAccounts', 'invLocations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Bill->id = $id;
		if (!$this->Bill->exists()) {
			throw new NotFoundException(__('Invalid bill'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Bill->delete()) {
			$this->Session->setFlash(__('The bill has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The bill could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function view_bills(){
		$bills = $this->Bill->find('all');
		$this->loadModel('InvLocation');
		$this->loadModel('BillAccount');
		$invs = $this->InvLocation->find('all');
		$billaccounts = $this->BillAccount->find('all');
		$this->set(compact('bills', 'invs', 'billaccounts'));
	
	}
	
	public function add_bills(){
		$this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
            
        $accountnumber = $data['accountnumber'];
        $billing_stat = $data['bill_stat'];
        $amount = $data['amount'];
        $payment_type = $data['payment_method'];
        $billaccount = $data['billaccount'];
        $location = $data['location'];
        
			if($this->request->is('post')){
			$this->Bill->create();
			$this->Bill->set(array(
                "account_number" => $accountnumber,
                "billing_status" => $billing_stat,
                "jecams_amount" => $amount,
                "payment_type" => $payment_type,
                "bill_account_id" => $billaccount,
                "inv_location_id" => $location
            ));
			if($this->Bill->save()){
				echo json_encode($this->request->data); 
			}
			

		}
	}
	
	public function update_bills(){
		
		$this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        
        $id = $data['id'];
        $accountnumber = $data['uaccountnumber'];
        $billing_stat = $data['ubill_stat'];
        $amount = $data['uamount'];
        $payment_type = $data['upayment_method'];
        $billaccount = $data['ubillaccount'];
        $location = $data['ulocation'];
        
        	$this->Bill->set(array(
        		"id" => $id,
                "account_number" => $accountnumber,
                "billing_status" => $billing_stat,
                "jecams_amount" => $amount,
                "payment_type" => $payment_type,
                "bill_account_id" => $billaccount,
                "inv_location_id" => $location
            ));
        
        
        if ($this->request->is(array('post', 'put'))) {

            if ($this->Bill->save($this->request->data)) {
                return (json_encode($this->request->data));
            } else {
                return (json_encode($this->request->data));
            }
        } else {
            return (json_encode());
        }
	}
	
	
}