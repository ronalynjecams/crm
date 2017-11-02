<?php
App::uses('AppController', 'Controller');
/**
 * TransactionSources Controller
 *
 * @property TransactionSource $TransactionSource
 * @property PaginatorComponent $Paginator
 */
class TransactionSourcesController extends AppController {

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
		$this->TransactionSource->recursive = 0;
		$this->set('transactionSources', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TransactionSource->exists($id)) {
			throw new NotFoundException(__('Invalid transaction source'));
		}
		$options = array('conditions' => array('TransactionSource.' . $this->TransactionSource->primaryKey => $id));
		$this->set('transactionSource', $this->TransactionSource->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TransactionSource->create();
			if ($this->TransactionSource->save($this->request->data)) {
				$this->Session->setFlash(__('The transaction source has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The transaction source could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->TransactionSource->exists($id)) {
			throw new NotFoundException(__('Invalid transaction source'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TransactionSource->save($this->request->data)) {
				$this->Session->setFlash(__('The transaction source has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The transaction source could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('TransactionSource.' . $this->TransactionSource->primaryKey => $id));
			$this->request->data = $this->TransactionSource->find('first', $options);
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
		$this->TransactionSource->id = $id;
		if (!$this->TransactionSource->exists()) {
			throw new NotFoundException(__('Invalid transaction source'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TransactionSource->delete()) {
			$this->Session->setFlash(__('The transaction source has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The transaction source could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
