<?php
App::uses('AppController', 'Controller');
/**
 * InventoryTransactions Controller
 *
 * @property InventoryTransaction $InventoryTransaction
 * @property PaginatorComponent $Paginator
 */
class InventoryTransactionsController extends AppController {

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
		$this->InventoryTransaction->recursive = 0;
		$this->set('inventoryTransactions', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InventoryTransaction->exists($id)) {
			throw new NotFoundException(__('Invalid inventory transaction'));
		}
		$options = array('conditions' => array('InventoryTransaction.' . $this->InventoryTransaction->primaryKey => $id));
		$this->set('inventoryTransaction', $this->InventoryTransaction->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InventoryTransaction->create();
			if ($this->InventoryTransaction->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory transaction has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory transaction could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$clients = $this->InventoryTransaction->Client->find('list');
		$users = $this->InventoryTransaction->User->find('list');
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
		if (!$this->InventoryTransaction->exists($id)) {
			throw new NotFoundException(__('Invalid inventory transaction'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InventoryTransaction->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory transaction has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory transaction could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('InventoryTransaction.' . $this->InventoryTransaction->primaryKey => $id));
			$this->request->data = $this->InventoryTransaction->find('first', $options);
		}
		$clients = $this->InventoryTransaction->Client->find('list');
		$users = $this->InventoryTransaction->User->find('list');
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
		$this->InventoryTransaction->id = $id;
		if (!$this->InventoryTransaction->exists()) {
			throw new NotFoundException(__('Invalid inventory transaction'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->InventoryTransaction->delete()) {
			$this->Session->setFlash(__('The inventory transaction has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The inventory transaction could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	
	public function all_list($status = null){
		
		$this->loadModel('InventoryStatus');
		$this->loadModel('InvLocation');
		$this->loadModel('User');
		$this->InventoryStatus->recursive = -1;
		$this->InvLocation->recursive = -1;
		$this->User->recursive = -1;
		$inv_statuses = $this->InventoryStatus->find('all', ['conditions' => ['name !=' => 'upcoming']]);
		$inv_locations = $this->InvLocation->find('all');
		$users = $this->User->find('all');
		
		$this->set(compact('status', 'inv_statuses', 'inv_locations', 'users'));
		$options = [];
		
		
		// $options['conditions'] = ['InventoryTransaction.id' => 13];
		// $options['contain'] = ['Client','Product','User','PurchaseOrderProduct' => ['SupplierProduct' => 'Supplier']];
		// // $this->InventoryTransaction->recursive = 2;
		// pr($this->InventoryTransaction->find('all', $options));
		// exit;
	}
	
	public function all_list_ajax(){
		// dont change
		$page =  $this->request->data['RecordsStart'];
		$limit =  $this->request->data['PageSize'];
		$search =  $this->request->data['Search'];
		$order =  $this->request->data['Order'];
		$status =  $this->request->data['status'];
		// dont change
		
		// include only the fields that needs to be searched.
		// Make sure that the field will be included on your find statement
		$fields_for_search = ['Product.name', 'InventoryTransaction.request_qty', 'User.first_name', 'User.last_name'];
		// include only the fields that are shown on the view.
		// as much as possible all fields that whats on the view side should be on DB. else disable sorting of that field
		$fields_for_order = ['Product.name', 'InventoryTransaction.request_qty', '', 'User.fullname'];
		
		//additional conditions
		$options['conditions'] = ['InventoryTransaction.status' => $status];
		$options['contain'] = ['Client','Product','User','PurchaseOrderProduct'=> ['SupplierProduct' => 'Supplier']];
		//additional conditions
		
		// for all
		$data_all = $this->InventoryTransaction->find('all', $options);

        // dont change
		if($search != ""){
			foreach($fields_for_search as $k){
				$options['conditions']['OR'][] = [$k.' LIKE' => '%'.$search.'%'];
				
			}
			
		}
		
		if($order != null){
			$options['order'] = $fields_for_order[$order['column']].' '.$order['dir'];
		}
		// dont change
		
		
		// for filtered
		$data_filtered = $this->InventoryTransaction->find('all', $options);
		
		// pr($data_filtered); exit;
		// dont change
		$options['limit'] = $limit;
		$options['page'] = ceil(($page / $limit)) + 1;
		// dont change
		
		// $this->InventoryTransaction->recursive = -1;
		$this->Paginator->settings = $options;
		$results = $this->Paginator->paginate('InventoryTransaction');
		
		$data = [];
		foreach($results as $key => $result){
		   
			$data[$key]['name'] =  htmlspecialchars($result['Product']['name']);
			
			$data[$key]['qty'] = htmlspecialchars($result['InventoryTransaction']['request_qty']);
			$data[$key]['supplier'] = htmlspecialchars($result['PurchaseOrderProduct']['SupplierProduct']['Supplier']['name']);
			$data[$key]['fullname'] =  htmlspecialchars($result['User']['fullname']);
			$data[$key]['action'] = '<a class="btn btn-sm btn-info inventory_action"
										data-toggle="tooltip"
										data-placement="top" title="'.ucfirst($status).'"
										data-inv_trans_id="'.$result['InventoryTransaction']['id'].'"
										data-inv_trans_qty="'.$result['InventoryTransaction']['request_qty'].'"
										data-product_name="'.htmlspecialchars($result['Product']['name']).'">
										<span class="fa fa-book"></span>
									</a>';
			
		}
		// change only the value
		$return_data['Data'] = $data;
		$return_data['TotalRecords'] = count($data_all);
		$return_data['RecordsFiltered'] = count($data_filtered);
		
		$this->set('data', $return_data);
		$this->set('_serialize', 'data');
		// change only the value
	}
}
