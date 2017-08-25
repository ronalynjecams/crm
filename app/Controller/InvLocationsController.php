<?php
App::uses('AppController', 'Controller');
/**
 * InvLocations Controller
 *
 * @property InvLocation $InvLocation
 * @property PaginatorComponent $Paginator
 */
class InvLocationsController extends AppController {

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
		$this->InvLocation->recursive = 0;
		$this->set('invLocations', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InvLocation->exists($id)) {
			throw new NotFoundException(__('Invalid inv location'));
		}
		$options = array('conditions' => array('InvLocation.' . $this->InvLocation->primaryKey => $id));
		$this->set('invLocation', $this->InvLocation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InvLocation->create();
			if ($this->InvLocation->save($this->request->data)) {
				$this->Session->setFlash(__('The inv location has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inv location could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->InvLocation->exists($id)) {
			throw new NotFoundException(__('Invalid inv location'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InvLocation->save($this->request->data)) {
				$this->Session->setFlash(__('The inv location has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inv location could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('InvLocation.' . $this->InvLocation->primaryKey => $id));
			$this->request->data = $this->InvLocation->find('first', $options);
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
		$this->InvLocation->id = $id;
		if (!$this->InvLocation->exists()) {
			throw new NotFoundException(__('Invalid inv location'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->InvLocation->delete()) {
			$this->Session->setFlash(__('The inv location has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The inv location could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
