<?php
App::uses('AppController', 'Controller');
/**
 * FitoutWorks Controller
 *
 * @property FitoutWork $FitoutWork
 * @property PaginatorComponent $Paginator
 */
class FitoutWorksController extends AppController {

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
		$this->FitoutWork->recursive = 0;
		$this->set('fitoutWorks', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->FitoutWork->exists($id)) {
			throw new NotFoundException(__('Invalid fitout work'));
		}
		$options = array('conditions' => array('FitoutWork.' . $this->FitoutWork->primaryKey => $id));
		$this->set('fitoutWork', $this->FitoutWork->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->FitoutWork->create();
			if ($this->FitoutWork->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout work has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout work could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$clients = $this->FitoutWork->Client->find('list');
		$users = $this->FitoutWork->User->find('list');
		$this->set(compact('clients', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->FitoutWork->exists($id)) {
			throw new NotFoundException(__('Invalid fitout work'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->FitoutWork->save($this->request->data)) {
				$this->Session->setFlash(__('The fitout work has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fitout work could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('FitoutWork.' . $this->FitoutWork->primaryKey => $id));
			$this->request->data = $this->FitoutWork->find('first', $options);
		}
		$clients = $this->FitoutWork->Client->find('list');
		$users = $this->FitoutWork->User->find('list');
		$this->set(compact('clients', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->FitoutWork->id = $id;
		if (!$this->FitoutWork->exists()) {
			throw new NotFoundException(__('Invalid fitout work'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->FitoutWork->delete()) {
			$this->Session->setFlash(__('The fitout work has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The fitout work could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        public function project() {
            //load models
            $this->loadModel('Quotation');
            
            //get parameter status from url
            //query fitoutwork status
            $passed_status = $this->params['url']['status'];
            $options = ['conditions'=>['FitoutWork.status'=>$passed_status]];
            $this->set('fitoutworks', $this->FitoutWork->find('all', $options));
            
            //get quotations
            $quotations = $this->Quotation->find('all');
            $this->set('quotes_data', $quotations);
        }
}
