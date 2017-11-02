<?php
App::uses('AppController', 'Controller');
/**
 * ProductCombos Controller
 *
 * @property ProductCombo $ProductCombo
 * @property PaginatorComponent $Paginator
 */
class ProductCombosController extends AppController {

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
		$this->ProductCombo->recursive = 0;
		$this->set('productCombos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProductCombo->exists($id)) {
			throw new NotFoundException(__('Invalid product combo'));
		}
		$options = array('conditions' => array('ProductCombo.' . $this->ProductCombo->primaryKey => $id));
		$this->set('productCombo', $this->ProductCombo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProductCombo->create();
			if ($this->ProductCombo->save($this->request->data)) {
				$this->Session->setFlash(__('The product combo has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product combo could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$products = $this->ProductCombo->Product->find('list');
		$units = $this->ProductCombo->Unit->find('list');
		$this->set(compact('products', 'units'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ProductCombo->exists($id)) {
			throw new NotFoundException(__('Invalid product combo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProductCombo->save($this->request->data)) {
				$this->Session->setFlash(__('The product combo has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product combo could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProductCombo.' . $this->ProductCombo->primaryKey => $id));
			$this->request->data = $this->ProductCombo->find('first', $options);
		}
		$products = $this->ProductCombo->Product->find('list');
		$units = $this->ProductCombo->Unit->find('list');
		$this->set(compact('products', 'units'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductCombo->id = $id;
		if (!$this->ProductCombo->exists()) {
			throw new NotFoundException(__('Invalid product combo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductCombo->delete()) {
			$this->Session->setFlash(__('The product combo has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The product combo could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
