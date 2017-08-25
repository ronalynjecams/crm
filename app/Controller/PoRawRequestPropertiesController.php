<?php
App::uses('AppController', 'Controller');
/**
 * PoRawRequestProperties Controller
 *
 * @property PoRawRequestProperty $PoRawRequestProperty
 * @property PaginatorComponent $Paginator
 */
class PoRawRequestPropertiesController extends AppController {

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
		$this->PoRawRequestProperty->recursive = 0;
		$this->set('poRawRequestProperties', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PoRawRequestProperty->exists($id)) {
			throw new NotFoundException(__('Invalid po raw request property'));
		}
		$options = array('conditions' => array('PoRawRequestProperty.' . $this->PoRawRequestProperty->primaryKey => $id));
		$this->set('poRawRequestProperty', $this->PoRawRequestProperty->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PoRawRequestProperty->create();
			if ($this->PoRawRequestProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The po raw request property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The po raw request property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$poRawRequests = $this->PoRawRequestProperty->PoRawRequest->find('list');
		$this->set(compact('poRawRequests'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PoRawRequestProperty->exists($id)) {
			throw new NotFoundException(__('Invalid po raw request property'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PoRawRequestProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The po raw request property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The po raw request property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PoRawRequestProperty.' . $this->PoRawRequestProperty->primaryKey => $id));
			$this->request->data = $this->PoRawRequestProperty->find('first', $options);
		}
		$poRawRequests = $this->PoRawRequestProperty->PoRawRequest->find('list');
		$this->set(compact('poRawRequests'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PoRawRequestProperty->id = $id;
		if (!$this->PoRawRequestProperty->exists()) {
			throw new NotFoundException(__('Invalid po raw request property'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PoRawRequestProperty->delete()) {
			$this->Session->setFlash(__('The po raw request property has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The po raw request property could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
