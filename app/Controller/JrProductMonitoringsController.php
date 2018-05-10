<?php
App::uses('AppController', 'Controller');
/**
 * JrProductMonitorings Controller
 *
 * @property JrProductMonitoring $JrProductMonitoring
 * @property PaginatorComponent $Paginator
 */
class JrProductMonitoringsController extends AppController {

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
		$this->JrProductMonitoring->recursive = 0;
		$this->set('jrProductMonitorings', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JrProductMonitoring->exists($id)) {
			throw new NotFoundException(__('Invalid jr product monitoring'));
		}
		$options = array('conditions' => array('JrProductMonitoring.' . $this->JrProductMonitoring->primaryKey => $id));
		$this->set('jrProductMonitoring', $this->JrProductMonitoring->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JrProductMonitoring->create();
			if ($this->JrProductMonitoring->save($this->request->data)) {
				$this->Session->setFlash(__('The jr product monitoring has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jr product monitoring could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->JrProductMonitoring->User->find('list');
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
		if (!$this->JrProductMonitoring->exists($id)) {
			throw new NotFoundException(__('Invalid jr product monitoring'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JrProductMonitoring->save($this->request->data)) {
				$this->Session->setFlash(__('The jr product monitoring has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jr product monitoring could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('JrProductMonitoring.' . $this->JrProductMonitoring->primaryKey => $id));
			$this->request->data = $this->JrProductMonitoring->find('first', $options);
		}
		$users = $this->JrProductMonitoring->User->find('list');
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
		$this->JrProductMonitoring->id = $id;
		if (!$this->JrProductMonitoring->exists()) {
			throw new NotFoundException(__('Invalid jr product monitoring'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JrProductMonitoring->delete()) {
			$this->Session->setFlash(__('The jr product monitoring has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The jr product monitoring could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
