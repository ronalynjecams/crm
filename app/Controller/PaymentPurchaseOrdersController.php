<?php
App::uses('AppController', 'Controller');
/**
 * PaymentPurchaseOrders Controller
 *
 * @property PaymentPurchaseOrder $PaymentPurchaseOrder
 * @property PaginatorComponent $Paginator
 */
class PaymentPurchaseOrdersController extends AppController {

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
		$this->PaymentPurchaseOrder->recursive = 0;
		$this->set('paymentPurchaseOrders', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PaymentPurchaseOrder->exists($id)) {
			throw new NotFoundException(__('Invalid payment purchase order'));
		}
		$options = array('conditions' => array('PaymentPurchaseOrder.' . $this->PaymentPurchaseOrder->primaryKey => $id));
		$this->set('paymentPurchaseOrder', $this->PaymentPurchaseOrder->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PaymentPurchaseOrder->create();
			if ($this->PaymentPurchaseOrder->save($this->request->data)) {
				$this->Session->setFlash(__('The payment purchase order has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment purchase order could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$paymentRequests = $this->PaymentPurchaseOrder->PaymentRequest->find('list');
		$purchaseOrders = $this->PaymentPurchaseOrder->PurchaseOrder->find('list');
		$this->set(compact('paymentRequests', 'purchaseOrders'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PaymentPurchaseOrder->exists($id)) {
			throw new NotFoundException(__('Invalid payment purchase order'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PaymentPurchaseOrder->save($this->request->data)) {
				$this->Session->setFlash(__('The payment purchase order has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment purchase order could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PaymentPurchaseOrder.' . $this->PaymentPurchaseOrder->primaryKey => $id));
			$this->request->data = $this->PaymentPurchaseOrder->find('first', $options);
		}
		$paymentRequests = $this->PaymentPurchaseOrder->PaymentRequest->find('list');
		$purchaseOrders = $this->PaymentPurchaseOrder->PurchaseOrder->find('list');
		$this->set(compact('paymentRequests', 'purchaseOrders'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PaymentPurchaseOrder->id = $id;
		if (!$this->PaymentPurchaseOrder->exists()) {
			throw new NotFoundException(__('Invalid payment purchase order'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentPurchaseOrder->delete()) {
			$this->Session->setFlash(__('The payment purchase order has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The payment purchase order could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
