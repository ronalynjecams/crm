<?php
App::uses('AppController', 'Controller');
/**
 * QuotationUpdateLogs Controller
 *
 * @property QuotationUpdateLog $QuotationUpdateLog
 * @property PaginatorComponent $Paginator
 */
class QuotationUpdateLogsController extends AppController {

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
		$this->QuotationUpdateLog->recursive = 0;
		$this->set('quotationUpdateLogs', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->QuotationUpdateLog->exists($id)) {
			throw new NotFoundException(__('Invalid quotation update log'));
		}
		$options = array('conditions' => array('QuotationUpdateLog.' . $this->QuotationUpdateLog->primaryKey => $id));
		$this->set('quotationUpdateLog', $this->QuotationUpdateLog->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->QuotationUpdateLog->create();
			if ($this->QuotationUpdateLog->save($this->request->data)) {
				$this->Session->setFlash(__('The quotation update log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quotation update log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$users = $this->QuotationUpdateLog->User->find('list');
		$quotations = $this->QuotationUpdateLog->Quotation->find('list');
		$this->set(compact('users', 'quotations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->QuotationUpdateLog->exists($id)) {
			throw new NotFoundException(__('Invalid quotation update log'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->QuotationUpdateLog->save($this->request->data)) {
				$this->Session->setFlash(__('The quotation update log has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quotation update log could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('QuotationUpdateLog.' . $this->QuotationUpdateLog->primaryKey => $id));
			$this->request->data = $this->QuotationUpdateLog->find('first', $options);
		}
		$users = $this->QuotationUpdateLog->User->find('list');
		$quotations = $this->QuotationUpdateLog->Quotation->find('list');
		$this->set(compact('users', 'quotations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->QuotationUpdateLog->id = $id;
		if (!$this->QuotationUpdateLog->exists()) {
			throw new NotFoundException(__('Invalid quotation update log'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->QuotationUpdateLog->delete()) {
			$this->Session->setFlash(__('The quotation update log has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The quotation update log could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
