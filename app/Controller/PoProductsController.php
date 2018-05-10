<?php
App::uses('AppController', 'Controller');
/**
 * PoProducts Controller
 *
 * @property PoProduct $PoProduct
 * @property PaginatorComponent $Paginator
 */
class PoProductsController extends AppController {

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
		$this->PoProduct->recursive = 0;
		$this->set('poProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PoProduct->exists($id)) {
			throw new NotFoundException(__('Invalid po product'));
		}
		$options = array('conditions' => array('PoProduct.' . $this->PoProduct->primaryKey => $id));
		$this->set('poProduct', $this->PoProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PoProduct->create();
			if ($this->PoProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The po product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The po product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$products = $this->PoProduct->Product->find('list');
		$purchaseOrders = $this->PoProduct->PurchaseOrder->find('list');
		$this->set(compact('products', 'purchaseOrders'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PoProduct->exists($id)) {
			throw new NotFoundException(__('Invalid po product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PoProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The po product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The po product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PoProduct.' . $this->PoProduct->primaryKey => $id));
			$this->request->data = $this->PoProduct->find('first', $options);
		}
		$products = $this->PoProduct->Product->find('list');
		$purchaseOrders = $this->PoProduct->PurchaseOrder->find('list');
		$this->set(compact('products', 'purchaseOrders'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PoProduct->id = $id;
		if (!$this->PoProduct->exists()) {
			throw new NotFoundException(__('Invalid po product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PoProduct->delete()) {
			$this->Session->setFlash(__('The po product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The po product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
