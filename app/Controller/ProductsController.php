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
	// var $helpers = array('xls');
	public $components = array('Paginator', 'PhpExcel');
	
	public function beforeFilter() {
        parent::beforeFilter();
            $this->response->header('Access-Control-Allow-Origin','*');
            $this->response->header('Access-Control-Allow-Methods','*');
            $this->response->header('Access-Control-Allow-Headers','X-Requested-With');
            $this->response->header('Access-Control-Allow-Headers','Content-Type, x-xsrf-token');
            $this->response->header('Access-Control-Max-Age','172800');
	}
	
	public function export() {
		/** Error reporting */
		error_reporting(E_ALL);
		ini_set('display_errors', TRUE);
		ini_set('display_startup_errors', TRUE);
		define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
		
		$data = $this->Product->find('all');
		$fname = $this->Auth->user('first_name');
		$lname = $this->Auth->user('last_name');
		$user = $fname ." ". $lname;
		
		$title = "Products";
		App::import('Vendor', 'PHPExcel', array('file' => 'PHPExcel.php'));
	    $objPHPExcel = new PHPExcel();

		$objPHPExcel->getProperties()->setCreator($user)
		                     ->setTitle($title)
		                     ->setSubject("Export")
		                     ->setDescription("All products as of ".date("m/d/Y"))
		                     ->setKeywords("xls xlsx excel products export");
		
		$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(14);
		$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setAutoSize(true);
		$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(14);
		$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
		
		// Set sheet security
		$objSheet = $objPHPExcel->getActiveSheet();
		$objSheet->protectCells('A1:J'.count($data), 'PHP');
		$objSheet->getProtection()->setSheet(true);
		
		$objPHPExcel->getActiveSheet()->getStyle('A1:I1')->applyFromArray(
			array(
				'font'    => array(
						'bold'      => true
					),
					'alignment' => array(
						'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_RIGHT,
					),
					'borders' => array(
						'top'     => array(
		 					'style' => PHPExcel_Style_Border::BORDER_THIN
		 				)
					),
					'fill' => array(
			 			'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
			  			'rotation'   => 90,
			 			'startcolor' => array(
			 				'argb' => 'FFA0A0A0'
			 			),
			 			'endcolor'   => array(
			 				'argb' => 'FFFFFFFF'
			 			)
			 		)
				)
		);
		
		$objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A1', 'id')
			    ->setCellValue('B1', 'subcat_id')
			    ->setCellValue('C1', 'name')
			    ->setCellValue('D1', 'image')
			    ->setCellValue('E1', 'other_info')
			    ->setCellValue('F1', 'type')
			    ->setCellValue('G1', 'created_at')
			    ->setCellValue('H1', 'updated_at')
			    ->setCellValue('I1', 'deleted_at')
			    ->setCellValue('J1', 'Properties & Values');
		
		for($i=2;$i<(count($data)+2);$i++) {
			$prod = $data[$i-2]['Product'];
			$prop_obj = $data[$i-2]['ProductProperty'];
			$prod_id = $prod['id'];
			
			$this->loadModel('ProductValue');
			$this->ProductValue->recursive = -1;
			
			$prop_val = [];
			foreach($prop_obj as $ret_prop) {
				$prop_id = $ret_prop['id'];
				$prop_name = $ret_prop['name'];
				
				$get_val = $this->ProductValue->find('all',
					['conditions'=>['ProductValue.product_property_id'=>$prop_id]]);
				foreach($get_val as $ret_val) {
					$arr_val = $ret_val['ProductValue'];
					$val_val = $arr_val['value'];
				
					$prop_val[] = [$prop_name=>$val_val];
				}
			}
			$pv = json_encode($prop_val);
			
			$objPHPExcel->setActiveSheetIndex(0)
			    ->setCellValue('A'.$i, $prod_id)
			    ->setCellValue('B'.$i, $prod['sub_category_id'])
			    ->setCellValue('C'.$i, $prod['name'])
			    ->setCellValue('D'.$i, $prod['image'])
			    ->setCellValue('E'.$i, $prod['other_info'])
			    ->setCellValue('F'.$i, $prod['type'])
			    ->setCellValue('G'.$i, $prod['created'])
			    ->setCellValue('H'.$i, $prod['modified'])
			    ->setCellValue('I'.$i, 'NULL')
			    ->setCellValue('J'.$i, $pv);
		}
		
		$objPHPExcel->getActiveSheet()->setTitle($title);
		$objPHPExcel->setActiveSheetIndex(0);
		
		$t = microtime(true);
		$micro = sprintf("%06d",($t - floor($t)) * 1000000);
		$date_tmp = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
		
		$date = $date_tmp->format("Y-m-d_his.u");
		$filename_datetime = "Products_".$date.".xlsx";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
		$path = APP .'Lib' .DS. 'Print'.DS. 'Products'.DS;
		$objWriter->save($path. '/'.$filename_datetime );
	
	    // Response - let user download it
	    $this->response->file($path. '/'.$filename_datetime, array('download' => true, 'name' => $filename_datetime));
	    return $this->response;
	}
/**
 * index method
 *
 * @return void
 */
	public function index_ajax() { 
	    if(!$this->Auth->user()){
			exit;
		}
		
	    $this->layout = "ajax";
	    $this->modelClass = "Product";
	    $this->autoRender = false;
	//	
	    $output = $this->Product->GetMyData('products', array('image', 'name', 'id'));    
	//        pr($_GET);exit;
	
		$data = $output['data'];
		$res = [];
		$count = 0;
		foreach($data as $items){
			foreach($items as $key => $item){
				//$img = $this->thumbnail($item);
				if($key == 0){
					$img = $this->thumbnail($item);
					// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
				
					$imageData = base64_encode($img);

					// Format the image SRC:  data:{mime};base64,{data};
					$src = 'data: image/jpg;base64,'.$imageData;
					
					// Echo out a sample image
					$data[$count][$key] =  '<img src="' . $src . '">';
					
					// $data[$count][$key] = '<p>'.$img.'</p>';
				}
				if($key == 1){
				    $data[$count][$key] =  preg_replace('/[^A-Za-z0-9\-]/', ' ', $item);
				}
				if($key == 2){
					$data[$count][$key] =   '<a href="/products/add_images?id='.$item.'" class="btn btn-sm btn-primary"
						                    		data-toggle="tooltip"
						                    		data-placement="top"
						                    		title="Add images">
						                    	<span class="fa fa-camera-retro"></span>
						                    </a>
						                    <a class="btn btn-sm btn-info"
												data-toggle="tooltip"
												data-placement="top" title="Product Combo"
												href="/product_combos/view?id='.$item.'">
												<span class="fa fa-book"></span>
											</a>
											<a class="btn btn-sm btn-warning"
											   style="color:white;"
											   href="/products/edit?id='.$item.'">
												Edit
											</a>';
				}
			}
			$count++;
		}
		// pr($data); exit;
		$output['data'] = $data;
	    echo json_encode($output);
	    exit;
	}
	
	public function load_image($product){
		$img = $this->thumbnail($product, 150, 195);
				// 	// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
				
		$imageData = base64_encode($img);

		// // Format the image SRC:  data:{mime};base64,{data};
		$src = 'data: image/jpg;base64,'.$imageData;
// 		echo "ksds";
		// $products[$count]['Product']['image'] = $src;
		// header("Content-Type: image/jpeg");
		echo $src;
		exit;
	} 
	
	public function requests_ajax() { 
	    if(!$this->Auth->user()){
			exit;
		}
	    $this->layout = "ajax";
	    $this->modelClass = "TempProduct";
	    $this->autoRender = false;          
	//
	    $output = $this->TempProduct->GetMyData('temp_products', array('image', 'name', 'user_id', 'id', 'status'), "status = 'request'");    
	       // pr($output);exit;
	
		$data = $output['data'];
		$output['data'] = [];
		$res = [];
		$count = 0;
		foreach($data as $items){
// 			if($items[4] == 'request'){
				foreach($items as $key => $item){
					//$img = $this->thumbnail($item);
				// 	echo $item;
					if($key == 0){
						
						$folder = APP.'webroot'."/img/product-uploads/";
						
						$f = $folder.''.$item;
						if(imagecreatefromjpeg($f)){
							$img = $this->thumbnail($item);
							// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
						
							$imageData = base64_encode($img);
		
							// Format the image SRC:  data:{mime};base64,{data};
							$src = 'data: image/jpg;base64,'.$imageData;
							
							// Echo out a sample image
							$data[$count][$key] =  '<img src="' . $src . '">';
							
							// $data[$count][$key] = '<p>'.$img.'</p>';
						}else{
							$data[$count][$key] = 'Please re-upload image.';
						}
					}
					if($key == 1){
					    $data[$count][$key] =  preg_replace('/[^A-Za-z0-9\-]/', ' ', $item);
					}
					if($key == 3){
						$data[$count][$key] =   '<a class="btn btn-sm btn-warning"
												   style="color:white;"
												   href="/products/approve_request?id='.$item.'">
													View
												</a>';
					}
					if($key == 2){
						$this->loadModel('User');
						$this->User->recursive = -1;
						$user = $this->User->findById($item);
						if($user){
						    $data[$count][$key] = $user['User']['first_name'].' '.$user['User']['last_name'];
						} else{
						    $data[$count][$key] = "";
						}
					}
				}
				// pr($data);
// 			} 
			$count++;
		}
// 		echo "hey";
// 		pr($data); exit;
		$output['data'] = $data;
	    echo json_encode($output);
	    exit;
	}
	
	public function index() {
		// $this->Product->recursive = -1;
		$products = $this->Product->find('all');
		$this->set(compact('products'));
		$this->set('_serialize', array('products'));
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
			$options = array('conditions' => array('ProductValue.default' => 1));
			$propVal = $this->ProductProperty->ProductValue->find('first', $options);
			$products[$count]['Product']['price'] = $propVal['ProductValue']['price']; 
			$count++;
		}
		
		$this->Product->recursive = -1;
		$count_product = count($this->Product->findAllBySubCategoryId($id));
		$this->set(compact('products', 'count_product'));
		$this->set('_serialize', array('products', 'count_product'));
	}
	
	public function get_product_subcategory_infinite($id, $limit, $paged) {
		$this->Product->recursive = -1;
		
		// $limit = $_POST['limit'];
  //  	$paged = $_POST['page'];
		// if($id){
		// $option = ['conditions' => array('Product.id' => $id)];
		// }
		$count_product = count($this->Product->findAllBySubCategoryId($id));
		
		$page_count = $count_product/$paged;
		$products = [];
		if($paged > $page_count){
		    $this->Paginator->settings = array('conditions' => array('Product.sub_category_id' => $id), 'limit' => $limit, 'page' => $paged);
		    $products = $this->Paginator->paginate('Product');
		    // $this->set(compact('data'));
			
			$this->loadModel('ProductProperty');
			$this->ProductProperty->recursive = 1;
			// $products = $this->Product->findAllBySubCategoryId($id);
			
			$count = 0;
			foreach($products as $product){
				$options = array('conditions' => array('ProductValue.default' => 1));
				$propVal = $this->ProductProperty->ProductValue->find('first', $options);
				$products[$count]['Product']['price'] = $propVal['ProductValue']['price']; 
				$count++;
			}
		}
		
		// $counter = $this->Paginator->counter();
		
		
		$this->set(compact('products', 'count_product'));
		$this->set('_serialize', array('products', 'count_product'));
	}
	
	public function get_product($id) {
		// $this->Product->recursive = -1;
		// if($id){
		// $option = ['conditions' => array('Product.id' => $id)];
		// }
		$product = $this->Product->findById($id);
		$this->set(compact('product'));
		$this->set('_serialize', array('product'));
	}
	
	public function list_requests(){
		
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
		// echo json_encode($data);
		$name = $data['name'];
		$other_info = $data['other_info'];
		$sub_category = $data['sub_category'];
		$image = $data['image'];
		$type = $data['type'];
		$sale_price = $data['sale_price'];

		$required_properties = $data['required_properties'];
		$required_values = $data['required_values'];
		$required_price = $data['required_price'];
		$required_default_tmp = $data['required_default'];
		
		if($required_default_tmp) {
			$required_default = 1;
		}
		else {
			$required_default = 0;
		}
		$appended_obj = $data['appended_obj'];
		
		// get name from database and strcmp
		$cmp = [];
		$this->Product->recursive = -1;
		$ps = $this->Product->find('all', ['fields'=>['Product.name']]);
		foreach($ps as $p) {
			$p_name = $p['Product']['name'];
			if (strcasecmp($name, $p_name) == 0) {
				$cmp[] = true;
			}
		}
		
		if(empty($cmp)) {
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
					// echo json_encode("first prod_prop saved");
					$ppid = $this->ProductProperty->getLastInsertId();
					
					$DS_ProductValue = $this->ProductValue->getDataSource();
					$DS_ProductValue->begin();
					
					$this->ProductValue->create();
					$this->ProductValue->set(['value'=>$required_values,
											'price'=>$required_price,	
											'default'=>$required_default,
											'product_property_id'=>$ppid]);
											
					if($this->ProductValue->save()) {
						$DS_ProductValue->commit();
						if($appended_obj!=0) {
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
										// echo json_encode("product property saved");
										$product_property_id = $this->ProductProperty->getLastInsertId();
										$product_value_set = ['value'=>$val,
																'price'=>$price,
																'default'=>$default,
																'product_property_id'=>$product_property_id];
										// echo json_encode($product_value_set);
										$this->ProductValue->create();
										$this->ProductValue->set($product_value_set);
										
										if ($this->ProductValue->save()) {
											// echo json_encode("product value saved");
											$DS_ProductValue->commit();
											$DS_ProductProperty->commit();
											$DS_Product->commit();
										}
										else {
											// echo json_encode("not saved values");
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
		}
		else {
			return "Error:Already_Existing";
		}
		
		return json_encode("Everything was executed");
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
				if(imagecreatefromjpeg($file['tmp_name'])){
		            if(in_array($ext, $arr_ext))
		            {
		            	echo json_encode("true");
		                if(move_uploaded_file($file['tmp_name'], WWW_ROOT . 'img/product-uploads' . DS . $newfilename))
		                {
		                	echo json_encode("Image uploaded properly");
					        return json_encode($_FILES);
		                }
		            }
		            else {
		            	echo json_encode("false");
		            }
				} else{
					echo json_encode("false");
				}
		    }
	    }
	}
	
	public function additional_image_upload() {
		$this->autoRender = false;
		
		$base64 = $this->request->data['base64'];
		$product_id = $this->request->data['id'];
		$baseFromJavascript = $base64;
		
		$data = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $baseFromJavascript));
		
		$t = microtime(true);
		$micro = sprintf("%06d",($t - floor($t)) * 1000000);
		$date_tmp = new DateTime( date('Y-m-d H:i:s.'.$micro, $t) );
		
		$date = $date_tmp->format("Y-m-d_his.u");
		$filepath = WWW_ROOT . 'img/product-uploads' . DS ."$date.jpg"; // or image.jpg
		file_put_contents($filepath,$data);
		
		$this->loadModel('AdditionalImage');
		$this->AdditionalImage->create();
		$ai_set = ['product_id'=>$product_id,
				   'image'=> "$date.jpg"];
		$this->AdditionalImage->set($ai_set);
		$this->AdditionalImage->save();
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
	
	
	
	public function approve_request() {
		$this->loadModel('TempProduct');
		$this->loadModel('SubCategory');
		$this->loadModel('TempProductProperty');
		$this->loadModel('Category');
		
		$product_id = $this->params['url']['id'];
		$this->set(compact('product_id'));
		
		$current_product = $this->TempProduct->findById($product_id);
		$this->set(compact('current_product'));
		
		$categories = $this->Category->find('all');
		$this->set(compact('categories'));
		
		$sub_category_id = $current_product['TempProduct']['sub_category_id'];
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
		echo json_encode($data);
		$id = $data['id'];
		$sub_category_id = $data['sub_category'];
		$other_info = $data['other_info'];
		$image_change = $data['image_change'];
		$image_keep = $data['image_keep'];
		$keep_image = $data['keep_image'];
		$sale_price = $data['sale_price'];
		$type = $data['type'];
		$appended_obj = $data['appended_obj'];
		$name = $data['name'];
		
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
							 'name' => $name,
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
	
    public function update_product_temp() {
		$this->autoRender = false;
		$this->response->type('text');
		
		$this->loadModel('TempProduct');
		$this->loadModel('TempProductProperty');
		$this->loadModel('TempProductValue');
		
		$data = $this->request->data;
		echo json_encode($data);
		$id = $data['id'];
		$sub_category_id = $data['sub_category'];
		$other_info = $data['other_info'];
		$image_change = $data['image_change'];
		$image_keep = $data['image_keep'];
		$keep_image = $data['keep_image'];
		$sale_price = $data['sale_price'];
		$type = $data['type'];
		$appended_obj = $data['appended_obj'];
		$name = $data['name'];
		
		if($keep_image=="true"){
			$image = $image_keep;
		}
		else {
			$image = $image_change;
		}
		
		echo json_encode("Image: ".$image);
		$DS_UpdateProduct = $this->TempProduct->getDataSource();
		$DS_UpdateProduct->begin();
		
		$this->TempProduct->id = $id;
		$this->TempProduct->set(['sub_category_id'=>$sub_category_id,
							 'other_info'=>$other_info,
							 'image'=>$image,
							 'sale_price'=>$sale_price,
							 'name' => $name,
							 'type'=>$type]);
		
		if($this->TempProduct->save()) {
			echo json_encode("Product is Updated");
			
			$DS_ProductProperty = $this->TempProductProperty->getDataSource();
			$DS_ProductProperty->begin();
			
			$DS_ProductValue = $this->TempProductValue->getDataSource();
						$DS_ProductValue->begin();

			$this->TempProductProperty->id = $id;
			$delete_properties = $this->TempProductProperty->find('all', ['conditions'=>
														['temp_product_id'=>$id]]);
			foreach ($delete_properties as $delete_property) {
				$delete_property_id = $delete_property['TempProductProperty']['id'];
				
				$this->TempProductProperty->delete($delete_property_id);

				$delete_values = $this->TempProductValue->find('all',
							['conditions'=>['temp_product_property_id'=>$delete_property_id]]);
				foreach ($delete_values as $delete_value) {
					$delete_value_id = $delete_value['TempProductValue']['id'];
					
					$this->TempProductValue->delete($delete_value_id);
				}
			}
			
			if ($DS_ProductProperty->commit() && $DS_ProductValue->commit()) {
				for($i=0; $i < count($appended_obj["appended"]); $i++) {
					$prop = $appended_obj["appended"][$i]['prop'];
					$val = $appended_obj["appended"][$i]['val'];
					$price = $appended_obj["appended"][$i]['price'];
					$default = $appended_obj["appended"][$i]['def'];
					
					$this->TempProductProperty->create();
					$this->TempProductProperty->set(['name'=>$prop,
												'temp_product_id'=>$id]);
												
					if($this->TempProductProperty->save()){
						echo json_encode("ProductProperty is Updated");
						$product_property_id = $this->TempProductProperty->getLastInsertId();
						
						$this->TempProductValue->create();
						$this->TempProductValue->set(['value'=>$val,
												'price'=>$price,
												'default'=>$default,
												'temp_product_property_id'=>$product_property_id]);
												
						if ($this->TempProductValue->save()) {
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
	
	public function approve_product() {
		$this->autoRender = false;
		$this->response->type('text');
		
		$this->loadModel('Product');
		$this->loadModel('ProductProperty');
		$this->loadModel('ProductValue');
		
		$data = $this->request->data;
		// echo json_encode($data);
		$id = $data['id'];
		$sub_category_id = $data['sub_category'];
		$other_info = $data['other_info'];
		$image_change = $data['image_change'];
		$image_keep = $data['image_keep'];
		$keep_image = $data['keep_image'];
		$sale_price = $data['sale_price'];
		$type = $data['type'];
		$appended_obj = $data['appended_obj'];
		$name = $data['name'];
		
		if($keep_image=="true"){
			$image = $image_keep;
		}
		else {
			$image = $image_change;
		}
		
		// echo json_encode("Image: ".$image);
		$DS_UpdateProduct = $this->Product->getDataSource();
		$DS_UpdateProduct->begin();
		
		// $this->Product->id = $id;
		$this->Product->create();
		$this->Product->set(['sub_category_id'=>$sub_category_id,
							 'other_info'=>$other_info,
							 'image'=>$image,
							 'sale_price'=>$sale_price,
							 'name' => $name,
							 'type'=>$type]);
		
		if($this->Product->save()) {
			echo json_encode("Product is Updated");
			$product_id = $this->Product->getLastInsertId();
			
			$DS_ProductProperty = $this->ProductProperty->getDataSource();
			$DS_ProductProperty->begin();
			
			$DS_ProductValue = $this->ProductValue->getDataSource();
						$DS_ProductValue->begin();

			// $this->ProductProperty->id = $id;
			// $delete_properties = $this->ProductProperty->find('all', ['conditions'=>
			// 											['product_id'=>$id]]);
			// foreach ($delete_properties as $delete_property) {
			// 	$delete_property_id = $delete_property['ProductProperty']['id'];
				
			// 	$this->ProductProperty->delete($delete_property_id);

			// 	$delete_values = $this->ProductValue->find('all',
			// 				['conditions'=>['product_property_id'=>$delete_property_id]]);
			// 	foreach ($delete_values as $delete_value) {
			// 		$delete_value_id = $delete_value['ProductValue']['id'];
					
			// 		$this->ProductValue->delete($delete_value_id);
			// 	}
			// }
			
			// if ($DS_ProductProperty->commit() && $DS_ProductValue->commit()) {
				for($i=0; $i < count($appended_obj["appended"]); $i++) {
					$prop = $appended_obj["appended"][$i]['prop'];
					$val = $appended_obj["appended"][$i]['val'];
					$price = $appended_obj["appended"][$i]['price'];
					$default = $appended_obj["appended"][$i]['def'];
					
					$this->ProductProperty->create();
					$this->ProductProperty->set(['name'=>$prop,
												'product_id'=>$product_id]);
												
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
							
							$this->loadModel('TempProduct');
							
							$this->TempProduct->id = $id;
							$this->TempProduct->set(array('status' => 'approved'));
							$this->TempProduct->save();
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
			// }
		}
		$DS_ProductValue->commit();
		$DS_ProductProperty->commit();
		$DS_UpdateProduct->commit();
		
		return json_encode("Aproved Successful");
		exit;
	}
	
	
	
	public function modify_default($id) {
		$this->autoRender = false;
		$product_id = $id;
		$product_obj = $this->Product->findById($product_id);
		$product_property_id = [];
		$get_product_property = $product_obj['ProductProperty'];
		foreach($get_product_property as $ret_product_property) {
			$product_property_id[] = $ret_product_property['id'];
		}
		
		$this->loadModel('ProductValue');
		$this->ProductValue->recursive = -1;
		$default_obj = [];
		$price_obj = [];
		$product_value_ids = [];
		$default_count = 0;
		$get_product_values = $this->ProductValue->find('all',
			['conditions'=>['product_property_id'=>$product_property_id],
			 'fields'=>['id', 'price', 'default']]);
		foreach($get_product_values as $ret_product_value) {
			$product_value_obj = $ret_product_value['ProductValue'];
			$default_tmp = $product_value_obj['default'];
			$price = $product_value_obj['price'];
			$product_value_id = $product_value_obj['id'];
			$product_value_ids[] = $product_value_id;
			
			$price_obj[$product_value_id] = $price;
		}
		
		$lowest_price = min($price_obj);		
		$price_tmp = 0;
		$price_id = 0.00;
		foreach($price_obj as $i=>$each_price) {
			// echo gettype(floatval($each_price))."-".gettype(floatval($price_tmp));
			if($each_price == $lowest_price) {
				$price_id = $i;
				break;
			}
			else {
				continue;
			}
		}
		
		$DS_ProductValue = $this->ProductValue->getDataSource();
		$DS_ProductValue->begin();
		$all_product_values = $this->ProductValue->find('all',
			['conditions'=>['id'=>$product_value_ids],
			 'fields'=>['id', 'default']]);
		
		$pv_ids = [];
		foreach($all_product_values as $each_product_values) {
			$product_values_obj = $each_product_values['ProductValue'];
			$pv_id = $product_values_obj['id'];
			$this->ProductValue->id = $pv_id;
			if(intval($pv_id)==$price_id) {
				echo  "<br/>".$pv_id." set to 1<br/>";
				$this->ProductValue->set(['default'=>1]);
			}
			else {
				echo $pv_id." set to 0<br/>";
				$this->ProductValue->set(['default'=>0]);
			}
			
			if($this->ProductValue->save()) {
				$DS_ProductValue->commit();
			}
			else {
				$DS_ProductValue->rollback();
				echo "<br/>Error in Modify Default";
			}
			$pv_ids[] = $pv_id;
		}
		echo "Modify Default Done. Check Product Values: ".json_encode($product_value_ids);
		return "<br/>Done<br/>";
	}
	
	public function modify_default_all() {
		$this->autoRender = false;
		
		$all_product = $this->Product->find('all');
		foreach($all_product as $each_product) {
			$product_obj = $each_product['Product'];
			$pid = $product_obj['id'];
			
			
			echo ($this->modify_default($pid))."<br/>";
		}
	}
	
	public function add_temp(){
		$this->loadModel('Category');
		$categories = $this->Category->find('all');
		$this->set(compact('categories'));
	}
	
	public function add_temp_product() {
		$this->autoRender = false;
		$this->response->type('text');
		
		$this->loadModel('TempProduct');
		$this->loadModel('TempProductProperty');
		$this->loadModel('TempProductValue');
		$user_id = $this->Auth->user('id');
		
		$data = $this->request->data;
		// echo json_encode($data);
		$name = $data['name'];
		$other_info = $data['other_info'];
		$sub_category = $data['sub_category'];
		$image = $data['image'];
		$type = $data['type'];
		$sale_price = $data['sale_price'];

		$required_properties = $data['required_properties'];
		$required_values = $data['required_values'];
		$required_price = $data['required_price'];
		$required_default_tmp = $data['required_default'];
		
		if($required_default_tmp) {
			$required_default = 1;
		}
		else {
			$required_default = 0;
		}
		$appended_obj = $data['appended_obj'];
		
		// get name from database and strcmp
		$cmp = [];
		$this->TempProduct->recursive = -1;
		$ps = $this->TempProduct->find('all', ['fields'=>['TempProduct.name']]);
		foreach($ps as $p) {
			$p_name = $p['TempProduct']['name'];
			if (strcasecmp($name, $p_name) == 0) {
				$cmp[] = true;
			}
		}
		
		if(empty($cmp)) {
			$DS_Product = $this->TempProduct->getDataSource();
			$DS_Product->begin();
	              	
			$data = $this->TempProduct->create();
			$this->TempProduct->set(['user_id' => $user_id,
								'name'=>$name,
								'other_info'=>$other_info,
								'sub_category'=>$sub_category,
								'image'=>$image,
								'sub_category_id'=>$sub_category,
								'type'=>$type,
								'sale_price'=>$sale_price]);
								
	        if ($this->TempProduct->save()){
				echo json_encode("product saved");
				$product_id = $this->TempProduct->getLastInsertId();
				
				$DS_ProductProperty = $this->TempProductProperty->getDataSource();
				$DS_ProductProperty->begin();
				
				$this->TempProductProperty->create();
				$this->TempProductProperty->set(['name'=>$required_properties,
											'product_id'=>$product_id]);
										
				if ($this->TempProductProperty->save()) {
					// echo json_encode("first prod_prop saved");
					$ppid = $this->TempProductProperty->getLastInsertId();
					
					$DS_ProductValue = $this->TempProductValue->getDataSource();
					$DS_ProductValue->begin();
					
					$this->TempProductValue->create();
					$this->TempProductValue->set(['value'=>$required_values,
											'price'=>$required_price,	
											'default'=>$required_default,
											'product_property_id'=>$ppid]);
											
					if($this->TempProductValue->save()) {
						$DS_ProductValue->commit();
						if($appended_obj!=0) {
							if ($this->TempProductValue->save()) {
								for($i=0; $i < count($appended_obj["appended"]); $i++) {
									$prop = $appended_obj["appended"][$i]['prop'];
									$val = $appended_obj["appended"][$i]['val'];
									$price = $appended_obj["appended"][$i]['price'];
									$default = $appended_obj["appended"][$i]['def'];
									
									$this->TempProductProperty->create();
									$this->TempProductProperty->set(['name'=>$prop,
																'product_id'=>$product_id]);
																
									if ($this->TempProductProperty->save()) {
										// echo json_encode("product property saved");
										$product_property_id = $this->TempProductProperty->getLastInsertId();
										$product_value_set = ['value'=>$val,
																'price'=>$price,
																'default'=>$default,
																'product_property_id'=>$product_property_id];
										// echo json_encode($product_value_set);
										$this->TempProductValue->create();
										$this->TempProductValue->set($product_value_set);
										
										if ($this->TempProductValue->save()) {
											// echo json_encode("product value saved");
											$DS_ProductValue->commit();
											$DS_ProductProperty->commit();
											$DS_Product->commit();
										}
										else {
											// echo json_encode("not saved values");
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
		}
		else {
			return "Error:Already_Existing";
		}
		
		return json_encode("Everything was executed");
	}

	public function add_images() {
		$id = $this->params['url']['id'];
		$product_obj = $this->Product->findById($id);
		$product_name = "Unknown";
		if(!empty($product_obj['Product'])) {
			$product = $product_obj['Product'];
			$product_name = $product['name'];
		}
		
		$this->set(compact('id', 'product_name'));
	}
	
	/////////////////////ADONIS/////////////////
	public function website_products(){
		 $this->loadModel('User');
         $user = $this->User->findById($this->Auth->user('id'));
		    
		     if($this->Auth->user('department_id') == 6 || $this->Auth->user('department_id') == 7 || $this->Auth->user('department_id') == 17 || $this->Auth->user('role') == 'it_staff'){
		     
		        $productinformations = $this->Product->find('all',
		        [
		    
		         "contain"=>["SubCategory" =>  ["Category"]],
		         "conditions" =>["Product.website_product" => 1],
		         "fields"=>['Product.id','Product.image','Product.name','Product.sub_category_id','SubCategory.category_id','SubCategory.id','SubCategory.name'],
		        ]);
		        
		       
		         $productinformation_selects = $this->Product->find('all',
		        [
		         "conditions"=>["Product.website_product" => 0],
		         "fields"=>['Product.id','Product.name'],
		        ]);
		       
		        // pr($productinformations); exit();
	            $this->set(compact('productinformations','productinformation_selects')); 
		}
	}
	
	public function update_website_products(){
			$this->autoRender = false;
	    	$this->response->type('json');
			$data=$this->request->data;
	        $id=$data['id'];
        
        foreach($id as $id1){
        	$this->Product->id=$id1;
        	$this->Product->set(array(
        		"website_product"=>1
        		));
        		if($this->Product->save()){
        			echo json_encode($data);
        			}
            }
	}
	
	public function delete_website_products(){
		$this->autoRender = false;
    	$this->response->type('json');
		$data=$this->request->data;
        $id=$data['id'];
   
   
    	$this->Product->id=$id;
    	$this->Product->set(array(
    		"website_product"=>0));
    		if($this->Product->save()){
    			echo json_encode($data);
    			}
        
	}
	
	public function try_serverside(){
		
	}
	
	
	public function try_serverside__(){
		
		// $this->layout = "ajax";
		// $this->autoRender = false;   
		
		echo $this->request->data['RecordsStart'];
		echo $this->request->data['PageSize'];
		
		$this->Product->recursive = -1;
		$products = $this->Product->find('all');
		
		$data = [];
		foreach($products as $key => $product){
			$img = $this->thumbnail($product['Product']['image']);
			// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
		
			$imageData = base64_encode($img);

			// Format the image SRC:  data:{mime};base64,{data};
			$src = 'data: image/jpg;base64,'.$imageData;
			
			// Echo out a sample image
			
			
			$data[$key]['image'] =  $img;
			// $data[$key]['image'] =  $product['Product']['image'];
			$data[$key]['name'] = htmlspecialchars($product['Product']['name']);
			$data[$key]['action'] = '<a href="/products/add_images?id='.$product['Product']['id'].'" class="btn btn-sm btn-primary"
			                    		data-toggle="tooltip"
			                    		data-placement="top"
			                    		title="Add images">
			                    	<span class="fa fa-camera-retro"></span>
			                    </a>
			                    <a class="btn btn-sm btn-info"
									data-toggle="tooltip"
									data-placement="top" title="Product Combo"
									href="/product_combos/view?id='.$product['Product']['id'].'">
									<span class="fa fa-book"></span>
								</a>
								<a class="btn btn-sm btn-warning"
								   style="color:white;"
								   href="/products/edit?id='.$product['Product']['id'].'">
									Edit
								</a>';
			
		}
		// $return_data['data'] = $data;
		$this->set(compact('data'));
		$this->set('_serialize', array('data'));
		// echo json_encode($return_data);
	}
	
	
	public function try_serverside1(){
	    // dont change
		$page =  $this->request->data['RecordsStart'];
		$limit =  $this->request->data['PageSize'];
		$search =  $this->request->data['Search'];
		$order =  $this->request->data['Order'];
		// dont change
		
		// include only the fields that needs to be searched.
		// Make sure that the field will be included on your find statement
		$fields_for_search = ['Product.name'];
		// include only the fields that are shown on the view.
		// as much as possible all fields that whats on the view side should be on DB. else disable sorting of that field
		$fields_for_order = ['Product.image', 'Product.name', 'Product.id'];

        // dont change
		if($search != ""){
			foreach($fields_for_search as $k){
				
				$options['conditions']['OR'] = [$k.' LIKE' => '%'.$search.'%'];
				
			}
			
		}
		
		if($order != null){
			$options['order'] = $fields_for_order[$order['column']].' '.$order['dir'];
		}
		// dont change
		
		
		// your query
		$products_all = $this->Product->find('all');
		$products_filtered = $this->Product->find('all', $options);
		
		// dont change
		$options['limit'] = $limit;
		$options['page'] = ceil(($page / $limit)) + 1;
		// dont change
		
		$this->Product->recursive = -1;
		$this->Paginator->settings = $options;
		$products = $this->Paginator->paginate('Product');
		
		$data = [];
		foreach($products as $key => $product){
		    ///--start--create thumbnail
			$img = $this->thumbnail($product['Product']['image']);
			$imageData = base64_encode($img);
			$src = 'data: image/jpg;base64,'.$imageData;
			//--end--create thumbnail
			$data[$key]['image'] =  '<img src="' . $src . '">';
			
			$data[$key]['name'] = htmlspecialchars($product['Product']['name']);
			$data[$key]['action'] = '<a href="/products/add_images?id='.$product['Product']['id'].'" class="btn btn-sm btn-primary"
			                    		data-toggle="tooltip"
			                    		data-placement="top"
			                    		title="Add images">
			                    	<span class="fa fa-camera-retro"></span>
			                    </a>
			                    <a class="btn btn-sm btn-info"
									data-toggle="tooltip"
									data-placement="top" title="Product Combo"
									href="/product_combos/view?id='.$product['Product']['id'].'">
									<span class="fa fa-book"></span>
								</a>
								<a class="btn btn-sm btn-warning"
								   style="color:white;"
								   href="/products/edit?id='.$product['Product']['id'].'">
									Edit
								</a>';
			
		}
		// change only the value
		$return_data['Data'] = $data;
		$return_data['TotalRecords'] = count($products_all);
		$return_data['RecordsFiltered'] = count($products_filtered);
		
		$this->set('data', $return_data);
		$this->set('_serialize', 'data');
		// change only the value
	}

}