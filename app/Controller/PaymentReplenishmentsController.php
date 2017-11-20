<?php
App::uses('AppController', 'Controller');
/**
 * PaymentReplenishments Controller
 *
 * @property PaymentReplenishment $PaymentReplenishment
 * @property PaginatorComponent $Paginator
 */
class PaymentReplenishmentsController extends AppController {

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
		$this->PaymentReplenishment->recursive = 0;
		$this->set('paymentReplenishments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PaymentReplenishment->exists($id)) {
			throw new NotFoundException(__('Invalid payment replenishment'));
		}
		$options = array('conditions' => array('PaymentReplenishment.' . $this->PaymentReplenishment->primaryKey => $id));
		$this->set('paymentReplenishment', $this->PaymentReplenishment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PaymentReplenishment->create();
			if ($this->PaymentReplenishment->save($this->request->data)) {
				$this->Session->setFlash(__('The payment replenishment has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment replenishment could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->PaymentReplenishment->User->find('list');
		$this->set(compact('users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PaymentReplenishment->exists($id)) {
			throw new NotFoundException(__('Invalid payment replenishment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PaymentReplenishment->save($this->request->data)) {
				$this->Session->setFlash(__('The payment replenishment has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment replenishment could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PaymentReplenishment.' . $this->PaymentReplenishment->primaryKey => $id));
			$this->request->data = $this->PaymentReplenishment->find('first', $options);
		}
		$users = $this->PaymentReplenishment->User->find('list');
		$this->set(compact('users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PaymentReplenishment->id = $id;
		if (!$this->PaymentReplenishment->exists()) {
			throw new NotFoundException(__('Invalid payment replenishment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentReplenishment->delete()) {
			$this->Session->setFlash(__('The payment replenishment has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The payment replenishment could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
