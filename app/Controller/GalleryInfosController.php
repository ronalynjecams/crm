<?php
App::uses('AppController', 'Controller');
/**
 * GalleryInfos Controller
 *
 * @property GalleryInfo $GalleryInfo
 * @property PaginatorComponent $Paginator
 */
class GalleryInfosController extends AppController {

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
		$this->GalleryInfo->recursive = 0;
		$this->set('galleryInfos', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->GalleryInfo->exists($id)) {
			throw new NotFoundException(__('Invalid gallery info'));
		}
		$options = array('conditions' => array('GalleryInfo.' . $this->GalleryInfo->primaryKey => $id));
		$this->set('galleryInfo', $this->GalleryInfo->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->GalleryInfo->create();
			if ($this->GalleryInfo->save($this->request->data)) {
				$this->Session->setFlash(__('The gallery info has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gallery info could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$quotations = $this->GalleryInfo->Quotation->find('list');
		$clients = $this->GalleryInfo->Client->find('list');
		$users = $this->GalleryInfo->User->find('list');
		$teams = $this->GalleryInfo->Team->find('list');
		$this->set(compact('quotations', 'clients', 'users', 'teams'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->GalleryInfo->exists($id)) {
			throw new NotFoundException(__('Invalid gallery info'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->GalleryInfo->save($this->request->data)) {
				$this->Session->setFlash(__('The gallery info has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The gallery info could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('GalleryInfo.' . $this->GalleryInfo->primaryKey => $id));
			$this->request->data = $this->GalleryInfo->find('first', $options);
		}
		$quotations = $this->GalleryInfo->Quotation->find('list');
		$clients = $this->GalleryInfo->Client->find('list');
		$users = $this->GalleryInfo->User->find('list');
		$teams = $this->GalleryInfo->Team->find('list');
		$this->set(compact('quotations', 'clients', 'users', 'teams'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->GalleryInfo->id = $id;
		if (!$this->GalleryInfo->exists()) {
			throw new NotFoundException(__('Invalid gallery info'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->GalleryInfo->delete()) {
			$this->Session->setFlash(__('The gallery info has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The gallery info could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
