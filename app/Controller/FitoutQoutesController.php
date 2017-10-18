<?php
App::uses('AppController', 'Controller');
/**
 * FitoutQoutes Controller
 *
 * @property FitoutQoute $FitoutQoute
 * @property PaginatorComponent $Paginator
 */
class FitoutQoutesController extends AppController {

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
		$this->FitoutQoute->recursive = 0;
		$this->set('fitoutQoutes', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FitoutQoute->exists($id)) {
			throw new NotFoundException(__('Invalid fitout qoute'));
		}
		$options = array('conditions' => array('FitoutQoute.' . $this->FitoutQoute->primaryKey => $id));
		$this->set('fitoutQoute', $this->FitoutQoute->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FitoutQoute->create();
			if ($this->FitoutQoute->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout qoute has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout qoute could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$quotations = $this->FitoutQoute->Quotation->find('list');
		$fitoutWorks = $this->FitoutQoute->FitoutWork->find('list');
		$this->set(compact('quotations', 'fitoutWorks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FitoutQoute->exists($id)) {
			throw new NotFoundException(__('Invalid fitout qoute'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FitoutQoute->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout qoute has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout qoute could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('FitoutQoute.' . $this->FitoutQoute->primaryKey => $id));
			$this->request->data = $this->FitoutQoute->find('first', $options);
		}
		$quotations = $this->FitoutQoute->Quotation->find('list');
		$fitoutWorks = $this->FitoutQoute->FitoutWork->find('list');
		$this->set(compact('quotations', 'fitoutWorks'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FitoutQoute->id = $id;
		if (!$this->FitoutQoute->exists()) {
			throw new NotFoundException(__('Invalid fitout qoute'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FitoutQoute->delete()) {
			$this->Session->setFlash(__('The fitout qoute has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The fitout qoute could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
