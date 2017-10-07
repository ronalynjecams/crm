<?php

App::uses('AppController', 'Controller');

/**
 * CollectionPapers Controller
 *
 * @property CollectionPaper $CollectionPaper
 * @property PaginatorComponent $Paginator
 */
class CollectionPapersController extends AppController {

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
        $this->CollectionPaper->recursive = 0;
        $this->set('collectionPapers', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->CollectionPaper->exists($id)) {
            throw new NotFoundException(__('Invalid collection paper'));
        }
        $options = array('conditions' => array('CollectionPaper.' . $this->CollectionPaper->primaryKey => $id));
        $this->set('collectionPaper', $this->CollectionPaper->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->CollectionPaper->create();
            if ($this->CollectionPaper->save($this->request->data)) {
                $this->Session->setFlash(__('The collection paper has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The collection paper could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $accountingPapers = $this->CollectionPaper->AccountingPaper->find('list');
        $this->set(compact('accountingPapers'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->CollectionPaper->exists($id)) {
            throw new NotFoundException(__('Invalid collection paper'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->CollectionPaper->save($this->request->data)) {
                $this->Session->setFlash(__('The collection paper has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The collection paper could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('CollectionPaper.' . $this->CollectionPaper->primaryKey => $id));
            $this->request->data = $this->CollectionPaper->find('first', $options);
        }
        $accountingPapers = $this->CollectionPaper->AccountingPaper->find('list');
        $this->set(compact('accountingPapers'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->CollectionPaper->id = $id;
        if (!$this->CollectionPaper->exists()) {
            throw new NotFoundException(__('Invalid collection paper'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->CollectionPaper->delete()) {
            $this->Session->setFlash(__('The collection paper has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The collection paper could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function advance_invoice() {
        $this->loadModel('Quotation');
        if ($this->params['url']['status'] == 'pending') {
            $quotations = $this->Quotation->find('all', ['conditions' => [
                    'Quotation.advance_invoice' => 1,
                    'Quotation.collection_paper_id' => 0,
            ]]);
        } else {
            $quotations = $this->Quotation->find('all', ['conditions' => [
                    'Quotation.advance_invoice' => 1,
                    'Quotation.collection_paper_id !=' => 0,
            ]]);
        }
        $this->set(compact('quotations'));
    }

}
