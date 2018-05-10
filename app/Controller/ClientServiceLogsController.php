<?php
App::uses('AppController', 'Controller');
/**
 * ClientServiceLogs Controller
 *
 * @property ClientServiceLog $ClientServiceLog
 * @property PaginatorComponent $Paginator
 */
class ClientServiceLogsController extends AppController {

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
		$this->ClientServiceLog->recursive = 0;
		$this->set('clientServiceLogs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ClientServiceLog->exists($id)) {
			throw new NotFoundException(__('Invalid client service log'));
		}
		$options = array('conditions' => array('ClientServiceLog.' . $this->ClientServiceLog->primaryKey => $id));
		$this->set('clientServiceLog', $this->ClientServiceLog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ClientServiceLog->create();
			if ($this->ClientServiceLog->save($this->request->data)) {
				$this->Session->setFlash(__('The client service log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client service log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$clientServices = $this->ClientServiceLog->ClientService->find('list');
		$users = $this->ClientServiceLog->User->find('list');
		$this->set(compact('clientServices', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ClientServiceLog->exists($id)) {
			throw new NotFoundException(__('Invalid client service log'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ClientServiceLog->save($this->request->data)) {
				$this->Session->setFlash(__('The client service log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client service log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ClientServiceLog.' . $this->ClientServiceLog->primaryKey => $id));
			$this->request->data = $this->ClientServiceLog->find('first', $options);
		}
		$clientServices = $this->ClientServiceLog->ClientService->find('list');
		$users = $this->ClientServiceLog->User->find('list');
		$this->set(compact('clientServices', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ClientServiceLog->id = $id;
		if (!$this->ClientServiceLog->exists()) {
			throw new NotFoundException(__('Invalid client service log'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ClientServiceLog->delete()) {
			$this->Session->setFlash(__('The client service log has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The client service log could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
