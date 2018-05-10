<?php
App::uses('AppController', 'Controller');
/**
 * StatementOfAccounts Controller
 *
 * @property StatementOfAccount $StatementOfAccount
 * @property PaginatorComponent $Paginator
 */
class StatementOfAccountsController extends AppController {

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
		$this->StatementOfAccount->recursive = 0;
		$this->set('statementOfAccounts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->StatementOfAccount->exists($id)) {
			throw new NotFoundException(__('Invalid statement of account'));
		}
		$options = array('conditions' => array('StatementOfAccount.' . $this->StatementOfAccount->primaryKey => $id));
		$this->set('statementOfAccount', $this->StatementOfAccount->find('first', $options));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->StatementOfAccount->exists($id)) {
			throw new NotFoundException(__('Invalid statement of account'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->StatementOfAccount->save($this->request->data)) {
				$this->Session->setFlash(__('The statement of account has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The statement of account could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('StatementOfAccount.' . $this->StatementOfAccount->primaryKey => $id));
			$this->request->data = $this->StatementOfAccount->find('first', $options);
		}
		$quotations = $this->StatementOfAccount->Quotation->find('list');
		$users = $this->StatementOfAccount->User->find('list');
		$this->set(compact('quotations', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->StatementOfAccount->id = $id;
		if (!$this->StatementOfAccount->exists()) {
			throw new NotFoundException(__('Invalid statement of account'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->StatementOfAccount->delete()) {
			$this->Session->setFlash(__('The statement of account has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The statement of account could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function all_list() {
		$this->loadModel('Client');
		
		$soas = $this->StatementOfAccount->find('all');
		$agentnames=[];
		foreach($soas as $soa) {
			$client_id = $soa['StatementOfAccount']['client_id'];
			$getClient = $this->Client->findById($client_id);
			$agentnames[$client_id] = $getClient['User']['first_name']." ".$getClient['User']['last_name'];
		}
		
		$this->set(compact('soas', 'agentnames'));
	}
	
	public function quotation_list() {
		$client_id = $this->params['url']['id'];
		
		$this->loadModel('Client');
		$this->loadModel('StatementOfAccount');
		
		$this->Client->recursive = 2;
		$client = $this->Client->findById($client_id, ['name', 'user_id', 'User.id', 'User.first_name', 'User.last_name']);
		$client_name = $client['Client']['name'];
		$agent = "";
		if(!empty($client['User'])) {
    		$agent = ucwords("[".$client['User']['first_name']." ".$client['User']['last_name']."]");
		}
		$this->set(compact('client_name', 'agent'));
		
		
		$this->StatementOfAccount->recursive = 1;
		$soas =  $this->StatementOfAccount->find('all', ['conditions'=>
				['StatementOfAccount.client_id'=>$client_id]]);
		$this->set(compact('soas'));
	}
	
	public function add() {
		$this->autoRender = false;
		
		$quotation_id = $this->request->data['id'];
		echo json_encode($quotation_id);
		
		$this->loadModel('Quotation');
		$this->loadModel('Collection');
		$this->loadModel('StatementOfAccount');
		
		$dateToday = date("Hymds");
        $milliseconds = round(microtime(true) * 1000);
        $newstring = substr($milliseconds, -3);
        $soa_number = 'JEC-SOA' . $dateToday;
        
        $this->Quotation->recursive = -1;
        $quotations = $this->Quotation->findById($quotation_id);
        $quotation = $quotations['Quotation'];
        
        $client_id = $quotation['client_id'];
        $contract_amount = $quotation['grand_total'];
        
        $this->Collection->recursive = -1;
        $collections_with_held = $this->Collection->find('all', ['conditions'=>
        								['quotation_id'=>$quotation_id],
        								['fields'=>['with_held']]]);
        $with_held_amount = 0;
		foreach($collections_with_held as $collection) {
			$with_held_amount += $collection['Collection']['with_held'];
		}
		
		$this->Collection->recursive = -1;
		$collections_collected_amount = $this->Collection->find('all',
									['conditions'=>
									['quotation_id'=>$quotation_id,
									 'status'=>'verified'],
									['fields'=>['amount_paid',
									            'with_held',
									            'other_anount']]]);
        $amount_paid = 0;
        $with_held = 0;
        $other_amount = 0;
        foreach($collections_collected_amount as $collection_collected_amount) {
        	$collection_ca = $collection_collected_amount['Collection'];
        	$amount_paid += $collection_ca['amount_paid'];
			$with_held += $collection_ca['with_held'];
			$other_amount += $collection_ca['other_amount'];	
        }
		
		$collected_amount = $amount_paid+$with_held+$other_amount;
		$balance = $quotation['grand_total'] - $collected_amount;
		
		$user_id = $this->Auth->user('id');
		$set = ['quotation_id'=>intval($quotation_id),
				'client_id'=>intval($client_id),
				'contract_amount'=>floatval($contract_amount),
				'collected_amount'=>floatval($collected_amount),
				'with_held_amount'=>floatval($with_held_amount),
				'balance'=>floatval($balance),
				'user_id'=>intval($user_id)];
		$final_set = ['soa_number'=>$soa_number]+$set;
		
		$this->StatementOfAccount->recursive = -1;
		$soas = $this->StatementOfAccount->find('all', ['conditions'=>
												['quotation_id'=>$quotation_id]]);
		$existing_soa_array = [];
		foreach($soas as $soa) {
			$existing_soa = $soa['StatementOfAccount'];
			$soa_quotation_id = intval($existing_soa['quotation_id']);
			$soa_client_id = intval($existing_soa['client_id']);
			$soa_contract_amount = floatval($existing_soa['contract_amount']);
			$soa_collected_amount = floatval($existing_soa['collected_amount']);
			$soa_with_held_amount = floatval($existing_soa['with_held_amount']);
			$soa_balance = floatval($existing_soa['balance']);
			$soa_user_id = intval($existing_soa['user_id']);
			
			$existing_soa_array[] = ['quotation_id'=>$soa_quotation_id,
								   'client_id'=>$soa_client_id,
								   'contract_amount'=>$soa_contract_amount,
								   'collected_amount'=>$soa_collected_amount,
								   'with_held_amount'=>$soa_with_held_amount,
								   'balance'=>$soa_balance,
								   'user_id'=>$soa_user_id];
		}
		
			
		$check_existing = [false];
		foreach($existing_soa_array as $each_existing_soa) {
			echo "\nexisting_soa_array:";
			echo json_encode($existing_soa_array[0]);
			echo "\nset";
			echo json_encode($set);
			if($set === $each_existing_soa) {
				$check_existing[] = true;
			}
			else {
				$check_existing[] = false;
			}
		}
		
		echo json_encode($check_existing);
		if(in_array(true, $check_existing, true)) {
			$this->Session->setFlash('Statement of Accounts already exists.',
							'default', array('class' => 'alert alert-danger'), 'alertforexisting');
			return json_encode("exists");
		}
		else {
			$DS_SOA = $this->StatementOfAccount->getDataSource();
			$DS_SOA->begin();
			
			$this->StatementOfAccount->create();
			$this->StatementOfAccount->set($final_set);
			if($this->StatementOfAccount->save()) {
				echo "\nSOA saved";
				$DS_SOA->commit();
			}
			else {
				echo "\nERROR in SOA\n";
				$DS_SOA->rollback();
			}
			return json_encode($final_set);
 		}
	}
	
	public function updateCollectionDue(){
		
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        
        $soa_id = $data['soa_id'];
        $collection_due = date('Y-m-d',strtotime($data['collection_due'])); 
        $this->StatementOfAccount->recursive = 0;
        $soa_detail = $this->StatementOfAccount->findById($soa_id);
         
         
         
        $this->Quotation->id = $soa_detail['StatementOfAccount']['quotation_id'];
        $this->Quotation->set(array(
        	'collection_due' => $collection_due, 
        ));
        if ($this->Quotation->save()) {
            	$this->StatementOfAccount->id = $soa_detail['StatementOfAccount']['id'];
            	$this->StatementOfAccount->set(array(
        			'collection_due' => $collection_due, 
            		));
        		if ($this->StatementOfAccount->save()) {
                	echo json_encode($data);
        		}else{
        			echo json_encode('error');
        		}
        }
	}
}