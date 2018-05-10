<?php
App::uses('AppController', 'Controller');
/**
 * PaymentRequestCategories Controller
 *
 * @property PaymentRequestCategory $PaymentRequestCategory
 * @property PaginatorComponent $Paginator
 */
class PaymentRequestCategoriesController extends AppController {

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
		$this->PaymentRequestCategory->recursive = 0;
		$this->set('paymentRequestCategories', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PaymentRequestCategory->exists($id)) {
			throw new NotFoundException(__('Invalid payment request category'));
		}
		$options = array('conditions' => array('PaymentRequestCategory.' . $this->PaymentRequestCategory->primaryKey => $id));
		$this->set('paymentRequestCategory', $this->PaymentRequestCategory->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PaymentRequestCategory->create();
			if ($this->PaymentRequestCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The payment request category has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment request category could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PaymentRequestCategory->exists($id)) {
			throw new NotFoundException(__('Invalid payment request category'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PaymentRequestCategory->save($this->request->data)) {
				$this->Session->setFlash(__('The payment request category has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The payment request category could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PaymentRequestCategory.' . $this->PaymentRequestCategory->primaryKey => $id));
			$this->request->data = $this->PaymentRequestCategory->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PaymentRequestCategory->id = $id;
		if (!$this->PaymentRequestCategory->exists()) {
			throw new NotFoundException(__('Invalid payment request category'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PaymentRequestCategory->delete()) {
			$this->Session->setFlash(__('The payment request category has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The payment request category could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
