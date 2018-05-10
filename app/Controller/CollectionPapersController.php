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
        $this->Quotation->recursive = 2;
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
        // pr($quotations);
    }
    
    public function process_advance_invoice() {

        $this->autoRender = false;
        $this->response->type('json');
        $this->loadModel('Collection');
        $this->loadModel('Quotation');
        $data = $this->request->data;
        $quotation_id = $data['quotation_id'];
        $ref_num = $data['ref_num'];
        $ref_amount = $data['ref_amount'];
        $ref_date = $data['ref_date'];
        
        $dateToday = date("Y-m-d H:i:s");
        
        

        $cols = $this->Collection->getDataSource();
        $cols->begin();
        
        $this->Collection->create();
        $this->Collection->set(array(
            'quotation_id' => $quotation_id,
            'user_id' => $this->Auth->user('id'),
            'payment_mode' => 'documents',
            'bank_id' => 0,
            'amount_paid' => 0,
            'with_held' => 0,
            'other_amount' => 0,
            'check_number' => 0,
            'check_date' => NULL,
            'type' => 'none',
            'status' => 'verified',
        ));
        if ($this->Collection->save()) {
        	
            $cols->commit();
            $collection_id = $this->Collection->getLastInsertID();  

    		$colpapers = $this->CollectionPaper->getDataSource();
                $this->CollectionPaper->create();
                $this->CollectionPaper->set(array(
                    'ref_number' => $ref_num,
                    'ref_date' => $ref_date,
                    'amount' => $ref_amount,
                    'accounting_paper_id' => 6,
                    'status' => 'onhand',
                    'quotation_id' => $quotation_id,
                    'user_id' => $this->Auth->user('id'),
                    'collection_id' => $collection_id,
                ));
                if($this->CollectionPaper->save()){
            		$colpapers->commit();
    				$quotats = $this->CollectionPaper->getDataSource();
            		$collection_paper_id = $this->CollectionPaper->getLastInsertID();  
                	$this->Quotation->id=$quotation_id;
                	$this->Quotation->set(array(
                		'collection_paper_id' => $collection_paper_id
                		));
                	if($this->Quotation->save()){
            			$quotats->commit();
            			return (json_encode('ok'));
                	}else{
            			return (json_encode('notok'));
		            	$cols->rollback();
	            		$colpapers->rollback();
            			$quotats->rollback(); 
                	} 
                }else{ 
		            $cols->rollback();
	            	$colpapers->rollback();
                }
                
        } else {
        	
            $cols->rollback();
        }

        
    }
}
