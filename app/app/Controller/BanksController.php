<?php
App::uses('AppController', 'Controller');
/**
 * Banks Controller
 *
 * @property Bank $Bank
 * @property PaginatorComponent $Paginator
 */
class BanksController extends AppController {

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
		$this->Bank->recursive = 0;
		$this->set('banks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Bank->exists($id)) {
			throw new NotFoundException(__('Invalid bank'));
		}
		$options = array('conditions' => array('Bank.' . $this->Bank->primaryKey => $id));
		$this->set('bank', $this->Bank->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Bank->create();
			if ($this->Bank->save($this->request->data)) {
				$this->Session->setFlash(__('The bank has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bank could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->Bank->exists($id)) {
			throw new NotFoundException(__('Invalid bank'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Bank->save($this->request->data)) {
				$this->Session->setFlash(__('The bank has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bank could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Bank.' . $this->Bank->primaryKey => $id));
			$this->request->data = $this->Bank->find('first', $options);
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
		$this->Bank->id = $id;
		if (!$this->Bank->exists()) {
			throw new NotFoundException(__('Invalid bank'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Bank->delete()) {
			$this->Session->setFlash(__('The bank has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The bank could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
