<?php
App::uses('AppController', 'Controller');
/**
 * Subtasks Controller
 *
 * @property Subtask $Subtask
 * @property PaginatorComponent $Paginator
 */
class SubtasksController extends AppController {

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
		$this->Subtask->recursive = 0;
		$this->set('subtasks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Subtask->exists($id)) {
			throw new NotFoundException(__('Invalid subtask'));
		}
		$options = array('conditions' => array('Subtask.' . $this->Subtask->primaryKey => $id));
		$this->set('subtask', $this->Subtask->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Subtask->create();
			if ($this->Subtask->save($this->request->data)) {
				$this->Session->setFlash(__('The subtask has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subtask could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$tasks = $this->Subtask->Task->find('list');
		$this->set(compact('tasks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Subtask->exists($id)) {
			throw new NotFoundException(__('Invalid subtask'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Subtask->save($this->request->data)) {
				$this->Session->setFlash(__('The subtask has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The subtask could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Subtask.' . $this->Subtask->primaryKey => $id));
			$this->request->data = $this->Subtask->find('first', $options);
		}
		$tasks = $this->Subtask->Task->find('list');
		$this->set(compact('tasks'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Subtask->id = $id;
		if (!$this->Subtask->exists()) {
			throw new NotFoundException(__('Invalid subtask'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Subtask->delete()) {
			$this->Session->setFlash(__('The subtask has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The subtask could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
