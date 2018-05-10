<?php
App::uses('AppController', 'Controller');
/**
 * InventoryProductDetails Controller
 *
 * @property InventoryProductDetail $InventoryProductDetail
 * @property PaginatorComponent $Paginator
 */
class InventoryProductDetailsController extends AppController {

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
		$this->InventoryProductDetail->recursive = 0;
		$this->set('inventoryProductDetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InventoryProductDetail->exists($id)) {
			throw new NotFoundException(__('Invalid inventory product detail'));
		}
		$options = array('conditions' => array('InventoryProductDetail.' . $this->InventoryProductDetail->primaryKey => $id));
		$this->set('inventoryProductDetail', $this->InventoryProductDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InventoryProductDetail->create();
			if ($this->InventoryProductDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory product detail has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory product detail could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productCombos = $this->InventoryProductDetail->ProductCombo->find('list');
		$invLocations = $this->InventoryProductDetail->InvLocation->find('list');
		$inventoryStatuses = $this->InventoryProductDetail->InventoryStatus->find('list');
		$suppliers = $this->InventoryProductDetail->Supplier->find('list');
		$this->set(compact('productCombos', 'invLocations', 'inventoryStatuses', 'suppliers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->InventoryProductDetail->exists($id)) {
			throw new NotFoundException(__('Invalid inventory product detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InventoryProductDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory product detail has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory product detail could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('InventoryProductDetail.' . $this->InventoryProductDetail->primaryKey => $id));
			$this->request->data = $this->InventoryProductDetail->find('first', $options);
		}
		$productCombos = $this->InventoryProductDetail->ProductCombo->find('list');
		$invLocations = $this->InventoryProductDetail->InvLocation->find('list');
		$inventoryStatuses = $this->InventoryProductDetail->InventoryStatus->find('list');
		$suppliers = $this->InventoryProductDetail->Supplier->find('list');
		$this->set(compact('productCombos', 'invLocations', 'inventoryStatuses', 'suppliers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->InventoryProductDetail->id = $id;
		if (!$this->InventoryProductDetail->exists()) {
			throw new NotFoundException(__('Invalid inventory product detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->InventoryProductDetail->delete()) {
			$this->Session->setFlash(__('The inventory product detail has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The inventory product detail could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
