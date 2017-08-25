<?php
App::uses('AppController', 'Controller');
/**
 * ProductSources Controller
 *
 * @property ProductSource $ProductSource
 * @property PaginatorComponent $Paginator
 */
class ProductSourcesController extends AppController {

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
		$this->ProductSource->recursive = 0;
		$this->set('productSources', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductSource->exists($id)) {
			throw new NotFoundException(__('Invalid product source'));
		}
		$options = array('conditions' => array('ProductSource.' . $this->ProductSource->primaryKey => $id));
		$this->set('productSource', $this->ProductSource->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductSource->create();
			if ($this->ProductSource->save($this->request->data)) {
				$this->Session->setFlash(__('The product source has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product source could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$quotationProducts = $this->ProductSource->QuotationProduct->find('list');
		$quotations = $this->ProductSource->Quotation->find('list');
		$purchaseOrders = $this->ProductSource->PurchaseOrder->find('list');
		$prodInvLocations = $this->ProductSource->ProdInvLocation->find('list');
		$this->set(compact('quotationProducts', 'quotations', 'purchaseOrders', 'prodInvLocations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductSource->exists($id)) {
			throw new NotFoundException(__('Invalid product source'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductSource->save($this->request->data)) {
				$this->Session->setFlash(__('The product source has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product source could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProductSource.' . $this->ProductSource->primaryKey => $id));
			$this->request->data = $this->ProductSource->find('first', $options);
		}
		$quotationProducts = $this->ProductSource->QuotationProduct->find('list');
		$quotations = $this->ProductSource->Quotation->find('list');
		$purchaseOrders = $this->ProductSource->PurchaseOrder->find('list');
		$prodInvLocations = $this->ProductSource->ProdInvLocation->find('list');
		$this->set(compact('quotationProducts', 'quotations', 'purchaseOrders', 'prodInvLocations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductSource->id = $id;
		if (!$this->ProductSource->exists()) {
			throw new NotFoundException(__('Invalid product source'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductSource->delete()) {
			$this->Session->setFlash(__('The product source has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The product source could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
