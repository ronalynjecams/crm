<?php
App::uses('AppController', 'Controller');
/**
 * JobRequestRevisions Controller
 *
 * @property JobRequestRevision $JobRequestRevision
 * @property PaginatorComponent $Paginator
 */
class JobRequestRevisionsController extends AppController {

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
		$this->JobRequestRevision->recursive = 0;
		$this->set('jobRequestRevisions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JobRequestRevision->exists($id)) {
			throw new NotFoundException(__('Invalid job request revision'));
		}
		$options = array('conditions' => array('JobRequestRevision.' . $this->JobRequestRevision->primaryKey => $id));
		$this->set('jobRequestRevision', $this->JobRequestRevision->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JobRequestRevision->create();
			if ($this->JobRequestRevision->save($this->request->data)) {
				$this->Session->setFlash(__('The job request revision has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job request revision could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$jobRequestProducts = $this->JobRequestRevision->JobRequestProduct->find('list');
		$jobRequestTypes = $this->JobRequestRevision->JobRequestType->find('list');
		$products = $this->JobRequestRevision->Product->find('list');
		$this->set(compact('jobRequestProducts', 'jobRequestTypes', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JobRequestRevision->exists($id)) {
			throw new NotFoundException(__('Invalid job request revision'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JobRequestRevision->save($this->request->data)) {
				$this->Session->setFlash(__('The job request revision has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job request revision could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('JobRequestRevision.' . $this->JobRequestRevision->primaryKey => $id));
			$this->request->data = $this->JobRequestRevision->find('first', $options);
		}
		$jobRequestProducts = $this->JobRequestRevision->JobRequestProduct->find('list');
		$jobRequestTypes = $this->JobRequestRevision->JobRequestType->find('list');
		$products = $this->JobRequestRevision->Product->find('list');
		$this->set(compact('jobRequestProducts', 'jobRequestTypes', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JobRequestRevision->id = $id;
		if (!$this->JobRequestRevision->exists()) {
			throw new NotFoundException(__('Invalid job request revision'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JobRequestRevision->delete()) {
			$this->Session->setFlash(__('The job request revision has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The job request revision could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
    public function view_list(){ 
    	// exit;
        $this->loadModel('JobRequest');
        $this->loadModel('JobRequestProduct');
        $this->loadModel('QuotationProductProperty');
        $this->loadModel('JobRequestFloorplan');
        $id = $this->params['url']['id'];
        $job_request_type = $this->params['url']['type'];
        $role = $this->Auth->user('role');
        $my_id = $this->Auth->user('id');
        
        // NOTE: 
        // jrp == job request product ,
        // fp == floorplan
	         
        if($job_request_type == 'jrp'){ 
        	
	    	$getJRRevisions = $this->JobRequestRevision->find('all',[
	    		'conditions'=>['JobRequestRevision.job_request_product_id' => $id],
	    		'order'=>['JobRequestRevision.deadline_date ASC']
	    		]);  
	    		
        	$jr_label = 'Product Details';
	        $getJRProduct = $this->JobRequestProduct->findById($id); 
	        $quotation_product_id = $getJRProduct['JobRequestProduct']['quotation_product_id']; 
	        
	        $this->QuotationProductProperty->recursive = -1;
	    	 $getQuotationProductProperties = $this->QuotationProductProperty->findAllByQuotationProductId($quotation_product_id); 
	    	 
        }else{
        	
	    	$getJRRevisions = $this->JobRequestRevision->find('all',[
	    		'conditions'=>['JobRequestRevision.job_request_floorplan_id' => $id],
	    		'order'=>['JobRequestRevision.deadline_date ASC']
	    		]);  
        	$jr_label = 'Floor Plan Details'; 
        	$getFloorPlan = $this->JobRequestFloorplan->findById($id);  
        	
        }
	        
	    // MAE: MODIFICATION
	    // ===================================================================>
	    $this->loadModel('User');
	    $Designers = $this->User->find('all',
	    	['conditions'=>['role'=>['designer', 'design_head']]]);
	    // ===================================================================>
	    // END OF MAE: MODIFICATION
    	
        $this->set(compact('getJRProduct','jr_label','job_request_type',
        				   'getQuotationProductProperties','getJRRevisions',
        				   'role','getFloorPlan','smy_id', 'Designers'));
    }
}