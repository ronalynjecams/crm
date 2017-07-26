<?php
App::uses('AppController', 'Controller');
/**
 * ErpPermissions Controller
 *
 * @property ErpPermission $ErpPermission
 * @property PaginatorComponent $Paginator
 */
class ErpPermissionsController extends AppController {

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
		$this->ErpPermission->recursive = 0;
		$this->set('erpPermissions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ErpPermission->exists($id)) {
			throw new NotFoundException(__('Invalid erp permission'));
		}
		$options = array('conditions' => array('ErpPermission.' . $this->ErpPermission->primaryKey => $id));
		$this->set('erpPermission', $this->ErpPermission->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ErpPermission->create();
			if ($this->ErpPermission->save($this->request->data)) {
				$this->Session->setFlash(__('The erp permission has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The erp permission could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->ErpPermission->exists($id)) {
			throw new NotFoundException(__('Invalid erp permission'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ErpPermission->save($this->request->data)) {
				$this->Session->setFlash(__('The erp permission has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The erp permission could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ErpPermission.' . $this->ErpPermission->primaryKey => $id));
			$this->request->data = $this->ErpPermission->find('first', $options);
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
		$this->ErpPermission->id = $id;
		if (!$this->ErpPermission->exists()) {
			throw new NotFoundException(__('Invalid erp permission'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ErpPermission->delete()) {
			$this->Session->setFlash(__('The erp permission has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The erp permission could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
