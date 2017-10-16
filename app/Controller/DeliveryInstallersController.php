<?php
App::uses('AppController', 'Controller');
/**
 * DeliveryInstallers Controller
 *
 * @property DeliveryInstaller $DeliveryInstaller
 * @property PaginatorComponent $Paginator
 */
class DeliveryInstallersController extends AppController {

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
		$this->DeliveryInstaller->recursive = 0;
		$this->set('deliveryInstallers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DeliveryInstaller->exists($id)) {
			throw new NotFoundException(__('Invalid delivery installer'));
		}
		$options = array('conditions' => array('DeliveryInstaller.' . $this->DeliveryInstaller->primaryKey => $id));
		$this->set('deliveryInstaller', $this->DeliveryInstaller->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DeliveryInstaller->create();
			if ($this->DeliveryInstaller->save($this->request->data)) {
				$this->Session->setFlash(__('The delivery installer has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The delivery installer could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$deliveryIteneraries = $this->DeliveryInstaller->DeliveryItenerary->find('list');
		$users = $this->DeliveryInstaller->User->find('list');
		$this->set(compact('deliveryIteneraries', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->DeliveryInstaller->exists($id)) {
			throw new NotFoundException(__('Invalid delivery installer'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DeliveryInstaller->save($this->request->data)) {
				$this->Session->setFlash(__('The delivery installer has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The delivery installer could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('DeliveryInstaller.' . $this->DeliveryInstaller->primaryKey => $id));
			$this->request->data = $this->DeliveryInstaller->find('first', $options);
		}
		$deliveryIteneraries = $this->DeliveryInstaller->DeliveryItenerary->find('list');
		$users = $this->DeliveryInstaller->User->find('list');
		$this->set(compact('deliveryIteneraries', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->DeliveryInstaller->id = $id;
		if (!$this->DeliveryInstaller->exists()) {
			throw new NotFoundException(__('Invalid delivery installer'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DeliveryInstaller->delete()) {
			$this->Session->setFlash(__('The delivery installer has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The delivery installer could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
