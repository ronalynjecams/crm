<?php
App::uses('AppController', 'Controller');
/**
 * InvLogs Controller
 *
 * @property InvLog $InvLog
 * @property PaginatorComponent $Paginator
 */
class InvLogsController extends AppController {

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
		$this->InvLog->recursive = 0;
		$this->set('invLogs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InvLog->exists($id)) {
			throw new NotFoundException(__('Invalid inv log'));
		}
		$options = array('conditions' => array('InvLog.' . $this->InvLog->primaryKey => $id));
		$this->set('invLog', $this->InvLog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InvLog->create();
			if ($this->InvLog->save($this->request->data)) {
				$this->Session->setFlash(__('The inv log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inv log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$products = $this->InvLog->Product->find('list');
		$invLocations = $this->InvLog->InvLocation->find('list');
		$quotationProducts = $this->InvLog->QuotationProduct->find('list');
		$this->set(compact('products', 'invLocations', 'quotationProducts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->InvLog->exists($id)) {
			throw new NotFoundException(__('Invalid inv log'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InvLog->save($this->request->data)) {
				$this->Session->setFlash(__('The inv log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inv log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('InvLog.' . $this->InvLog->primaryKey => $id));
			$this->request->data = $this->InvLog->find('first', $options);
		}
		$products = $this->InvLog->Product->find('list');
		$invLocations = $this->InvLog->InvLocation->find('list');
		$quotationProducts = $this->InvLog->QuotationProduct->find('list');
		$this->set(compact('products', 'invLocations', 'quotationProducts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->InvLog->id = $id;
		if (!$this->InvLog->exists()) {
			throw new NotFoundException(__('Invalid inv log'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->InvLog->delete()) {
			$this->Session->setFlash(__('The inv log has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The inv log could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
