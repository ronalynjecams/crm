<?php
App::uses('AppController', 'Controller');
/**
 * FitoutReports Controller
 *
 * @property FitoutReport $FitoutReport
 * @property PaginatorComponent $Paginator
 */
class FitoutReportsController extends AppController {

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
		$this->FitoutReport->recursive = 0;
		$this->set('fitoutReports', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FitoutReport->exists($id)) {
			throw new NotFoundException(__('Invalid fitout report'));
		}
		$options = array('conditions' => array('FitoutReport.' . $this->FitoutReport->primaryKey => $id));
		$this->set('fitoutReport', $this->FitoutReport->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FitoutReport->create();
			if ($this->FitoutReport->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout report has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout report could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->FitoutReport->User->find('list');
		$fitoutWorks = $this->FitoutReport->FitoutWork->find('list');
		$this->set(compact('users', 'fitoutWorks'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FitoutReport->exists($id)) {
			throw new NotFoundException(__('Invalid fitout report'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FitoutReport->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout report has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout report could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('FitoutReport.' . $this->FitoutReport->primaryKey => $id));
			$this->request->data = $this->FitoutReport->find('first', $options);
		}
		$users = $this->FitoutReport->User->find('list');
		$fitoutWorks = $this->FitoutReport->FitoutWork->find('list');
		$this->set(compact('users', 'fitoutWorks'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FitoutReport->id = $id;
		if (!$this->FitoutReport->exists()) {
			throw new NotFoundException(__('Invalid fitout report'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FitoutReport->delete()) {
			$this->Session->setFlash(__('The fitout report has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The fitout report could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
