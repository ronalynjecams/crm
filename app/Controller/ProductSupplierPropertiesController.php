<?php
App::uses('AppController', 'Controller');
/**
 * ProductSupplierProperties Controller
 *
 * @property ProductSupplierProperty $ProductSupplierProperty
 * @property PaginatorComponent $Paginator
 */
class ProductSupplierPropertiesController extends AppController {

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
		$this->ProductSupplierProperty->recursive = 0;
		$this->set('productSupplierProperties', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductSupplierProperty->exists($id)) {
			throw new NotFoundException(__('Invalid product supplier property'));
		}
		$options = array('conditions' => array('ProductSupplierProperty.' . $this->ProductSupplierProperty->primaryKey => $id));
		$this->set('productSupplierProperty', $this->ProductSupplierProperty->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductSupplierProperty->create();
			if ($this->ProductSupplierProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The product supplier property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product supplier property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productSuppliers = $this->ProductSupplierProperty->ProductSupplier->find('list');
		$this->set(compact('productSuppliers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductSupplierProperty->exists($id)) {
			throw new NotFoundException(__('Invalid product supplier property'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductSupplierProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The product supplier property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product supplier property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProductSupplierProperty.' . $this->ProductSupplierProperty->primaryKey => $id));
			$this->request->data = $this->ProductSupplierProperty->find('first', $options);
		}
		$productSuppliers = $this->ProductSupplierProperty->ProductSupplier->find('list');
		$this->set(compact('productSuppliers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductSupplierProperty->id = $id;
		if (!$this->ProductSupplierProperty->exists()) {
			throw new NotFoundException(__('Invalid product supplier property'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductSupplierProperty->delete()) {
			$this->Session->setFlash(__('The product supplier property has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The product supplier property could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
