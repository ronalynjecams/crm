<?php
App::uses('AppController', 'Controller');
/**
 * JrWorkStatuses Controller
 *
 * @property JrWorkStatus $JrWorkStatus
 * @property PaginatorComponent $Paginator
 */
class JrWorkStatusesController extends AppController {

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
		$this->JrWorkStatus->recursive = 0;
		$this->set('jrWorkStatuses', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JrWorkStatus->exists($id)) {
			throw new NotFoundException(__('Invalid jr work status'));
		}
		$options = array('conditions' => array('JrWorkStatus.' . $this->JrWorkStatus->primaryKey => $id));
		$this->set('jrWorkStatus', $this->JrWorkStatus->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JrWorkStatus->create();
			if ($this->JrWorkStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The jr work status has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jr work status could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$jrProducts = $this->JrWorkStatus->JrProduct->find('list');
		$this->set(compact('jrProducts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JrWorkStatus->exists($id)) {
			throw new NotFoundException(__('Invalid jr work status'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JrWorkStatus->save($this->request->data)) {
				$this->Session->setFlash(__('The jr work status has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jr work status could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('JrWorkStatus.' . $this->JrWorkStatus->primaryKey => $id));
			$this->request->data = $this->JrWorkStatus->find('first', $options);
		}
		$jrProducts = $this->JrWorkStatus->JrProduct->find('list');
		$this->set(compact('jrProducts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JrWorkStatus->id = $id;
		if (!$this->JrWorkStatus->exists()) {
			throw new NotFoundException(__('Invalid jr work status'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JrWorkStatus->delete()) {
			$this->Session->setFlash(__('The jr work status has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The jr work status could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
