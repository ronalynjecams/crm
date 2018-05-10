<?php
App::uses('AppController', 'Controller');
/**
 * PulloutLogs Controller
 *
 * @property PulloutLog $PulloutLog
 * @property PaginatorComponent $Paginator
 */
class PulloutLogsController extends AppController {

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
		$this->PulloutLog->recursive = 0;
		$this->set('pulloutLogs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PulloutLog->exists($id)) {
			throw new NotFoundException(__('Invalid pullout log'));
		}
		$options = array('conditions' => array('PulloutLog.' . $this->PulloutLog->primaryKey => $id));
		$this->set('pulloutLog', $this->PulloutLog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PulloutLog->create();
			if ($this->PulloutLog->save($this->request->data)) {
				$this->Session->setFlash(__('The pullout log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pullout log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$pullouts = $this->PulloutLog->Pullout->find('list');
		$this->set(compact('pullouts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PulloutLog->exists($id)) {
			throw new NotFoundException(__('Invalid pullout log'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PulloutLog->save($this->request->data)) {
				$this->Session->setFlash(__('The pullout log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The pullout log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PulloutLog.' . $this->PulloutLog->primaryKey => $id));
			$this->request->data = $this->PulloutLog->find('first', $options);
		}
		$pullouts = $this->PulloutLog->Pullout->find('list');
		$this->set(compact('pullouts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PulloutLog->id = $id;
		if (!$this->PulloutLog->exists()) {
			throw new NotFoundException(__('Invalid pullout log'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PulloutLog->delete()) {
			$this->Session->setFlash(__('The pullout log has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The pullout log could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
