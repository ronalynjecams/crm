<?php
App::uses('AppController', 'Controller');
/**
 * ProductionLogs Controller
 *
 * @property ProductionLog $ProductionLog
 * @property PaginatorComponent $Paginator
 */
class ProductionLogsController extends AppController {

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
		$this->ProductionLog->recursive = 0;
		$this->set('productionLogs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductionLog->exists($id)) {
			throw new NotFoundException(__('Invalid production log'));
		}
		$options = array('conditions' => array('ProductionLog.' . $this->ProductionLog->primaryKey => $id));
		$this->set('productionLog', $this->ProductionLog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductionLog->create();
			if ($this->ProductionLog->save($this->request->data)) {
				$this->Session->setFlash(__('The production log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The production log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productions = $this->ProductionLog->Production->find('list');
		$productionProcesses = $this->ProductionLog->ProductionProcess->find('list');
		$productionCarpenters = $this->ProductionLog->ProductionCarpenter->find('list');
		$users = $this->ProductionLog->User->find('list');
		$this->set(compact('productions', 'productionProcesses', 'productionCarpenters', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductionLog->exists($id)) {
			throw new NotFoundException(__('Invalid production log'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductionLog->save($this->request->data)) {
				$this->Session->setFlash(__('The production log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The production log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProductionLog.' . $this->ProductionLog->primaryKey => $id));
			$this->request->data = $this->ProductionLog->find('first', $options);
		}
		$productions = $this->ProductionLog->Production->find('list');
		$productionProcesses = $this->ProductionLog->ProductionProcess->find('list');
		$productionCarpenters = $this->ProductionLog->ProductionCarpenter->find('list');
		$users = $this->ProductionLog->User->find('list');
		$this->set(compact('productions', 'productionProcesses', 'productionCarpenters', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductionLog->id = $id;
		if (!$this->ProductionLog->exists()) {
			throw new NotFoundException(__('Invalid production log'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductionLog->delete()) {
			$this->Session->setFlash(__('The production log has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The production log could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
