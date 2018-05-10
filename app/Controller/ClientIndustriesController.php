<?php
App::uses('AppController', 'Controller');
/**
 * ClientIndustries Controller
 *
 * @property ClientIndustry $ClientIndustry
 * @property PaginatorComponent $Paginator
 */
class ClientIndustriesController extends AppController {

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
		$this->ClientIndustry->recursive = 0;
		$this->set('clientIndustries', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ClientIndustry->exists($id)) {
			throw new NotFoundException(__('Invalid client industry'));
		}
		$options = array('conditions' => array('ClientIndustry.' . $this->ClientIndustry->primaryKey => $id));
		$this->set('clientIndustry', $this->ClientIndustry->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ClientIndustry->create();
			if ($this->ClientIndustry->save($this->request->data)) {
				$this->Session->setFlash(__('The client industry has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client industry could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->ClientIndustry->exists($id)) {
			throw new NotFoundException(__('Invalid client industry'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ClientIndustry->save($this->request->data)) {
				$this->Session->setFlash(__('The client industry has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client industry could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ClientIndustry.' . $this->ClientIndustry->primaryKey => $id));
			$this->request->data = $this->ClientIndustry->find('first', $options);
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
		$this->ClientIndustry->id = $id;
		if (!$this->ClientIndustry->exists()) {
			throw new NotFoundException(__('Invalid client industry'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ClientIndustry->delete()) {
			$this->Session->setFlash(__('The client industry has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The client industry could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
