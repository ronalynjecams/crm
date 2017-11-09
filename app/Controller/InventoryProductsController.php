<?php
App::uses('AppController', 'Controller');
/**
 * InventoryProducts Controller
 *
 * @property InventoryProduct $InventoryProduct
 * @property PaginatorComponent $Paginator
 */
class InventoryProductsController extends AppController {

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
		$this->InventoryProduct->recursive = 0;
		$this->set('inventoryProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InventoryProduct->exists($id)) {
			throw new NotFoundException(__('Invalid inventory product'));
		}
		$options = array('conditions' => array('InventoryProduct.' . $this->InventoryProduct->primaryKey => $id));
		$this->set('inventoryProduct', $this->InventoryProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InventoryProduct->create();
			if ($this->InventoryProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productCombos = $this->InventoryProduct->ProductCombo->find('list');
		$invLocations = $this->InventoryProduct->InvLocation->find('list');
		$this->set(compact('productCombos', 'invLocations'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->InventoryProduct->exists($id)) {
			throw new NotFoundException(__('Invalid inventory product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InventoryProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('InventoryProduct.' . $this->InventoryProduct->primaryKey => $id));
			$this->request->data = $this->InventoryProduct->find('first', $options);
		}
		$productCombos = $this->InventoryProduct->ProductCombo->find('list');
		$invLocations = $this->InventoryProduct->InvLocation->find('list');
		$this->set(compact('productCombos', 'invLocations'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->InventoryProduct->id = $id;
		if (!$this->InventoryProduct->exists()) {
			throw new NotFoundException(__('Invalid inventory product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->InventoryProduct->delete()) {
			$this->Session->setFlash(__('The inventory product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The inventory product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function warehouse_list(){
		
		$this->loadModel('InvLocation');
		$this->loadModel('InventoryProduct');
		$this->loadModel('ProductCombo');
		$this->loadModel('Product');
		$this->loadModel('ProductComboProperty');
		

		$inv_location_id = $this->params['url']['id'];
		$this->InvLocation->recursive=4;
		$invs = $this->InvLocation->findById($inv_location_id);
		
		$this->InventoryProduct->recursive=4;
		$selected_prods = $this->ProductCombo->InventoryProduct->find('all', array(
			'conditions'=>['InventoryProduct.inv_location_id'=>$inv_location_id]
			));
			// pr($selected_prods);
		
		// foreach
		
		// $this->InventoryProduct->recursive=4;
		// $selected_prods = $this->InventoryProduct->find('all', array(
		// 	'conditions'=>['InventoryProduct.inv_location_id'=>$inv_location_id]
		// 	));

		//list all product for add product modal
		$lists_products = $this->Product->find('all');	

		$this->set(compact('invs', 'selected_prods', 'lists_products'));

	}
	
	 public function get_product_combination(){ 
    	$this->autoRender = false;
    	$this->response->type('json');
    	
    	$this->loadModel('ProductCombo');
    	
    	if ($this->request->is('ajax')) {
    	
    		$combo_id = $this->request->query['product'];
  
    		$this->ProductCombo->recursive = -1;

        	$product_combo_lists = $this->ProductCombo->find('all', ['conditions'=>['ProductCombo.product_id'=>$combo_id]]);
        	
			return json_encode($product_combo_lists);

        	exit;
    	}
    }
    
	public function update_product($id=null){
		$this->loadModel('InventoryProduct');
        
        $this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
        
        $u_id = $data['u_id'];
        $u_minstock = $data['u_minstock'];
        $u_qty = $data['u_qty'];
        $u_qtyrepair = $data['u_qtyrepair'];
        $u_qtychop = $data['u_qtychop'];
        
        $edit_TS = $this->InventoryProduct->getDataSource();
        $edit_TS->begin();
        
        $this->InventoryProduct->id = $u_id;
        
        $this->InventoryProduct->set(array(
        	'min_stock_level' => $u_minstock,
            'qty' => $u_qty,
            'qty_for_repair' => $u_qtyrepair,
            'qty_chopped' => $u_qtychop
        ));
        
        $edit_processed = $this->InventoryProduct->save();
        if($edit_processed){
            $edit_TS->commit();
            echo json_encode($u_id);
        }else{
            $edit_TS->rollback();
        }
        exit;
	}
	
	public function add_product(){
		$this->loadModel('InventoryProduct');
        $this->loadModel('ProductCombo');
        
        $this->autoRender = false;
        header("Content-type:application/json");
        $data1 = $this->request->data;
        
        $inv_location_id = $data1['inv_location_id'];
        $selected_product_combo = $data1['selected_product_combo'];
        $quantity = $data1['quantity'];
        $quantity_repair = $data1['quantity_repair'];
        $quantity_chop = $data1['quantity_chop'];
        $min_stock_level = $data1['min_stock_level'];
        
        if($this->request->is('post')){
			
			$product_TS = $this->InventoryProduct->getDataSource();
			$product_TS->begin();
			
			$this->InventoryProduct->create();
			
			$this->InventoryProduct->set(array(
				'product_combo_id' => $selected_product_combo,
				'inv_location_id' => $inv_location_id,
				'min_stock_level' => $min_stock_level,
				'qty' => $quantity,
				'qty_for_repair' => $quantity_repair,
				'qty_chopped' => $quantity_chop
            ));
            
            $save_product = $this->InventoryProduct->save();
            // $save_combo = $this->ProductCombo->save();
            
			if($save_product){
				$product_TS->commit();
				echo json_encode($this->request->data); 
			}else{
				$product_TS->rollback();
			}

		}
		
	}

	
}
