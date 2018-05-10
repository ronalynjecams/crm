<?php
App::uses('AppController', 'Controller');
/**
 * PurchaseOrderProducts Controller
 *
 * @property PurchaseOrderProduct $PurchaseOrderProduct
 * @property PaginatorComponent $Paginator
 */
class PurchaseOrderProductsController extends AppController {

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
		$this->PurchaseOrderProduct->recursive = 0;
		$this->set('purchaseOrderProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->PurchaseOrderProduct->exists($id)) {
			throw new NotFoundException(__('Invalid purchase order product'));
		}
		$options = array('conditions' => array('PurchaseOrderProduct.' . $this->PurchaseOrderProduct->primaryKey => $id));
		$this->set('purchaseOrderProduct', $this->PurchaseOrderProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->PurchaseOrderProduct->create();
			if ($this->PurchaseOrderProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The purchase order product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchase order product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productCombos = $this->PurchaseOrderProduct->ProductCombo->find('list');
		$purchaseOrders = $this->PurchaseOrderProduct->PurchaseOrder->find('list');
		$users = $this->PurchaseOrderProduct->User->find('list');
		$supplierProducts = $this->PurchaseOrderProduct->SupplierProduct->find('list');
		$this->set(compact('productCombos', 'purchaseOrders', 'users', 'supplierProducts'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->PurchaseOrderProduct->exists($id)) {
			throw new NotFoundException(__('Invalid purchase order product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->PurchaseOrderProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The purchase order product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The purchase order product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('PurchaseOrderProduct.' . $this->PurchaseOrderProduct->primaryKey => $id));
			$this->request->data = $this->PurchaseOrderProduct->find('first', $options);
		}
		$productCombos = $this->PurchaseOrderProduct->ProductCombo->find('list');
		$purchaseOrders = $this->PurchaseOrderProduct->PurchaseOrder->find('list');
		$users = $this->PurchaseOrderProduct->User->find('list');
		$supplierProducts = $this->PurchaseOrderProduct->SupplierProduct->find('list');
		$this->set(compact('productCombos', 'purchaseOrders', 'users', 'supplierProducts'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->PurchaseOrderProduct->id = $id;
		if (!$this->PurchaseOrderProduct->exists()) {
			throw new NotFoundException(__('Invalid purchase order product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->PurchaseOrderProduct->delete()) {
			$this->Session->setFlash(__('The purchase order product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The purchase order product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
    
    public function top_purchased() {
    	$passed_dept = $this->params['url']['dept'];
        $this->set(compact('passed_dept'));
        
        $this->loadModel('Department');
        
        $depts = $this->Department->find('all', ['conditions'=>['id'=>[6,7]]]);
        $this->set(compact('depts'));
        
        $user_dept_id = $this->Auth->user('department_id'); 
        
        $this->Department->recursive = -1;
        $get_dept_of_authuser = $this->Department->findById($user_dept_id);
        $dept_of_authuser = $get_dept_of_authuser['Department']['name'];
        $this->set(compact('dept_of_authuser'));
    
    	$type1 = 'supply';
		$type2 = 'combination';
		$prod_combo_obj = [];
		$products = [];
	
    	// =========================================================================>   
 
		if($passed_dept == 6) {
        	$get_po_products = $this->PurchaseOrderProduct->find('all',
        		['conditions'=>
					['PurchaseOrder.type'=>[$type1,$type2]],
					 'fields'=>['PurchaseOrderProduct.purchase_order_id',
							'PurchaseOrderProduct.product_id',
							'PurchaseOrderProduct.product_combo_id',
							'PurchaseOrderProduct.id',
							'Product.id',
							'Product.name',
							'Product.other_info',
							'PurchaseOrderProduct.list_price',
							'PurchaseOrderProduct.qty']]);
        }
        else if($passed_dept == 7) {
        	$get_po_products = $this->PurchaseOrderProduct->find('all',
        		['conditions'=>
					['NOT'=>['PurchaseOrder.type'=>[$type1,$type2]]],
					 'fields'=>['PurchaseOrderProduct.purchase_order_id',
							'PurchaseOrderProduct.product_id',
							'PurchaseOrderProduct.product_combo_id',
							'PurchaseOrderProduct.id',
							'Product.id',
							'Product.name',
							'Product.other_info',
							'PurchaseOrderProduct.list_price',
							'PurchaseOrderProduct.qty']]);
        }
       
    	$count_for_products = 1;
        $unique_array_of_products = [];
		foreach($get_po_products as $ret_po_products) {
			$po_products_obj = $ret_po_products['PurchaseOrderProduct'];
			$prod_obj = $ret_po_products['Product'];
			$product_id = $prod_obj['id'];
			$grand_total = $po_products_obj['list_price']*$po_products_obj['qty'];
			$po_products_id = $po_products_obj['id'];
			
			if (!array_key_exists( $product_id, $unique_array_of_products )) {
				$unique_array_of_products[$product_id] = ["po_products_id"=>$po_products_id,
													      "grand_total"=>$grand_total,
													      "count"=>$count_for_products];
			} else {
				$unique_array_of_products[$product_id]['grand_total'] += $grand_total;
				$unique_array_of_products[$product_id]['count'] += $count_for_products;
			}
		}
		
		$get_product = [];
		$this->loadModel('Product');
		$this->Product->recursive = -1;
		foreach($unique_array_of_products as $i => $unique_array_of_product) {
			$get_product[] = $this->Product->findById($i, 'id, name');
		}
		
		foreach($get_product as $return_product) {
			$product_object = $return_product['Product'];
			$product_name = $product_object['name'];
			$product_id = $product_object['id'];
			
			$unique_array_of_products[$product_id]['name'] = $product_name;
		}
		
		arsort($unique_array_of_products);
    	// =========================================================================>
    	$this->set(compact('unique_array_of_products', 'get_product'));
    }
    
    // MARK: OFFLINE MODIFICATION
    public function supply_top_purchased() {
    	$type = $this->params['url']['type'];

    	$this->loadModel('PurchaseOrder');
		$pos = $this->PurchaseOrder->find('all',
			['conditions'=>
				['PurchaseOrder.type'=>$type]]);

		// =====================================================================>
		$count = 1;
        $unique_array = [];
		foreach($pos as $ret_pos) {
			$supplier = $ret_pos['Supplier'];
			$purchase_order = $ret_pos['PurchaseOrder'];
			$grand_total = $purchase_order['grand_total'];
			
			$supplier_id = $supplier['id'];
			if (!array_key_exists( $supplier_id, $unique_array )) {
				$unique_array[$supplier_id] = ["grand_total"=>$grand_total,
													      "count"=>$count];
			} else {
				$unique_array[$supplier_id]['grand_total'] += $grand_total;
				$unique_array[$supplier_id]['count'] += $count;
			}
		}
		
		$this->loadModel('Supplier');
		$this->Supplier->recursive = -1;
		$suppliers = [];
		foreach($unique_array as $i=>$unique_array_each) {
			$id = $i;
			
			$suppliers[] = $this->Supplier->findById($id, 'id, name');
		}
		
		foreach($suppliers as $return_suppliers) {
			$supplier_object_return = $return_suppliers['Supplier'];
			$supplier_name_return = $supplier_object_return['name'];
			$supplier_id_return = $supplier_object_return['id'];
			
			$unique_array[$supplier_id_return]['name'] = $supplier_name_return;
		}
		$this->set(compact('unique_array', 'type'));
		// =====================================================================>
    }
    // MARK: END OF OFFLINE MODIFICATION
    
    public function ordered_history(){
        $id = $this->params['url']['id'];
        
        $this->loadModel('Product');
        $this->Product->recursive = -1;
        $product = $this->Product->findById($id);
        // $this->PurchaseOrderProduct->recursive = 2;
        
        $po_products = $this->PurchaseOrderProduct->find('all');
        
        // pr($po_products);
        $this->set(compact('product', 'po_products'));
        // exit;
    }
    
}