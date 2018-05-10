<?php
App::uses('AppController', 'Controller');
/**
 * TempProductValues Controller
 *
 * @property TempProductValue $TempProductValue
 * @property PaginatorComponent $Paginator
 */
class TempProductValuesController extends AppController {

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
		$this->TempProductValue->recursive = 0;
		$this->set('tempProductValues', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TempProductValue->exists($id)) {
			throw new NotFoundException(__('Invalid temp product value'));
		}
		$options = array('conditions' => array('TempProductValue.' . $this->TempProductValue->primaryKey => $id));
		$this->set('tempProductValue', $this->TempProductValue->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TempProductValue->create();
			if ($this->TempProductValue->save($this->request->data)) {
				$this->Session->setFlash(__('The temp product value has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The temp product value could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$tempProductProperties = $this->TempProductValue->TempProductProperty->find('list');
		$this->set(compact('tempProductProperties'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TempProductValue->exists($id)) {
			throw new NotFoundException(__('Invalid temp product value'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TempProductValue->save($this->request->data)) {
				$this->Session->setFlash(__('The temp product value has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The temp product value could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('TempProductValue.' . $this->TempProductValue->primaryKey => $id));
			$this->request->data = $this->TempProductValue->find('first', $options);
		}
		$tempProductProperties = $this->TempProductValue->TempProductProperty->find('list');
		$this->set(compact('tempProductProperties'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TempProductValue->id = $id;
		if (!$this->TempProductValue->exists()) {
			throw new NotFoundException(__('Invalid temp product value'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TempProductValue->delete()) {
			$this->Session->setFlash(__('The temp product value has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The temp product value could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
