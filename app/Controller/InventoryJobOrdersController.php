<?php
App::uses('AppController', 'Controller');
/**
 * InventoryJobOrders Controller
 *
 * @property InventoryJobOrder $InventoryJobOrder
 * @property PaginatorComponent $Paginator
 */
class InventoryJobOrdersController extends AppController {

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
		$this->InventoryJobOrder->recursive = 0;
		$this->set('inventoryJobOrders', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InventoryJobOrder->exists($id)) {
			throw new NotFoundException(__('Invalid inventory job order'));
		}
		$options = array('conditions' => array('InventoryJobOrder.' . $this->InventoryJobOrder->primaryKey => $id));
		$this->set('inventoryJobOrder', $this->InventoryJobOrder->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InventoryJobOrder->create();
			if ($this->InventoryJobOrder->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory job order has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory job order could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productCombos = $this->InventoryJobOrder->ProductCombo->find('list');
		$this->set(compact('productCombos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->InventoryJobOrder->exists($id)) {
			throw new NotFoundException(__('Invalid inventory job order'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InventoryJobOrder->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory job order has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory job order could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('InventoryJobOrder.' . $this->InventoryJobOrder->primaryKey => $id));
			$this->request->data = $this->InventoryJobOrder->find('first', $options);
		}
		$productCombos = $this->InventoryJobOrder->ProductCombo->find('list');
		$this->set(compact('productCombos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->InventoryJobOrder->id = $id;
		if (!$this->InventoryJobOrder->exists()) {
			throw new NotFoundException(__('Invalid inventory job order'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->InventoryJobOrder->delete()) {
			$this->Session->setFlash(__('The inventory job order has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The inventory job order could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
