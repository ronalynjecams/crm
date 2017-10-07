<?php
App::uses('AppController', 'Controller');
/**
 * QuotationTerms Controller
 *
 * @property QuotationTerm $QuotationTerm
 * @property PaginatorComponent $Paginator
 */
class QuotationTermsController extends AppController {

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
		$this->QuotationTerm->recursive = 0;
		$this->set('quotationTerms', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->QuotationTerm->exists($id)) {
			throw new NotFoundException(__('Invalid quotation term'));
		}
		$options = array('conditions' => array('QuotationTerm.' . $this->QuotationTerm->primaryKey => $id));
		$this->set('quotationTerm', $this->QuotationTerm->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->QuotationTerm->create();
			if ($this->QuotationTerm->save($this->request->data)) {
				$this->Session->setFlash(__('The quotation term has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quotation term could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
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
		if (!$this->QuotationTerm->exists($id)) {
			throw new NotFoundException(__('Invalid quotation term'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->QuotationTerm->save($this->request->data)) {
				$this->Session->setFlash(__('The quotation term has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quotation term could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('QuotationTerm.' . $this->QuotationTerm->primaryKey => $id));
			$this->request->data = $this->QuotationTerm->find('first', $options);
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
		$this->QuotationTerm->id = $id;
		if (!$this->QuotationTerm->exists()) {
			throw new NotFoundException(__('Invalid quotation term'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->QuotationTerm->delete()) {
			$this->Session->setFlash(__('The quotation term has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The quotation term could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
