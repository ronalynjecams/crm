<?php
App::uses('AppController', 'Controller');
/**
 * DrPapers Controller
 *
 * @property DrPaper $DrPaper
 * @property PaginatorComponent $Paginator
 */
class DrPapersController extends AppController {

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
		$this->DrPaper->recursive = 0;
		$this->set('drPapers', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->DrPaper->exists($id)) {
			throw new NotFoundException(__('Invalid dr paper'));
		}
		$options = array('conditions' => array('DrPaper.' . $this->DrPaper->primaryKey => $id));
		$this->set('drPaper', $this->DrPaper->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->DrPaper->create();
			if ($this->DrPaper->save($this->request->data)) {
				$this->Session->setFlash(__('The dr paper has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dr paper could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->DrPaper->exists($id)) {
			throw new NotFoundException(__('Invalid dr paper'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->DrPaper->save($this->request->data)) {
				$this->Session->setFlash(__('The dr paper has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The dr paper could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('DrPaper.' . $this->DrPaper->primaryKey => $id));
			$this->request->data = $this->DrPaper->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->DrPaper->id = $id;
		if (!$this->DrPaper->exists()) {
			throw new NotFoundException(__('Invalid dr paper'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->DrPaper->delete()) {
			$this->Session->setFlash(__('The dr paper has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The dr paper could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
