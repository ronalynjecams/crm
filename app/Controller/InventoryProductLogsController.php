<?php
App::uses('AppController', 'Controller');
/**
 * InventoryProductLogs Controller
 *
 * @property InventoryProductLog $InventoryProductLog
 * @property PaginatorComponent $Paginator
 */
class InventoryProductLogsController extends AppController {

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
		$this->InventoryProductLog->recursive = 0;
		$this->set('inventoryProductLogs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InventoryProductLog->exists($id)) {
			throw new NotFoundException(__('Invalid inventory product log'));
		}
		$options = array('conditions' => array('InventoryProductLog.' . $this->InventoryProductLog->primaryKey => $id));
		$this->set('inventoryProductLog', $this->InventoryProductLog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InventoryProductLog->create();
			if ($this->InventoryProductLog->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory product log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory product log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$inventoryProductDetails = $this->InventoryProductLog->InventoryProductDetail->find('list');
		$inventoryStatuses = $this->InventoryProductLog->InventoryStatus->find('list');
		$inventoryTransactions = $this->InventoryProductLog->InventoryTransaction->find('list');
		$users = $this->InventoryProductLog->User->find('list');
		$this->set(compact('inventoryProductDetails', 'inventoryStatuses', 'inventoryTransactions', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->InventoryProductLog->exists($id)) {
			throw new NotFoundException(__('Invalid inventory product log'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InventoryProductLog->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory product log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory product log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('InventoryProductLog.' . $this->InventoryProductLog->primaryKey => $id));
			$this->request->data = $this->InventoryProductLog->find('first', $options);
		}
		$inventoryProductDetails = $this->InventoryProductLog->InventoryProductDetail->find('list');
		$inventoryStatuses = $this->InventoryProductLog->InventoryStatus->find('list');
		$inventoryTransactions = $this->InventoryProductLog->InventoryTransaction->find('list');
		$users = $this->InventoryProductLog->User->find('list');
		$this->set(compact('inventoryProductDetails', 'inventoryStatuses', 'inventoryTransactions', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->InventoryProductLog->id = $id;
		if (!$this->InventoryProductLog->exists()) {
			throw new NotFoundException(__('Invalid inventory product log'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->InventoryProductLog->delete()) {
			$this->Session->setFlash(__('The inventory product log has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The inventory product log could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
