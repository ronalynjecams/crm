<?php
App::uses('AppController', 'Controller');
/**
 * QuotationProductProperties Controller
 *
 * @property QuotationProductProperty $QuotationProductProperty
 * @property PaginatorComponent $Paginator
 */
class QuotationProductPropertiesController extends AppController {

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
		$this->QuotationProductProperty->recursive = 0;
		$this->set('quotationProductProperties', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->QuotationProductProperty->exists($id)) {
			throw new NotFoundException(__('Invalid quotation product property'));
		}
		$options = array('conditions' => array('QuotationProductProperty.' . $this->QuotationProductProperty->primaryKey => $id));
		$this->set('quotationProductProperty', $this->QuotationProductProperty->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->QuotationProductProperty->create();
			if ($this->QuotationProductProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The quotation product property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quotation product property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$quotationProducts = $this->QuotationProductProperty->QuotationProduct->find('list');
		$productProperties = $this->QuotationProductProperty->ProductProperty->find('list');
		$productValues = $this->QuotationProductProperty->ProductValue->find('list');
		$this->set(compact('quotationProducts', 'productProperties', 'productValues'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->QuotationProductProperty->exists($id)) {
			throw new NotFoundException(__('Invalid quotation product property'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->QuotationProductProperty->save($this->request->data)) {
				$this->Session->setFlash(__('The quotation product property has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quotation product property could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('QuotationProductProperty.' . $this->QuotationProductProperty->primaryKey => $id));
			$this->request->data = $this->QuotationProductProperty->find('first', $options);
		}
		$quotationProducts = $this->QuotationProductProperty->QuotationProduct->find('list');
		$productProperties = $this->QuotationProductProperty->ProductProperty->find('list');
		$productValues = $this->QuotationProductProperty->ProductValue->find('list');
		$this->set(compact('quotationProducts', 'productProperties', 'productValues'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->QuotationProductProperty->id = $id;
		if (!$this->QuotationProductProperty->exists()) {
			throw new NotFoundException(__('Invalid quotation product property'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->QuotationProductProperty->delete()) {
			$this->Session->setFlash(__('The quotation product property has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The quotation product property could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
}
