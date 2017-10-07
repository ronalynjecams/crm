<?php
App::uses('AppController', 'Controller');
/**
 * Positions Controller
 *
 * @property Position $Position
 * @property PaginatorComponent $Paginator
 */
class PositionsController extends AppController {

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
		$this->Position->recursive = 0;
		$this->set('positions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Position->exists($id)) {
			throw new NotFoundException(__('Invalid position'));
		}
		$options = array('conditions' => array('Position.' . $this->Position->primaryKey => $id));
		$this->set('position', $this->Position->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->Position->create();
			if ($this->Position->save($this->request->data)) {
				$this->Session->setFlash(__('The position has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => '/index'));
			} else {
				$this->Session->setFlash(__('The position could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Position->exists($id)) {
			throw new NotFoundException(__('Invalid position'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Position->save($this->request->data)) {
				$this->Session->setFlash(__('The position has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The position could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Position.' . $this->Position->primaryKey => $id));
			$this->request->data = $this->Position->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Position->id = $id;
		if (!$this->Position->exists()) {
			throw new NotFoundException(__('Invalid position'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Position->delete()) {
			$this->Session->setFlash(__('The position has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The position could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
