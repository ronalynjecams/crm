<?php
App::uses('AppController', 'Controller');
/**
 * OfficialBusinessReports Controller
 *
 * @property OfficialBusinessReport $OfficialBusinessReport
 * @property PaginatorComponent $Paginator
 */
class OfficialBusinessReportsController extends AppController {

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
		$this->OfficialBusinessReport->recursive = 0;
		$this->set('officialBusinessReports', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->OfficialBusinessReport->exists($id)) {
			throw new NotFoundException(__('Invalid official business report'));
		}
		$options = array('conditions' => array('OfficialBusinessReport.' . $this->OfficialBusinessReport->primaryKey => $id));
		$this->set('officialBusinessReport', $this->OfficialBusinessReport->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->OfficialBusinessReport->create();
			if ($this->OfficialBusinessReport->save($this->request->data)) {
				$this->Session->setFlash(__('The official business report has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The official business report could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$officialBusinesses = $this->OfficialBusinessReport->OfficialBusiness->find('list');
		$this->set(compact('officialBusinesses'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->OfficialBusinessReport->exists($id)) {
			throw new NotFoundException(__('Invalid official business report'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->OfficialBusinessReport->save($this->request->data)) {
				$this->Session->setFlash(__('The official business report has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The official business report could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('OfficialBusinessReport.' . $this->OfficialBusinessReport->primaryKey => $id));
			$this->request->data = $this->OfficialBusinessReport->find('first', $options);
		}
		$officialBusinesses = $this->OfficialBusinessReport->OfficialBusiness->find('list');
		$this->set(compact('officialBusinesses'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->OfficialBusinessReport->id = $id;
		if (!$this->OfficialBusinessReport->exists()) {
			throw new NotFoundException(__('Invalid official business report'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->OfficialBusinessReport->delete()) {
			$this->Session->setFlash(__('The official business report has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The official business report could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
