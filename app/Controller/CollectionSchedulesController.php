<?php
App::uses('AppController', 'Controller');
/**
 * CollectionSchedules Controller
 *
 * @property CollectionSchedule $CollectionSchedule
 * @property PaginatorComponent $Paginator
 */
class CollectionSchedulesController extends AppController {

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
		$this->CollectionSchedule->recursive = 0;
		$this->set('collectionSchedules', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CollectionSchedule->exists($id)) {
			throw new NotFoundException(__('Invalid collection schedule'));
		}
		$options = array('conditions' => array('CollectionSchedule.' . $this->CollectionSchedule->primaryKey => $id));
		$this->set('collectionSchedule', $this->CollectionSchedule->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CollectionSchedule->create();
			if ($this->CollectionSchedule->save($this->request->data)) {
				$this->Session->setFlash(__('The collection schedule has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection schedule could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$quotations = $this->CollectionSchedule->Quotation->find('list');
		$collections = $this->CollectionSchedule->Collection->find('list');
		$users = $this->CollectionSchedule->User->find('list');
		$this->set(compact('quotations', 'collections', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->CollectionSchedule->exists($id)) {
			throw new NotFoundException(__('Invalid collection schedule'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CollectionSchedule->save($this->request->data)) {
				$this->Session->setFlash(__('The collection schedule has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection schedule could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CollectionSchedule.' . $this->CollectionSchedule->primaryKey => $id));
			$this->request->data = $this->CollectionSchedule->find('first', $options);
		}
		$quotations = $this->CollectionSchedule->Quotation->find('list');
		$collections = $this->CollectionSchedule->Collection->find('list');
		$users = $this->CollectionSchedule->User->find('list');
		$this->set(compact('quotations', 'collections', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->CollectionSchedule->id = $id;
		if (!$this->CollectionSchedule->exists()) {
			throw new NotFoundException(__('Invalid collection schedule'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CollectionSchedule->delete()) {
			$this->Session->setFlash(__('The collection schedule has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The collection schedule could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function agent_move(){
             $id = $this->params['url']['id'];
        $this->loadModel('Bank');
        $this->loadModel('QuotationTerm');
        $this->loadModel('Quotation');
        $quote_data = $this->Quotation->findById($id);
        $quote_number = $quote_data['Quotation']['quote_number'];
        $this->set(compact('quote_data'));

        $this->loadModel('Client');
        $clients = $this->Client->find('all', array(
            'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Client.lead' => 0)
        ));


        $banks = $this->Bank->find('all');
        $terms = $this->QuotationTerm->find('all',array(
            'conditions'=>array('QuotationTerm.id !='=>2)
        ));
        $this->set(compact('clients', 'quote_number', 'banks', 'terms'));
        }
        
        public function agent_move_process(){
            
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $this->loadModel('Quotation');
        $this->loadModel('Client');
        $time  = date("H:i:s", strtotime($data['collection_date_time']));
        $collection_date = $data['collection_date'].' '.$time;

        $this->CollectionSchedule->create();
        $this->CollectionSchedule->set(array( 
           'created_by' =>$this->Auth->user('id'), 
           'agent_instruction' =>$data['agent_instruction'], 
           'collection_date' =>$collection_date, 
            'status' => 'for_collection',
            'quotation_id'=>$data['quotation_id'], 
        ));
        $this->CollectionSchedule->save();
             
        $this->Client->id = $data['client_id'];
        $this->Client->set(array(
            'tin_number' => $data['tin_number']
        ));
        $this->Client->save();
        
        $dateToday = date("Y-m-d H:i:s");
        $quotation_id = $data['quotation_id'];
        $this->Quotation->id = $quotation_id;
        $this->Quotation->set(array(
            'status' => 'approved',
            'vat_type' => $data['vat_type'],
            'quotation_term_id' => $data['term_id'],
            'delivery_mode' => $data['delivery_mode'],
            'target_delivery' => $data['target_delivery'],
            'date_moved' => $dateToday,
        ));
        $this->Quotation->save();
        echo json_encode($data);
        }
        
        public function agent(){
             $id = $this->params['url']['id']; 
        $this->loadModel('Quotation');
        $quote_data = $this->Quotation->findById($id);
        $quote_number = $quote_data['Quotation']['quote_number'];
        $this->set(compact('quote_data'));

        $this->loadModel('Client');
        $clients = $this->Client->find('all', array(
            'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Client.lead' => 0)
        ));
  
        $this->set(compact('clients'));
        }
        
        public function agent_process(){
            
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data;
        $this->loadModel('Quotation');
        $this->loadModel('Client');
        $time  = date("H:i:s", strtotime($data['collection_date_time']));
        $collection_date = $data['collection_date'].' '.$time;

        $this->CollectionSchedule->create();
        $this->CollectionSchedule->set(array( 
           'created_by' =>$this->Auth->user('id'), 
           'agent_instruction' =>$data['agent_instruction'], 
           'collection_date' =>$collection_date, 
            'status' => 'for_collection',
            'quotation_id'=>$data['quotation_id'], 
            
        ));
        $this->CollectionSchedule->save();
        
        echo json_encode($data['quotation_id']);
        }
        
        public function list_view(){
            $this->loadModel('Users');
            
            $this->CollectionSchedule->recursive = 2;
            $status = $this->params['url']['status'];
            $options = array('conditions' => array('CollectionSchedule.status' => $status ),
                             'contain' => "");
            $lists = $this->CollectionSchedule->find('all', $options );
//            pr($lists); exit;
            $collectors = $this->Users->find('all');
//            pr($collectors); exit;
            $this->set(compact('lists', 'collectors'));
        }
}
