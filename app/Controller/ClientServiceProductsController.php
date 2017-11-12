<?php
App::uses('AppController', 'Controller');
/**
 * ClientServiceProducts Controller
 *
 * @property ClientServiceProduct $ClientServiceProduct
 * @property PaginatorComponent $Paginator
 */
class ClientServiceProductsController extends AppController {

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
		$this->ClientServiceProduct->recursive = 0;
		$this->set('clientServiceProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ClientServiceProduct->exists($id)) {
			throw new NotFoundException(__('Invalid client service product'));
		}
		$options = array('conditions' => array('ClientServiceProduct.' . $this->ClientServiceProduct->primaryKey => $id));
		$this->set('clientServiceProduct', $this->ClientServiceProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ClientServiceProduct->create();
			if ($this->ClientServiceProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The client service product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client service product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$products = $this->ClientServiceProduct->Product->find('list');
		$quotationProducts = $this->ClientServiceProduct->QuotationProduct->find('list');
		$productCombos = $this->ClientServiceProduct->ProductCombo->find('list');
		$this->set(compact('products', 'quotationProducts', 'productCombos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ClientServiceProduct->exists($id)) {
			throw new NotFoundException(__('Invalid client service product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ClientServiceProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The client service product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client service product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ClientServiceProduct.' . $this->ClientServiceProduct->primaryKey => $id));
			$this->request->data = $this->ClientServiceProduct->find('first', $options);
		}
		$products = $this->ClientServiceProduct->Product->find('list');
		$quotationProducts = $this->ClientServiceProduct->QuotationProduct->find('list');
		$productCombos = $this->ClientServiceProduct->ProductCombo->find('list');
		$this->set(compact('products', 'quotationProducts', 'productCombos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ClientServiceProduct->id = $id;
		if (!$this->ClientServiceProduct->exists()) {
			throw new NotFoundException(__('Invalid client service product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ClientServiceProduct->delete()) {
			$this->Session->setFlash(__('The client service product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The client service product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
