<?php
App::uses('AppController', 'Controller');
/**
 * Collections Controller
 *
 * @property Collection $Collection
 * @property PaginatorComponent $Paginator
 */
class CollectionsController extends AppController {

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
		$this->Collection->recursive = 0;
		$this->set('collections', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Collection->exists($id)) {
			throw new NotFoundException(__('Invalid collection'));
		}
		$options = array('conditions' => array('Collection.' . $this->Collection->primaryKey => $id));
		$this->set('collection', $this->Collection->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Collection->create();
			if ($this->Collection->save($this->request->data)) {
				$this->Session->setFlash(__('The collection has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$quotations = $this->Collection->Quotation->find('list');
		$users = $this->Collection->User->find('list');
		$banks = $this->Collection->Bank->find('list');
		$this->set(compact('quotations', 'users', 'banks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Collection->exists($id)) {
			throw new NotFoundException(__('Invalid collection'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Collection->save($this->request->data)) {
				$this->Session->setFlash(__('The collection has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The collection could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Collection.' . $this->Collection->primaryKey => $id));
			$this->request->data = $this->Collection->find('first', $options);
		}
		$quotations = $this->Collection->Quotation->find('list');
		$users = $this->Collection->User->find('list');
		$banks = $this->Collection->Bank->find('list');
		$this->set(compact('quotations', 'users', 'banks'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Collection->id = $id;
		if (!$this->Collection->exists()) {
			throw new NotFoundException(__('Invalid collection'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Collection->delete()) {
			$this->Session->setFlash(__('The collection has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The collection could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        
    public function collect(){
        
        $id = $this->params['url']['id'];
        $this->loadModel('Bank');
        $this->loadModel('Quotation');
        $this->loadModel('QuotationTerm');
        $quote_data = $this->Quotation->findById($id);
        $quote_number = $quote_data['Quotation']['quote_number'];
        $this->set(compact('quote_data'));
        
//        pr($quote_data);
        
        
        $collection_data = $this->Collection->findAllByQuotationId($id);
        
//        $collection_data = $this->Collection->find('all',['conditions'=>['Collection.status'=>'verified']]);
        $this->set(compact('collection_data'));

        $this->loadModel('Client');
        $clients = $this->Client->find('all', array(
            'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Client.lead' => 0)
        ));


        $banks = $this->Bank->find('all');
        $terms = $this->QuotationTerm->find('all', array(
            'conditions' => array('QuotationTerm.id >=' => 3)
        ));
        $this->set(compact('clients', 'quote_number', 'banks', 'terms','id'));
    
    }
    
    public function viodPayment(){
        
        $this->autoRender = false;
        $this->response->type('json');
        $data = $this->request->data; 
        $id = $data['id'];
        $status = $data['status'];
        
        $this->Collection->id = $id;
        $this->Collection->set(array(
            'status' => $status
        ));
        if ($this->Collection->save()) {
            echo json_encode($data);
        }
    }
    
    public function accounting(){
        $status = $this->params['url']['status'];
        
        if($status == 'pending'){
            
        }else if($status == 'for_collection'){
            
        }else if($status == 'full'){
            
        }
    }
        
}
