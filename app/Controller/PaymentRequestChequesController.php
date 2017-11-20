<?php
App::uses('AppController', 'Controller');
/**
 * PaymentRequestCheques Controller
 *
 * @property PaymentRequestCheque $PaymentRequestCheque
 * @property PaginatorComponent $Paginator
 */
class PaymentRequestChequesController extends AppController {

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
		$this->PaymentRequestCheque->recursive = 0;
		$this->set('paymentRequestCheques', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PaymentRequestCheque->exists($id)) {
			throw new NotFoundException(__('Invalid payment request cheque'));
		}
		$options = array('conditions' => array('PaymentRequestCheque.' . $this->PaymentRequestCheque->primaryKey => $id));
		$this->set('paymentRequestCheque', $this->PaymentRequestCheque->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PaymentRequestCheque->create();
			if ($this->PaymentRequestCheque->save($this->request->data)) {
				$this->Session->setFlash(__('The payment request cheque has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment request cheque could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$paymentRequests = $this->PaymentRequestCheque->PaymentRequest->find('list');
		$payees = $this->PaymentRequestCheque->Payee->find('list');
		$banks = $this->PaymentRequestCheque->Bank->find('list');
		$this->set(compact('paymentRequests', 'payees', 'banks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PaymentRequestCheque->exists($id)) {
			throw new NotFoundException(__('Invalid payment request cheque'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PaymentRequestCheque->save($this->request->data)) {
				$this->Session->setFlash(__('The payment request cheque has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment request cheque could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PaymentRequestCheque.' . $this->PaymentRequestCheque->primaryKey => $id));
			$this->request->data = $this->PaymentRequestCheque->find('first', $options);
		}
		$paymentRequests = $this->PaymentRequestCheque->PaymentRequest->find('list');
		$payees = $this->PaymentRequestCheque->Payee->find('list');
		$banks = $this->PaymentRequestCheque->Bank->find('list');
		$this->set(compact('paymentRequests', 'payees', 'banks'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PaymentRequestCheque->id = $id;
		if (!$this->PaymentRequestCheque->exists()) {
			throw new NotFoundException(__('Invalid payment request cheque'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentRequestCheque->delete()) {
			$this->Session->setFlash(__('The payment request cheque has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The payment request cheque could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
