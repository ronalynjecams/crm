<?php
App::uses('AppController', 'Controller');
/**
 * AdditionalImages Controller
 *
 * @property AdditionalImage $AdditionalImage
 * @property PaginatorComponent $Paginator
 */
class AdditionalImagesController extends AppController {

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
		$this->AdditionalImage->recursive = 0;
		$this->set('additionalImages', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->AdditionalImage->exists($id)) {
			throw new NotFoundException(__('Invalid additional image'));
		}
		$options = array('conditions' => array('AdditionalImage.' . $this->AdditionalImage->primaryKey => $id));
		$this->set('additionalImage', $this->AdditionalImage->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->AdditionalImage->create();
			if ($this->AdditionalImage->save($this->request->data)) {
				$this->Session->setFlash(__('The additional image has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The additional image could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$products = $this->AdditionalImage->Product->find('list');
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
		if (!$this->AdditionalImage->exists($id)) {
			throw new NotFoundException(__('Invalid additional image'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->AdditionalImage->save($this->request->data)) {
				$this->Session->setFlash(__('The additional image has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The additional image could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('AdditionalImage.' . $this->AdditionalImage->primaryKey => $id));
			$this->request->data = $this->AdditionalImage->find('first', $options);
		}
		$products = $this->AdditionalImage->Product->find('list');
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
		$this->AdditionalImage->id = $id;
		if (!$this->AdditionalImage->exists()) {
			throw new NotFoundException(__('Invalid additional image'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->AdditionalImage->delete()) {
			$this->Session->setFlash(__('The additional image has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The additional image could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
