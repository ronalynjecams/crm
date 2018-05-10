<?php
App::uses('AppController', 'Controller');
/**
 * TempProducts Controller
 *
 * @property TempProduct $TempProduct
 * @property PaginatorComponent $Paginator
 */
class TempProductsController extends AppController {

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
		$this->TempProduct->recursive = 0;
		$this->set('tempProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TempProduct->exists($id)) {
			throw new NotFoundException(__('Invalid temp product'));
		}
		$options = array('conditions' => array('TempProduct.' . $this->TempProduct->primaryKey => $id));
		$this->set('tempProduct', $this->TempProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TempProduct->create();
			if ($this->TempProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The temp product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The temp product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$subCategories = $this->TempProduct->SubCategory->find('list');
		$this->set(compact('subCategories'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TempProduct->exists($id)) {
			throw new NotFoundException(__('Invalid temp product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TempProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The temp product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The temp product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('TempProduct.' . $this->TempProduct->primaryKey => $id));
			$this->request->data = $this->TempProduct->find('first', $options);
		}
		$subCategories = $this->TempProduct->SubCategory->find('list');
		$this->set(compact('subCategories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TempProduct->id = $id;
		if (!$this->TempProduct->exists()) {
			throw new NotFoundException(__('Invalid temp product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->TempProduct->delete()) {
			$this->Session->setFlash(__('The temp product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The temp product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
