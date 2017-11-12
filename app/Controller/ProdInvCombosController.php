<?php
App::uses('AppController', 'Controller');
/**
 * ProdInvCombos Controller
 *
 * @property ProdInvCombo $ProdInvCombo
 * @property PaginatorComponent $Paginator
 */
class ProdInvCombosController extends AppController {

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
		$this->ProdInvCombo->recursive = 0;
		$this->set('prodInvCombos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ProdInvCombo->exists($id)) {
			throw new NotFoundException(__('Invalid prod inv combo'));
		}
		$options = array('conditions' => array('ProdInvCombo.' . $this->ProdInvCombo->primaryKey => $id));
		$this->set('prodInvCombo', $this->ProdInvCombo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ProdInvCombo->create();
			if ($this->ProdInvCombo->save($this->request->data)) {
				$this->Session->setFlash(__('The prod inv combo has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prod inv combo could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$prodInvLocations = $this->ProdInvCombo->ProdInvLocation->find('list');
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
		if (!$this->ProdInvCombo->exists($id)) {
			throw new NotFoundException(__('Invalid prod inv combo'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ProdInvCombo->save($this->request->data)) {
				$this->Session->setFlash(__('The prod inv combo has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The prod inv combo could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ProdInvCombo.' . $this->ProdInvCombo->primaryKey => $id));
			$this->request->data = $this->ProdInvCombo->find('first', $options);
		}
		$prodInvLocations = $this->ProdInvCombo->ProdInvLocation->find('list');
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
		$this->ProdInvCombo->id = $id;
		if (!$this->ProdInvCombo->exists()) {
			throw new NotFoundException(__('Invalid prod inv combo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProdInvCombo->delete()) {
			$this->Session->setFlash(__('The prod inv combo has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The prod inv combo could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
