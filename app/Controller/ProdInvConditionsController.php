<?php
App::uses('AppController', 'Controller');
/**
 * ProdInvConditions Controller
 *
 * @property ProdInvCondition $ProdInvCondition
 * @property PaginatorComponent $Paginator
 */
class ProdInvConditionsController extends AppController {

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
		$this->ProdInvCondition->recursive = 0;
		$this->set('prodInvConditions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProdInvCondition->exists($id)) {
			throw new NotFoundException(__('Invalid prod inv condition'));
		}
		$options = array('conditions' => array('ProdInvCondition.' . $this->ProdInvCondition->primaryKey => $id));
		$this->set('prodInvCondition', $this->ProdInvCondition->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProdInvCondition->create();
			if ($this->ProdInvCondition->save($this->request->data)) {
				$this->Session->setFlash(__('The prod inv condition has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prod inv condition could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$prodInvLocationProperties = $this->ProdInvCondition->ProdInvLocationProperty->find('list');
		$products = $this->ProdInvCondition->Product->find('list');
		$this->set(compact('prodInvLocationProperties', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProdInvCondition->exists($id)) {
			throw new NotFoundException(__('Invalid prod inv condition'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProdInvCondition->save($this->request->data)) {
				$this->Session->setFlash(__('The prod inv condition has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prod inv condition could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProdInvCondition.' . $this->ProdInvCondition->primaryKey => $id));
			$this->request->data = $this->ProdInvCondition->find('first', $options);
		}
		$prodInvLocationProperties = $this->ProdInvCondition->ProdInvLocationProperty->find('list');
		$products = $this->ProdInvCondition->Product->find('list');
		$this->set(compact('prodInvLocationProperties', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProdInvCondition->id = $id;
		if (!$this->ProdInvCondition->exists()) {
			throw new NotFoundException(__('Invalid prod inv condition'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProdInvCondition->delete()) {
			$this->Session->setFlash(__('The prod inv condition has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The prod inv condition could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
