<?php
App::uses('AppController', 'Controller');
/**
 * ProductValues Controller
 *
 * @property ProductValue $ProductValue
 * @property PaginatorComponent $Paginator
 */
class ProductValuesController extends AppController {

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
		$this->ProductValue->recursive = 0;
		$this->set('productValues', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductValue->exists($id)) {
			throw new NotFoundException(__('Invalid product value'));
		}
		$options = array('conditions' => array('ProductValue.' . $this->ProductValue->primaryKey => $id));
		$this->set('productValue', $this->ProductValue->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductValue->create();
			if ($this->ProductValue->save($this->request->data)) {
				$this->Session->setFlash(__('The product value has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => '/index'));
			} else {
				$this->Session->setFlash(__('The product value could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productProperties = $this->ProductValue->ProductProperty->find('list');
		$this->set(compact('productProperties'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductValue->exists($id)) {
			throw new NotFoundException(__('Invalid product value'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductValue->save($this->request->data)) {
				$this->Session->setFlash(__('The product value has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product value could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProductValue.' . $this->ProductValue->primaryKey => $id));
			$this->request->data = $this->ProductValue->find('first', $options);
		}
		$productProperties = $this->ProductValue->ProductProperty->find('list');
		$this->set(compact('productProperties'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductValue->id = $id;
		if (!$this->ProductValue->exists()) {
			throw new NotFoundException(__('Invalid product value'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductValue->delete()) {
			$this->Session->setFlash(__('The product value has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The product value could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
