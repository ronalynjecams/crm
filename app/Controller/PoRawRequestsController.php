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
        $today = date("Y-m-d H:m:s");
        $data = $this->request->data;
        $id = $data['id'];
        $this->PoRawRequest->id = $id;
        $this->PoRawRequest->set(['deleted'=>$today]);
        if($this->PoRawRequest->save()) {
            echo "Po Raw Request updated deleted to today";
        }
        else {
            echo "Error in Po Raw Request update of deleted date";
        }
	}
        
    public function addProduct() {
        $this->autoRender = false;
        $data = $this->request->data;
        
        $this->loadModel('PoRawRequestProperty'); 
        $qty = $data['qty'];
        $date_needed = $data['date_needed'];
        $property  = $data['property'];
        $value = $data['value'];
        $counter = $data['counter'];
        $quotation_product_id = $data['quotation_product_id'];
        $product_id = $data['product_id'];
        $jr_product_id = $data['jr_product_id'];
        $jr_floorplan_id = $data['jr_floorplan_id'];
        $quotation_id = $data['quotation_id'];
        $client_id = $data['client_id'];
        
        
        $this->PoRawRequest->create();
        $this->PoRawRequest->set(array(
            'quotation_product_id' => $quotation_product_id,
            'quotation_id' => $quotation_id,
            'client_id' => $client_id,
            'job_request_product_id' => $jr_product_id,
            'job_request_floorplan_id' => $jr_floorplan_id,
            'jr_product_id' => 0,
            'product_id' => $product_id,
            'user_id' => $this->Auth->user('id'),
            'qty' => $qty,
            'status' => 'pending',
            'date_needed' => $date_needed
            ));
        if($this->PoRawRequest->save()){ 
             $po_raw_request_id = $this->PoRawRequest->getLastInsertID();
             
            for ($i = 0; $i <= $counter; $i++) {
                    // return json_encode($property[$i]);exit;
                $this->PoRawRequestProperty->create();
                $this->PoRawRequestProperty->set(array(
                    'property' => $property[$i],
                    'value' => $value[$i], 
                    'po_raw_request_id' => $po_raw_request_id
                ));
                
                $this->PoRawRequestProperty->save(); 
            }
            
                    return json_encode($data);
        } 
    }
    
    
    public function addRaw() {
        $this->autoRender = false;
        $data = $this->request->data;

        $this->loadModel('PoRawRequestProperty');
        $uid = $data['user_id'];
        $client_id = $data['client_id'];
        $purpose = $data['purpose'];
        $qty = $data['qty'];
        $date_needed = $data['date_needed'];
        $property = $data['property'];
        $value = $data['value'];
        $counter = $data['counter'];
        $product_id = $data['product_id'];
        $quotation_product_id = 0;
        $jr_product_id = 0;
        
        $this->PoRawRequest->create();
        $this->PoRawRequest->set(array(
            'client_id' => $client_id,
            'purpose' => $purpose,
            'quotation_product_id' => $quotation_product_id,
            'jr_product_id' => $jr_product_id,
            'product_id' => $product_id,
            'user_id' => $uid,
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
                
                if($this->PoRawRequestProperty->save()) {
                    return json_encode($data);
                }
                else {
                    return "Error in PO_RAW_REQUEST AddRaw";
                }
            }
        } 
        return json_encode($data);
    }
    
    public function list_view(){
        $status = $this->params['url']['status'];
        $this->PoRawRequest->recursive=4;
        $requests = $this->PoRawRequest->find('all',['conditions'=>['PoRawRequest.status'=>$status]]);
        // pr($requests);
        
        
        $this->loadModel('Client');
        $clients = $this->Client->find('all', array(
            'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Client.lead' => 0)
        ));
        $get_clients = $this->Client->find('all', ['conditions'=>['Client.lead' => 0],
                                                   'order'=>'Client.name ASC']);
 
        $this->loadModel('Product');
        $products = $this->Product->find('all', ['order'=>'Product.name ASC']); 

        $this->loadModel('InvLocation');
        $locations = $this->InvLocation->find('all'); 
        
        $this->loadModel('User');
        $this->User->recursive = -1;
        $get_users = $this->User->find('all', ['conditions'=>['active'=>1],
                                               'order'=>'first_name ASC']);
        
        $this->set(compact('requests', 'status', 'clients', 'products', 'locations',
                           'get_clients', 'get_users'));
    }
    
    
    public function approve_request(){
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $data = $this->request->data;
            $id = $data['id'];   
            $dateToday = date("Y-m-d H:i:s");
            
            
            $this->PoRawRequest->id = $id;
            $this->PoRawRequest->set(array(
                'status' => 'approved',
                'date_approved' => $dateToday, 
            )); 
            if ($this->PoRawRequest->save()) {
                return (json_encode($id));
            } else {
                echo json_encode('invalid data');
            }
            exit;
        }
        
    }
    
    public function cancel_product() {
        $this->autoRender = false;
        $data = $this->request->data;
        $this->PoRawRequest->save($data);
        return "Executed everything.";
    }
}
