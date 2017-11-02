<?php
App::uses('AppController', 'Controller');
/**
 * ProductComboProperties Controller
 *
 * @property ProductComboProperty $ProductComboProperty
 * @property PaginatorComponent $Paginator
 */
class ProductComboPropertiesController extends AppController {

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
		$this->ProductComboProperty->recursive = 0;
		$this->set('productComboProperties', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductComboProperty->exists($id)) {
			throw new NotFoundException(__('Invalid product combo property'));
		}
		$options = array('conditions' => array('ProductComboProperty.' . $this->ProductComboProperty->primaryKey => $id));
		$this->set('productComboProperty', $this->ProductComboProperty->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductComboProperty->create();
			if ($this->ProductComboProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The product combo property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product combo property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productCombos = $this->ProductComboProperty->ProductCombo->find('list');
		$this->set(compact('productCombos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductComboProperty->exists($id)) {
			throw new NotFoundException(__('Invalid product combo property'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductComboProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The product combo property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product combo property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProductComboProperty.' . $this->ProductComboProperty->primaryKey => $id));
			$this->request->data = $this->ProductComboProperty->find('first', $options);
		}
		$productCombos = $this->ProductComboProperty->ProductCombo->find('list');
		$this->set(compact('productCombos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductComboProperty->id = $id;
		if (!$this->ProductComboProperty->exists()) {
			throw new NotFoundException(__('Invalid product combo property'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductComboProperty->delete()) {
			$this->Session->setFlash(__('The product combo property has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The product combo property could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
