<?php
App::uses('AppController', 'Controller');
/**
 * PoProductProperties Controller
 *
 * @property PoProductProperty $PoProductProperty
 * @property PaginatorComponent $Paginator
 */
class PoProductPropertiesController extends AppController {

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
		$this->PoProductProperty->recursive = 0;
		$this->set('poProductProperties', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PoProductProperty->exists($id)) {
			throw new NotFoundException(__('Invalid po product property'));
		}
		$options = array('conditions' => array('PoProductProperty.' . $this->PoProductProperty->primaryKey => $id));
		$this->set('poProductProperty', $this->PoProductProperty->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PoProductProperty->create();
			if ($this->PoProductProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The po product property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The po product property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$poProducts = $this->PoProductProperty->PoProduct->find('list');
		$this->set(compact('poProducts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PoProductProperty->exists($id)) {
			throw new NotFoundException(__('Invalid po product property'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PoProductProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The po product property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The po product property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PoProductProperty.' . $this->PoProductProperty->primaryKey => $id));
			$this->request->data = $this->PoProductProperty->find('first', $options);
		}
		$poProducts = $this->PoProductProperty->PoProduct->find('list');
		$this->set(compact('poProducts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PoProductProperty->id = $id;
		if (!$this->PoProductProperty->exists()) {
			throw new NotFoundException(__('Invalid po product property'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PoProductProperty->delete()) {
			$this->Session->setFlash(__('The po product property has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The po product property could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
