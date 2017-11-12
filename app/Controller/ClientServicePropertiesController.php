<?php
App::uses('AppController', 'Controller');
/**
 * ClientServiceProperties Controller
 *
 * @property ClientServiceProperty $ClientServiceProperty
 * @property PaginatorComponent $Paginator
 */
class ClientServicePropertiesController extends AppController {

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
		$this->ClientServiceProperty->recursive = 0;
		$this->set('clientServiceProperties', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ClientServiceProperty->exists($id)) {
			throw new NotFoundException(__('Invalid client service property'));
		}
		$options = array('conditions' => array('ClientServiceProperty.' . $this->ClientServiceProperty->primaryKey => $id));
		$this->set('clientServiceProperty', $this->ClientServiceProperty->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ClientServiceProperty->create();
			if ($this->ClientServiceProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The client service property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client service property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$clientServiceProducts = $this->ClientServiceProperty->ClientServiceProduct->find('list');
		$this->set(compact('clientServiceProducts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ClientServiceProperty->exists($id)) {
			throw new NotFoundException(__('Invalid client service property'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ClientServiceProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The client service property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client service property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ClientServiceProperty.' . $this->ClientServiceProperty->primaryKey => $id));
			$this->request->data = $this->ClientServiceProperty->find('first', $options);
		}
		$clientServiceProducts = $this->ClientServiceProperty->ClientServiceProduct->find('list');
		$this->set(compact('clientServiceProducts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ClientServiceProperty->id = $id;
		if (!$this->ClientServiceProperty->exists()) {
			throw new NotFoundException(__('Invalid client service property'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ClientServiceProperty->delete()) {
			$this->Session->setFlash(__('The client service property has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The client service property could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
