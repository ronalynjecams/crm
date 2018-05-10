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
		$this->loadModel('ClientServiceProduct');
		$this->loadModel('Client');
		$this->loadModel('Product');
		
		$type = $this->params['url']['type'];
		$status = $this->params['url']['status'];
		$role = $this->Auth->user('role');
		$uid = $this->Auth->user('id');
		
		if($role=="sales_executive") {
			$client_services = $this->ClientService->find('all', ['conditions'=>
															['type'=>$type,
															 'status'=>$status,
															 'agent_id'=>$uid]]);
		}
		elseif($role=="plant_manager" || $role=="supply_staff" || $role="logistics_head") {
			$client_services = $this->ClientService->find('all', ['conditions'=>
															['type'=>$type,
															 'status'=>$status]]);
		}
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
		if($role=="sales_executive") {
			$clients = $this->Client->find('all', ['conditions'=>
										['user_id'=>$user_id]]);
		}
		else {
			$clients = $this->Client->find('all');
		}
		$this->set(compact('clients'));
		
		$products = $this->Product->find('all');
		$this->set(compact('products', 'role'));
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
    	
    	$this->loadModel('ClientServiceProduct');
    	$this->loadModel('ClientServiceProperty');
    	$this->loadModel('QuotationProduct');
    	
    	$user_id = $this->Auth->user('id');
    	$data = $this->request->data;
    	$client_id = $data['client_id'];
    	$agent_id = $data['agent_id'];
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
    	$textarea_other_info = $data['textarea_other_info'];
    	
    	$expected_demo_datetime = date("Y-m-d H:m:s", strtotime($expected_demo_date." ".$expected_demo_time));
    	$expected_po_datetime = date("Y-m-d H:m:s" , strtotime($expected_po_date." ".$expected_po_time));
    	
    	$this->loadModel('Client');
    	$getClientAddress = $this->Client->findById($client_id, 'address');
    	$client_address = $getClientAddress['Client']['address'];
    	
    	$getClientService = $this->ClientService->find('all',
    						['conditions'=>['status'=>'newest',
    										'client_id'=>$client_id,
    										'type'=>'demo']]);
    	
		$client_service_id = 0;
    	if(empty($getClientService)) {
    		$DS_ClientService = $this->ClientService->getDataSource();
    		$DS_ClientService->begin();
			$this->ClientService->create();
			$this->ClientService->set(['agent_id'=>$agent_id,
									   'client_id'=>$client_id, 'type'=>$type,
									   'status'=>'newest', 'user_id'=>$user_id,
									   'service_code'=>$service_code,
									   'address'=>$client_address]);
			if($this->ClientService->save()) {
				$client_service_id = $this->ClientService->getLastInsertId();
				$this->loadModel('ClientServiceLogs');
				$DS_ClientServiceLogs = $this->ClientServiceLogs->getDatasource();
				$DS_ClientServiceLogs->begin();
				
				$client_service_logs_set = ["client_service_id"=>$client_service_id,
											"user_id"=>$user_id,
											"status"=>"newest"];
				
				$this->ClientServiceLogs->create();
				$this->ClientServiceLogs->set($client_service_logs_set);
				if($this->ClientServiceLogs->save()) {
					$DS_ClientServiceLogs->commit();
					$DS_ClientService->commit();
				}
				else {
					$DS_ClientServiceLogs->rollback();
					$DS_ClientService->rollback();
				}
			}
			else {
				$DS_ClientService->rollback();
			}
    	}
    	else {
    		foreach($getClientService as $retClientService) {
    			$ClientService_object = $retClientService['ClientService'];
    			$client_service_id = $ClientService_object['id'];
    		}
    	}
    	
		$DS_ClientServiceProduct = $this->ClientServiceProduct->getDataSource();
		$DS_ClientServiceProduct->begin();
		
		$this->ClientServiceProduct->create();
		$this->ClientServiceProduct->set(['client_service_id'=>$client_service_id,
					   'product_id'=>$product_id,
					   'quotation_product_id'=>$quotation_product_id,
					   'qty'=>$qty,
					   'product_combo_id'=>$product_combo_id,
					   'expected_demo_date'=>$expected_demo_datetime,
					   'expected_pullout_date'=>$expected_po_datetime,
					   'other_info'=>$textarea_other_info
					   ]);
		
		if($this->ClientServiceProduct->save()) {
			// echo json_encode("client_service_product saved");
			$client_service_product_id = $this->ClientServiceProduct->getLastInsertId();
			
			$DS_ClientServiceProperty = $this->ClientServiceProperty->getDataSource();
    		$DS_ClientServiceProperty->begin();
    		
    		for($c=0;$c<count($properties);$c++) {
    			$property = $properties[$c];
    			$value = $values[$c];
    			// echo json_encode($property.":".$value."----");
	    		$this->ClientServiceProperty->create();
	    		$this->ClientServiceProperty->set(
	    			['client_service_product_id'=>$client_service_product_id,
				     'property'=>$property,
				     'value'=>$value]);
	    										   
			    if($this->ClientServiceProperty->save()) {
			    	// echo json_encode("client_service_property saved");
			    	// echo json_encode($type);
			    	if($type=="Demo" && $quotation_product_id != 0) {
			    		// echo json_encode("type is demo and qpid != 0");
				    	$DS_QuotationProduct = $this->QuotationProduct->getDataSource();
				    	$DS_QuotationProduct->begin();
				    	
						$this->QuotationProduct->id = $quotation_product_id;
						
						if($this->QuotationProduct->saveField('demo',1)) {
							// echo "quotation_product updated";
							$DS_QuotationProduct->commit();
							$DS_ClientServiceProperty->commit();
							$DS_ClientServiceProduct->commit();
						}
						else {
							// echo "Error in QuotationProduct";
							$DS_ClientServiceProperty->rollback();
							$DS_ClientServiceProduct->rollback();
						}
			    	}
			    	else {
				    	$DS_ClientServiceProperty->commit();
						$DS_ClientServiceProduct->commit();
			    	}
			    }
			    else {
			    	// echo "Error in Client Service Property";
					$DS_ClientServiceProduct->rollback();
			    }
    		}
		}
		else {
			// echo "Error in ClientServiceProduct";
			$DS_ClientServiceProduct->rollback();
		}
    	
    	// DO NOT CHANGE, NEEDED FOR PULLOUT
    	return $this->ClientServiceProduct->getLastInsertId();
	}
	
	public function view() {
		$id = $this->params['url']['id'];
		$this->loadModel('ClientServiceProperty');
		$this->set(compact('status', 'id'));

		$client_service = $this->ClientService->findById($id);
		$this->set(compact('client_service'));
		
		$type = $client_service['ClientService']['type'];		
		$status = $client_service['ClientService']['status'];
		$this->set(compact('type', 'status'));
		
		$this->loadModel('ClientServiceProduct');
		$this->ClientServiceProduct->recursive = 2;
		$products = $this->ClientServiceProduct->find('all',
												 ['conditions'=>
													 ['client_service_id'=>$id]
												 ]);
		$this->set(compact('products', 'status'));
		$cs_prop = [];
		foreach($products as $perproduct) {
			$cs_prod_id = $perproduct['ClientServiceProduct']['id'];
			$this->ClientServiceProperty->recursive = -1;
			$cs_prop[$cs_prod_id][] = $this->ClientServiceProperty->findByClientServiceProductId($cs_prod_id);
		}
		
		if($type=="demo") { $ref_type="client_services"; }
		else { $ref_type="quotation"; }
		
		$this->loadModel('DeliverySchedule');
		$this->DeliverySchedule->recursive = -1;
		$getDel_Schedule = $this->DeliverySchedule->find('all',
						   ['conditions'=>
							['reference_type'=>$ref_type,
							 'reference_number'=>$id]]);
		
		$this->loadModel('Product');
		$all_products = $this->Product->find('all');
		$this->set(compact('all_products', 'getDel_Schedule', 'cs_prop'));
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
	
	public function edit_delete() {
		$this->autoRender = false;
		
		$data = $this->request->data;
		$client_service_product_id = $data['id'];
		$client_service_id = $data['client_service_id'];
		$qpid = $data['qpid'];
		$today = date("Y-m-d H:m:s");
		$userin = $this->Auth->user('id');
		
		$this->loadModel('ClientServiceProduct');
		$this->loadModel('QuotationProduct');
		
		$DS_ClientServiceProduct = $this->ClientServiceProduct->getDataSource();
		$DS_ClientServiceProduct->begin();
		
		$this->ClientServiceProduct->id = $client_service_product_id;
		$this->ClientServiceProduct->set(["status"=>"cancelled",
										  "date_deleted"=>$today]);
		if($this->ClientServiceProduct->save()) {
			$cancelled_count = 0;
			$cs_prod_count = 0;
			$get_allCS_prod = $this->ClientServiceProduct->findAllByClientServiceId($client_service_id,'status');
			foreach($get_allCS_prod as $ret_allCS_prod) {
				$CS_prod = $ret_allCS_prod['ClientServiceProduct'];
				$CS_prod_status = $CS_prod['status'];
				if($CS_prod_status=="cancelled") {
					$cancelled_count++;
				}
				$cs_prod_count++;
			}

			if($cancelled_count==$cs_prod_count) {
				$this->loadModel('ClientService');
				$DS_ClientService = $this->ClientService->getDataSource();
				$DS_ClientService->begin();
				
				$this->ClientService->id = $client_service_id;
				$this->ClientService->set(['status'=>'cancelled']);
				if($this->ClientService->save()) {
					$this->loadModel('ClientServiceLog');
					$DS_ClientServiceLog = $this->ClientServiceLog->getDataSource();
					$DS_ClientServiceLog->begin();
					$this->ClientServiceLog->create();
					$this->ClientServiceLog->set(['client_service_id'=>$client_service_id,
											      'user_id'=>$userin,
											      'status'=>'cancelled']);
					if($this->ClientServiceLog->save()) {
						$DS_QuotationProduct = $this->QuotationProduct->getDataSource();
						$DS_QuotationProduct->begin();
						
						$this->QuotationProduct->id = $qpid;
						if($this->QuotationProduct->saveField('demo',0)) {
							$DS_ClientServiceLog->commit();
							$DS_QuotationProduct->commit();
							$DS_ClientServiceProduct->commit();
							$DS_ClientService->commit();
						}
						else {
							$DS_ClientServiceLog->rollback();
							$DS_QuotationProduct->rollback();
							$DS_ClientService->rollback();
							$DS_ClientServiceProduct->rollback();
						}
					}
					else {
						$DS_ClientServiceLog->rollback();
						$DS_QuotationProduct->rollback();
						$DS_ClientService->rollback();
						$DS_ClientServiceProduct->rollback();
					}
				}
				else {
					$DS_ClientServiceProduct->rollback();
					$DS_ClientService->rollback();
				}
			}
			else {
				$DS_ClientServiceProduct->commit();
			}
		}
		else {
			$DS_ClientServiceProduct->rollback();
		}
		
		return json_encode("Successfully Cancelled");
	}
	
	public function logs() {
		$this->autoRender = false;
		
		$data = $this->request->data;
		$client_service_id = $data['client_service_id'];
		$user_id = $this->Auth->user('id');
		$status = $data['status'];
		
		$client_service_log_set = ['client_service_id'=>$client_service_id,
								   'user_id'=>$user_id,
								   'status'=>$status];
		echo json_encode($client_service_log_set);
		
		$this->loadModel('ClientServiceLog');
		$DS_ClientServiceLog = $this->ClientServiceLog->getDataSource();
		$DS_ClientServiceLog->begin();
		
		$this->ClientServiceLog->create();
		$this->ClientServiceLog->set($client_service_log_set);
		
		if($this->ClientServiceLog->save()) {
			$DS_ClientServiceLog->commit();
			return "ClientServiceLog saved";
		}
		else {
			$DS_ClientServiceLog->rollback();
			return "Error ClientServiceLog";
		}
	}
	
	public function complete() {
		$this->autoRender = false;
		
		$id = $this->request->data['id'];
		$userin = $this->Auth->user('id');
		$DS_ClientService = $this->ClientService->getDataSource();
		$DS_ClientService->begin();
		$this->ClientService->id = $id;
		$this->ClientService->set(['status'=>'pending']);
		if($this->ClientService->save()) {
			echo "ClientService saved";
			$client_service_log_set = ['client_service_id'=>$id,
									   'user_id'=>$userin,
									   'status'=>'pending'];
			
			$this->loadModel('ClientServiceLog');
			$DS_ClientServiceLog = $this->ClientServiceLog->getDataSource();
			$DS_ClientServiceLog->begin();
			$this->ClientServiceLog->create();
			$this->ClientServiceLog->set($client_service_log_set);
			if($this->ClientServiceLog->save()) {
				echo "ClientServiceLog saved";
				$DS_ClientServiceLog->commit();
				$DS_ClientService->commit();
			}
			else {
				echo "Error in ClientServiceLog";
				$DS_ClientServiceLog->rollback();
				$DS_ClientService->rollback();
			}
		}
		else {
			echo "ERROR in ClientService";
			$DS_ClientService->rollback();
		}
		
		return "Everything executed";
	}
	
	public function update_pullout() {
		$this->autoRender = false;
		$this->loadModel('ClientServiceProduct');
		$this->loadModel('ClientServiceLog');
		
		$data = $this->request->data;
		$id = $data['reference_number'];
		$userin = $this->Auth->user('id');
		$ref_prod_id = $data['reference_product_number'];
		$delivery_mode = $data['delivery_mode'];
		$expected_pullout_date = $data['expected_pullout_date'];
		$expected_pullout_time = $data['expected_pullout_time'];
		$pullout_datetime = date("Y-m-d H:m:s", strtotime($expected_pullout_date." ".$expected_pullout_time));
		
		$getClientService = $this->ClientService->findById($id);
		$ClientService = $getClientService['ClientService'];
		$status = $ClientService['status'];
		$client_service_log_set = ['client_service_id'=>$id,
								   'user_id'=>$userin,
								   'status'=>'pullout'];
		if($status=="delivered") {
			$DS_ClientServiceLog = $this->ClientServiceLog->getDataSource();
			$DS_ClientServiceLog->begin();
			$this->ClientServiceLog->create();
			$this->ClientServiceLog->set($client_service_log_set);
			if($this->ClientServiceLog->save()) {
				echo "clientservice log saved";
				$DS_ClientServiceLog->commit();
			}
			else {
				echo "error in clientservice log";
				$DS_ClientServiceLog->rollback();
			}
		}
		
		$DS_ClientService = $this->ClientService->getDataSource();
		$DS_ClientService->begin();
		
		$this->ClientService->id = $id;
		$this->ClientService->set(['type'=>'pull_out',
								   'status'=>'pullout']);
		if($this->ClientService->save()) {
			echo 'clientservice save';
			$client_service_product_set = ['status'=>'pullout',
										   'pullout_delivery_mode'=>$delivery_mode,
										   'expected_pullout_date'=>$pullout_datetime];
			$DS_ClientServiceProduct = $this->ClientServiceProduct->getDataSource();
			$DS_ClientServiceProduct->begin();
			
			$this->ClientServiceProduct->id = $ref_prod_id;
			$this->ClientServiceProduct->set($client_service_product_set);
			if($this->ClientServiceProduct->save()) {
				echo "clientserviceproduct save";
				$DS_ClientService->commit();
				$DS_ClientServiceProduct->commit();
			}
			else {
				echo "error in clientservice product";
				$DS_ClientService->rollback();
				$DS_ClientServiceProduct->rollback();
			}
		}
		else {
			echo "error in clientservice";
			$DS_ClientService->rollback();
		}
		
		return "Done executing everything.";
	}
	
	public function pulloutUpdate() {
		$this->autoRender = false;
		$id = $this->request->data;
		$userin = $this->Auth->user('id');
		$DS_ClientService = $this->ClientService->getDataSource();
		$DS_ClientService->begin();
		$this->ClientService->id = $id;
		$this->ClientService->set(['status'=>'pullout',
								   'pullout_requested'=>1]);
		
		if($this->ClientService->save()) {
			echo json_encode("ClientService save");
			$this->loadModel('ClientServiceLog');
			$DS_ClientServiceLog = $this->ClientServiceLog->getDataSource();
			$DS_ClientServiceLog->begin();
			$this->ClientServiceLog->create();
			$this->ClientServiceLog->set(['client_service_id'=>$id,
									      'user_id'=>$userin,
									      'status'=>'pullout']);
			if($this->ClientServiceLog->save()) {
				echo "ClientServiceLog saved";
				$DS_ClientService->commit();
				$DS_ClientServiceLog->commit();
			}
			else {
				echo json_encode("Error in ClientServiceLog");
				$DS_ClientService->rollback();
				$DS_ClientServiceLog->rollback();
			}
		}
		else {
			echo json_encode("Error in ClientService");
			$DS_ClientService->rollback();
		}
		
		return "Executed Everything";
	}
	
	public function update_agent_id() {
		$this->autoRender = false;
		$this->loadModel('Client');
		$getAllClientServices = $this->ClientService->find('all');
		foreach($getAllClientServices as $retAllClientServices) {
			$id = $retAllClientServices['ClientService']['id'];
			$client_id = $retAllClientServices['ClientService']['client_id'];
			$agent = $retAllClientServices['Client']['user_id'];
			$DS_ClientService = $this->ClientService->getDataSource();
			$DS_ClientService->begin();
			$this->ClientService->id = $id;
			$this->ClientService->set(['agent_id'=>$agent]);
			if($this->ClientService->save()) {
				echo "Client_id: ".$client_id."==>Agent_id: ".$agent;
				$DS_ClientService->commit();
			}
			else {
				echo "Error in ClientService";
				$DS_ClientService->rollback();
			}
		}
		
		return "Executed everything~";
	}
}