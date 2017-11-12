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
        $limit = $this->params['url']['limit'];
        $passed_dept = $this->params['url']['dept'];
        $this->set(compact('passed_dept'));
        
        $this->loadModel('Department');
        $this->loadModel('Product');
        $this->loadModel('ProductCombo');
        $this->loadModel('PurchaseOrderProduct');
        
        $depts = $this->Department->find('all', ['conditions'=>['id'=>[6,7]]]);
        $this->set(compact('depts'));
        
        $user_dept_id = $this->Auth->user('department_id');
        
        $this->Department->recursive = -1;
        $get_dept_of_authuser = $this->Department->findById($user_dept_id);
        $dept_of_authuser = $get_dept_of_authuser['Department']['name'];
        $this->set(compact('dept_of_authuser'));
    
    	$type1 = 'supply';
		$type2 = 'combination';
		$this->Product->recursive = -1;
		$products = [];
		$product_combos = [];
		$po_counts = [];
        if($passed_dept == 6) {
        	$products = $this->Product->find('all', ['conditions'=>
        					['type'=>[$type1,$type2]]]);
			foreach($products as $product) {
				$product_id = $product['Product']['id'];
				$product_combos[$product_id] = $this->ProductCombo->find('all',
										['conditions'=>
										['product_id'=>$product_id]]);
				foreach($product_combos[$product_id] as $product_combo) {
					$product_combo_id = $product_combo['ProductCombo']['id'];
					$po_counts[$product_id][$product_combo_id] = $this->PurchaseOrderProduct->find('all',
										['conditions'=>
										['PurchaseOrderProduct.product_combo_id'=>$product_combo_id]]);
				}
			}
        }
        else if($passed_dept == 7) {
        	$products = $this->Product->find('all', ['conditions'=>
        					['NOT'=>['type'=>[$type1,$type2]]]]);
        }
        
        $this->set(compact('products'));
        $this->set(compact('product_combos'));
        $this->set(compact('po_counts'));
    }
}
