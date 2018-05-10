<?php
App::uses('AppController', 'Controller');
/**
 * InventoryStatuses Controller
 *
 * @property InventoryStatus $InventoryStatus
 * @property PaginatorComponent $Paginator
 */
class InventoryStatusesController extends AppController {

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
		$this->InventoryStatus->recursive = 0;
		$this->set('inventoryStatuses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InventoryStatus->exists($id)) {
			throw new NotFoundException(__('Invalid inventory status'));
		}
		$options = array('conditions' => array('InventoryStatus.' . $this->InventoryStatus->primaryKey => $id));
		$this->set('inventoryStatus', $this->InventoryStatus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InventoryStatus->create();
			if ($this->InventoryStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory status has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory status could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->InventoryStatus->exists($id)) {
			throw new NotFoundException(__('Invalid inventory status'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InventoryStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory status has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory status could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('InventoryStatus.' . $this->InventoryStatus->primaryKey => $id));
			$this->request->data = $this->InventoryStatus->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->InventoryStatus->id = $id;
		if (!$this->InventoryStatus->exists()) {
			throw new NotFoundException(__('Invalid inventory status'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->InventoryStatus->delete()) {
			$this->Session->setFlash(__('The inventory status has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The inventory status could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
