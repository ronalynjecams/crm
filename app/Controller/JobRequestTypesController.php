<?php
App::uses('AppController', 'Controller');
/**
 * JobRequestTypes Controller
 *
 * @property JobRequestType $JobRequestType
 * @property PaginatorComponent $Paginator
 */
class JobRequestTypesController extends AppController {

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
		$this->JobRequestType->recursive = 0;
		$this->set('jobRequestTypes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JobRequestType->exists($id)) {
			throw new NotFoundException(__('Invalid job request type'));
		}
		$options = array('conditions' => array('JobRequestType.' . $this->JobRequestType->primaryKey => $id));
		$this->set('jobRequestType', $this->JobRequestType->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JobRequestType->create();
			if ($this->JobRequestType->save($this->request->data)) {
				$this->Session->setFlash(__('The job request type has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job request type could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JobRequestType->exists($id)) {
			throw new NotFoundException(__('Invalid job request type'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JobRequestType->save($this->request->data)) {
				$this->Session->setFlash(__('The job request type has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The job request type could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('JobRequestType.' . $this->JobRequestType->primaryKey => $id));
			$this->request->data = $this->JobRequestType->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JobRequestType->id = $id;
		if (!$this->JobRequestType->exists()) {
			throw new NotFoundException(__('Invalid job request type'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JobRequestType->delete()) {
			$this->Session->setFlash(__('The job request type has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The job request type could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
