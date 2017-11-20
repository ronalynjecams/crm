<?php
App::uses('AppController', 'Controller');
/**
 * PaymentReplenishedDetails Controller
 *
 * @property PaymentReplenishedDetail $PaymentReplenishedDetail
 * @property PaginatorComponent $Paginator
 */
class PaymentReplenishedDetailsController extends AppController {

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
		$this->PaymentReplenishedDetail->recursive = 0;
		$this->set('paymentReplenishedDetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PaymentReplenishedDetail->exists($id)) {
			throw new NotFoundException(__('Invalid payment replenished detail'));
		}
		$options = array('conditions' => array('PaymentReplenishedDetail.' . $this->PaymentReplenishedDetail->primaryKey => $id));
		$this->set('paymentReplenishedDetail', $this->PaymentReplenishedDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PaymentReplenishedDetail->create();
			if ($this->PaymentReplenishedDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The payment replenished detail has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment replenished detail could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$paymentReplenishments = $this->PaymentReplenishedDetail->PaymentReplenishment->find('list');
		$paymentRequests = $this->PaymentReplenishedDetail->PaymentRequest->find('list');
		$this->set(compact('paymentReplenishments', 'paymentRequests'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PaymentReplenishedDetail->exists($id)) {
			throw new NotFoundException(__('Invalid payment replenished detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PaymentReplenishedDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The payment replenished detail has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment replenished detail could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PaymentReplenishedDetail.' . $this->PaymentReplenishedDetail->primaryKey => $id));
			$this->request->data = $this->PaymentReplenishedDetail->find('first', $options);
		}
		$paymentReplenishments = $this->PaymentReplenishedDetail->PaymentReplenishment->find('list');
		$paymentRequests = $this->PaymentReplenishedDetail->PaymentRequest->find('list');
		$this->set(compact('paymentReplenishments', 'paymentRequests'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PaymentReplenishedDetail->id = $id;
		if (!$this->PaymentReplenishedDetail->exists()) {
			throw new NotFoundException(__('Invalid payment replenished detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentReplenishedDetail->delete()) {
			$this->Session->setFlash(__('The payment replenished detail has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The payment replenished detail could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
