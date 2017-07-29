<?php
App::uses('AppController', 'Controller');
/**
 * JrProducts Controller
 *
 * @property JrProduct $JrProduct
 * @property PaginatorComponent $Paginator
 */
class JrProductsController extends AppController {

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
		$this->JrProduct->recursive = 0;
		$this->set('jrProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->JrProduct->exists($id)) {
			throw new NotFoundException(__('Invalid jr product'));
		}
		$options = array('conditions' => array('JrProduct.' . $this->JrProduct->primaryKey => $id));
		$this->set('jrProduct', $this->JrProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->JrProduct->create();
			if ($this->JrProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The jr product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jr product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$quotationProducts = $this->JrProduct->QuotationProduct->find('list');
		$users = $this->JrProduct->User->find('list');
		$jobRequests = $this->JrProduct->JobRequest->find('list');
		$this->set(compact('quotationProducts', 'users', 'jobRequests'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->JrProduct->exists($id)) {
			throw new NotFoundException(__('Invalid jr product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->JrProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The jr product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The jr product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('JrProduct.' . $this->JrProduct->primaryKey => $id));
			$this->request->data = $this->JrProduct->find('first', $options);
		}
		$quotationProducts = $this->JrProduct->QuotationProduct->find('list');
		$users = $this->JrProduct->User->find('list');
		$jobRequests = $this->JrProduct->JobRequest->find('list');
		$this->set(compact('quotationProducts', 'users', 'jobRequests'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->JrProduct->id = $id;
		if (!$this->JrProduct->exists()) {
			throw new NotFoundException(__('Invalid jr product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->JrProduct->delete()) {
			$this->Session->setFlash(__('The jr product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The jr product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
