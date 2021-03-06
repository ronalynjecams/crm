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
        $today = date('Y-m-d H:m:s');
        
        $userin = $this->Auth->user('id');
        $id = $data['id'];
        $qid = $data['quote_id'];
        $grand_total = $data['grand_total'];
        $sub_total = $data['sub_total'];
        $delivery_charge = $data['delivery_charge'];
        $installation_charge = $data['installation_charge'];
        $discount = $data['discount'];
        
        $this->loadModel('JobRequestProduct');
        $this->loadModel('JobRequest');
        $this->loadModel('JobRequestLog');
        $this->loadModel('Quotation');
        $this->loadModel('DeliverySchedule');
        $this->loadModel('DeliverySchedProduct');
        $this->loadModel('PurchaseOrder');
        $this->loadModel('PurchaseOrderProduct');
        $this->loadModel('Production');
        $this->loadModel('PoRawRequest');
        $this->loadModel('QuotationUpdateLog');
        $this->loadModel('InventoryJobOrder');
        $this->loadModel('ClientServiceProduct');
        $this->loadModel('ClientService');
        
        // DELETED ON JOB REQUESTS
        // ===================================================================>
        // GET QUOTATION PRODUCT ON JOB REQUEST PRODUCT
        $this->JobRequestProduct->recursive = -1;
        $getJobRequestProduct = $this->JobRequestProduct->find('first',
            ['conditions'=>['quotation_product_id'=>$id,
                            'quotation_id'=>$qid],
             'fields'=>['id', 'quotation_product_id', 'quotation_id',
                        'job_request_id']]);
        if(!empty($getJobRequestProduct)) {
            $job_request_id = $getJobRequestProduct['JobRequestProduct']['job_request_id'];
            $job_request_product_id = $getJobRequestProduct['JobRequestProduct']['id'];
            $DS_JobRequestProduct_delete = $this->JobRequestProduct->getDataSource();
            $DS_JobRequestProduct_delete->begin();
            $this->JobRequestProduct->id = $job_request_product_id;
            $this->JobRequestProduct->set(['date_deleted'=>$today]);
            if($this->JobRequestProduct->save()) {
                echo "-JobRequestProduct delete save-";
                
                // CHECK ALL JOB REQUEST PRODUCT OF THIS JOB REQUEST IF "date_deleted" != null
                $this->JobRequestProduct->recursive = -1;
                $count_JobRequestProductDeleted = $this->JobRequestProduct->find('count',
                    ['conditions'=>['job_request_id'=>$job_request_id,
                                    'date_deleted'=>null],
                     'fields'=>['id', 'date_deleted', 'job_request_id', 'status']]);
                
                // UPDATE JOB REQUEST DELETED
                if($count_JobRequestProductDeleted==0) {
                    echo "-JOB REQUEST PRODUCTS HAS BEEN DELETED ALL-";
                    $DS_JobRequest_delete = $this->JobRequest->getDataSource();
                    $DS_JobRequest_delete->begin();
                    
                    $this->JobRequest->id = $job_request_id;
                    $this->JobRequest->set(['deleted'=>$today]);
                    if($this->JobRequest->save()) {
                        echo "-JobRequest saved-";
                        
                        // UPDATE "job_request_id" to 0 OF QUOTATION if "job_request_id" was deleted
                        $DS_Quotation_update = $this->Quotation->getDataSource();
                        $DS_Quotation_update->begin();
                        $this->Quotation->id = $qid;
                        $this->Quotation->set(['job_request_id'=>0]);
                        if($this->Quotation->save()) {
                            echo "-Quotation update saved-";
                            
                            $job_request_log_set= ['user_id'=>$userin,
                                                  'job_request_id'=>$job_request_id,
                                                  'job_request_product_id'=>$job_request_product_id,
                                                  'quotation_product_id'=>$id];
                            
                            // Job request log
                            $DS_JobRequestLog = $this->JobRequestLog->getDataSource();
                            $DS_JobRequestLog->begin();
                            $this->JobRequestLog->create();
                            $this->JobRequestLog->set($job_request_log_set);
                            if($this->JobRequestLog->save()) {
                                echo "-JobRequestLog save-";
                                $DS_JobRequestLog->commit();
                                $DS_Quotation_update->commit();
                                $DS_JobRequest_delete->commit();
                                $DS_JobRequestProduct_delete->commit();
                            }
                            else {
                                echo "-Error in JobRequestLog-";
                                $DS_JobRequestLog->rollback();
                                $DS_Quotation_update->rollback();
                                $DS_JobRequest_delete->rollback();
                                $DS_JobRequestProduct_delete->rollback();
                            }
                        }
                        else {
                            echo "-Error in Quotation update-";
                            $DS_Quotation_update->rollback();
                            $DS_JobRequest_delete->rollback();
                            $DS_JobRequestProduct_delete->rollback();
                        }
                    }
                    else {
                        echo "-Error in JobRequest delete-";
                        $DS_JobRequest_delete->rollback();
                        $DS_JobRequestProduct_delete->rollback();
                    }
                }
                else {
                    echo "-NOT All JobRequest Product deleted-";
                    $DS_JobRequestProduct_delete->commit();
                }
            }
            else {
                echo "-Error in JobRequestProduct delete-";
                $DS_JobRequestProduct_delete->rollback();
            }
        }
        else {
            echo "-NO JOB REQUEST PRODUCT FOR THIS.-";
        }
        // END FOR DELETED ON JOB REQUESTS
        // ===================================================================>
    
        // DELETED ON PURCHASE ORDER PRODUCT
        // ===================================================================>
        $getPurchaseOrderProduct = $this->PurchaseOrderProduct->find('all',
            ['conditions'=>
                ['reference_type'=>'quotation',
                 'reference_num'=>$id],
             'fields'=>['reference_type',
                        'reference_num',
                        'purchase_order_id',
                        'id']]);
        foreach($getPurchaseOrderProduct as $retPurchaseOrderProduct) {
            $PurchaseOrderProduct = $retPurchaseOrderProduct['PurchaseOrderProduct'];
            $id_PurchaseOrderProduct = $PurchaseOrderProduct['id'];
            $purchase_order_id_PurchaseOrderProduct = $PurchaseOrderProduct['purchase_order_id'];
            $DS_PurchaseOrderProduct = $this->PurchaseOrderProduct->getDataSource();
            $DS_PurchaseOrderProduct->begin();
            $this->PurchaseOrderProduct->id = $id_PurchaseOrderProduct;
            $this->PurchaseOrderProduct->set(['deleted'=>$today]);
            if($this->PurchaseOrderProduct->save()) {
                echo "PurchaseOrderProduct save";
                
                $this->PurchaseOrderProduct->recursive = -1;
                $getAllPurchaseOrderProduct = $this->PurchaseOrderProduct->find('all',
                    ['conditions'=>
                        ['purchase_order_id'=>$purchase_order_id_PurchaseOrderProduct],
                     'fields'=>['id', 'purchase_order_id']]);
                if(count($getAllPurchaseOrderProduct)==1) {
                    $DS_PurchaseOrder = $this->PurchaseOrder->getDataSource();
                    $DS_PurchaseOrder->begin();
                    $this->PurchaseOrder->id = $purchase_order_id_PurchaseOrderProduct;
                    $this->PurchaseOrder->set(['status'=>'cancelled']);
                    if($this->PurchaseOrder->save()) {
                        echo "PurchaseOrder save";
                        $DS_PurchaseOrder->commit();
                        $DS_PurchaseOrderProduct->commit();
                    }
                    else {
                        echo "Error in PurchaseOrder";
                        $DS_PurchaseOrder->rollback();
                        $DS_PurchaseOrderProduct->commit();
                    }
                }
                else { 
                    echo "PurchaseOrderProduct save";
                    $DS_PurchaseOrderProduct->commit();
                }
            }
            else {
                echo "Error PurchaseOrderProduct";
                $DS_PurchaseOrderProduct->rollback();
            }
        }
        // END FOR DELETED ON PURCHASE ORDER PRODUCT
        // ===================================================================>
        
        
        // END FOR DELETED ON PRODUCTIONS
        // ===================================================================>
        $this->Production->recursive = -1;
        $getProductions = $this->Production->findByQuotationProductId($id, 'id');
        $Productions = [];
        if(!empty($Productions)) {
            $Productions = $getProductions['Productions'];
            $id_Productions = $Productions['id'];
            $DS_Productions = $this->Production->getDataSource();
            $DS_Productions->begin();
            $this->Production->id = $id_Productions;
            $this->Production->set(['deleted'=>$today]);
            if($this->Production->save()) {
                echo "Production save";
                $DS_Productions->commit();
            }
            else {
                echo "Error Production";
                $DS_Productions->rollback();
            }
        }
        // END FOR DELETED ON PRODUCTIONS
        // ===================================================================>
        
        // DELETED ON PO RAW REQUESTS
        // ===================================================================>
        $this->PoRawRequest->recursive = -1;
        $getPoRawRequests = $this->PoRawRequest->findAllByQuotationProductId($id);
        foreach($getPoRawRequests as $retPoRawRequest) {
            $PoRawRequest = $retPoRawRequest['PoRawRequest'];
            $id_PoRawRequest = $PoRawRequest['id'];
            $this->PoRawRequest->id = $id_PoRawRequest;
            $this->PoRawRequest->set(['deleted'=>$today]);
            if($this->PoRawRequest->save()) {
                echo "PoRawRequest save";
            }
            else {
                echo "Error PoRawRequest";
            }
        }
        // END FOR DELETED ON PO RAW REQUESTS
        // ===================================================================>
        
        // DELETED ON INVENTORY JOB ORDERS
        // ===================================================================>
        $getInventoryJobOrder = $this->InventoryJobOrder->find('all',
                                ['conditions'=>['reference_type'=>'dr',
                                                'reference_num'=>$id]]);
        foreach($getInventoryJobOrder as $retInventoryJobOrder) {
            $InventoryJobOrder = $retInventoryJobOrder['InventoryJobOrder'];
            $InventoryJobOrder_id = $InventoryJobOrder['id'];
            
            $DS_InventoryJobOrder = $this->InventoryJobOrder->getDataSource();
            $DS_InventoryJobOrder->begin();
            $this->InventoryJobOrder->id = $InventoryJobOrder_id;
            $this->InventoryJobOrder->set(['deleted'=>$today]);
            if($this->InventoryJobOrder->save()) {
                echo "InventoryJobOrder save";
                $DS_InventoryJobOrder->commit();
            }
            else {
                echo "Error InventoryJobOrder";
                $DS_InventoryJobOrder->rollback();
            }
        }
        // END FOR DELETED ON INVENTORY JOB ORDERS
        // ===================================================================>
        
        
        // END FOR DELETED ON DEMO PRODUCTS
        // ===================================================================>
        $getClientServiceProduct = $this->ClientServiceProduct->find('all',
            ['conditions'=>['quotation_product_id'=>$id]]);
        
        $ClientServicesIds = [];
        $isAllClientServiceProductDeleted = [];
        foreach($getClientServiceProduct as $retClientServiceProduct) {
            $ClientServiceProduct = $retClientServiceProduct['ClientServiceProduct'];
            $ClientServiceProduct_id = $ClientServiceProduct['id'];
            $ClientServiceProduct_client_service_id = $ClientServiceProduct['client_service_id'];
            
            $this->ClientServiceProduct->id = $ClientServiceProduct_id;
            $this->ClientServiceProduct->set(['date_deleted'=>$today]);
            if($this->ClientServiceProduct->save()) {
                echo "ClientServiceProduct save";
                $isAllClientServiceProductDeleted[] = "yes";
                $ClientServicesIds[] = $ClientServiceProduct_client_service_id;
            }
            else {
                echo "Error ClientServiceProduct";
                $isAllClientServiceProductDeleted[] = "no";
            }
        }
        
        if(in_array("no", $isAllClientServiceProductDeleted)) {
            echo "Error in ClientServiceProduct all in all";
        }
        else {
            foreach($ClientServicesIds as $ClientServiceId) {
                $DS_ClientService = $this->ClientService->getDataSource();
                $DS_ClientService->begin();
                $this->ClientService->id = $ClientServiceId;
                $this->ClientService->set(['deleted'=>$today]);
                if($this->ClientService->save()) {
                    echo "ClientService save";
                    $DS_ClientService->commit();
                }
                else {
                    echo "Error ClientService";
                    $DS_ClientService->rollback();
                }
            }
        }
        // END FOR DELETED ON DEMO PRODUCTS
        // ===================================================================>
        
        $this->QuotationProduct->id = $id;
        $this->QuotationProduct->set(['deleted'=>$today]);
        if ($this->QuotationProduct->save()) {
            echo "QuotationProduct set deleted to today";
            
            $this->Quotation->id = $qid;
            $this->Quotation->set(['sub_total'=>$sub_total,
                                  'grand_total'=>$grand_total]);
            if($this->Quotation->save()) {
                echo "Quotation save";
                $this->QuotationUpdateLog->create();
                $this->QuotationUpdateLog->set([
                    "user_id"=>$this->Auth->user('id'),
                    "quotation_id"=>$qid,
                    "status"=>'deleted_product'
                    ]);
                if($this->QuotationUpdateLog->save()){
                    echo json_encode($id);
                }else{
                    echo json_encode($id);
                }
            }
            else { echo "Error in saving Grand total in Quotation"; }
        } else {
            echo json_encode($id);
        }
        
        echo $this->compute_sub_grand($qid, $installation_charge, $delivery_charge, $discount);
        return "Executed everything";
    }

    public function add_quote_product() {
        $this->autoRender = false;
        $c = ["1", "2"];
        if (!is_null($c)) {
            foreach ($c as $key => $property_id) {
                pr($property_id);
            }
        } else {
            pr('asd');
        }
    }

    public function saveProductQuotation() {
        $this->autoRender = false;
        $data = $this->request->data;

        $userin = $this->Auth->user('id');
        $quotation_id = $data['quotation_id'];
        $product_id = $data['product_id'];
        $image = $data['image'];
        $qty = $data['qty'];
        $price = $data['price'];
        $type = $data['type'];
        $other_info = $data['other_info'];
        $edited_amount = $data['edited_amount'];
        $sale = $data['sale'];
        $swatch = $data['swatch'];
        $installation_charge = $data['installation_charge'];
        $delivery_charge = $data['delivery_charge'];
        $discount = $data['discount'];
        $total = $qty*$edited_amount;

        $dif = $price - $edited_amount;
        if ($edited_amount > $price) {
            $discount = 0;
            $additional = $dif;
        } else if ($edited_amount < $price) {
            $discount = $dif;
            $additional = 0;
        } else {
            $discount = 0;
            $additional = 0;
        }
        
        $quotationproduct_set = ["quotation_id" => $quotation_id,
                                 "product_id" => $product_id,
                                 "image" => $image,
                                 "qty" => $qty,
                                 "price" => $price,
                                 "other_info" => $other_info,
                                 "edited_amount" => $edited_amount,
                                 "sale" => $sale,
                                 "total" => $total,
                                 "discount" => $discount,
                                 "additional" => $additional,
                                 "type" => $type];
        echo json_encode($quotationproduct_set);
        $this->QuotationProduct->create();
        $this->QuotationProduct->set($quotationproduct_set);
        if ($this->QuotationProduct->save()) {
            echo "QuotationProduct saved";
            $this->loadModel('QuotationProductProperty');
            $quotation_product_id = $this->QuotationProduct->getLastInsertID();
            
            if($swatch!="---- Select Swatches ----") {
                $swatch_format = ucwords($type." - ".$swatch);
                $this->QuotationProductProperty->create();
                $this->QuotationProductProperty->set(['quotation_product_id'=>$quotation_product_id,
                                                      'property'=>'Finish',
                                                      'value'=>$swatch_format]);
                $this->QuotationProductProperty->save();
            }
            
            if (count(@$data['property']) != 0) {
                foreach ($data['property'] as $key => $value) {
                    $this->QuotationProductProperty->create();
                    $this->QuotationProductProperty->set(array(
                        "quotation_product_id" => $quotation_product_id
                    ));
                    $this->QuotationProductProperty->save();

                    $qpp_id = $this->QuotationProductProperty->getLastInsertID();

                    $this->QuotationProductProperty->id = $qpp_id;
                    $this->QuotationProductProperty->set(array(
                        "property" => $value,
                        "value" => $data['value'][$key]
                    ));
                    
                    $this->QuotationProductProperty->save();
                }
            }
            
            if($type!='supply') {
                // ADD JOB REQUEST PRODUCT IF JOB REQUEST IS EXISTING
                $this->loadModel('JobRequest');
                $this->JobRequest->recursive = -1;
                $JobRequestIsExisting = $this->JobRequest->findByQuotationId($quotation_id, ['id', 'status']);
                if(!empty($JobRequestIsExisting)) {
                    // JOB REQUEST IS ACCOMPLISHED
                    if($JobRequestIsExisting['JobRequest']['status']=='accomplished') {
                        $this->JobRequest->id = $JobRequestIsExisting['JobRequest']['id'];
                        $this->JobRequest->set(['status'=>'ongoing']);
                        if($this->JobRequest->save()) {
                            echo "JobRequest status[ongoing] saved";   
                        }
                        else {
                            echo "Error in JobRequest status[ongoing] update";
                        }
                    }
                    
                    // VARIABLES TO INSERT
                    // insert: quotation_product_id, user_id, client_id, job_request_id,
                    // status[new], quotation_id, image, product_id,
                    
                    // GET VARIABLES
                    $this->loadModel('Quotation');
                    $getClientId = $this->Quotation->findById($quotation_id, ['id', 'client_id', 'job_request_id']);
                    $client_id = 0;
                    if(!empty($getClientId)) {
                        $client_id = $getClientId['Quotation']['client_id'];
                    }
                    $job_request_id = 0;
                    if(!empty($JobRequestIsExisting)) {
                        $job_request_id = $JobRequestIsExisting['JobRequest']['id'];
                    }
                    
                    $job_request_product_set = ['quotation_product_id'=>$quotation_product_id,
                                                'user_id'=>$userin,
                                                'client_id'=>$client_id,
                                                'job_request_id'=>$job_request_id,
                                                'status'=>'new',
                                                'quotation_id'=>$quotation_id,
                                                'image'=>$image,
                                                'product_id'=>$product_id];
                                                
                    $this->loadModel('JobRequestProduct');
                    $this->JobRequestProduct->create();
                    $this->JobRequestProduct->set($job_request_product_set);
                    if($this->JobRequestProduct->save()) {
                        echo "JobRequestProduct saved";
                    }
                    else {
                        echo "Error in JobRequestProduct";
                    }
                }
                // END OF JOB REQUEST
            }
            else {
                echo "Quotation Product is SUPPLY!";
            }
        }
        else {
            echo "Error in Quotation product";
        }
        
        echo $this->compute_sub_grand($quotation_id, $installation_charge, $delivery_charge, $discount);
        
        return json_encode($quotationproduct_set);
    }
    
    public function updateProductQuotation() {
        $this->autoRender = false;
        $data = $this->request->data;

        $qpid = $data['qpid'];
        $quotation_id = $data['quotation_id'];
        $product_id = $data['product_id'];
        $image = $data['image'];
        $qty = $data['qty'];
        $price = $data['price'];
        $type = $data['type'];
        $other_info = $data['other_info'];
        $edited_amount = $data['edited_amount'];
        $sale = $data['sale'];
        $swatch = $data['swatch'];
        $installation_charge = $data['installation_charge'];
        $delivery_charge = $data['delivery_charge'];
        $discount = $data['discount'];
        $total = $qty*$edited_amount;

        $dif = $price - $edited_amount;
        if ($edited_amount > $price) {
            $discount = 0;
            $additional = $dif;
        } else if ($edited_amount < $price) {
            $discount = $dif;
            $additional = 0;
        } else {
            $discount = 0;
            $additional = 0;
        }
        
        $quotationproduct_set = ["quotation_id" => $quotation_id,
                                 "product_id" => $product_id,
                                 "image" => $image,
                                 "qty" => $qty,
                                 "price" => $price,
                                 "other_info" => $other_info,
                                 "edited_amount" => $edited_amount,
                                 "sale" => $sale,
                                 "total" => $total,
                                 "discount" => $discount,
                                 "additional" => $additional,
                                 "type" => $type];
            
        $this->QuotationProduct->id = $qpid;
        $this->QuotationProduct->set($quotationproduct_set);
        if ($this->QuotationProduct->save()) {
            echo "\nQuotationProduct saved";
            $this->loadModel('QuotationProductProperty');
            
            if($swatch!="---- Select Swatches ----") {
                $swatch_format = ucwords($type." - ".$swatch);
                $this->QuotationProductProperty->create();
                $this->QuotationProductProperty->set(['quotation_product_id'=>$qpid,
                                                      'property'=>'Finish',
                                                      'value'=>$swatch_format]);
                                                      
                $this->QuotationProductProperty->save();
            }
            else {
                echo "\nno Swatch";
            }
            
            $this->loadModel('QuotationProductProperty');
            $this->QuotationProductProperty->recursive = -1;
            $get_qpp = $this->QuotationProductProperty->find('all', ['conditions'=>
                ['quotation_product_id'=>$qpid]]);
            
            $isDeletedPP = true;
            foreach($get_qpp as $ret_qpp) {
                $qpp_obj = $ret_qpp['QuotationProductProperty'];
                $qpp_id = $qpp_obj['id'];
                
                $this->QuotationProductProperty->id = $qpp_id;
                if($this->QuotationProductProperty->delete()) {
                    echo "\nQPP id: ".$qpp_id." deleted.";
                }
                else {
                    echo "\nError in deleting qpp";
                    $isDeletedPP = false;
                }
            }
            
            if($isDeletedPP) {
                echo "\nisDeletedPP is true";
                echo "\ncount1:".count($data['property']);
                if (count($data['property']) != 0) {
                    echo "\ncount1 is not 0";
                    foreach ($data['property'] as $key => $value) {
                        echo "\ndata1:".$key."=>".$value;
                        $this->QuotationProductProperty->create();
                        $this->QuotationProductProperty->set(array(
                            "quotation_product_id" => $qpid,
                            "property" => $value,
                            "value" => $data['value'][$key]
                        ));
                        
                        if($this->QuotationProductProperty->save()) {
                            echo "\nQuotationProductProperty1 save";
                        }
                        else {
                            echo "\nERROR in QuotationProductProperty1";
                        }
                    }
                }
                else {
                    echo "\ncount1 is 0";
                }
            }
            else {
                echo "\nProp and Val not deleted.";
            }
            echo json_encode($data);
        }
        else {
            echo "\nError in Quotation product";
        }
        
        $this->loadModel('QuotationUpdateLog');
        
        $this->QuotationUpdateLog->create();
        $this->QuotationUpdateLog->set([
            "user_id"=>$this->Auth->user('id'),
            "quotation_id"=>$quotation_id,
            "quotation_product_id"=>$data['qpid'],
            "status"=>'edited_product'
            ]);
        if($this->QuotationUpdateLog->save()){
            echo json_encode($quotationproduct_set);
        }
        
        echo $this->compute_sub_grand($quotation_id, $installation_charge, $delivery_charge, $discount);
        return "Executed everything";
    }

    public function quoted_product_warehouse_source() {
        $this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;

        $this->loadModel('ProductSource');
        $this->loadModel('ProductSourceProperty');
        $this->loadModel('QuotationProduct');
        $this->loadModel('Quotation');
        $this->loadModel('ProdInvLocation');
        $this->loadModel('ProdInvLocationProperty');

        $inv_location_id = $data['inv_location_id'];
        $prod_inv_location_id = $data['prod_inv_location_id'];
        $quoted_prod_id = $data['quoted_prod_id'];
        $inv_prop = $data['inv_prop'];
        $inv_val = $data['inv_val'];
        $inv_qty_deduct = $data['inv_qty_deduct'];
        $total_inv_deduct = $data['total_inv_deduct'];
        $counter = $data['counter'];

        $quote_prod = $this->QuotationProduct->findById($quoted_prod_id);
        $tt_qty = 0;
        foreach ($inv_qty_deduct as $inv_qty) {
            $tt_qty = $tt_qty + $inv_qty;
        }

        $processed_qty = floatval($quote_prod['QuotationProduct']['processed_qty']) + floatval($tt_qty);


        $this->ProductSource->create();
        $this->ProductSource->set(array(
            "quotation_product_id" => $quoted_prod_id,
            "product_id" => $quote_prod['Product']['id'],
            "source" => 'inventory',
            "quotation_id" => $quote_prod['Quotation']['id'],
            "prod_inv_location_id" => $prod_inv_location_id,
            "status" => "pending",
            "qty" => $total_inv_deduct,
            "type"=>'supply'
        ));
        if ($this->ProductSource->save()) {
            $product_source_id = $this->ProductSource->getLastInsertID();

            for ($i = 0; $i <= $counter; $i++) {
                $this->ProductSourceProperty->create();
                $this->ProductSourceProperty->set(array(
                    'property' => $inv_prop[$i],
                    'value' => $inv_val[$i],
                    'qty' => $inv_qty_deduct[$i],
                    'product_source_id' => $product_source_id
                ));
                $this->ProductSourceProperty->save();
            }


            $this->QuotationProduct->id = $quoted_prod_id;
            $this->QuotationProduct->set(array(
                'processed_qty' => $processed_qty
            ));
            $this->QuotationProduct->save();

            $dateToday = date("Y-m-d H:i:s");
            $this->Quotation->id = $quote_prod['Quotation']['id'];
            $this->Quotation->set(array(
                'status' => 'processed',
                'date_processed' => $dateToday
            ));
            $this->Quotation->save();


            echo json_encode($product_source_id);
        }
    }

    public function Rawrequest_product_warehouse_source() {
        $this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;

        $this->loadModel('PoRawRequest');
        $this->loadModel('ProductSource');
        $this->loadModel('ProductSourceProperty');

        $inv_location_id = $data['inv_location_id'];
        $prod_inv_location_id = $data['prod_inv_location_id'];
        $po_raw_id = $data['po_raw_id'];
        $inv_prop = $data['inv_prop'];
        $inv_val = $data['inv_val'];
        $inv_qty_deduct = $data['inv_qty_deduct'];
        $total_inv_deduct = $data['total_inv_deduct'];
        $counter = $data['counter'];

        $po_raw = $this->PoRawRequest->findById($po_raw_id);
        $quotation_product = $this->QuotationProduct->findById($po_raw['PoRawRequest']['quotation_product_id']);

        $product_id = $po_raw['PoRawRequest']['product_id'];
        if ($po_raw_id != 0) {
            $quotation_product_id = $quotation_product['QuotationProduct']['id'];
            $quotation_id = $quotation_product['QuotationProduct']['quotation_id'];
        }


        $tt_qty = 0;
        foreach ($inv_qty_deduct as $inv_qty) {
            $tt_qty = $tt_qty + $inv_qty;
        }

        $processed_qty = floatval($po_raw['PoRawRequest']['processed_qty']) + floatval($tt_qty);

        if ($processed_qty >= $po_raw['PoRawRequest']['qty']) {
            $stats = 'processed';
        } else {
            $stats = 'pending';
        }

        $this->ProductSource->create();
        $this->ProductSource->set(array(
            "quotation_product_id" => $quotation_product_id,
            "product_id" => $product_id,
            "source" => 'inventory',
            "quotation_id" => $quotation_id,
            "prod_inv_location_id" => $prod_inv_location_id,
            "status" => "pending",
            "qty" => $total_inv_deduct,
            "type"=>'raw'
        ));
        if ($this->ProductSource->save()) {
            $product_source_id = $this->ProductSource->getLastInsertID();

            for ($i = 0; $i <= $counter; $i++) {
                $this->ProductSourceProperty->create();
                $this->ProductSourceProperty->set(array(
                    'property' => $inv_prop[$i],
                    'value' => $inv_val[$i],
                    'qty' => $inv_qty_deduct[$i],
                    'product_source_id' => $product_source_id
                ));
                $this->ProductSourceProperty->save();
            }

            $dateToday = date("Y-m-d H:i:s");

            $this->PoRawRequest->id = $po_raw_id;
            $this->PoRawRequest->set(array(
                'status' => $stats,
                'date_processed' => $dateToday,
                'processed_qty' => $processed_qty
            ));
            $this->PoRawRequest->save();

            echo json_encode($product_source_id);
        }
    }
    
    public function purchasing_list(){  
        $this->loadModel('Client');
        $this->loadModel('Product');
        $this->loadModel('InvLocation');
        // pr($this->Auth->user('department_id'));
        // // $quote_status = $this->params['url']['status'];
        //  $where=[];
        //  $myDepartmentId = $this->Auth->user('department_id');
        //  if($myDepartmentId == 6){ //supply
        //      $where = ['supply','combination'];
        //  }else if($myDepartmentId == 7){//raw
        //      $where = ['customized','raw','combination','swatches','office']; 
        //  }else{
        //      $where = ['customized','raw','combination','supply','swatches','office']; 
        //  }
         
        // $quoted_prods = $this->QuotationProduct->find('all',[
        //     'fields'=>['QuotationProduct.image','QuotationProduct.processed_qty','QuotationProduct.qty','QuotationProduct.type','QuotationProduct.other_info','Product.name','Quotation.client_id','Quotation.accounting_approved_date','Quotation.date_moved'],
        //     'contain'=>[ 
        //         'Quotation',
        //         'Product',
        //         'QuotationProductProperty', 
        //         ], 
        //             'conditions'=>[
        //                 'Quotation.status'=>['approved', 'processed'],
        //                 'QuotationProduct.type'=>$where,
        //                 'QuotationProduct.deleted'=>NULL,
        //             ]
        // ]);
        
        // $arr = [];
        // foreach($quoted_prods as $quoted_prod){
        //     // $client = $this->Client->findById($quoted_prod['Quotation']['client_id']); 
        //         $client = $this->Client->find('first',[
        //             'conditions'=>['Client.id'=>$quoted_prod['Quotation']['client_id']],
        //             'fields'=>['Client.name','Client.id']
        //         ]);
        //         array_push($quoted_prod, $client);
        //         array_push($arr, $quoted_prod);
        
        // } 
        // pr($arr);exit;
         
        $products = $this->Product->find('all');
        
        $locations = $this->InvLocation->find('all'); 
        
        $this->set(compact('arr','products','locations'));
        
        
    }
    
	public function purchasing_list_ajax() { 
	    if(!$this->Auth->user()){
			exit;
		}
	    $this->layout = "ajax";
	    $this->modelClass = "QuotationProduct";
	    $this->autoRender = false;        
	    
	    
	    
	    
	    
	    
	    
	     
	    
	    
	    /////////////////////////////////////
	    
	    //orginal query
        //  $where=[];
         $myDepartmentId = $this->Auth->user('department_id');
         if($myDepartmentId == 6){ //supply
             $cond1 = 'supply';
             $cond2 = 'combination';
             $cond3 = '';
             $cond4 = '';
             $cond5 = ''; 
             $cond6 = '';  
         }else if($myDepartmentId == 7){//raw
             $cond1 = 'customized';
             $cond2 = 'combination';
             $cond3 = 'raw';
             $cond4 = 'swatches';
             $cond5 = 'office'; 
             $cond6 = '';  
         }else{
             $cond1 = 'customized';
             $cond2 = 'combination';
             $cond3 = 'raw';
             $cond4 = 'swatches';
             $cond5 = 'office'; 
             $cond6 = 'supply';  
         }
         
        // $quoted_prods = $this->QuotationProduct->find('all',[
        //     'fields'=>['QuotationProduct.image','QuotationProduct.processed_qty','QuotationProduct.qty','QuotationProduct.type','QuotationProduct.other_info','Product.name','Quotation.client_id','Quotation.accounting_approved_date','Quotation.date_moved'],
        //     'contain'=>[ 
        //         'Quotation',
        //         'Product',
        //         'QuotationProductProperty', 
        //         ], 
        //             'conditions'=>[
        //                 'Quotation.status'=>['approved', 'processed'],
        //                 'QuotationProduct.type'=>$where,
        //                 'QuotationProduct.deleted'=>NULL,
        //             ]
        // ]);
        
        
        // $arr = [];
        // foreach($quoted_prods as $quoted_prod){
        //     // $client = $this->Client->findById($quoted_prod['Quotation']['client_id']); 
        //         $client = $this->Client->find('first',[
        //             'conditions'=>['Client.id'=>$quoted_prod['Quotation']['client_id']],
        //             'fields'=>['Client.name','Client.id']
        //         ]);
        //         array_push($quoted_prod, $client);
        //         array_push($arr, $quoted_prod);
        
        // } 
	    
        ///////////////////////////
        // a = quotation product
        // b = quotations
        // c = product

	    $model = 'quotation_products AS a';
	    $columns = ['date_moved', 'image','product_id', 'client_id','qtype','qp_id','qty'];
	    $joincolumns = ['b.date_moved', 'a.image', 'a.product_id', 'b.client_id','a.type as qtype', 'a.id as qp_id', 'a.qty'];
	    
	    $where = "b.status = 'approved' || b.status = 'processed' && (a.type='".$cond1."' || a.type='".$cond2."' || a.type='".$cond3."' || a.type='".$cond4."' || a.type='".$cond5."' || a.type='".$cond6."') && a.deletedd IS NULL";
	    $join = "INNER JOIN quotations as b ON b.id = a.quotation_id";
	    
	    $output = $this->Quotation->GetMyData($model, $columns, $where, $join, $joincolumns); 
        
        $data = $output['data'];
		$res = [];
		$count = 0;
// 		pr($data);
		foreach($data as $items){
		    $this->loadModel('Client');
		    $this->loadModel('Product');
		     
		    $this->Product->recursive = -1;
		    $prod = $this->Product->findById($items[2]);
		    
		    
		    $this->Client->recursive = -1;
		    $client = $this->Client->findById($items[3]);
		    
// 		    $this->JobRequest->recursive = -1;
// 		    $jr = $this->JobRequest->findById($items[5]);
		    foreach($items as $key => $item){
		        if($key == 0){
		            $data[$count][$key] = time_elapsed_string($item).'<br/><small>'. date('h:i a', strtotime($item)) . '</small>';
		        }
		        if($key == 1){
					$img = $this->thumbnail($item);
					// $data[$count][$key] = '<img class="img-responsive" src="/img/product-uploads/'.$item.'" id="prod_image_preview" width="20%" />';
				
					$imageData = base64_encode($img);

					// Format the image SRC:  data:{mime};base64,{data};
					$src = 'data: image/jpg;base64,'.$imageData;
					
					$data[$count][$key] =  '<img src="' . $src . '">';
		        }
		        
		        if($key == 2){
		            $data[$count][$key] = $prod['Product']['name'].'<br/><small>[' . $item . ']</small>';
		        }
		        if($key == 4){
		            $data[$count][$key] = $client['Client']['name'].'<br/><small>[' . $item . ']</small>';
		        }
		      //  if($key == 3){
		          //  $data[$count][$key] = '
            //                     <button class="btn btn-sm btn-primary po_product_btn"
            //                         data-client="'.$client['Client']['id'].'"
            //                         data-qtprodid='.$qp_id.'>Select Supplier</button>
                                    
            //                     <button class="btn btn-sm btn-warning inventory_product_btn add-tooltip" data-toggle="tooltip"
            //                         data-original-title="Get Product From Inventory" 
            //                         data-qprdctids='.$qp_id.' data-qprdctqty='.$qty.'><i class="fa fa-cubes"></i></button>
            //                     ';
		      //  }
// 		        if($key == 5){
// 		            if($item != 0){
// 		                $data[$count][$key] = '<div class="input-group mar-btm">
//                                                 <input type="text" class="form-control" placeholder="Name" readonly value="'.$jr['JobRequest']['jr_number'].'">
//                                                 <span class="input-group-btn"><button class="btn btn-mint add-tooltip jrupdateBtn" data-toggle="tooltip"  data-original-title="View Job Request"  type="button"data-jobrid="' . $items[6] . '"><i class="fa fa-external-link"></i></button></span>
//                                             </div>';
// 		            } else{
// 		                $data[$count][$key] = '<br/><button  class="btn btn-default  btn-icon  add-tooltip jobRequeBtn" data-toggle="tooltip"  data-original-title="With Job Request?"  type="button" data-quoteid="' . $items[6] . '"><i class="fa fa-plus"></i></button>';
// 		            }
// 		        }
// 		        if($key == 6){
// 		            if($this->Auth->user('role') == 'sales_executive'){
// 		                $data[$count][$key] = '<button class="btn btn-mint btn-icon add-tooltip update_quote" data-toggle="tooltip"  data-original-title="Update Quotation?"   data-upquoteid="'.$item.'"><i class="fa fa-edit"></i></button>
// 		                <button class="btn btn-danger btn-icon add-tooltip delete_quote" data-toggle="tooltip"  data-original-title="Delete Quotation?" data-typo="deleted" data-delquoteid="'.$item.'" data-jrid="'.$jr['JobRequest']['id'].'"><i class="fa fa-window-close"></i> </button>
//                         <button class="btn btn-danger btn-icon add-tooltip delete_quote" data-toggle="tooltip"  data-original-title="Lost Quotation?" data-typo="lost" data-delquoteid="'.$item.'" data-jrid="'.$jr['JobRequest']['id'].'"><i class="fa fa-thumbs-down"></i> </button>';
// 		            }
// 		        }
		        unset($data[$count][2]);
		    }
		$count++;    
		}         
		$output['data'] = $data;
	    echo json_encode($output);
	    exit;
	    
	}
	  
    /////////adonis//////
	public function po_products(){

        $this->loadModel('User');
        if ($this->Auth->user('department_id') == 6 ) {
            
	      
		        $po_product_infos = $this->QuotationProduct->find('all',
		          [
		        
		         "conditions" => [
		            
    		             "OR" =>[
    		                 
    		                  "QuotationProduct.type" => "supply",
    		                  "QuotationProduct.type" => "combination",
    		                 
    		                 ],
		                 "OR" =>[
		                      "Quotation.status"=>"processed",
		                      "Quotation.status"=>"approved"
		                     
		                     ],
		             ],
		             
		       ]);
		   
		     // pr($po_product_infos); exit();
		            $this->set(compact('po_product_infos')); 

        }else if($this->Auth->user('department_id') == '7'){
            
           
		        $po_product_infos = $this->QuotationProduct->find('all',
		          [
		        
		         "conditions" => [
    		             "NOT" =>[
            		            "QuotationProduct.type" => "supply",
            		          ],
		                 "OR" =>[
		                      "Quotation.status"=>"processed",
		                      "Quotation.status"=>"approved"
		                     ],
		             
		             ],
		       ]);
            $this->set(compact('po_product_infos'));
            
        }else{
        
		        $po_product_infos = $this->QuotationProduct->find('all',
		          [
		        
		         "conditions" => [
		              "OR" =>[
		                      "Quotation.status"=>"processed",
		                      "Quotation.status"=>"approved"
		                     
		                     ], // makanoson ka tabi
		             ],
		                
		       ]);
            $this->set(compact('po_product_infos'));
            
        }
        
        
        $this->loadModel('Client');
        $clients = $this->Client->find('all', array(
            'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Client.lead' => 0)
        ));

        $this->set(compact('clients'));

        $this->loadModel('Product');
        $products = $this->Product->find('all');
        $this->set(compact('products'));

		            
		            
	}/////////adonis//////


    public function compute_sub_grand($quotation_id, $installation, $delivery, $discount) {
        $sub_total = 0;
        $this->QuotationProduct->recursive = -1;
        $getQuotationProducts = $this->QuotationProduct->find('all',
            ['conditions'=>['quotation_id'=>$quotation_id,
                            'deleted'=>null],
             'fields'=>['id', 'quotation_id', 'total']]);
        foreach($getQuotationProducts as $retQuotationProducts) {
            $QuotationProducts = $retQuotationProducts['QuotationProduct'];
            $sub_total += $QuotationProducts['total'];
        }
        
        $this->loadModel('Quotation');
        $grand_total = ($sub_total+$installation+$delivery)-$discount;
        
        $this->Quotation->id = $quotation_id;
        $this->Quotation->set(['sub_total'=>$sub_total, 'grand_total'=>$grand_total,
                               'installation_charge'=>$installation,
                               'delivery_charge'=>$delivery,
                               'discount'=>$discount]);
        if($this->Quotation->save()) {
            return "Quotation update grand and sub";
        }
        else {
            return "Error in Quotation update grand and sub";
        }
    }
    
    public function delete_qproduct_test() {
        $this->autoRender = false;
        $this->loadModel('DeliverySchedule');
        // DELETED ON DELIVERY SCHEDULE
        // ===================================================================>
        $getDeliverySchedule = $this->DeliverySchedule->find('all',
            ['conditions'=>
                ['reference_type'=>'quotation',
                 'reference_number'=>20],
             'fields'=>['id', 'reference_type', 'reference_number']]);
             
        echo json_encode($getDeliverySchedule);
        exit;
        // foreach($getDeliverySchedule as $retDeliverySchedule) {
        //     $DeliveryShedule = $retDeliverySchedule['DeliverySchedule'];
        //     $DeliveryShedule_id = $DeliveryShedule['id'];
            
        //     $DeliverySchedProduct = $retDeliverySchedule['DeliverySchedProduct'];
        //     foreach($DeliverySchedProduct as $retDeliverySchedProduct) {
        //         $dsp = $retDeliverySchedProduct['id'];
        //         $dsp_prod_id = $retDeliverySchedProduct['reference_num'];
        //     }
        // }

        // foreach($dsp_quotation_product_ids as $key=>$delivery_schedule_id) {
        //     echo "delivery_schedule_id:".$delivery_schedule_id."<br/>";
        //     $DS_DeliverySchedProduct = $this->DeliverySchedProduct->getDataSource();
        //     $DS_DeliverySchedProduct->begin();
        //     $this->DeliverySchedProduct->id = $key;
        //     $this->DeliverySchedProduct->set(['deleted'=>$today]);
        //     if($this->DeliverySchedProduct->save()) {
        //         echo "Delivery Sched Product save";
        //         if(count($dsp_quotation_product_ids)==1) {
        //             $DS_DeliverySchedule = $this->DeliverySchedule->getDataSource();
        //             $DS_DeliverySchedule->begin();
        //             $this->DeliverySchedule->id = $delivery_schedule_id;
        //             $this->DeliverySchedule->set(['deleted'=>$today]);
        //             if($this->DeliverySchedule->save()) {
        //                 echo "DeliverySchedule save";
        //                 $DS_DeliverySchedule->commit();
        //                 $DS_DeliverySchedProduct->commit();
        //             }
        //             else {
        //                 echo "Error in DeliverySchedule";
        //                 $DS_DeliverySchedule->rollback();
        //                 $DS_DeliverySchedProduct->rollback();
        //             }
        //         }
        //         else {
        //             echo "\nDelivery Schedule Product is greater than 1.\n
        //                   Will not update Delivery Schedule.\n";
        //         }
        //     }
        //     else {
        //         echo "Error in DeliverySchedProduct\n";
        //         $DS_DeliverySchedProduct->rollback();
        //     }
        // }
        
        // DELETED ON DELIVERY SCHEDULE
        // ===================================================================>
    }
}
