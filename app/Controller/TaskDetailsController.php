<?php
App::uses('AppController', 'Controller');
/**
 * TaskDetails Controller
 *
 * @property TaskDetail $TaskDetail
 * @property PaginatorComponent $Paginator
 */
class TaskDetailsController extends AppController {

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
		$this->TaskDetail->recursive = 0;
		$this->set('taskDetails', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TaskDetail->exists($id)) {
			throw new NotFoundException(__('Invalid task detail'));
		}
		$options = array('conditions' => array('TaskDetail.' . $this->TaskDetail->primaryKey => $id));
		$this->set('taskDetail', $this->TaskDetail->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TaskDetail->create();
			if ($this->TaskDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The task detail has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The task detail could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$tasks = $this->TaskDetail->Task->find('list');
		$subtasks = $this->TaskDetail->Subtask->find('list');
		$this->set(compact('tasks', 'subtasks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TaskDetail->exists($id)) {
			throw new NotFoundException(__('Invalid task detail'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TaskDetail->save($this->request->data)) {
				$this->Session->setFlash(__('The task detail has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The task detail could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('TaskDetail.' . $this->TaskDetail->primaryKey => $id));
			$this->request->data = $this->TaskDetail->find('first', $options);
		}
		$tasks = $this->TaskDetail->Task->find('list');
		$subtasks = $this->TaskDetail->Subtask->find('list');
		$this->set(compact('tasks', 'subtasks'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TaskDetail->id = $id;
		if (!$this->TaskDetail->exists()) {
			throw new NotFoundException(__('Invalid task detail'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TaskDetail->delete()) {
			$this->Session->setFlash(__('The task detail has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The task detail could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
