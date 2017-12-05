<?php
App::uses('AppController', 'Controller');
/**
 * ClientServices Controller
 *
 * @property ClientService $ClientService
 * @property PaginatorComponent $Paginator
 */
class ClientServicesController extends AppController {

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
		$this->ClientService->recursive = 0;
		$this->set('clientServices', $this->Paginator->paginate());
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ClientService->create();
			if ($this->ClientService->save($this->request->data)) {
				$this->Session->setFlash(__('The client service has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client service could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$clients = $this->ClientService->Client->find('list');
		$users = $this->ClientService->User->find('list');
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
		if (!$this->ClientService->exists($id)) {
			throw new NotFoundException(__('Invalid client service'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ClientService->save($this->request->data)) {
				$this->Session->setFlash(__('The client service has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The client service could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('ClientService.' . $this->ClientService->primaryKey => $id));
			$this->request->data = $this->ClientService->find('first', $options);
		}
		$clients = $this->ClientService->Client->find('list');
		$users = $this->ClientService->User->find('list');
		$this->set(compact('clients', 'users'));
	}
	
	public function all_lists() {
		$this->loadModel('ClientService');
		$this->loadModel('ClientServiceProduct');
		$this->loadModel('Client');
		$this->loadModel('Product');
		
		$type = $this->params['url']['type'];
		$status = $this->params['url']['status'];
		
		$client_services = $this->ClientService->find('all', ['conditions'=>
														['type'=>$type,
														'status'=>$status]]);
		$this->set(compact('type', 'status', 'client_services'));
		
		$cs_prods = [];
		foreach($client_services as $client_service) {
			$client_service_id = $client_service['ClientService']['id'];
			$this->ClientServiceProduct->recursive = -1;
			$cs_prods[$client_service_id] = $this->ClientServiceProduct->find('all', ['conditions'=>
										 ['client_service_id'=>$client_service_id],
										 'fields'=>['expected_demo_date',
												     'expected_pullout_date',
												     'pullout_date']]);
		}
		$this->set(compact('cs_prods'));
		
		$user_id = $this->Auth->user('id');
		$clients = $this->Client->find('all', ['conditions'=>
									['user_id'=>$user_id]]);
		$this->set(compact('clients'));
		
		$products = $this->Product->find('all');
		$this->set(compact('products'));
	}
	
	public function get_prod_combo() {
		$this->autoRender = false;
    	$this->response->type('json');
		
		$this->loadModel('ProductCombo');
		
		if ($this->request->is('ajax')) {
			$product_id = $this->request->query['id'];
			$this->ProductCombo->recursive = 1;
			$product_combos = $this->ProductCombo->find('all', ['conditions'=>
													 ['product_id'=>$product_id],
													  'fields'=>['ProductCombo.id',
																 'ProductCombo.ordering',
																 'Product.name']]);
			
			return json_encode($product_combos);
		}
	}
	
	public function get_prod_combo_prop() {
		$this->autoRender = false;
    	$this->response->type('json');
		
		$this->loadModel('ProductComboProperty');
		
		if ($this->request->is('ajax')) {
			$product_combo_id = $this->request->query['id'];
			$this->ProductComboProperty->recursive = -1;
			$product_combo_props = $this->ProductComboProperty->find('all',
										 ['conditions'=>
										 ['product_combo_id'=>$product_combo_id]]);
			
			return json_encode($product_combo_props);
		}
	}
	
	public function add_demo_or_su() {
		$this->autoRender = false;
    	$this->response->type('json');
    	
    	$this->loadModel('ClientService');
    	$this->loadModel('ClientServiceProduct');
    	$this->loadModel('ClientServiceProperty');
    	$this->loadModel('QuotationProduct');
    	
    	$user_id=$this->Auth->user('id');
    	$data = $this->request->data;
    	$client_id = $data['client_id'];
    	$type = $data['type'];
    	$status = $data['status'];
    	$service_code = $data['service_code'];
    	$product_id = $data['product_id'];
    	$properties = $data['property'];
    	$values = $data['value'];
    	$quotation_product_id = $data['quotation_product_id'];
    	$qty = $data['qty'];
    	$product_combo_id = $data['product_combo_id'];
    	$expected_po_date = $data['expected_pull_out_date'];
    	$expected_demo_date = $data['expected_delivery_date'];
    	$expected_po_time = $data['expected_pull_out_time'];
    	$expected_demo_time = $data['expected_delivery_time'];
    	
    	$expected_demo_datetime = date("Y-m-d H:m:s", strtotime($expected_demo_date." ".$expected_demo_time));
    	$expected_po_datetime = date("Y-m-d H:m:s" , strtotime($expected_po_date." ".$expected_po_time));
    	
    	echo json_encode($expected_po_datetime);
    	echo json_encode($expected_po_datetime);
    	
    	$DS_ClientService = $this->ClientService->getDataSource();
    	$DS_ClientService->begin();
    	
    	$this->ClientService->create();
    	$this->ClientService->set(['client_id'=>$client_id, 'type'=>$type,
    							   'status'=>$status, 'user_id'=>$user_id,
    							   'service_code'=>$service_code]);
    	if($this->ClientService->save()) {
    		echo json_encode("client_service saved");
    		$client_service_id = $this->ClientService->getLastInsertId();
    		
			$DS_ClientServiceProduct = $this->ClientServiceProduct->getDataSource();
			$DS_ClientServiceProduct->begin();
			
			$this->ClientServiceProduct->create();
			$this->ClientServiceProduct->set(['client_service_id'=>$client_service_id,
						   'product_id'=>$product_id,
						   'quotation_product_id'=>$quotation_product_id,
						   'qty'=>$qty,
						   'product_combo_id'=>$product_combo_id,
						   'expected_demo_date'=>$expected_demo_datetime,
						   'expected_pullout_date'=>$expected_po_datetime
						   ]);
			
			if($this->ClientServiceProduct->save()) {
				echo json_encode("client_service_product saved");
				$client_service_product_id = $this->ClientServiceProduct->getLastInsertId();
				
				$DS_ClientServiceProperty = $this->ClientServiceProperty->getDataSource();
	    		$DS_ClientServiceProperty->begin();
	    		
	    		for($c=0;$c<count($properties);$c++) {
	    			$property = $properties[$c];
	    			$value = $values[$c];
	    			echo json_encode($property.":".$value."----");
		    		$this->ClientServiceProperty->create();
		    		$this->ClientServiceProperty->set(
		    			['client_service_product_id'=>$client_service_product_id,
					     'property'=>$property,
					     'value'=>$value]);
		    										   
				    if($this->ClientServiceProperty->save()) {
				    	echo json_encode("client_service_property saved");
				    	echo json_encode($type);
				    	if($type=="Demo" && $quotation_product_id != 0) {
				    		echo json_encode("type is demo and qpid != 0");
					    	$DS_QuotationProduct = $this->QuotationProduct->getDataSource();
					    	$DS_QuotationProduct->begin();
					    	
							$this->QuotationProduct->id = $quotation_product_id;
							
							if($this->QuotationProduct->saveField('demo',1)) {
								echo json_encode("quotation_product updated");
								$DS_QuotationProduct->commit();
								$DS_ClientServiceProperty->commit();
								$DS_ClientServiceProduct->commit();
						    	$DS_ClientService->commit();
							}
							else {
								$DS_ClientServiceProperty->rollback();
								$DS_ClientServiceProduct->rollback();
						    	$DS_ClientService->rollback();
							}
				    	}
				    	else {
					    	$DS_ClientServiceProperty->commit();
							$DS_ClientServiceProduct->commit();
					    	$DS_ClientService->commit();
				    	}
				    }
				    else {
						$DS_ClientServiceProduct->rollback();
				    	$DS_ClientService->rollback();
				    }
	    		}
			}
			else {
				echo json_encode("rollback clientServices and client_service_product");
				$DS_ClientServiceProduct->rollback();
				$DS_ClientService->rollback();
			}
    	}
    	
    	$DS_ClientService->commit();
    	
    	return json_encode("Everything was executed");
	}
	
	public function view() {
		$id = $this->params['url']['id'];
		$status = $this->params['url']['status'];
		
		$this->set(compact('status', 'id'));
		
		$this->loadModel('ClientServie');
		$this->ClientService->recursive = -1;
		$client_service = $this->ClientService->find('all', ['conditions'=>
												['id'=>$id]],
												['fields'=>['type']]);
		$type = $client_service[0]['ClientService']['type'];
		$this->set(compact('type'));
		
		$this->loadModel('ClientServiceProduct');
		
		$products = $this->ClientServiceProduct->find('all', ['conditions'=>
												 ['client_service_id'=>$id]]);
		if(!empty($products)) {
			$product = $products[0]['Product'];
			$product_id = $products[0]['Product']['id'];
			$qpid = $products[0]['ClientServiceProduct']['quotation_product_id'];
		}
		else {
			$product = [];
			$product_id = 0;
			$qpid = 0;
		}
		$this->set(compact('product', 'qpid'));
		
		$this->loadModel('ProductCombo');
		$this->ProductCombo->recursive = -1;
		$product_combos = $this->ProductCombo->find('all', ['conditions'=>
											  ['product_id'=>$product_id]]);
	    
	    $this->loadModel('ProductComboProperty');
	    $this->ProductComboProperty->recursive = -1;
	    $prod_combo_prop = [];
		foreach($product_combos as $product_combo) {
			$product_combo_id = $product_combo['ProductCombo']['id'];
			
			$prod_combo_prop[] = $this->ProductComboProperty->find('all',
								 ['conditions'=>
								 ['product_combo_id'=>$product_combo_id]]);
		}
		
		$this->set(compact('prod_combo_prop'));
		
		$this->loadModel('ClientService');
		$this->loadModel('Client');
		$this->loadModel('Product');

		$AP_user_id = $this->Auth->user('id');
		$AP_clients = $this->Client->find('all', ['conditions'=>
									['user_id'=>$AP_user_id]]);
		$this->set(compact('AP_clients'));
		
		$AP_products = $this->Product->find('all');
		$this->set(compact('AP_products'));
	}
	
	public function cancel() {
		$this->autoRender = false;
		$this->response->type('text');
	
		$client_services_id = $this->request->query['id'];
		
		$this->loadModel('ClientService');
		$this->ClientService->id = $client_services_id;
		$this->ClientService->set(['status'=>'cancelled']);
		if($this->ClientService->save()) {
			return json_encode("Successfully Cancelled");
		}
	}
	
	public function done() {
		$this->autoRender = false;
		$this->response->type('text');
	
		$client_services_id = $this->request->query['id'];
		
		$this->loadModel('ClientService');
		$this->ClientService->id = $client_services_id;
		$this->ClientService->set(['status'=>'pending']);
		if($this->ClientService->save()) {
			return json_encode("Successfully Added");
		}
	}
	
	public function delete() {
		$this->autoRender = false;
		$this->response->type('text');
		
		$client_service_id = $this->request->query['id'];
		$qpid = $this->request->query['qpid'];
		
		$this->loadModel('ClientService');
		$this->loadModel('QuotationProduct');
		
		$DS_ClientService = $this->ClientService->getDataSource();
		$DS_ClientService->begin();
		
		$this->ClientService->id = $client_service_id;
		if($this->ClientService->saveField("status", "cancelled")) {
			$DS_QuotationProduct = $this->QuotationProduct->getDataSource();
			$DS_QuotationProduct->begin();
			
			$this->QuotationProduct->id = $qpid;
			if($this->QuotationProduct->saveField('demo',0)) {
				$DS_QuotationProduct->commit();
				$DS_ClientService->commit();
			}
			else {
				$DS_ClientService->rollback();
			}
			
		}
		
		$DS_ClientService->commit();
		return json_encode("Successfully Cancelled");
	}
}
