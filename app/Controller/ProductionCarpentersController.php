<?php
App::uses('AppController', 'Controller');
/**
 * ProductionCarpenters Controller
 *
 * @property ProductionCarpenter $ProductionCarpenter
 * @property PaginatorComponent $Paginator
 */
class ProductionCarpentersController extends AppController {

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
		$this->ProductionCarpenter->recursive = 0;
		$this->set('productionCarpenters', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductionCarpenter->exists($id)) {
			throw new NotFoundException(__('Invalid production carpenter'));
		}
		$options = array('conditions' => array('ProductionCarpenter.' . $this->ProductionCarpenter->primaryKey => $id));
		$this->set('productionCarpenter', $this->ProductionCarpenter->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductionCarpenter->create();
			if ($this->ProductionCarpenter->save($this->request->data)) {
				$this->Session->setFlash(__('The production carpenter has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The production carpenter could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productionProcesses = $this->ProductionCarpenter->ProductionProcess->find('list');
		$users = $this->ProductionCarpenter->User->find('list');
		$this->set(compact('productionProcesses', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductionCarpenter->exists($id)) {
			throw new NotFoundException(__('Invalid production carpenter'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductionCarpenter->save($this->request->data)) {
				$this->Session->setFlash(__('The production carpenter has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The production carpenter could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProductionCarpenter.' . $this->ProductionCarpenter->primaryKey => $id));
			$this->request->data = $this->ProductionCarpenter->find('first', $options);
		}
		$productionProcesses = $this->ProductionCarpenter->ProductionProcess->find('list');
		$users = $this->ProductionCarpenter->User->find('list');
		$this->set(compact('productionProcesses', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductionCarpenter->id = $id;
		if (!$this->ProductionCarpenter->exists()) {
			throw new NotFoundException(__('Invalid production carpenter'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductionCarpenter->delete()) {
			$this->Session->setFlash(__('The production carpenter has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The production carpenter could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
