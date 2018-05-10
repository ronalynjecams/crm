<?php
App::uses('AppController', 'Controller');
/**
 * JobRequestLogs Controller
 *
 * @property JobRequestLog $JobRequestLog
 * @property PaginatorComponent $Paginator
 */
class JobRequestLogsController extends AppController {

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
		$this->JobRequestLog->recursive = 0;
		$this->set('jobRequestLogs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JobRequestLog->exists($id)) {
			throw new NotFoundException(__('Invalid job request log'));
		}
		$options = array('conditions' => array('JobRequestLog.' . $this->JobRequestLog->primaryKey => $id));
		$this->set('jobRequestLog', $this->JobRequestLog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JobRequestLog->create();
			if ($this->JobRequestLog->save($this->request->data)) {
				$this->Session->setFlash(__('The job request log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job request log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->JobRequestLog->User->find('list');
		$jobRequests = $this->JobRequestLog->JobRequest->find('list');
		$jobRequestProducts = $this->JobRequestLog->JobRequestProduct->find('list');
		$jobRequestAssignments = $this->JobRequestLog->JobRequestAssignment->find('list');
		$quotationProducts = $this->JobRequestLog->QuotationProduct->find('list');
		$jobRequestRevisions = $this->JobRequestLog->JobRequestRevision->find('list');
		$this->set(compact('users', 'jobRequests', 'jobRequestProducts', 'jobRequestAssignments', 'quotationProducts', 'jobRequestRevisions'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JobRequestLog->exists($id)) {
			throw new NotFoundException(__('Invalid job request log'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JobRequestLog->save($this->request->data)) {
				$this->Session->setFlash(__('The job request log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job request log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('JobRequestLog.' . $this->JobRequestLog->primaryKey => $id));
			$this->request->data = $this->JobRequestLog->find('first', $options);
		}
		$users = $this->JobRequestLog->User->find('list');
		$jobRequests = $this->JobRequestLog->JobRequest->find('list');
		$jobRequestProducts = $this->JobRequestLog->JobRequestProduct->find('list');
		$jobRequestAssignments = $this->JobRequestLog->JobRequestAssignment->find('list');
		$quotationProducts = $this->JobRequestLog->QuotationProduct->find('list');
		$jobRequestRevisions = $this->JobRequestLog->JobRequestRevision->find('list');
		$this->set(compact('users', 'jobRequests', 'jobRequestProducts', 'jobRequestAssignments', 'quotationProducts', 'jobRequestRevisions'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JobRequestLog->id = $id;
		if (!$this->JobRequestLog->exists()) {
			throw new NotFoundException(__('Invalid job request log'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JobRequestLog->delete()) {
			$this->Session->setFlash(__('The job request log has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The job request log could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
