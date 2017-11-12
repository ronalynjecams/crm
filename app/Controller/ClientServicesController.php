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

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ClientService->id = $id;
		if (!$this->ClientService->exists()) {
			throw new NotFoundException(__('Invalid client service'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ClientService->delete()) {
			$this->Session->setFlash(__('The client service has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The client service could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function all_lists() {
		$this->loadModel('ClientService');
		$this->loadModel('Client');
		$this->loadModel('Product');
		
		$type = $this->params['url']['type'];
		$status = $this->params['url']['status'];
		
		$client_services = $this->ClientService->find('all', ['conditions'=>
														['type'=>$type,
														'status'=>$status]]);
		$this->set(compact('type', 'status', 'client_services'));
		
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
			$this->ProductCombo->recursive = -1;
			$product_combos = $this->ProductCombo->find('all', ['conditions'=>
													 ['product_id'=>$product_id]]);
			
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
    		
    	$DS_ClientService = $this->ClientService->getDataSource();
    	$DS_ClientService->begin();
    	
    	$this->ClientService->create();
    	$this->ClientService->set(['client_id'=>$client_id, 'type'=>$type,
    							   'status'=>$status, 'user_id'=>$user_id,
    							   'service_code'=>$service_code]);
    	if($this->ClientService->save()) {
    		$client_service_id = $this->ClientService->getLastInsertId();
    		
			$DS_ClientServiceProduct = $this->ClientServiceProduct->getDataSource();
			$DS_ClientServiceProduct->begin();
			
			$this->ClientServiceProduct->create();
			$this->ClientServiceProduct->set(['product_id'=>$product_id,
						   'quotation_product_id'=>$quotation_product_id,
						   'qty'=>$qty,
						   'product_combo_id'=>$product_combo_id,
						   'expected_pullout_date'=>$expected_po_date
						   ]);
						   
			if($this->ClientServiceProduct->save()) {
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
				    	$DS_ClientServiceProperty->commit();
						$DS_ClientServiceProduct->commit();
				    	$DS_ClientService->commit();
				    }
				    else {
						$DS_ClientServiceProduct->rollback();
				    	$DS_ClientService->rollback();
				    }
	    		}
			}
			else {
				$DS_ClientServiceProduct->rollback();
				$DS_ClientService->rollback();
			}
    	}
    	
    	$DS_ClientService->commit();
    	
    	return json_encode($data);
	}
	
	public function view() {
		$id = $this->params['url']['id'];
		$status = $this->params['url']['status'];
		
		$this->set(compact('status', 'id'));
		
		$this->loadModel('ClientServiceProduct');
		
		$products = $this->ClientServiceProduct->find('all', ['conditions'=>
												 ['client_service_id'=>$id]]);
		if(!empty($products)) {
			$product = $products[0]['Product'];
			$product_id = $products[0]['Product']['id'];
		}
		else {
			$product = [];
			$product_id = 0;
		}
		$this->set(compact('product'));
		
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
	}
	
	public function cancel() {
		$this->autoRender = false;
		$this->response->type('text');
		
		$id = $this->request->query;
		echo json_encode($id);
		return json_encode("this");
	}
}
