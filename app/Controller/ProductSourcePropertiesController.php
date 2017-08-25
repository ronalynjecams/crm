<?php
App::uses('AppController', 'Controller');
/**
 * ProductSourceProperties Controller
 *
 * @property ProductSourceProperty $ProductSourceProperty
 * @property PaginatorComponent $Paginator
 */
class ProductSourcePropertiesController extends AppController {

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
		$this->ProductSourceProperty->recursive = 0;
		$this->set('productSourceProperties', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductSourceProperty->exists($id)) {
			throw new NotFoundException(__('Invalid product source property'));
		}
		$options = array('conditions' => array('ProductSourceProperty.' . $this->ProductSourceProperty->primaryKey => $id));
		$this->set('productSourceProperty', $this->ProductSourceProperty->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductSourceProperty->create();
			if ($this->ProductSourceProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The product source property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product source property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productSources = $this->ProductSourceProperty->ProductSource->find('list');
		$this->set(compact('productSources'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductSourceProperty->exists($id)) {
			throw new NotFoundException(__('Invalid product source property'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductSourceProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The product source property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product source property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProductSourceProperty.' . $this->ProductSourceProperty->primaryKey => $id));
			$this->request->data = $this->ProductSourceProperty->find('first', $options);
		}
		$productSources = $this->ProductSourceProperty->ProductSource->find('list');
		$this->set(compact('productSources'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductSourceProperty->id = $id;
		if (!$this->ProductSourceProperty->exists()) {
			throw new NotFoundException(__('Invalid product source property'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductSourceProperty->delete()) {
			$this->Session->setFlash(__('The product source property has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The product source property could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
