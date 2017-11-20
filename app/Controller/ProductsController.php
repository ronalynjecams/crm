<?php
App::uses('AppController', 'Controller');
/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class ProductsController extends AppController {

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
		$this->Product->recursive = 0;
		$products = $this->Product->find('all');
		$this->set(compact('products'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		$this->loadModel('Category');
		$categories = $this->Category->find('all');
		$this->set(compact('categories'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('The product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => '/index'));
	}

/**
 * admin_index method
 *
 * @return void
 */
	public function admin_index() {
		$this->Product->recursive = 0;
		$this->set('products', $this->Paginator->paginate());
	}

/**
 * admin_view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_view($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
		$this->set('product', $this->Product->find('first', $options));
	}

/**
 * admin_add method
 *
 * @return void
 */
	public function admin_add() {
		if ($this->request->is('post')) {
			$this->Product->create();
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$subCategories = $this->Product->SubCategory->find('list');
		$this->set(compact('subCategories'));
	}

/**
 * admin_edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_edit($id = null) {
		if (!$this->Product->exists($id)) {
			throw new NotFoundException(__('Invalid product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Product->save($this->request->data)) {
				$this->Session->setFlash(__('The product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('Product.' . $this->Product->primaryKey => $id));
			$this->request->data = $this->Product->find('first', $options);
		}
		$subCategories = $this->Product->SubCategory->find('list');
		$this->set(compact('subCategories'));
	}

/**
 * admin_delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function admin_delete($id = null) {
		$this->Product->id = $id;
		if (!$this->Product->exists()) {
			throw new NotFoundException(__('Invalid product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Product->delete()) {
			$this->Session->setFlash(__('The product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function get_sub_category() {
		// disable auto rendering of view
    	$this->autoRender = false;
    	$this->response->type('json');
    	
    	// load models
    	$this->loadModel('SubCategory');
    	
    	// check request type
    	if ($this->request->is('ajax')) {
    		// get passed id
    		$category_id = $this->request->query['id'];
    		
        	$sub_categories = $this->SubCategory->find('all',
        		['conditions'=>['category_id'=>$category_id]]);
        	
        	// return data acquired
			return json_encode($sub_categories);
        	exit;
    	}
	}
	
	public function add_product() {
		$this->autoRender = false;
		$this->response->type('text');
		
		$this->loadModel('Product');
		$this->loadModel('ProductProperty');
		$this->loadModel('ProductValue');
		
		$data = $this->request->data;
		$name = $data['name'];
		$other_info = $data['other_info'];
		$sub_category = $data['sub_category'];
		$image = $data['image'];
		$type = $data['type'];
		$sale_price = $data['sale_price'];
		
		$required_properties = $data['required_properties'];
		$required_values = $data['required_values'];
		$required_price = $data['required_price'];
		$required_default = $data['required_default'];
		
		$appended_obj = $data['appended_obj'];
		
		$DS_Product = $this->Product->getDataSource();
		$DS_Product->begin();
              	
		$data = $this->Product->create();
		$this->Product->set(['name'=>$name,
							'other_info'=>$other_info,
							'sub_category'=>$sub_category,
							'image'=>$image,
							'sub_category_id'=>$sub_category,
							'type'=>$type,
							'sale_price'=>$sale_price]);
							
        if ($this->Product->save()){
			echo json_encode("product saved");
			$product_id = $this->Product->getLastInsertId();
			
			$DS_ProductProperty = $this->ProductProperty->getDataSource();
			$DS_ProductProperty->begin();
			
			$this->ProductProperty->create();
			$this->ProductProperty->set(['name'=>$required_properties,
										'product_id'=>$product_id]);
									
			if ($this->ProductProperty->save()) {
				$ppid = $this->ProductProperty->getLastInsertId();
				
				$DS_ProductValue = $this->ProductValue->getDataSource();
				$DS_ProductValue->begin();
				
				$this->ProductValue->create();
				$this->ProductValue->set(['value'=>$required_values,
										'price'=>$required_price,	
										'default'=>$required_default,
										'product_property_id'=>$ppid]);
				
				if ($this->ProductValue->save()) {
					for($i=0; $i < count($appended_obj["appended"]); $i++) {
						$prop = $appended_obj["appended"][$i]['prop'];
						$val = $appended_obj["appended"][$i]['val'];
						$price = $appended_obj["appended"][$i]['price'];
						$default = $appended_obj["appended"][$i]['def'];
						
						$this->ProductProperty->create();
						$this->ProductProperty->set(['name'=>$prop,
													'product_id'=>$product_id]);
													
						if ($this->ProductProperty->save()) {
							echo json_encode("product property saved");
							$product_property_id = $this->ProductProperty->getLastInsertId();
							
							$this->ProductValue->create();
							$this->ProductValue->set(['value'=>$val,
													'price'=>$price,
													'default'=>$default,
													'product_property_id'=>$product_property_id]);
													
							if ($this->ProductValue->save()) {
								echo json_encode("product value saved");
								$DS_ProductValue->commit();
								$DS_ProductProperty->commit();
								$DS_Product->commit();
							}
							else {
								$DS_ProductValue->rollback();
								$DS_ProductProperty->rollback();
								$DS_Product->rollback();
							}
						}
						else {
							$DS_Product->rollback();
						}
					}
				}
				else {
					$DS_ProductProperty->rollback();
					$DS_Product->rollback();
				}
			}
			else {
				$DS_Product->rollback();
			}
		}
		else {
			$DS_Product->rollback();
		}
		
		$DS_ProductValue->commit();
		$DS_ProductProperty->commit();
		$DS_Product->commit();
		
		return json_encode("Everything was executed");
		exit;
	}
	
	public function image_upload() {
		$this->autoRender = false;
		if($this->request->is('post'))
	    {
		     if(!empty($_FILES['Image']['name'])) {
	            $file = $_FILES['Image'];
	            $ext = substr(strtolower(strrchr($file['name'], '.')), 1);
	            $arr_ext = array('jpg', 'jpeg', 'gif', 'png');
	            $temp = explode(".", $file['name']);
	            $newfilename = $_FILES['Image']['name'];
	            if(in_array($ext, $arr_ext))
	            {
	                if(move_uploaded_file($file['tmp_name'], WWW_ROOT . 'product_uploads' . DS . $newfilename))
	                {
				        return json_encode($_FILES);
	                }
	            }
		    }
	    }
	}

	public function edit() {
		$this->loadModel('Product');
		$this->loadModel('SubCategory');
		$this->loadModel('ProductProperty');
		$this->loadModel('Category');
		
		$product_id = $this->params['url']['id'];
		$this->set(compact('product_id'));
		
		$current_product = $this->Product->findById($product_id);
		$this->set(compact('current_product'));
		
		$categories = $this->Category->find('all');
		$this->set(compact('categories'));
		
		$sub_category_id = $current_product['Product']['sub_category_id'];
		$sub_category = $this->SubCategory->findById($sub_category_id);
		$this->set(compact('sub_category'));
	}
	
	public function update_product() {
		$this->autoRender = false;
		$this->response->type('text');
		
		$this->loadModel('Product');
		$this->loadModel('ProductProperty');
		$this->loadModel('ProductValue');
		
		$data = $this->request->data;
		$id = $data['id'];
		$sub_category_id = $data['sub_category'];
		$other_info = $data['other_info'];
		$image_change = $data['image_change'];
		$image_keep = $data['image_keep'];
		$keep_image = $data['keep_image'];
		$sale_price = $data['sale_price'];
		$type = $data['type'];
		$appended_obj = $data['appended_obj'];
		
		if($keep_image=="true"){
			$image = $image_keep;
		}
		else {
			$image = $image_change;
		}
		
		echo json_encode("Image: ".$image);
		$DS_UpdateProduct = $this->Product->getDataSource();
		$DS_UpdateProduct->begin();
		
		$this->Product->id = $id;
		$this->Product->set(['sub_category_id'=>$sub_category_id,
							'other_info'=>$other_info,
							'image'=>$image,
							'sale_price'=>$sale_price,
							'type'=>$type]);
		
		if($this->Product->save()) {
			echo json_encode("Product is Updated");
			
			$DS_ProductProperty = $this->ProductProperty->getDataSource();
			$DS_ProductProperty->begin();
			
			$DS_ProductValue = $this->ProductValue->getDataSource();
						$DS_ProductValue->begin();

			$this->ProductProperty->id = $id;
			$delete_properties = $this->ProductProperty->find('all', ['conditions'=>
														['product_id'=>$id]]);
			foreach ($delete_properties as $delete_property) {
				$delete_property_id = $delete_property['ProductProperty']['id'];
				
				$this->ProductProperty->delete($delete_property_id);

				$delete_values = $this->ProductValue->find('all',
							['conditions'=>['product_property_id'=>$delete_property_id]]);
				foreach ($delete_values as $delete_value) {
					$delete_value_id = $delete_value['ProductValue']['id'];
					
					$this->ProductValue->delete($delete_value_id);
				}
			}
			
			if ($DS_ProductProperty->commit() && $DS_ProductValue->commit()) {
				for($i=0; $i < count($appended_obj["appended"]); $i++) {
					$prop = $appended_obj["appended"][$i]['prop'];
					$val = $appended_obj["appended"][$i]['val'];
					$price = $appended_obj["appended"][$i]['price'];
					$default = $appended_obj["appended"][$i]['def'];
					
					$this->ProductProperty->create();
					$this->ProductProperty->set(['name'=>$prop,
												'product_id'=>$id]);
												
					if($this->ProductProperty->save()){
						echo json_encode("ProductProperty is Updated");
						$product_property_id = $this->ProductProperty->getLastInsertId();
						
						$this->ProductValue->create();
						$this->ProductValue->set(['value'=>$val,
												'price'=>$price,
												'default'=>$default,
												'product_property_id'=>$product_property_id]);
												
						if ($this->ProductValue->save()) {
							echo json_encode("ProductValue is Updated");
							$DS_ProductValue->commit();
							$DS_ProductProperty->commit();
							$DS_UpdateProduct->commit();
						}
						else {
							$DS_ProductValue->rollback();
							$DS_ProductProperty->rollback();
							$DS_UpdateProduct->rollback();
						}
					}
					else { 
						$DS_ProductValue->rollback();
						$DS_ProductProperty->rollback();
						$DS_UpdateProduct->rollback();
					}
				}
			}
		}
		$DS_ProductValue->commit();
		$DS_ProductProperty->commit();
		$DS_UpdateProduct->commit();
		
		return json_encode("Update Successful");
		exit;
	}
}