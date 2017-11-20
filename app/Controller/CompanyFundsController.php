<?php
App::uses('AppController', 'Controller');
/**
 * CompanyFunds Controller
 *
 * @property CompanyFund $CompanyFund
 * @property PaginatorComponent $Paginator
 */
class CompanyFundsController extends AppController {

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
		$this->CompanyFund->recursive = 0;
		$this->set('companyFunds', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->CompanyFund->exists($id)) {
			throw new NotFoundException(__('Invalid company fund'));
		}
		$options = array('conditions' => array('CompanyFund.' . $this->CompanyFund->primaryKey => $id));
		$this->set('companyFund', $this->CompanyFund->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->CompanyFund->create();
			if ($this->CompanyFund->save($this->request->data)) {
				$this->Session->setFlash(__('The company fund has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company fund could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->CompanyFund->exists($id)) {
			throw new NotFoundException(__('Invalid company fund'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->CompanyFund->save($this->request->data)) {
				$this->Session->setFlash(__('The company fund has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The company fund could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('CompanyFund.' . $this->CompanyFund->primaryKey => $id));
			$this->request->data = $this->CompanyFund->find('first', $options);
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
		$this->CompanyFund->id = $id;
		if (!$this->CompanyFund->exists()) {
			throw new NotFoundException(__('Invalid company fund'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->CompanyFund->delete()) {
			$this->Session->setFlash(__('The company fund has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The company fund could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
