<?php
App::uses('AppController', 'Controller');
/**
 * SupplierProducts Controller
 *
 * @property SupplierProduct $SupplierProduct
 * @property PaginatorComponent $Paginator
 */
class SupplierProductsController extends AppController {

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
		$this->SupplierProduct->recursive = 0;
		$this->set('supplierProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->SupplierProduct->exists($id)) {
			throw new NotFoundException(__('Invalid supplier product'));
		}
		$options = array('conditions' => array('SupplierProduct.' . $this->SupplierProduct->primaryKey => $id));
		$this->set('supplierProduct', $this->SupplierProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->SupplierProduct->create();
			if ($this->SupplierProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The supplier product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productCombos = $this->SupplierProduct->ProductCombo->find('list');
		$suppliers = $this->SupplierProduct->Supplier->find('list');
		$this->set(compact('productCombos', 'suppliers'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->SupplierProduct->exists($id)) {
			throw new NotFoundException(__('Invalid supplier product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->SupplierProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The supplier product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The supplier product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('SupplierProduct.' . $this->SupplierProduct->primaryKey => $id));
			$this->request->data = $this->SupplierProduct->find('first', $options);
		}
		$productCombos = $this->SupplierProduct->ProductCombo->find('list');
		$suppliers = $this->SupplierProduct->Supplier->find('list');
		$this->set(compact('productCombos', 'suppliers'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->SupplierProduct->id = $id;
		if (!$this->SupplierProduct->exists()) {
			throw new NotFoundException(__('Invalid supplier product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->SupplierProduct->delete()) {
			$this->Session->setFlash(__('The supplier product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The supplier product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
        
        
    public function all_list() {
        $id = $this->params['url']['id'];
        $this->loadModel('Supplier');
        $this->loadModel('Product');
        $this->loadModel('ProductCombo');

        $supplier = $this->Supplier->findById($id); 

        $this->SupplierProduct->recursive=4;
        $products = $this->SupplierProduct->find('all', array(
            'conditions'=>array('SupplierProduct.supplier_id' => $id)
        ));
          
        $this->Product->recursive=4;
        $prods = $this->Product->find('all', array(
            'conditions' => array('Product.type' => array('supply', 'combi', 'chopped')),
            'fields'=>array('Product.id','Product.name')
        )); 
        
        
        $this->set(compact('supplier','products', 'prods'));
        
    		
    		
    		
    }
    
    public function get_product_combination(){ 
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $this->loadModel('ProductCombo');
            $id = $this->request->query['id'];
            
            $this->ProductCombo->recursive = 2;
            $product = $this->ProductCombo->findAllByProductId($id);
            return (json_encode($product));
            exit;
        }
    }
    
    
    public function check_supplier_product(){
        
        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $this->loadModel('Product');
            $data = $this->request->query['data'];
            $check = $this->SupplierProduct->find('all',array(
                'conditions'=>array(
                    'SupplierProduct.supplier_id'=>$data['supplier_id'],
                    'SupplierProduct.product_combo_id'=>$data['product_combo_id'],
                    )));
            if(count($check)==0){
                echo json_encode('ok');
            }else{
                echo json_encode('exist');
            }
            
        }
        exit;
    }
    
    
    public function get_product_combo_properties() {

        $this->autoRender = false;
        $this->response->type('json');
        if ($this->request->is('ajax')) {
            $product_combo_id = $this->request->query['id'];

            $this->loadModel('ProductComboProperty');

            $product_combo_props = $this->ProductComboProperty->find("all", array(
                'conditions' => array(
                    'ProductComboProperty.product_combo_id' => $product_combo_id
            )));
            return json_encode($product_combo_props);
            exit;
        }
    }
    
    public function add_new_supplier_product(){
        $this->autoRender = false;
        $data = $this->request->data;
     
        $price = $data['price'];
        $product_id = $data['product_id'];
        $product_combo_id = $data['product_combo_id'];
        $code = $data['code'];  
        $note = $data['note']; 
        $supplier_id = $data['supplier_id']; 
        $this->SupplierProduct->create();
        $this->SupplierProduct->set(array(
            'product_combo_id' => $product_combo_id,
            'supplier_id' => $supplier_id,
            'note' => $note,
            'supplier_code' => $code,
            'supplier_price' => $price,
        ));
        if ($this->SupplierProduct->save()) {
            echo json_encode('ok');
        }
    }
    
    
    public function edit_supplier($id = null){
        
        $this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
        
        $u_id = $data['u_id'];
        $usupplier_code = $data['usupplier_code'];
        $usupplier_price = $data['usupplier_price'];
        $unote = $data['unote'];
        
        
        $editds_TS = $this->SupplierProduct->getDataSource();
        $editds_TS->begin();
        
        $this->SupplierProduct->id = $u_id;
        
        $this->SupplierProduct->set(array(
            "supplier_code" => $usupplier_code,
            "supplier_price" => $usupplier_price,
            "note" => $unote
        ));
        
        $edit_supplier = $this->SupplierProduct->save();
        if($edit_supplier){
            $editds_TS->commit();
            echo json_encode($u_id);
            
        }else{
            $editds_TS->rollback();
        }
        exit;
    }
    
    public function delete_supplier($id = null){
        $this->loadModel('PurchaseOrderProduct');
     	$this->autoRender = false;
        header("Content-type:application/json");
        
        $delete_TS = $this->SupplierProduct->getDataSource();
        $delete_TS->begin();
        
        $data = $this->request->data;
         
        $id = $data['id'];
        $combiid = $data['combiid'];
        
        $chk_productid= $this->PurchaseOrderProduct->find('first', 
        [
            "conditions" => ['PurchaseOrderProduct.product_combo_id'=>$combiid]
        ]
        );
        
		if($this->request->is('post', 'put')){
		    
		  if(!$chk_productid){
		    
			$this->SupplierProduct->id = $id;
			     
			$del_supplier = $this->SupplierProduct->delete();   
			if ($del_supplier) {
				$delete_TS->commit();
				echo json_encode($id);
			}else{
				$delete_TS->rollback();
			} 
	        
		    }else{
		        //echo record exist
		    }
		}
    }
    
}
