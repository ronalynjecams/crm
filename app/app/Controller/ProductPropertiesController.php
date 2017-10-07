<?php
App::uses('AppController', 'Controller');
/**
 * ProductProperties Controller
 *
 * @property ProductProperty $ProductProperty
 * @property PaginatorComponent $Paginator
 */
class ProductPropertiesController extends AppController {

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
		$this->ProductProperty->recursive = 0;
		$this->set('productProperties', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductProperty->exists($id)) {
			throw new NotFoundException(__('Invalid product property'));
		}
		$options = array('conditions' => array('ProductProperty.' . $this->ProductProperty->primaryKey => $id));
		$this->set('productProperty', $this->ProductProperty->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductProperty->create();
			if ($this->ProductProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The product property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => '/index'));
			} else {
				$this->Session->setFlash(__('The product property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$products = $this->ProductProperty->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductProperty->exists($id)) {
			throw new NotFoundException(__('Invalid product property'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The product property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProductProperty.' . $this->ProductProperty->primaryKey => $id));
			$this->request->data = $this->ProductProperty->find('first', $options);
		}
		$products = $this->ProductProperty->Product->find('list');
		$this->set(compact('products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductProperty->id = $id;
		if (!$this->ProductProperty->exists()) {
			throw new NotFoundException(__('Invalid product property'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductProperty->delete()) {
			$this->Session->setFlash(__('The product property has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The product property could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
