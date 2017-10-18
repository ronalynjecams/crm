<?php
App::uses('AppController', 'Controller');
/**
 * FitoutReportComments Controller
 *
 * @property FitoutReportComment $FitoutReportComment
 * @property PaginatorComponent $Paginator
 */
class FitoutReportCommentsController extends AppController {

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
		$this->FitoutReportComment->recursive = 0;
		$this->set('fitoutReportComments', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FitoutReportComment->exists($id)) {
			throw new NotFoundException(__('Invalid fitout report comment'));
		}
		$options = array('conditions' => array('FitoutReportComment.' . $this->FitoutReportComment->primaryKey => $id));
		$this->set('fitoutReportComment', $this->FitoutReportComment->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FitoutReportComment->create();
			if ($this->FitoutReportComment->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout report comment has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout report comment could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$fitoutReports = $this->FitoutReportComment->FitoutReport->find('list');
		$users = $this->FitoutReportComment->User->find('list');
		$this->set(compact('fitoutReports', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FitoutReportComment->exists($id)) {
			throw new NotFoundException(__('Invalid fitout report comment'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FitoutReportComment->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout report comment has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout report comment could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('FitoutReportComment.' . $this->FitoutReportComment->primaryKey => $id));
			$this->request->data = $this->FitoutReportComment->find('first', $options);
		}
		$fitoutReports = $this->FitoutReportComment->FitoutReport->find('list');
		$users = $this->FitoutReportComment->User->find('list');
		$this->set(compact('fitoutReports', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FitoutReportComment->id = $id;
		if (!$this->FitoutReportComment->exists()) {
			throw new NotFoundException(__('Invalid fitout report comment'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FitoutReportComment->delete()) {
			$this->Session->setFlash(__('The fitout report comment has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The fitout report comment could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
