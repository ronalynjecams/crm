<?php
App::uses('AppController', 'Controller');
/**
 * InventoryJobOrders Controller
 *
 * @property InventoryJobOrder $InventoryJobOrder
 * @property PaginatorComponent $Paginator
 */
class InventoryJobOrdersController extends AppController {

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
		$this->InventoryJobOrder->recursive = 0;
		$this->set('inventoryJobOrders', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->InventoryJobOrder->exists($id)) {
			throw new NotFoundException(__('Invalid inventory job order'));
		}
		$options = array('conditions' => array('InventoryJobOrder.' . $this->InventoryJobOrder->primaryKey => $id));
		$this->set('inventoryJobOrder', $this->InventoryJobOrder->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->InventoryJobOrder->create();
			if ($this->InventoryJobOrder->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory job order has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory job order could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		}
		$productCombos = $this->InventoryJobOrder->ProductCombo->find('list');
		$this->set(compact('productCombos'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->InventoryJobOrder->exists($id)) {
			throw new NotFoundException(__('Invalid inventory job order'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->InventoryJobOrder->save($this->request->data)) {
				$this->Session->setFlash(__('The inventory job order has been saved.'), 'default', array('class' => 'alert alert-success'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The inventory job order could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
			}
		} else {
			$options = array('conditions' => array('InventoryJobOrder.' . $this->InventoryJobOrder->primaryKey => $id));
			$this->request->data = $this->InventoryJobOrder->find('first', $options);
		}
		$productCombos = $this->InventoryJobOrder->ProductCombo->find('list');
		$this->set(compact('productCombos'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->InventoryJobOrder->id = $id;
		if (!$this->InventoryJobOrder->exists()) {
			throw new NotFoundException(__('Invalid inventory job order'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->InventoryJobOrder->delete()) {
			$this->Session->setFlash(__('The inventory job order has been deleted.'), 'default', array('class' => 'alert alert-success'));
		} else {
			$this->Session->setFlash(__('The inventory job order could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
		}
		return $this->redirect(array('action' => 'index'));
	}
	
	public function process_quoted_products(){
		
        $this->autoRender = false;
        $data = $this->request->data;
        	$this->loadModel('TransactionSource');
        	$this->loadModel('Quotation');
        	$this->loadModel('QuotationProduct');
        	
            $slctd_inv_lcation = $data['slctd_inv_lcation']; 
            $slctd_inv_prdct = $data['slctd_inv_prdct']; 
            $slctd_inv_prdctcombo = $data['slctd_inv_prdctcombo']; 
            $po_inv_qty = $data['po_inv_qty']; 
            $inv_quote_product_id = $data['inv_quote_product_id'];
            $inventory_job_order_type = $data['inventory_job_order_type']; 
             
             //get quotation infor from quotationproduct
             
             if($inventory_job_order_type == 'dr'){
            	$quoted_product_details = $this->QuotationProduct->findById($inv_quote_product_id);
             	$reference_num = $quoted_product_details['Quotation']['id']; 
             	$reference_type = 'quotation';
             	$product_type = $quoted_product_details['Product']['type'];
             	
             	$processed_qty = $quoted_product_details['QuotationProduct']['processed_qty'];
	            $pro_qty = $processed_qty + $po_inv_qty;
             }
             
        $ijo = $this->InventoryJobOrder->getDataSource();
        $ijo->begin();
        
        $this->InventoryJobOrder->create;
            $this->InventoryJobOrder->set(array(
                'product_combo_id'=>$slctd_inv_prdctcombo,
                'qty'=>$po_inv_qty,
                'processed_qty'=>0,
                'reference_num'=>$reference_num,
                'reference_type'=>$inventory_job_order_type,
                'mode'=>'release',
                'status'=>'newest',
                'inv_location_id'=>$slctd_inv_lcation
            )); 
            if($this->InventoryJobOrder->save()){ 
                $inventory_job_order_id = $this->InventoryJobOrder->getLastInsertID();
		        $ts = $this->TransactionSource->getDataSource();
		        $ts->begin();
            		
                $this->TransactionSource->create;
                $this->TransactionSource->set(array(
                    'reference_num'=>$reference_num,
                    'reference_type'=>$reference_type, 
                    'mode'=>'inventory',
                    'mode_num'=>$inventory_job_order_id,
                    'product_combo_id'=>$slctd_inv_prdctcombo,
                    'product_source'=>$inv_quote_product_id,
                    'type'=>$product_type, 
                )); 
                if($this->TransactionSource->save()){
                	if($inventory_job_order_type == 'dr'){
                		
			            $dateToday = date("Y-m-d H:i:s");
			            
		        $qt = $this->Quotation->getDataSource();
		        $qt->begin();
		        
			            $this->Quotation->id = $reference_num;
			            $this->Quotation->set(array(
			                'status' => 'processed',
			                'date_processed' => $dateToday
			            ));
			            if($this->Quotation->save()){
				
		        $qtprod = $this->QuotationProduct->getDataSource();
		        $qtprod->begin();
		        
				            $this->QuotationProduct->id = $inv_quote_product_id;
				            $this->QuotationProduct->set(array(
				                'processed_qty' => $pro_qty
				            ));
				            if($this->QuotationProduct->save()){
				            	$ijo->commit();
				            	$ts->commit();
				            	$qt->commit();
				            	$qtprod->commit();
				            	echo json_encode($data); 
				            	exit;
				            }else{
				            	$ijo->rollback();
				            	$ts->rollback();
				            	$qt->rollback();
				            	$qtprod->rollback();
				            }
			            }//add else if here
			            else{
	                		$ijo->rollback();
	                		$ts->rollback();
			            }
                		
                	}else{
                		$ijo->rollback();
                		$ts->rollback();
                	}
                }else{
                    $ijo->rollback();
                    $ts->rollback();  
                }
	        }else{
	            $ijo->rollback();
	        }
        
          
		
	}
	
	public function all_list(){
		$mode = $this->params['url']['mode'];
        $status = $this->params['url']['status'];
        
        $this->InventoryJobOrder->recursive = 2;
        
        if($this->Auth->user('role') == "warehouse_head_supply") {
	        $options = array('conditions' => array('InventoryJobOrder.mode' => $mode, 'InventoryJobOrder.status' => $status, 'InventoryJobOrder.product_type' => 'supply'));
	        $inventory = $this->InventoryJobOrder->find('all', $options);
        }
        elseif($this->Auth->user('role') == "warehouse_head_raw") {
	        $options = array('conditions' => array('InventoryJobOrder.mode' => $mode, 'InventoryJobOrder.status' => $status, 'InventoryJobOrder.product_type' => 'raw'));
		    $inventory = $this->InventoryJobOrder->find('all', $options);
        }
        else {
        	$inventory = [];
        }
        
        
        $this->loadModel("InvLocation");
        $this->InvLocation->recursive = 0;
        // pr($inventory); exit;
        $locations = $this->InvLocation->find("all"); 
        $this->set(['mode' => $mode, 'status' => $status, 'locations' => $locations]);
        $this->set(compact('inventory'));
	}
	
	public function	save_inventory(){
		$this->autoRender = false;
		header("Content-type:application/json");
        $data = $this->request->data;
		 
		$ref_type = $data['ref_type'];
		$location = $data['location'];
        $qty = $data['qty'];
        $ref_num = $data['ref_num'];
        $prod_combo_id = $data['prod_combo_id'];
        $invjo_id = $data['invjo_id'];
        $status = $data['status'];
        $invjo_pqty = $data['invjo_pqty'];
		
		if($ref_type == 'po'){
			$this->loadModel('PurchaseOrderProduct');
			$this->PurchaseOrderProduct->recursive = -1;
			
			$po_prod = $this->PurchaseOrderProduct->findByProductComboIdAndPurchaseOrderId($prod_combo_id, $ref_num);
			if($po_prod){
				$this->PurchaseOrderProduct->id = $po_prod['PurchaseOrderProduct']['id'];
				$this->PurchaseOrderProduct->set(array('processed_qty' => $qty));
				if($this->PurchaseOrderProduct->save()){
					$this->loadModel('InventoryProduct');
					$this->InventoryProduct->recursive = -1;
					$inv_prod = $this->InventoryProduct->findByProductComboIdAndInvLocationId($prod_combo_id, $location);
					if($inv_prod){
						$this->InventoryProduct->id = $inv_prod['InventoryProduct']['id'];
						$this->InventoryProduct->set(array('qty' => ($inv_prod['InventoryProduct']['qty']+$qty)));
						if($this->InventoryProduct->save()){
							$this->InventoryJobOrder->id = $invjo_id;
							$this->InventoryJobOrder->set(array('status' => $status, 'processed_qty' => ($invjo_pqty+$qty)));
							if($this->InventoryJobOrder->save()){
								return 'success';
							} else{
								return 'error 1';	
							}
						} else{
							return 'error 2';	
						}
					} else{
						return 'error 3';	
					}
				} else{
					return 'error 4';	
				}
			} else{
				return 'error 5';	
			}
		} 
		if($ref_type == 'dr'){
			$this->loadModel('DeliverySchedProduct');
			$this->DeliverySchedProduct->recursive = -1;
			
			$po_prod = $this->DeliverySchedProduct->findByProductComboIdAndPurchaseOrderId($data['prod_combo_id'],$data['ref_num']);
			
			$this->PurchaseOrderProduct->id = $po_prod['PurchaseOrderProduct']['id'];
			$this->PurchaseOrderProduct->set(array('processed_qty' => $data['qty']));
			if($this->PurchaseOrderProduct->save()){
				return 'success';
			}	
		} 
		if($ref_type == 'demo' || $ref_type == 'demo'){
			
		} 
		
		exit;
	}
	
	
	public function get_inventory_prod(){
		$id = $this->params['url']['id'];
	}
	
	public function process_po_raw_products(){
		
        $this->autoRender = false;
        $data = $this->request->data;
        	$this->loadModel('TransactionSource');
        	$this->loadModel('Quotation');
        	$this->loadModel('QuotationProduct');
        	
            $slctd_inv_lcation = $data['slctd_inv_lcation']; 
            $slctd_inv_prdct = $data['slctd_inv_prdct']; 
            $slctd_inv_prdctcombo = $data['slctd_inv_prdctcombo']; 
            $po_inv_qty = $data['po_inv_qty']; 
            $inv_quote_product_id = $data['inv_quote_product_id'];
            $inventory_job_order_type = $data['inventory_job_order_type']; 
             
            $this->loadModel('PoRawRequest');
            $po_raw_request_id = $data['inv_po_raw_request_id'];
            $po_raw_request_qty = $data['inv_po_raw_request_qty']; //this is the processed qty
            
            //update prodcut combo id, processed qty, pdate processed
            
            $po_raw_qry = $this->PoRawRequest->findById($po_raw_request_id); 
            
            
            $dateToday = date("Y-m-d H:i:s");
            $new_processed_qty = $po_raw_request_qty + $po_inv_qty;
            
            if($po_raw_qry['PoRawRequest']['qty'] == $new_processed_qty){
                $raw_status = 'processed';
            }else{
                $raw_status = 'pending';
            }
            
            $this->PoRawRequest->id = $po_raw_request_id;
            $this->PoRawRequest->set([
                'processed_qty'=>$new_processed_qty,
                'product_combo_id'=>$slctd_inv_prdctcombo,
                'date_processed'=>$dateToday,
                'status'=>$raw_status
                ]);
            if($this->PoRawRequest->save()){
                
               //////////TRACE THIS PART
                // $this->TransactionSource->create;
                // $this->TransactionSource->set(array(
                //     'reference_num'=>$po_raw_request_id,
                //     'reference_type'=>'po_raw_request', 
                //     'mode'=>'inventory',
                //     'mode_num'=>0,
                //     'product_combo_id'=>$slctd_inv_prdctcombo,
                //     'product_source'=>$inv_quote_product_id,
                //     'type'=>$product_type, 
                // )); 
                // $this->TransactionSource->save(); 
                
            }
            
                        echo json_encode($data); 
             
             
             
             
             
             
             
             
             
                // $this->TransactionSource->create;
                // $this->TransactionSource->set(array(
                //     'reference_num'=>$reference_num,
                //     'reference_type'=>$reference_type, 
                //     'mode'=>'inventory',
                //     'mode_num'=>$inventory_job_order_id,
                //     'product_combo_id'=>$slctd_inv_prdctcombo,
                //     'product_source'=>$inv_quote_product_id,
                //     'type'=>$product_type, 
                // )); 
                // if($this->TransactionSource->save()){
                // 	//uodate po raw request
                // }
             
             
             
             
             
             
             //get quotation infor from quotationproduct
             
             //if($inventory_job_order_type == 'dr'){
            	// $quoted_product_details = $this->QuotationProduct->findById($inv_quote_product_id);
             //	$reference_num = $quoted_product_details['Quotation']['id']; 
             //	$reference_type = 'quotation';
             //	$product_type = $quoted_product_details['Product']['type'];
             	
             //	$processed_qty = $quoted_product_details['QuotationProduct']['processed_qty'];
	            // $pro_qty = $processed_qty + $po_inv_qty;
             //}
             
        // $ijo = $this->InventoryJobOrder->getDataSource();
        // $ijo->begin();
        
        // $this->InventoryJobOrder->create;
        //     $this->InventoryJobOrder->set(array(
        //         'product_combo_id'=>$slctd_inv_prdctcombo,
        //         'qty'=>$po_inv_qty,
        //         'processed_qty'=>0,
        //         'reference_num'=>$reference_num,
        //         'reference_type'=>$inventory_job_order_type,
        //         'mode'=>'release',
        //         'status'=>'newest',
        //         'inv_location_id'=>$slctd_inv_lcation
        //     )); 
        //     if($this->InventoryJobOrder->save()){ 
        //         $inventory_job_order_id = $this->InventoryJobOrder->getLastInsertID();
		      //  $ts = $this->TransactionSource->getDataSource();
		      //  $ts->begin();
            		
        //         $this->TransactionSource->create;
        //         $this->TransactionSource->set(array(
        //             'reference_num'=>$reference_num,
        //             'reference_type'=>$reference_type, 
        //             'mode'=>'inventory',
        //             'mode_num'=>$inventory_job_order_id,
        //             'product_combo_id'=>$slctd_inv_prdctcombo,
        //             'product_source'=>$inv_quote_product_id,
        //             'type'=>$product_type, 
        //         )); 
        //         if($this->TransactionSource->save()){
        //         	if($inventory_job_order_type == 'dr'){
                		
			     //       $dateToday = date("Y-m-d H:i:s");
			            
		      //  $qt = $this->Quotation->getDataSource();
		      //  $qt->begin();
		        
			     //       $this->Quotation->id = $reference_num;
			     //       $this->Quotation->set(array(
			     //           'status' => 'processed',
			     //           'date_processed' => $dateToday
			     //       ));
			     //       if($this->Quotation->save()){
				
		      //  $qtprod = $this->QuotationProduct->getDataSource();
		      //  $qtprod->begin();
		        
				    //         $this->QuotationProduct->id = $inv_quote_product_id;
				    //         $this->QuotationProduct->set(array(
				    //             'processed_qty' => $pro_qty
				    //         ));
				    //         if($this->QuotationProduct->save()){
				    //         	$ijo->commit();
				    //         	$ts->commit();
				    //         	$qt->commit();
				    //         	$qtprod->commit();
				    //         	echo json_encode($data); 
				    //         	exit;
				    //         }else{
				    //         	$ijo->rollback();
				    //         	$ts->rollback();
				    //         	$qt->rollback();
				    //         	$qtprod->rollback();
				    //         }
			     //       }//add else if here
			     //       else{
	       //         		$ijo->rollback();
	       //         		$ts->rollback();
			     //       }
                		
        //         	}else{
        //         		$ijo->rollback();
        //         		$ts->rollback();
        //         	}
        //         }else{
        //             $ijo->rollback();
        //             $ts->rollback();  
        //         }
	       // }else{
	       //     $ijo->rollback();
	       // }
        
          
		
	}
	

}
