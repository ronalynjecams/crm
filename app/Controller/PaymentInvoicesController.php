<?php
App::uses('AppController', 'Controller');
/**
 * PaymentInvoices Controller
 *
 * @property PaymentInvoice $PaymentInvoice
 * @property PaginatorComponent $Paginator
 */
class PaymentInvoicesController extends AppController {

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
		$this->PaymentInvoice->recursive = 0;
		$this->set('paymentInvoices', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PaymentInvoice->exists($id)) {
			throw new NotFoundException(__('Invalid payment invoice'));
		}
		$options = array('conditions' => array('PaymentInvoice.' . $this->PaymentInvoice->primaryKey => $id));
		$this->set('paymentInvoice', $this->PaymentInvoice->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PaymentInvoice->create();
			if ($this->PaymentInvoice->save($this->request->data)) {
				$this->Session->setFlash(__('The payment invoice has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment invoice could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$paymentRequests = $this->PaymentInvoice->PaymentRequest->find('list');
		$purchaseOrders = $this->PaymentInvoice->PurchaseOrder->find('list');
		$users = $this->PaymentInvoice->User->find('list');
		$this->set(compact('paymentRequests', 'purchaseOrders', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PaymentInvoice->exists($id)) {
			throw new NotFoundException(__('Invalid payment invoice'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PaymentInvoice->save($this->request->data)) {
				$this->Session->setFlash(__('The payment invoice has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment invoice could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PaymentInvoice.' . $this->PaymentInvoice->primaryKey => $id));
			$this->request->data = $this->PaymentInvoice->find('first', $options);
		}
		$paymentRequests = $this->PaymentInvoice->PaymentRequest->find('list');
		$purchaseOrders = $this->PaymentInvoice->PurchaseOrder->find('list');
		$users = $this->PaymentInvoice->User->find('list');
		$this->set(compact('paymentRequests', 'purchaseOrders', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PaymentInvoice->id = $id;
		if (!$this->PaymentInvoice->exists()) {
			throw new NotFoundException(__('Invalid payment invoice'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentInvoice->delete()) {
			$this->Session->setFlash(__('The payment invoice has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The payment invoice could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
