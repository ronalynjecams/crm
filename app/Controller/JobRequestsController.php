<?php
App::uses('AppController', 'Controller');
/**
 * JobRequests Controller
 *
 * @property JobRequest $JobRequest
 * @property PaginatorComponent $Paginator
 */
class JobRequestsController extends AppController {

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
		$this->JobRequest->recursive = 0;
		$this->set('jobRequests', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JobRequest->exists($id)) {
			throw new NotFoundException(__('Invalid job request'));
		}
		$options = array('conditions' => array('JobRequest.' . $this->JobRequest->primaryKey => $id));
		$this->set('jobRequest', $this->JobRequest->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JobRequest->create();
			if ($this->JobRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The job request has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job request could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$quotations = $this->JobRequest->Quotation->find('list');
		$this->set(compact('quotations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JobRequest->exists($id)) {
			throw new NotFoundException(__('Invalid job request'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JobRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The job request has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job request could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('JobRequest.' . $this->JobRequest->primaryKey => $id));
			$this->request->data = $this->JobRequest->find('first', $options);
		}
		$quotations = $this->JobRequest->Quotation->find('list');
		$this->set(compact('quotations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JobRequest->id = $id;
		if (!$this->JobRequest->exists()) {
			throw new NotFoundException(__('Invalid job request'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JobRequest->delete()) {
			$this->Session->setFlash(__('The job request has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The job request could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function saveNewJobRequest(){
            $this->autoRender = false;
            $data = $this->request->data; 
            $status = $data['status'];
            $quotation_id = $data['quotation_id']; 
            $jr_number = $data['jr_number']; 
            $this->loadModel('Quotation');
                $this->JobRequest->create();
                $this->JobRequest->set(array( 
                     'status' => $status,
                     'jr_number' => $jr_number,
                        ));
                if($this->JobRequest->save()){
                    $jr_id = $this->JobRequest->getLastInsertID();
                        $this->Quotation->id = $quotation_id;
                       $this->Quotation->set(array(
                           'job_request_id'=>$jr_id
                           ));
                       if($this->Quotation->save()){
                           echo json_encode($jr_id);
                         }
                }
               
                exit;  
             
        }
        
}
