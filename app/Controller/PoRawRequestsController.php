<?php
App::uses('AppController', 'Controller');
/**
 * PoRawRequests Controller
 *
 * @property PoRawRequest $PoRawRequest
 * @property PaginatorComponent $Paginator
 */
class PoRawRequestsController extends AppController {

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
		$this->PoRawRequest->recursive = 0;
		$this->set('poRawRequests', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PoRawRequest->exists($id)) {
			throw new NotFoundException(__('Invalid po raw request'));
		}
		$options = array('conditions' => array('PoRawRequest.' . $this->PoRawRequest->primaryKey => $id));
		$this->set('poRawRequest', $this->PoRawRequest->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PoRawRequest->create();
			if ($this->PoRawRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The po raw request has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The po raw request could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$quotationProducts = $this->PoRawRequest->QuotationProduct->find('list');
		$jrProducts = $this->PoRawRequest->JrProduct->find('list');
		$products = $this->PoRawRequest->Product->find('list');
		$users = $this->PoRawRequest->User->find('list');
		$this->set(compact('quotationProducts', 'jrProducts', 'products', 'users'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PoRawRequest->exists($id)) {
			throw new NotFoundException(__('Invalid po raw request'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PoRawRequest->save($this->request->data)) {
				$this->Session->setFlash(__('The po raw request has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The po raw request could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PoRawRequest.' . $this->PoRawRequest->primaryKey => $id));
			$this->request->data = $this->PoRawRequest->find('first', $options);
		}
		$quotationProducts = $this->PoRawRequest->QuotationProduct->find('list');
		$jrProducts = $this->PoRawRequest->JrProduct->find('list');
		$products = $this->PoRawRequest->Product->find('list');
		$users = $this->PoRawRequest->User->find('list');
		$this->set(compact('quotationProducts', 'jrProducts', 'products', 'users'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete() {
            
        $this->autoRender = false;
        $data = $this->request->data;
        $id = $data['id'];
            $this->PoRawRequest->id = $id;
            $this->PoRawRequest->delete();
            echo json_encode($id);
//		$this->PoRawRequest->id = $id;
//		if (!$this->PoRawRequest->exists()) {
//			throw new NotFoundException(__('Invalid po raw request'));
//		}
//		$this->request->onlyAllow('post', 'delete');
//		if ($this->PoRawRequest->delete()) {
//			$this->Session->setFlash(__('The po raw request has been deleted.'), 'default', array('class' => 'alert alert-success'));
//		} else {
//			$this->Session->setFlash(__('The po raw request could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
//		}
//		return $this->redirect(array('action' => 'index'));
	}
        
    public function addProduct() {
        header('Content-Type: application/json');
        $this->autoRender = false;
        $data = $this->request->data;
        
        $this->loadModel('PoRawRequestProperty'); 
        $qty = $data['qty'];
        $date_needed = $data['date_needed'];
        $property = $data['property'];
        $value = $data['value'];
        $counter = $data['counter'];
        $quotation_product_id = $data['quotation_product_id'];
        $product_id = $data['product_id'];
        $jr_product_id = $data['jr_product_id'];
        
        
        $this->PoRawRequest->create();
        $this->PoRawRequest->set(array(
         'quotation_product_id' => $quotation_product_id,
            'jr_product_id' => $jr_product_id,
            'product_id' => $product_id,
            'user_id' => $this->Auth->user('id'),
            'qty' => $qty,
            'status' => 'pending',
            'date_needed' => $date_needed
            ));
        if($this->PoRawRequest->save()){ 
             $po_raw_request_id = $this->PoRawRequest->getLastInsertID();
             
            for ($i = 0; $i <= $counter; $i++) {
                $this->PoRawRequestProperty->create();
                $this->PoRawRequestProperty->set(array(
                    'property' => $property[$i],
                    'value' => $value[$i], 
                    'po_raw_request_id' => $po_raw_request_id
                ));
                $this->PoRawRequestProperty->save();
            }
            echo json_encode($data);
        } 
//        debug($this->PoRawRequest->validationErrors);
 
    }
}
