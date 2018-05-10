<?php
App::uses('AppController', 'Controller');
/**
 * TempProductProperties Controller
 *
 * @property TempProductProperty $TempProductProperty
 * @property PaginatorComponent $Paginator
 */
class TempProductPropertiesController extends AppController {

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
		$this->TempProductProperty->recursive = 0;
		$this->set('tempProductProperties', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TempProductProperty->exists($id)) {
			throw new NotFoundException(__('Invalid temp product property'));
		}
		$options = array('conditions' => array('TempProductProperty.' . $this->TempProductProperty->primaryKey => $id));
		$this->set('tempProductProperty', $this->TempProductProperty->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TempProductProperty->create();
			if ($this->TempProductProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The temp product property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The temp product property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$tempProducts = $this->TempProductProperty->TempProduct->find('list');
		$this->set(compact('tempProducts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TempProductProperty->exists($id)) {
			throw new NotFoundException(__('Invalid temp product property'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TempProductProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The temp product property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The temp product property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('TempProductProperty.' . $this->TempProductProperty->primaryKey => $id));
			$this->request->data = $this->TempProductProperty->find('first', $options);
		}
		$tempProducts = $this->TempProductProperty->TempProduct->find('list');
		$this->set(compact('tempProducts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TempProductProperty->id = $id;
		if (!$this->TempProductProperty->exists()) {
			throw new NotFoundException(__('Invalid temp product property'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TempProductProperty->delete()) {
			$this->Session->setFlash(__('The temp product property has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The temp product property could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
