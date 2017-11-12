<?php
App::uses('AppController', 'Controller');
/**
 * FitoutPeople Controller
 *
 * @property FitoutPerson $FitoutPerson
 * @property PaginatorComponent $Paginator
 */
class FitoutPeopleController extends AppController {

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
		$this->FitoutPerson->recursive = 0;
		$this->set('fitoutPeople', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FitoutPerson->exists($id)) {
			throw new NotFoundException(__('Invalid fitout person'));
		}
		$options = array('conditions' => array('FitoutPerson.' . $this->FitoutPerson->primaryKey => $id));
		$this->set('fitoutPerson', $this->FitoutPerson->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FitoutPerson->create();
			if ($this->FitoutPerson->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout person has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout person could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$fitoutWorks = $this->FitoutPerson->FitoutWork->find('list');
		$users = $this->FitoutPerson->User->find('list');
		$this->set(compact('fitoutWorks', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FitoutPerson->exists($id)) {
			throw new NotFoundException(__('Invalid fitout person'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FitoutPerson->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout person has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout person could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('FitoutPerson.' . $this->FitoutPerson->primaryKey => $id));
			$this->request->data = $this->FitoutPerson->find('first', $options);
		}
		$fitoutWorks = $this->FitoutPerson->FitoutWork->find('list');
		$users = $this->FitoutPerson->User->find('list');
		$this->set(compact('fitoutWorks', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FitoutPerson->id = $id;
		if (!$this->FitoutPerson->exists()) {
			throw new NotFoundException(__('Invalid fitout person'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FitoutPerson->delete()) {
			$this->Session->setFlash(__('The fitout person has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The fitout person could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
}

