<?php
App::uses('AppController', 'Controller');
/**
 * SupplierTags Controller
 *
 * @property SupplierTag $SupplierTag
 * @property PaginatorComponent $Paginator
 */
class SupplierTagsController extends AppController {

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
		$this->SupplierTag->recursive = 0;
		$this->set('supplierTags', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SupplierTag->exists($id)) {
			throw new NotFoundException(__('Invalid supplier tag'));
		}
		$options = array('conditions' => array('SupplierTag.' . $this->SupplierTag->primaryKey => $id));
		$this->set('supplierTag', $this->SupplierTag->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SupplierTag->create();
			if ($this->SupplierTag->save($this->request->data)) {
				$this->Session->setFlash(__('The supplier tag has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier tag could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$suppliers = $this->SupplierTag->Supplier->find('list');
		$this->set(compact('suppliers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SupplierTag->exists($id)) {
			throw new NotFoundException(__('Invalid supplier tag'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SupplierTag->save($this->request->data)) {
				$this->Session->setFlash(__('The supplier tag has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier tag could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('SupplierTag.' . $this->SupplierTag->primaryKey => $id));
			$this->request->data = $this->SupplierTag->find('first', $options);
		}
		$suppliers = $this->SupplierTag->Supplier->find('list');
		$this->set(compact('suppliers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SupplierTag->id = $id;
		if (!$this->SupplierTag->exists()) {
			throw new NotFoundException(__('Invalid supplier tag'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SupplierTag->delete()) {
			$this->Session->setFlash(__('The supplier tag has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The supplier tag could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
