<?php
App::uses('AppController', 'Controller');
/**
 * ProdInvLocationProperties Controller
 *
 * @property ProdInvLocationProperty $ProdInvLocationProperty
 * @property PaginatorComponent $Paginator
 */
class ProdInvLocationPropertiesController extends AppController {

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
		$this->ProdInvLocationProperty->recursive = 0;
		$this->set('prodInvLocationProperties', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProdInvLocationProperty->exists($id)) {
			throw new NotFoundException(__('Invalid prod inv location property'));
		}
		$options = array('conditions' => array('ProdInvLocationProperty.' . $this->ProdInvLocationProperty->primaryKey => $id));
		$this->set('prodInvLocationProperty', $this->ProdInvLocationProperty->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProdInvLocationProperty->create();
			if ($this->ProdInvLocationProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The prod inv location property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prod inv location property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$prodInvLocations = $this->ProdInvLocationProperty->ProdInvLocation->find('list');
		$this->set(compact('prodInvLocations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProdInvLocationProperty->exists($id)) {
			throw new NotFoundException(__('Invalid prod inv location property'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProdInvLocationProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The prod inv location property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prod inv location property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProdInvLocationProperty.' . $this->ProdInvLocationProperty->primaryKey => $id));
			$this->request->data = $this->ProdInvLocationProperty->find('first', $options);
		}
		$prodInvLocations = $this->ProdInvLocationProperty->ProdInvLocation->find('list');
		$this->set(compact('prodInvLocations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProdInvLocationProperty->id = $id;
		if (!$this->ProdInvLocationProperty->exists()) {
			throw new NotFoundException(__('Invalid prod inv location property'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProdInvLocationProperty->delete()) {
			$this->Session->setFlash(__('The prod inv location property has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The prod inv location property could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
