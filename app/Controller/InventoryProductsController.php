<?php
App::uses('AppController', 'Controller');
/**
 * InventoryProducts Controller
 *
 * @property InventoryProduct $InventoryProduct
 * @property PaginatorComponent $Paginator
 */
class InventoryProductsController extends AppController {

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
		$this->InventoryProduct->recursive = 0;
		$this->set('inventoryProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InventoryProduct->exists($id)) {
			throw new NotFoundException(__('Invalid inventory product'));
		}
		$options = array('conditions' => array('InventoryProduct.' . $this->InventoryProduct->primaryKey => $id));
		$this->set('inventoryProduct', $this->InventoryProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InventoryProduct->create();
			if ($this->InventoryProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productCombos = $this->InventoryProduct->ProductCombo->find('list');
		$invLocations = $this->InventoryProduct->InvLocation->find('list');
		$this->set(compact('productCombos', 'invLocations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->InventoryProduct->exists($id)) {
			throw new NotFoundException(__('Invalid inventory product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InventoryProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('InventoryProduct.' . $this->InventoryProduct->primaryKey => $id));
			$this->request->data = $this->InventoryProduct->find('first', $options);
		}
		$productCombos = $this->InventoryProduct->ProductCombo->find('list');
		$invLocations = $this->InventoryProduct->InvLocation->find('list');
		$this->set(compact('productCombos', 'invLocations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->InventoryProduct->id = $id;
		if (!$this->InventoryProduct->exists()) {
			throw new NotFoundException(__('Invalid inventory product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->InventoryProduct->delete()) {
			$this->Session->setFlash(__('The inventory product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The inventory product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
