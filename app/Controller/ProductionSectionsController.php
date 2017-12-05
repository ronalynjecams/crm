<?php
App::uses('AppController', 'Controller');
/**
 * ProductionSections Controller
 *
 * @property ProductionSection $ProductionSection
 * @property PaginatorComponent $Paginator
 */
class ProductionSectionsController extends AppController {

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
		$this->ProductionSection->recursive = 0;
		$this->set('productionSections', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductionSection->exists($id)) {
			throw new NotFoundException(__('Invalid production section'));
		}
		$options = array('conditions' => array('ProductionSection.' . $this->ProductionSection->primaryKey => $id));
		$this->set('productionSection', $this->ProductionSection->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductionSection->create();
			if ($this->ProductionSection->save($this->request->data)) {
				$this->Session->setFlash(__('The production section has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The production section could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->ProductionSection->User->find('list');
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
		if (!$this->ProductionSection->exists($id)) {
			throw new NotFoundException(__('Invalid production section'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductionSection->save($this->request->data)) {
				$this->Session->setFlash(__('The production section has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The production section could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProductionSection.' . $this->ProductionSection->primaryKey => $id));
			$this->request->data = $this->ProductionSection->find('first', $options);
		}
		$users = $this->ProductionSection->User->find('list');
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
		$this->ProductionSection->id = $id;
		if (!$this->ProductionSection->exists()) {
			throw new NotFoundException(__('Invalid production section'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductionSection->delete()) {
			$this->Session->setFlash(__('The production section has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The production section could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
