<?php
App::uses('AppController', 'Controller');

/**
 * Products Controller
 *
 * @property Product $Product
 * @property PaginatorComponent $Paginator
 */
class ApisController extends AppController {

/**
 * Components
 *
 * @var array
 */
    
	// var $helpers = array('xls');
	public $uses = array('SubCategory', 'Product', 'Category');
	public $components = array('Paginator', 'PhpExcel');
	
	public function beforeFilter() {
    	$this->Auth->allow('load_image', 'change_websubcat', 'allsubcat', 'get_product_subcategory','subcat','get_product', 'try2', 'categories', 'get_product_subcategory_infinite', 'search');
	}
	
	public function try2(){
	    $this->loadModel('SupplierProduct');
	    $this->SupplierProduct->recursive = -1;
	    pr($this->SupplierProduct->find('all',
	    							['contain' => ['ProductCombo']]));
	    							exit;
	    
	}
	
	
	public function get_product_subcategory($id) {
		$this->Product->recursive = -1;
		// if($id){
		// $option = ['conditions' => array('Product.id' => $id)];
		// }
		$this->loadModel('ProductProperty');
		$this->ProductProperty->recursive = 1;
		$products = $this->Product->findAllBySubCategoryId($id);
		
		$count = 0;
		foreach($products as $product){
			$options = array('conditions' => array('ProductValue.default' => 1, 'ProductProperty.product_id' => $product['Product']['id'], 'ProductProperty.id = ProductValue.product_property_id'));
			$propVal = $this->ProductProperty->ProductValue->find('first', $options);
			$products[$count]['Product']['price'] = 0;
			
			// $img = $this->thumbnail($product['Product']['image'], 400, 519);
			// 	// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
			
			// $imageData = base64_encode($img);

			// // Format the image SRC:  data:{mime};base64,{data};
			// $src = 'data: image/jpg;base64,'.$imageData;
			
			// $products[$count]['Product']['image'] = '<img src="' . $src . '">';
			
			if($propVal){
				$products[$count]['Product']['price'] = $propVal['ProductValue']['price']; 
			}
			$count++;
		}
		
		$this->Product->recursive = -1;
		$count_product = count($this->Product->findAllBySubCategoryId($id));
		$this->set(compact('products', 'count_product'));
		$this->set('_serialize', array('products', 'count_product'));
	}
	
	public function get_product_subcategory_infinite($id, $limit, $paged) {
		$this->Product->recursive = -1;
		
		
		if($_POST){
			$limit = $_POST['limit'];
	    	$paged = $_POST['page'];
		}
		// if($id){
		// $option = ['conditions' => array('Product.id' => $id)];
		// }
		$options = ['contions' => ['Product.sub_category_id' => $id, 'Product.website_product' => 1]];
		$count_product = count($this->Product->find('all', $options));
		// $count_product = count($this->Product->findAllBySubCategoryId($id));
		
		$page_count = $count_product/$limit;
		$products = [];
		if($paged <= ceil($page_count)){
		    $this->Paginator->settings = array('conditions' => array('Product.sub_category_id' => $id), 'limit' => $limit, 'page' => $paged);
		    $products = $this->Paginator->paginate('Product');
		    // $this->set(compact('data'));
			
			$this->loadModel('ProductProperty');
			$this->ProductProperty->recursive = 1;
			// $products = $this->Product->findAllBySubCategoryId($id);
			
			$count = 0;
			foreach($products as $product){
				$options = array('conditions' => array('ProductValue.default' => 1, 'ProductProperty.product_id' => $product['Product']['id'], 'ProductProperty.id = ProductValue.product_property_id'));
				$propVal = $this->ProductProperty->ProductValue->find('first', $options);
				$products[$count]['Product']['price'] = 0;
				
				// $img = $this->thumbnail($product['Product']['image'], 400, 519);
				// 	// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
				
				// $imageData = base64_encode($img);

				// // Format the image SRC:  data:{mime};base64,{data};
				// $src = 'data: image/jpg;base64,'.$imageData;
				
				// $products[$count]['Product']['image'] = $src;
				
				if($propVal){
					$products[$count]['Product']['price'] = $propVal['ProductValue']['price']; 
				}
				$count++;
			}
		}
		
		// $counter = $this->Paginator->counter();
		
		
		$this->set(compact('products', 'count_product'));
		$this->set('_serialize', array('products', 'count_product'));
	}
	
// 	public function load_image($product){
// 		$img = $this->thumbnail($product, 400, 519);
// 				// 	// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
				
// // 		$imageData = base64_encode($img);

// 		// // Format the image SRC:  data:{mime};base64,{data};
// // 		$src = 'data: image/jpg;base64,'.$imageData;
// // 		echo "ksds";
// 		// $products[$count]['Product']['image'] = $src;
// 		header("Content-Type: image/jpeg");
// 		echo $img;
// 		exit;
// 	} 
	
	public function get_product($id) {
		$this->Product->recursive = 2;
    	$this->loadModel('AdditionalImage');
		$this->AdditionalImage->recursive = -1;
		
		$product = $this->Product->findById($id);
		$product['other_images'] = $this->AdditionalImage->findAllByProductId($id);
		
        unset($product['SubCategory']['Product']);
        
        $this->loadModel('ProductProperty');
		$this->ProductProperty->recursive = 1;
        
			$options = array('conditions' => array('ProductValue.default' => 1, 'ProductProperty.product_id' => $product['Product']['id'], 'ProductProperty.id = ProductValue.product_property_id'));
			$propVal = $this->ProductProperty->ProductValue->find('first', $options);
			$product['Product']['price'] = 0;
			
			if($propVal){
				$product['Product']['price'] = $propVal['ProductValue']['price']; 
			}
        
		$this->set(compact('product'));
		$this->set('_serialize', array('product'));
	}
	
	public function subcat($id){
		
		$this->SubCategory->recursive = -1;
		$sub_category = $this->SubCategory->find('all', array('conditions' => array('website_category' => $id)));
		    $counter = 0;
		    foreach($sub_category as $sub){
		        $count = count($this->Product->findAllBySubCategoryId($sub['SubCategory']['id']));
		        $sub_category[$counter]['SubCategory']['count'] = $count;
		        $counter++;
		    }
// 		pr($sub_category); exit;    
		$this->set(compact('sub_category'));
		$this->set('_serialize', array('sub_category'));
	}
	
	public function allsubcat($id = null){
	    $count_product = 0;
	    if($id != null){
			$this->Product->recursive = -1;
			$count_product = count($this->Product->findAllBySubCategoryId($id));
	    }
		$this->SubCategory->recursive = -1;
		$sub_category = $this->SubCategory->find('all');
		$this->set(compact('sub_category', 'count_product'));
		$this->set('_serialize', array('sub_category', 'count_product'));
	}
	
	public function categories(){
		
		$this->Category->recursive = -1;
		$categories = $this->Category->find('all');
		$this->set(compact('categories'));
		$this->set('_serialize', array('categories'));
	}
	
	public function search($k){
		$this->loadModel('SubCategories');
		$result = [];
		$this->Product->recursive = -1;
		$condition = ['conditions' => ['name LIKE' => '%'.$k.'%']];
		// $products = $this->Product->findAllByName($k);
		$products = $this->Product->find('all', $condition);
		// pr($products); exit;
		$this->SubCategories->revursive = -1;
		// $subcat = $this->SubCategories->findAllByName($k);
		$subcat = $this->SubCategories->find('all', $condition);
			foreach($subcat as $sub){
				
				$prod = $this->Product->findAllBySubCategoryId($sub['SubCategories']['id']);
				$result['subcat'][$sub['SubCategories']['name']][] = $prod;
			}
		$this->loadModel('ProductProperty');
		$this->ProductProperty->recursive = 1;
		// $products = $this->Product->findAllBySubCategoryId($id);
		
		$count = 0;
		foreach($products as $product){
			$options = array('conditions' => array('ProductValue.default' => 1, 'ProductProperty.product_id' => $product['Product']['id'], 'ProductProperty.id = ProductValue.product_property_id'));
			$propVal = $this->ProductProperty->ProductValue->find('first', $options);
			$products[$count]['Product']['price'] = 0;
			
			// $img = $this->thumbnail($product['Product']['image'], 400, 519);
			// 	// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
			
			// $imageData = base64_encode($img);

			// // Format the image SRC:  data:{mime};base64,{data};
			// $src = 'data: image/jpg;base64,'.$imageData;
			
			// $products[$count]['Product']['image'] = $src;
			
			if($propVal){
				$products[$count]['Product']['price'] = $propVal['ProductValue']['price']; 
			}
			$count++;
		}
		$result['products'] = $products;
		 
		$this->set(compact('result'));
		$this->set('_serialize', array('result'));
		
	}
	
	public function search_infinite($k, $limit, $paged){
		$this->loadModel('SubCategories');
		$result = [];
		$this->Product->recursive = -1;
		$condition = ['conditions' => ['name LIKE' => '%'.$k.'%']];
		// $products = $this->Product->findAllByName($k);
		// $products = $this->Product->find('all', $condition);
		// pr($products); exit;
		$this->SubCategories->revursive = -1;
		// $subcat = $this->SubCategories->findAllByName($k);
		// $subcat = $this->SubCategories->find('all', $condition);
		// 	foreach($subcat as $sub){
				
		// 		$prod = $this->Product->findAllBySubCategoryId($sub['SubCategories']['id']);
		// 		$result['subcat'][$sub['SubCategories']['name']][] = $prod;
		// 	}
		$this->loadModel('ProductProperty');
		$this->ProductProperty->recursive = 1;
		// $products = $this->Product->findAllBySubCategoryId($id);
		
		if($_POST){
			$limit = $_POST['limit'];
	    	$paged = $_POST['page'];
		}
		// if($id){
		// $option = ['conditions' => array('Product.id' => $id)];
		// }
		$count_product = count($this->Product->find('all', array('conditions' => array('name LIKE' => '%'.$k.'%'))));
		$page_count = $count_product/$limit;
		$products = [];
		if($paged <= ceil($page_count)){
		    $this->Paginator->settings = array('conditions' => array('name LIKE' => '%'.$k.'%'), 'limit' => $limit, 'page' => $paged);
		    $products = $this->Paginator->paginate('Product');
		
			$count = 0;
			foreach($products as $product){
				$options = array('conditions' => array('ProductValue.default' => 1, 'ProductProperty.product_id' => $product['Product']['id'], 'ProductProperty.id = ProductValue.product_property_id'));
				$propVal = $this->ProductProperty->ProductValue->find('first', $options);
				$products[$count]['Product']['price'] = 0;
				
				// $img = $this->thumbnail($product['Product']['image'], 400, 519);
				// 	// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
				
				// $imageData = base64_encode($img);
	
				// // Format the image SRC:  data:{mime};base64,{data};
				// $src = 'data: image/jpg;base64,'.$imageData;
				
				// $products[$count]['Product']['image'] = $src;
				
				if($propVal){
					$products[$count]['Product']['price'] = $propVal['ProductValue']['price']; 
				}
				$count++;
			}
		}
		$result['products'] = $products;
		 
		$this->set(compact('result'));
		$this->set('_serialize', array('result'));
		
	}
	
	public function change_websubcat($id, $wid){
	   if (!$this->SubCategory->exists($id)) {
			throw new NotFoundException(__('Invalid sub category_id'));
		}
	   
	    $this->SubCategory->id = $id;
	    $this->SubCategory->set(array('website_category' => $wid));
	    if($this->SubCategory->save()){
	        echo 'saved';
	    }
	    exit;
	}
	
	public function	inv_prod_combo($loc_id){
		
		if($loc_id){
			$this->loadModel('InvLocation');
			$this->loadModel('InventoryProduct');
	
			$inv_location_id = $this->params['url']['id'];
			$this->InvLocation->recursive=2;
			$invs = $this->InvLocation->findById($inv_location_id);
			
			$this->InventoryProduct->recursive=2;
			$selected_prods = $this->ProductCombo->InventoryProduct->find('all', array(
				'conditions'=>['InventoryProduct.inv_location_id'=>$inv_location_id]
				));
				
			foreach($selected_prods as $prods){
					
			}
		}
		
	}
	
}