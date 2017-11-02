<?php
App::uses('AppController', 'Controller');
/**
 * PurchaseOrderProducts Controller
 *
 * @property PurchaseOrderProduct $PurchaseOrderProduct
 * @property PaginatorComponent $Paginator
 */
class PurchaseOrderProductsController extends AppController {

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
		$this->PurchaseOrderProduct->recursive = 0;
		$this->set('purchaseOrderProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PurchaseOrderProduct->exists($id)) {
			throw new NotFoundException(__('Invalid purchase order product'));
		}
		$options = array('conditions' => array('PurchaseOrderProduct.' . $this->PurchaseOrderProduct->primaryKey => $id));
		$this->set('purchaseOrderProduct', $this->PurchaseOrderProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PurchaseOrderProduct->create();
			if ($this->PurchaseOrderProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The purchase order product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchase order product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productCombos = $this->PurchaseOrderProduct->ProductCombo->find('list');
		$purchaseOrders = $this->PurchaseOrderProduct->PurchaseOrder->find('list');
		$users = $this->PurchaseOrderProduct->User->find('list');
		$supplierProducts = $this->PurchaseOrderProduct->SupplierProduct->find('list');
		$this->set(compact('productCombos', 'purchaseOrders', 'users', 'supplierProducts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PurchaseOrderProduct->exists($id)) {
			throw new NotFoundException(__('Invalid purchase order product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PurchaseOrderProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The purchase order product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchase order product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PurchaseOrderProduct.' . $this->PurchaseOrderProduct->primaryKey => $id));
			$this->request->data = $this->PurchaseOrderProduct->find('first', $options);
		}
		$productCombos = $this->PurchaseOrderProduct->ProductCombo->find('list');
		$purchaseOrders = $this->PurchaseOrderProduct->PurchaseOrder->find('list');
		$users = $this->PurchaseOrderProduct->User->find('list');
		$supplierProducts = $this->PurchaseOrderProduct->SupplierProduct->find('list');
		$this->set(compact('productCombos', 'purchaseOrders', 'users', 'supplierProducts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PurchaseOrderProduct->id = $id;
		if (!$this->PurchaseOrderProduct->exists()) {
			throw new NotFoundException(__('Invalid purchase order product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PurchaseOrderProduct->delete()) {
			$this->Session->setFlash(__('The purchase order product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The purchase order product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
