<?php
App::uses('AppController', 'Controller');
/**
 * ProductCombos Controller
 *
 * @property ProductCombo $ProductCombo
 * @property PaginatorComponent $Paginator
 */
class ProductCombosController extends AppController {

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
		$this->ProductCombo->recursive = 0;
		$this->set('productCombos', $this->Paginator->paginate());
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ProductCombo->id = $id;
		if (!$this->ProductCombo->exists()) {
			throw new NotFoundException(__('Invalid product combo'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ProductCombo->delete()) {
			$this->Session->setFlash(__('The product combo has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The product combo could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function view() {
		$product_id = $this->params['url']['id'];
		$this->set(compact('product_id'));
		
		$this->loadModel('Product');
		$this->loadModel('ProductCombo');
		$this->loadModel('Unit');
		
		$this->Product->recursive = -1;
		$product_obj = $this->Product->findById($product_id);
		$product_name = $product_obj['Product']['name'];
		$this->set(compact('product_name'));
		
		$products = $this->Product->find('all');
		$this->set(compact('products'));
		
		$product_combos = $this->ProductCombo->find('all', ['conditions'=>
												['product_id'=>$product_id]]);
		$this->set(compact('product_combos'));
		
		$units = $this->Unit->find('all');
		$this->set(compact('units'));
	}

	public function add() {
		$this->autoRender = false;
		$this->response->type('text');
		
		$data = $this->request->data;
		$product_id = $data['product_id'];
		$unit_id = $data['unit_id'];
		$prop_value_obj = $data['prop_value_obj'];
		
		$this->loadModel('ProductCombo');
		$this->loadModel('ProductComboProperty');
		
		$product_combos = $this->ProductCombo->find('all', ['conditions'=>
												['product_id'=>$product_id]]);
		$existing = [];
		$ordering = [];
		
		foreach($product_combos as $product_combo) {
			$existing_tmp=[];
			
			$ordering[] = $product_combo['ProductCombo']['ordering'];
			
			foreach($product_combo["ProductComboProperty"] as $product_combo_prop) {
				$existing_prop = $product_combo_prop["property"];
				$existing_val = $product_combo_prop["value"];
				
				$existing_tmp[] = $existing_prop.":".$existing_val;
			}
			$existing[] = $existing_tmp;
		}
		
		if(count($ordering)!=0) {
			$last_ordering = max($ordering);
		}
		else {
			$last_ordering = 0;
		}
		
		$append_ordering = $last_ordering+1;
		echo json_encode($append_ordering);
		
		$current = [];
		foreach($prop_value_obj['prodcombo'] as $prop_value) {
			$current_prop = strtolower($prop_value['prodcombo_prop']);
			$current_val = strtolower($prop_value['prodcombo_val']);
			
			$current[] = ($current_prop.":".$current_val);
		}
		
		$check_array = [];
		foreach($existing as $each_existing) {
			$check_array[] = ($current == $each_existing);
		}
		
		if(count($check_array)!=0) {
			$check_result = in_array(true, $check_array, TRUE);
		}
		else {
			$check_result = false;
		}
		
		if ($check_result) {
			$this->Session->setFlash('This combination already exists.',
			'default', array('class' => 'alert alert-danger'), 'alertforexisting');
			
			echo json_encode("This combination already exists.");
		}
		else {
			$DS_ProductCombo = $this->ProductCombo->getDataSource();
			$DS_ProductCombo->begin();
			
			$this->ProductCombo->create();
			$this->ProductCombo->set(['product_id'=>$product_id,
									'ordering'=>$append_ordering,
									'unit_id'=>$unit_id]);
			
			if ($this->ProductCombo->save()){
				$product_combo_id = $this->ProductCombo->getLastInsertId();
				echo json_encode("prodcombo id ".$product_combo_id);
				
				$DS_ProductComboProperty = $this->ProductComboProperty->getDataSource();
				$DS_ProductComboProperty->begin();
				
				$this->ProductComboProperty->recursive = -1;
				$properties_values = $this->ProductComboProperty->find('all',
											['conditions'=>
											['product_combo_id'=>$product_id]]);
				foreach($prop_value_obj['prodcombo'] as $prop_value) {
					$current_prop = strtolower($prop_value['prodcombo_prop']);
					$current_val = strtolower($prop_value['prodcombo_val']);
					
					$this->ProductComboProperty->create();
					$this->ProductComboProperty->set(['product_combo_id'=>$product_combo_id,
													'property'=>$current_prop,
													'value'=>$current_val]);
													
					if($this->ProductComboProperty->save()) {
						$DS_ProductComboProperty->commit();
						$DS_ProductCombo->commit();
					}
					else {
						$DS_ProductCombo->rollback();
					}
				}
			}
			
			$DS_ProductComboProperty->commit();
			$DS_ProductCombo->commit();
		}
		
		return json_encode("Everything was executed");
		exit;
	}
	
	public function remove() {
		$this->autoRender = false;
		$this->response->type('json');
		
		$this->loadModel('ProductCombo');
		$this->loadModel('ProductComboProperty');
		
		$data = $this->request->data;
		$ordering = $data['ordering'];
		$id_str = $data['id'];
		$ids = explode(",", rtrim($id_str, ','));
		
		$this->ProductCombo->recursive = -1;
		$product_combo_ids = $this->ProductCombo->find('all', ['conditions'=>
							['ordering'=>$ordering]]);
		foreach ($product_combo_ids as $product_combo_id) {
			$product_combo_id = $product_combo_id['ProductCombo']['id'];
		}
		echo json_encode($product_combo_id);
		
		$DS_ProductComboProperty = $this->ProductComboProperty->getDataSource();
		$DS_ProductComboProperty->begin();
		
		$DS_ProductCombo = $this->ProductCombo->getDataSource();
		$DS_ProductCombo->begin();
		
		foreach($ids as $id) {
			$this->ProductComboProperty->id = $id;
			if($this->ProductComboProperty->delete()):
				echo json_encode("Deleted prop");
				$this->ProductCombo->id = $product_combo_id;
				if($this->ProductCombo->delete()) {
					echo json_encode("Deleted combo");
					$DS_ProductCombo->commit();
					$DS_ProductComboProperty->commit();
				}
				else {
					$DS_ProductComboProperty->rollback();
				}
			else:
				$DS_ProductComboProperty->rollback();
			endif;
		}
		
		$DS_ProductComboProperty->commit();
		$DS_ProductCombo->commit();
		
		return json_encode("Everything was executed");
	}
	
	public function edit() {
		$prod_combo_id = $this->params['url']['id'];
		$this->set(compact('prod_combo_id'));
		
		$this->loadModel('ProductCombo');
		$this->loadModel('Unit');
		
		$prod_combo = $this->ProductCombo->findById($prod_combo_id);
		$this->set(compact('prod_combo'));
		
		$units = $this->Unit->find('all');
		$this->set(compact('units'));
	}

	public function update() {
		$this->autoRender = false;
		$this->response->type('text');
		
		$data = $this->request->data;
		$prod_combo_id = $data['id'];
		$prod_id = $data['product_id'];
		$unit_id = $data['unit_id'];
		$prop_value_obj = $data['prop_value_obj'];
		$prod_combo_id = $data['id'];
		
		$this->loadModel('ProductComboProperty');
		$this->loadModel('ProductCombo');
		
		$this->ProductComboProperty->recursive = -1;
		$prod_combo_prop = $this->ProductComboProperty->find('all',
							['conditions'=>['product_combo_id'=>$prod_combo_id]]);
		
		// 1. format current properties and values for comparing later
		foreach($prop_value_obj as $prop_value) {
			foreach($prop_value as $each_prop_value) {
				$current[] = $each_prop_value['prodcombo_prop'].":".$each_prop_value['prodcombo_val'];
			}
		}
		//end of 1
		
		// 2. get existing
		$product_combos = $this->ProductCombo->find('all', ['conditions'=>
												['product_id'=>$prod_id]]);
		$existing = [];
		$ordering = [];
		
		foreach($product_combos as $product_combo) {
			$existing_tmp=[];
			
			$ordering[] = $product_combo['ProductCombo']['ordering'];
			
			foreach($product_combo["ProductComboProperty"] as $product_combo_prop) {
				$existing_prop = $product_combo_prop["property"];
				$existing_val = $product_combo_prop["value"];
				
				$existing_tmp[] = $existing_prop.":".$existing_val;
			}
			$existing[] = $existing_tmp;
		}
		// end of 2
		
		// 3. check if existing
		$check_array = [];
		foreach($existing as $each_existing) {
			$check_array[] = ($current == $each_existing);
		}
		
		if(count($check_array)!=0) {
			$check_result = in_array(true, $check_array, TRUE);
		}
		else {
			$check_result = false;
		}
		// end of 3
		
		if($check_result) {
			$this->Session->setFlash('This combination already exists.',
			'default', array('class' => 'alert alert-danger'), 'alertforexisting');
			
			echo json_encode("This combination already exists.");
			return json_encode("existing");
		}
		else {
			// delete existing prodcomboprop
			$DS_ProductComboProperty = $this->ProductComboProperty->getDataSource();
			$DS_ProductComboProperty->begin();
			
			foreach($prod_combo_prop as $each_prop) {
				$each_prop_id = $each_prop['ProductComboProperty']['id'];
				
				$this->ProductComboProperty->delete($each_prop_id);
			}
			
			foreach($prop_value_obj as $prop_value) {
				foreach($prop_value as $each_prop_value) {
					$prop = $each_prop_value['prodcombo_prop'];
					$val = $each_prop_value['prodcombo_val'];
					
					$this->ProductComboProperty->create();
					$this->ProductComboProperty->set(['product_combo_id'=>$prod_combo_id,
							'property'=>$prop, 'value'=>$val]);
					if($this->ProductComboProperty->save()) {
						$DS_ProductComboProperty->commit();
					}
					else {
						$DS_ProductComboProperty->rollback();
					}
				}
			}
			return json_encode("success");
		}
		$DS_ProductComboProperty->commit();
	}
}