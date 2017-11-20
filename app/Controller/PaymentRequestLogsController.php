<?php
App::uses('AppController', 'Controller');
/**
 * PaymentRequestLogs Controller
 *
 * @property PaymentRequestLog $PaymentRequestLog
 * @property PaginatorComponent $Paginator
 */
class PaymentRequestLogsController extends AppController {

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
		$this->PaymentRequestLog->recursive = 0;
		$this->set('paymentRequestLogs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PaymentRequestLog->exists($id)) {
			throw new NotFoundException(__('Invalid payment request log'));
		}
		$options = array('conditions' => array('PaymentRequestLog.' . $this->PaymentRequestLog->primaryKey => $id));
		$this->set('paymentRequestLog', $this->PaymentRequestLog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PaymentRequestLog->create();
			if ($this->PaymentRequestLog->save($this->request->data)) {
				$this->Session->setFlash(__('The payment request log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment request log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$paymentRequests = $this->PaymentRequestLog->PaymentRequest->find('list');
		$users = $this->PaymentRequestLog->User->find('list');
		$this->set(compact('paymentRequests', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PaymentRequestLog->exists($id)) {
			throw new NotFoundException(__('Invalid payment request log'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PaymentRequestLog->save($this->request->data)) {
				$this->Session->setFlash(__('The payment request log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment request log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PaymentRequestLog.' . $this->PaymentRequestLog->primaryKey => $id));
			$this->request->data = $this->PaymentRequestLog->find('first', $options);
		}
		$paymentRequests = $this->PaymentRequestLog->PaymentRequest->find('list');
		$users = $this->PaymentRequestLog->User->find('list');
		$this->set(compact('paymentRequests', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PaymentRequestLog->id = $id;
		if (!$this->PaymentRequestLog->exists()) {
			throw new NotFoundException(__('Invalid payment request log'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentRequestLog->delete()) {
			$this->Session->setFlash(__('The payment request log has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The payment request log could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
