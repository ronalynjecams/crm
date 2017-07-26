<?php
App::uses('AppController', 'Controller');
/**
 * QuotationProducts Controller
 *
 * @property QuotationProduct $QuotationProduct
 * @property PaginatorComponent $Paginator
 */
class QuotationProductsController extends AppController {

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
		$this->QuotationProduct->recursive = 0;
		$this->set('quotationProducts', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->QuotationProduct->exists($id)) {
			throw new NotFoundException(__('Invalid quotation product'));
		}
		$options = array('conditions' => array('QuotationProduct.' . $this->QuotationProduct->primaryKey => $id));
		$this->set('quotationProduct', $this->QuotationProduct->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->QuotationProduct->create();
			if ($this->QuotationProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The quotation product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quotation product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$quotations = $this->QuotationProduct->Quotation->find('list');
		$products = $this->QuotationProduct->Product->find('list');
		$this->set(compact('quotations', 'products'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->QuotationProduct->exists($id)) {
			throw new NotFoundException(__('Invalid quotation product'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->QuotationProduct->save($this->request->data)) {
				$this->Session->setFlash(__('The quotation product has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The quotation product could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('QuotationProduct.' . $this->QuotationProduct->primaryKey => $id));
			$this->request->data = $this->QuotationProduct->find('first', $options);
		}
		$quotations = $this->QuotationProduct->Quotation->find('list');
		$products = $this->QuotationProduct->Product->find('list');
		$this->set(compact('quotations', 'products'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete() {
            
            $this->autoRender = false;
            $data = $this->request->data;
            $id = $data['id'];
		$this->QuotationProduct->id = $id;
		if (!$this->QuotationProduct->exists()) {
			throw new NotFoundException(__('Invalid quotation product'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->QuotationProduct->delete()) {
                    echo json_encode($id);
//			$this->Session->setFlash(__('The quotation product has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
                    echo json_encode($id);
//			$this->Session->setFlash(__('The quotation product could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
                echo json_encode($id);
//		return $this->redirect(array('action' => 'index'));
	}
        
        
        public function add_quote_product(){
            $this->autoRender = false;
            $c = ["1","2"];
            if(!is_null($c)){
                foreach($c as $key => $property_id){ 
                    pr($property_id);
            }
            }else{
                pr('asd');
            }
        }
        
        
        public function saveProductQuotation(){
             
            $this->autoRender = false; 
            $data = $this->request->data;
                 
            
            $quotation_id = $data['quotation_id'];
            $product_id = $data['product_id'];
            $image = $data['image'];
            $qty = $data['qty'];
            $price = $data['price'];
            $type = $data['type'];
            $other_info = $data['other_info'];
            $edited_amount = $data['edited_amount'];
            $sale = $data['sale'];
            
            $total = $qty * $edited_amount;
             
            $dif = $price - $edited_amount;
            if($edited_amount > $price){
                $discount = 0;
                $additional = $dif;
            }else if($edited_amount < $price){
                $discount = $dif;
                $additional = 0;
            }else{
                $discount = 0;
                $additional = 0;
            }
            
            $this->QuotationProduct->create();
            $this->QuotationProduct->set(array(
                "quotation_id"=>$quotation_id,
                "product_id"=>$product_id,
                "image"=>$image,
                "qty"=>$qty,
                "price"=>$price,
                "other_info"=>$other_info,
                "edited_amount"=>$edited_amount,
                "sale"=>$sale,
                "total"=>$total,
                "discount"=>$discount,
                "additional"=>$additional,
                "type"=>$type 
            )); 
            if($this->QuotationProduct->save()){ 
                
            $this->loadModel('QuotationProductProperty');
                $quotation_product_id = $this->QuotationProduct->getLastInsertID();
                   
                if(count(@$data['obj'])!=0){
                   foreach($data['obj'] as $key => $value) { 
                        $this->QuotationProductProperty->create();
                        $this->QuotationProductProperty->set(array(
                            "quotation_product_id"=>$quotation_product_id 
                        )); 
                        $this->QuotationProductProperty->save(); 

                        $qpp_id = $this->QuotationProductProperty->getLastInsertID();

                        $this->QuotationProductProperty->id=$qpp_id;
                        $this->QuotationProductProperty->set(array( 
                            "property"=> $key,
                            "value"=>$value
                        ));
                        $this->QuotationProductProperty->save(); 
                    } 
                }   
                
                if(count(@$data['obj_ids'])!=0){
                   foreach($data['obj_ids'] as $key => $value) { 
                        $this->QuotationProductProperty->create();
                        $this->QuotationProductProperty->set(array(
                            "quotation_product_id"=>$quotation_product_id 
                        )); 
                        $this->QuotationProductProperty->save(); 

                        $qpp_id = $this->QuotationProductProperty->getLastInsertID();

                        $this->QuotationProductProperty->id=$qpp_id;
                        $this->QuotationProductProperty->set(array( 
                            "product_property_id"=> $key,
                            "product_value_id"=>$value
                        ));
                        $this->QuotationProductProperty->save(); 
                    } 
                }
             
                    echo json_encode($data); 
            }
        }
        
        
}
