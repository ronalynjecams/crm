<?php
App::uses('AppController', 'Controller');
/**
 * CompanyFundLogs Controller
 *
 * @property CompanyFundLog $CompanyFundLog
 * @property PaginatorComponent $Paginator
 */
class CompanyFundLogsController extends AppController {

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
		$this->CompanyFundLog->recursive = 0;
		$this->set('companyFundLogs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CompanyFundLog->exists($id)) {
			throw new NotFoundException(__('Invalid company fund log'));
		}
		$options = array('conditions' => array('CompanyFundLog.' . $this->CompanyFundLog->primaryKey => $id));
		$this->set('companyFundLog', $this->CompanyFundLog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CompanyFundLog->create();
			if ($this->CompanyFundLog->save($this->request->data)) {
				$this->Session->setFlash(__('The company fund log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company fund log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->CompanyFundLog->exists($id)) {
			throw new NotFoundException(__('Invalid company fund log'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CompanyFundLog->save($this->request->data)) {
				$this->Session->setFlash(__('The company fund log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company fund log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CompanyFundLog.' . $this->CompanyFundLog->primaryKey => $id));
			$this->request->data = $this->CompanyFundLog->find('first', $options);
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
		$this->CompanyFundLog->id = $id;
		if (!$this->CompanyFundLog->exists()) {
			throw new NotFoundException(__('Invalid company fund log'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CompanyFundLog->delete()) {
			$this->Session->setFlash(__('The company fund log has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The company fund log could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
