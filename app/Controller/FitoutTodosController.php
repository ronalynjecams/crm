<?php
App::uses('AppController', 'Controller');
/**
 * FitoutTodos Controller
 *
 * @property FitoutTodo $FitoutTodo
 * @property PaginatorComponent $Paginator
 */
class FitoutTodosController extends AppController {

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
		$this->FitoutTodo->recursive = 0;
		$this->set('fitoutTodos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FitoutTodo->exists($id)) {
			throw new NotFoundException(__('Invalid fitout todo'));
		}
		$options = array('conditions' => array('FitoutTodo.' . $this->FitoutTodo->primaryKey => $id));
		$this->set('fitoutTodo', $this->FitoutTodo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FitoutTodo->create();
			if ($this->FitoutTodo->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout todo has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout todo could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->FitoutTodo->User->find('list');
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
		if (!$this->FitoutTodo->exists($id)) {
			throw new NotFoundException(__('Invalid fitout todo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FitoutTodo->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout todo has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout todo could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('FitoutTodo.' . $this->FitoutTodo->primaryKey => $id));
			$this->request->data = $this->FitoutTodo->find('first', $options);
		}
		$users = $this->FitoutTodo->User->find('list');
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
		$this->FitoutTodo->id = $id;
		if (!$this->FitoutTodo->exists()) {
			throw new NotFoundException(__('Invalid fitout todo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FitoutTodo->delete()) {
			$this->Session->setFlash(__('The fitout todo has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The fitout todo could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
