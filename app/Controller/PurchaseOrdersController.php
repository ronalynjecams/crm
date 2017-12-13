<?php

App::uses('AppController', 'Controller');

/**
 * PurchaseOrders Controller
 *
 * @property PurchaseOrder $PurchaseOrder
 * @property PaginatorComponent $Paginator
 */
class PurchaseOrdersController extends AppController {

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
        $this->PurchaseOrder->recursive = 0;
        $this->set('purchaseOrders', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->PurchaseOrder->exists($id)) {
            throw new NotFoundException(__('Invalid purchase order'));
        }
        $options = array('conditions' => array('PurchaseOrder.' . $this->PurchaseOrder->primaryKey => $id));
        $this->set('purchaseOrder', $this->PurchaseOrder->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->PurchaseOrder->create();
            if ($this->PurchaseOrder->save($this->request->data)) {
                $this->Session->setFlash(__('The purchase order has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The purchase order could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        }
        $suppliers = $this->PurchaseOrder->Supplier->find('list');
        $users = $this->PurchaseOrder->User->find('list');
        $this->set(compact('suppliers', 'users'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null) {
        if (!$this->PurchaseOrder->exists($id)) {
            throw new NotFoundException(__('Invalid purchase order'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->PurchaseOrder->save($this->request->data)) {
                $this->Session->setFlash(__('The purchase order has been saved.'), 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The purchase order could not be saved. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
            }
        } else {
            $options = array('conditions' => array('PurchaseOrder.' . $this->PurchaseOrder->primaryKey => $id));
            $this->request->data = $this->PurchaseOrder->find('first', $options);
        }
        $suppliers = $this->PurchaseOrder->Supplier->find('list');
        $users = $this->PurchaseOrder->User->find('list');
        $this->set(compact('suppliers', 'users'));
    }

    public function quotation_view_supply() {
        
        $this->loadModel('Quotation');
        $id = $this->params['url']['id'];
        $quote_data = $this->Quotation->findById($id);
        $quote_number = $quote_data['Quotation']['quote_number'];
        $this->set(compact('quote_data'));

        $this->loadModel('Client');
        $clients = $this->Client->find('all', array(
            'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Client.lead' => 0)
        ));

        $this->set(compact('clients'));

        $this->loadModel('Product');
        $products = $this->Product->find('all');
        $this->set(compact('products'));

        $this->loadModel('QuotationProduct');
         
        $this->QuotationProduct->recursive = 3;
        if ($this->Auth->user('role') != 'supply_staff') {
            $quote_products = $this->QuotationProduct->find('all', array(
                'conditions' => array('QuotationProduct.quotation_id' => $quote_data['Quotation']['id'])
            ));
        } else {
            $quote_products = $this->QuotationProduct->find('all', array(
                'conditions' => array(
                    'QuotationProduct.quotation_id' => $quote_data['Quotation']['id'],
                    'QuotationProduct.type' => array('supply', 'combination')
                )
            ));
            
            // pr($quote_products);
        }
        $this->set(compact('quote_products'));

        $this->set(compact('quote_number'));

//        $this->loadModel('Collection');
//        $collections = $this->Collection->find('all', array(
//            'conditions' => array('Collection.quotation_id' => $this->params['url']['id'],
//                'Collection.status' => 'verified')
//        ));
//        $this->set(compact('collections'));


        $this->loadModel('PoProduct');
        $this->PoProduct->recursive = 2;
        $poprod = $this->PoProduct->find('all', array(
            'conditions' => array(
                'PoProduct.quotation_id' => $this->params['url']['id'],
                'PoProduct.additional' => 0)
        ));
        $this->set(compact('poprod'));

        $this->loadModel('InvLocation');
        $locations = $this->InvLocation->find('all');
        $this->set(compact('locations'));

        $this->loadModel('DeliverySchedule');
        $DelScheds = $this->DeliverySchedule->find('all', ['conditions' => [
                'DeliverySchedule.quotation_id' => $this->params['url']['id']
        ]]);
        $this->set(compact('DelScheds'));

        $this->loadModel('CollectionPaper');
        $CollectPapers = $this->CollectionPaper->find('all', ['conditions' => [
                'CollectionPaper.quotation_id' => $this->params['url']['id'],
                'CollectionPaper.status' => 'onhand'
        ]]);
        $this->set(compact('CollectPapers'));

        $this->loadModel('CollectionSchedule');
        $CollectSched = $this->CollectionSchedule->find('first', ['conditions' => [
                'CollectionSchedule.quotation_id' => $this->params['url']['id'],
                'CollectionSchedule.status' => 'for_collection'
        ]]);
        $this->set(compact('CollectSched'));

        $this->loadModel('DeliveryPaper');
        $delivery_papers = $this->DeliveryPaper->findAllByQuotationId($id);


        $this->loadModel('DrPaper');
        $drpapers = $this->DrPaper->find('all');
        $this->set(compact('drpapers', 'delivery_papers'));
// pr($this->QuotationProduct->findById(62));
//        $this->loadModel('SupplierProduct');
//        $this->SupplierProduct->recursive=-1;
//        $product_supplier = $this->SupplierProduct->findAllByProductComboId(1);
//        pr($product_supplier);
//        $this->loadModel('PurchaseOrderProduct');
//        $this->loadModel('PurchaseOrder');
//        $this->loadModel('InventoryProduct');
//            pr($product_combo_properties);
        
//        $inv_products = $this->InventoryProduct->find('all', [
//                'conditions' => ['InventoryProduct.inv_location_id' => 4],
////                'fields' => ['MAX(PurchaseOrder.id) as po_id', 'PurchaseOrder.*']
//            ]);
//        pr($inv_products); 
    }

    ///////////////// 
    public function process_new_po() {
        $this->autoRender = false;
        $data = $this->request->data;
        $product_combo_id = $data['product_combo_id'];
        $product_id = $data['product_id'];
        $supplier_id = $data['supplier_id'];
        $quotation_product_id = $data['quote_product_id'];
        $qty = $data['po_qty'];
        $price = $data['list_price'];
        $additional = $data['additional'];
        $supplier_product_id = $data['supplier_product_id'];
        $inventory_job_order_type = $data['inventory_job_order_type'];
        // $ref_type = $data['ref_type'];

        $discount = 0;
        $ewt_type = "one";
        
//        pr($inventory_job_order_type);exit;
        //check if with existing ongoing purchase order
        $check_po = $this->PurchaseOrder->find('first', [
            'conditions' => [
                'PurchaseOrder.supplier_id' => $supplier_id,
                'PurchaseOrder.status' => 'ongoing'
        ]]);
        $this->loadModel('User');
        $user = $this->User->findById($this->Auth->user('id'));
        $this->loadModel('PurchaseOrderProduct');
        $this->loadModel('InventoryJobOrder');
        $this->loadModel('QuotationProduct');
        $this->loadModel('Quotation');
        $this->loadModel('TransactionSource');



        if ($quotation_product_id != 0 && (!empty($quotation_product_id))) {
            $qprod = $this->QuotationProduct->findById($quotation_product_id);
            $product_id = $qprod['QuotationProduct']['product_id'];
            $quotation_product_id = $qprod['QuotationProduct']['id'];
            $quotation_id = $qprod['Quotation']['id'];
            //get processed qty in quote product  
            $processed_qty = $qprod['QuotationProduct']['processed_qty'];
            $pro_qty = $processed_qty + $qty;
            
            if($data['po_raw_request_id'] != 0){
                $reference_type = 'po_raw_request';  
                $reference_num = $quotation_product_id;
            }else{
                $reference_type = 'quotation';
                $reference_num = $quotation_product_id; 
                
            }
            $reference_type = 'quotation';
            $transaction_num = $quotation_id;
        } else {
            
            $quotation_product_id = 0;
            $quotation_id = 0;
            $reference_num = 0;
            $reference_type = 'none';
            $transaction_num = 0;
        }



        if (count($check_po) == 0) {
            //create new purchase order
            if ($user['User']['department_id'] == 6) {
                $type = 'supply';
            } else if ($user['User']['department_id'] == 7) {
                $type = 'raw';
            }

            $dateToday = date("hmdsi");
            $po_number = 'JEC-' . $dateToday;

            $this->PurchaseOrder->create();
            $this->PurchaseOrder->set(array(
                'supplier_id' => $supplier_id,
                'user_id' => $this->Auth->user('id'),
                'po_number' => $po_number,
                'status' => 'ongoing',
                'type' => $type
            ));
            if ($this->PurchaseOrder->save()) {
                //add poProduct
                $po_id = $this->PurchaseOrder->getLastInsertID();
                //price of item should be from 
                $this->PurchaseOrderProduct->create();
                $this->PurchaseOrderProduct->set(array(
                    'product_combo_id' => $product_combo_id,
                    'purchase_order_id' => $po_id,
                    'qty' => $qty,
                    'list_price' => $price,
                    'user_id' => $this->Auth->user('id'),
                    'quotation_id' => $quotation_id,
                    'additional' => $additional,
                    'reference_num' => $reference_num,
                    'reference_type' => $reference_type,
                    'transaction_num' => $transaction_num,
                    'supplier_product_id' => $supplier_product_id
                ));
                if ($this->PurchaseOrderProduct->save()) {
                    $po_product_id = $this->PurchaseOrderProduct->getLastInsertID();
                }
            }
        } else {
            //get purchase order number then add the po product
            $po_id = $check_po['PurchaseOrder']['id'];
            $this->PurchaseOrderProduct->create();
            $this->PurchaseOrderProduct->set(array(
                'product_combo_id' => $product_combo_id,
                'purchase_order_id' => $po_id,
                'qty' => $qty,
                'list_price' => $price,
                'quotation_product_id' => $quotation_product_id,
                'user_id' => $this->Auth->user('id'),
                'quotation_id' => $quotation_id,
                'additional' => $additional,
                'reference_num' => $reference_num,
                'reference_type' => $reference_type,
                'transaction_num' => $transaction_num,
                'supplier_product_id' => $supplier_product_id
            ));
            if ($this->PurchaseOrderProduct->save()) {
                $po_product_id = $this->PurchaseOrderProduct->getLastInsertID();
            }
            $discount = $check_po['PurchaseOrder']['discount'];
            $ewt_type = $check_po['PurchaseOrder']['ewt_type'];
        }
        
        // if reference type == quotation
        if ($quotation_product_id != 0 && (!empty($quotation_product_id))) {
            if($additional == 0){
                $dateToday = date("Y-m-d H:i:s");
            $this->Quotation->id = $quotation_id;
            $this->Quotation->set(array(
                'status' => 'processed',
                'date_processed' => $dateToday
            ));
            $this->Quotation->save();

            $this->QuotationProduct->id = $quotation_product_id;
            $this->QuotationProduct->set(array(
                'processed_qty' => $pro_qty
            ));
            $this->QuotationProduct->save(); 
            
            }
                $this->TransactionSource->create;
                $this->TransactionSource->set(array(
                    'reference_num'=>$quotation_id,
                    'reference_type'=>'quotation', 
                    'mode'=>'po',
                    'mode_num'=>$po_id,
                    'product_combo_id'=>$product_combo_id,
                    'product_source'=>$quotation_product_id,
                    'type'=>$qprod['Product']['type'], 
                    'qty' => $qty
                )); 
                $this->TransactionSource->save(); 
                
        }///end of reference type=quotation
        
         //if purchase order product if from po raw request
        if($data['po_raw_request_id'] != 0){
            $this->loadModel('PoRawRequest');
            $po_raw_request_id = $data['po_raw_request_id'];
            $po_raw_request_qty = $data['po_raw_request_qty']; //this is the processed qty
            
            //update prodcut combo id, processed qty, pdate processed
            
            $po_raw_qry = $this->PoRawRequest->findById($po_raw_request_id); 
            
            
            $dateToday = date("Y-m-d H:i:s");
            $new_processed_qty = $po_raw_request_qty + $qty;
            
            if($po_raw_qry['PoRawRequest']['qty'] == $new_processed_qty){
                $raw_status = 'processed';
            }else{
                $raw_status = 'pending';
            }
            
            $this->PoRawRequest->id = $po_raw_request_id;
            $this->PoRawRequest->set([
                'processed_qty'=>$new_processed_qty,
                'product_combo_id'=>$product_combo_id,
                'date_processed'=>$dateToday,
                'status'=>$raw_status
                ]);
            if($this->PoRawRequest->save()){
                
                $this->TransactionSource->create;
                $this->TransactionSource->set(array(
                    'reference_num'=>$po_raw_request_id,
                    'reference_type'=>'po_raw_request', 
                    'mode'=>'po',
                    'mode_num'=>$po_id,
                    'product_combo_id'=>$product_combo_id,
                    'product_source'=>$quotation_product_id,
                    'type'=>$po_raw_qry['Product']['type'], 
                    'qty' => $qty
                )); 
                $this->TransactionSource->save(); 
                
            }
            
            
            
            
            
        }
        
        
                /////////// this is universal
                $this->InventoryJobOrder->create;
                $this->InventoryJobOrder->set(array(
                    'product_combo_id'=>$product_combo_id,
                    'qty'=>$qty,
                    'processed_qty'=>0,
                    'reference_num'=>$po_id,
                    'reference_type'=>$inventory_job_order_type,
                    'mode'=>'receive',
                    'status'=>'newest'
                )); 
                $this->InventoryJobOrder->save();
                // if($this->InventoryJobOrder->save()){
                //         echo json_encode($data); 
                // } 
        
        $this->loadModel('Supplier');
        $supplier = $this->Supplier->findById($supplier_id);
        
        $vatable = $supplier['Supplier']['vatable'];
        
        $total = $this->PurchaseOrderProduct->find('first', array(
                'fields' => 'sum(PurchaseOrderProduct.list_price * PurchaseOrderProduct.qty) as total',
                'recursive' => -1,
                'conditions' => array(
                    'PurchaseOrderProduct.purchase_order_id' => $po_id
                    )
            ));
            
        if ($discount != 0) {
            $new_total_purchased = $total['0']['total'] - $discount;
        } else {
            $new_total_purchased = $total['0']['total'];
        }
        if($ewt_type == 'one'){
            $new_ewt = $new_total_purchased * .01;
        } else{
            $new_ewt = $new_total_purchased * .02;
        }
        if ($vatable == 0) {
            //computation for vat inc
            $data['vaat'] = 'if';
            $vat = $new_total_purchased * .12;
            $data['newvat'] = $vat;
            // $new_ewt = $non_vat * 0.01;
            $new_grand_total = ($new_total_purchased + $vat) - $new_ewt;
            // $new_vat = $non_vat;
            //$new_vat = 0;
        } else {
            //computation for vat ex
            $data['vaat'] = 'else';
            $new_vat =   0;
            $vat = 0;
            // $new_ewt = $new_total_purchased * 0.01;
            $new_grand_total = $new_total_purchased - $new_ewt;
        }
        $this->PurchaseOrder->id = $po_id;
        $this->PurchaseOrder->set(array(
            'total_purchased' => $new_total_purchased,
            'vat_amount' => floatval($vat),
            'ewt_amount' => $new_ewt,
            'ewt_type' => $ewt_type,
            'grand_total' => $new_grand_total,
            'discount' => $discount
        ));
        
        if ($this->PurchaseOrder->save()) {
            echo json_encode($data);
        }
    }
    
    

    public function design_raw_mats() {
        $this->loadModel('QuotationProduct');
        $this->loadModel('JrProduct');
        $this->loadModel('Product');
        $id = $this->params['url']['id'];
        $this->JrProduct->recursive = 2;
        $qprod = $this->JrProduct->findById($id);
        $this->set(compact('qprod'));


        $this->loadModel('Product');
        $products = $this->Product->find('all', array(
            'conditions' => array('Product.type' => array('supply', 'customized', 'combination', 'raw'))
        ));
        $this->set(compact('products'));

        $this->loadModel('PoRawRequest');
//        $this->PoRawRequest->recursive = 2;
        $raws = $this->PoRawRequest->findAllByJrProductId($id);
        $this->set(compact('raws'));


//         pr($raws);
//       
//        error_reporting(0);
//        $this->loadModel('Quotation');
//        $id = $this->params['url']['id'];
//        $quote_data = $this->Quotation->findById($id);
//        $quote_number = $quote_data['Quotation']['quote_number'];
//        $this->set(compact('quote_data'));
//
//        $this->loadModel('Client');
//        $clients = $this->Client->find('all', array(
//            'conditions' => array('Client.user_id' => $this->Auth->user('id'), 'Client.lead' => 0)
//        ));
//
//
//        $this->set(compact('clients'));
//
//        $this->loadModel('Product');
//        $products = $this->Product->find('all');
//        $this->set(compact('products'));
//
//        $this->loadModel('QuotationProduct');
//        $this->QuotationProduct->recursive = 3;
//        if ($this->Auth->user('role') != 'supply_staff') {
//            $quote_products = $this->QuotationProduct->find('all', array(
//                'conditions' => array('QuotationProduct.quotation_id' => $quote_data['Quotation']['id'])
//            ));
//        } else {
//            $quote_products = $this->QuotationProduct->find('all', array(
//                'conditions' => array(
//                    'QuotationProduct.quotation_id' => $quote_data['Quotation']['id'],
//                    'QuotationProduct.type' => array('supply', 'combination')
//                )
//            ));
//        }
//        $this->set(compact('quote_products'));
//
//        $this->set(compact('quote_number'));
//
//        $this->loadModel('Collection');
//        $collections = $this->Collection->find('all', array(
//            'conditions' => array('Collection.quotation_id' => $this->params['url']['id'],
//                'Collection.status' => 'verified')
//        ));
//        $this->set(compact('collections'));
//
//
//        $this->loadModel('PoProduct');
//        $this->PoProduct->recursive = 2;
//        $poprod = $this->PoProduct->find('all', array(
//            'conditions' => array(
//                'PoProduct.quotation_id' => $this->params['url']['id'],
//                'PoProduct.additional' => 0)
//        ));
//        $this->set(compact('poprod'));
//
//        $this->loadModel('InvLocation');
//        $locations = $this->InvLocation->find('all');
//        $this->set(compact('locations'));
//            pr($poprod);
//        $additional_products = $this->Product->find()
    }
    
    public function edit_inquired($id=null){
        $this->loadModel('QuotationProduct');
        
        $this->autoRender = false;
        header("Content-type:application/json");
        $data = $this->request->data;
        
        $quotation_product_id = $data['id'];
        
        $edit_TS = $this->QuotationProduct->getDataSource();
        $edit_TS->begin();
        
        $this->QuotationProduct->id = $quotation_product_id;
        
        $this->QuotationProduct->set(array(
            "inquired" => 1
        ));
        
        $edit_start = $this->QuotationProduct->save();
        if($edit_start){
            $edit_TS->commit();
            echo json_encode($quotation_product_id);
        }else{
            $edit_TS->rollback();
        }
        exit;
        
    }
    
    public function all_list(){
        
        $status = $this->params['url']['status'];

        $this->loadModel('User');
        $user = $this->User->findById($this->Auth->user('id'));
        if ($user['User']['department_id'] == 6) {
            $type = 'supply';
        } else if ($user['User']['department_id'] == 7) {
            $type = 'raw';
        }
        $pendings = $this->PurchaseOrder->find('all', array(
            'conditions' => array(
                'PurchaseOrder.status' => $status,
                'PurchaseOrder.type' => $type,
            )
        ));
        

        $this->loadModel('Product');
        $products = $this->Product->find('all');
        $this->set(compact('products'));
        $this->set(compact('pendings', 'type'));
    }
    public function po_product() {
        $id = $this->params['url']['id'];
        $this->PurchaseOrder->recursive = 3;
        $po = $this->PurchaseOrder->findById($id);
//        pr($po);
        $this->set(compact('po'));

        $this->loadModel('User');
        $user = $this->User->findById($this->Auth->user('id'));
        if ($user['User']['department_id'] == 6) {
            $type = 'supply';
        } else if ($user['User']['department_id'] == 7) {
            $type = 'raw';
        }
        
        $stat = $po['PurchaseOrder']['status'];
        $this->loadModel('Product');
        $products = $this->Product->find('all');
        $this->set(compact('products', 'type', 'stat'));
        
    }
    
    
    public function updatePoProductPrice() {
        $this->autoRender = false;
        $data = $this->request->data;
        $po_product_id = $data['po_product_id'];
        $price = $data['price'];

        $this->loadModel('PurchaseOrderProduct');

        $this->PurchaseOrderProduct->id = $po_product_id;
        $this->PurchaseOrderProduct->set(array(
            'list_price' => $price
        ));
        if ($this->PurchaseOrderProduct->save()) {
            echo json_encode($data);
        }
    }
    public function poAmounts() {

        $this->autoRender = false;
        $data = $this->request->data;


        $discount = $data['discount'];
        $vat = $data['vat'];
        $total_purchased_val = $data['total_purchased_val'];
        $total_purchased = $data['total_purchased'];
//        $total = $data['total'];
        $ewt = $data['ewt'];
        $ewt_type = $data['ewt_type'];
        $grand_total = $data['grand_total'];
        $po_id = $data['po_id'];

        //get total of all poproduct
        $this->loadModel('PurchaseOrderProduct');
//            $po_prods = $this->PoProduct->FindAllByPurchaseOrderId($po_id);
        $po_prods = $this->PurchaseOrderProduct->find('all', array(
            'conditions' => array('PurchaseOrderProduct.purchase_order_id' => $po_id,
                                  'PurchaseOrderProduct.status'=>null)
        ));
        $ntp = 0;
        foreach ($po_prods as $po_prod) {
            $total_p = $po_prod['PurchaseOrderProduct']['list_price'] * $po_prod['PurchaseOrderProduct']['qty'];
            $ntp = $ntp + $total_p;
        }


        if ($discount != 0) {
            $new_total_purchased = $ntp - $discount;
        } else {
        $new_total_purchased = $ntp;
        }
        if($ewt_type == 'one'){
            $new_ewt = $new_total_purchased * .01;
        } else{
            $new_ewt = $new_total_purchased * .02;
        }
        if ((int)$vat == 0) {
            //computation for vat inc
            $data['vaat'] = 'if';
            $vat = $new_total_purchased * .12;
            $data['newvat'] = $vat;
            // $new_ewt = $non_vat * 0.01;
            $new_grand_total = ($new_total_purchased + $vat) - $new_ewt;
            // $new_vat = $non_vat;
            //$new_vat = 0;
        } else {
            //computation for vat ex
            $data['vaat'] = 'else';
            $new_vat =   0;
            $vat = 0;
            // $new_ewt = $new_total_purchased * 0.01;
            $new_grand_total = $new_total_purchased - $new_ewt;
        }
        $this->PurchaseOrder->id = $po_id;
        $this->PurchaseOrder->set(array(
            'total_purchased' => $new_total_purchased,
            'vat_amount' => floatval($vat),
            'ewt_amount' => $new_ewt,
            'ewt_type' => $ewt_type,
            'grand_total' => $new_grand_total,
            'discount' => $discount
        ));
        $this->PurchaseOrder->recursive = -1;
        $data[] = $this->PurchaseOrder->findById($po_id);
        if ($this->PurchaseOrder->save()) {
            echo json_encode($data);
        }
    }
    public function changeStatus() {
        $this->autoRender = false;
        $data = $this->request->data;


        $po_id = $data['po_id'];
        $status = $data['savestatus'];

        $this->PurchaseOrder->id = $po_id;
        $this->PurchaseOrder->set(array(
            'status' => $status
        ));
        if ($this->PurchaseOrder->save()) {
            echo json_encode($data);
        }
    }
    
    public function delete() {
        $this->autoRender = false;
        $data = $this->request->data;
        
        $id = $data['id'];
        $po_id = $data['poid'];
        
        $empty = "not_empty";
        $this->loadModel('PurchaseOrderProduct');
        $this->loadModel('Quotation');
        $this->loadModel('QuotationProduct');
        $this->loadModel('TransactionSource');
        
        $DS_PurchaseOrder = $this->PurchaseOrder->getDataSource();
        $DS_PurchaseOrderProduct = $this->PurchaseOrderProduct->getDataSource();
        
        // ==================================================
        //  RECOMPUTE vat, total_purchased, ewt, grand_total;
        // ==================================================
        $get_po_prod = $this->PurchaseOrderProduct->findById($id);
        $ret_po_prod = $get_po_prod['PurchaseOrderProduct'];
        $additional = $ret_po_prod['additional'];
        $qp_id = $ret_po_prod['reference_num'];
        $po_p_process_qty = $ret_po_prod['processed_qty'];
        
        $this->QuotationProduct->recursive = -1;
        $get_qps = $this->QuotationProduct->findById($qp_id);
        
        $qps_process_qty = 0;
        if(!empty($get_qps)) {
            $qps_process_qty = $get_qps['QuotationProduct']['processed_qty'];
        }
        
        $total_insert_qty = $qps_process_qty - $po_p_process_qty;
        if($additional==0) {
            $this->QuotationProduct->id=$qp_id;
            $this->QuotationProduct->set(['processed_qty'=>$total_insert_qty]);
            $this->QuotationProduct->save();
        }
        
        
        
        // delete po_product
        $DS_PurchaseOrderProduct->begin();
        $this->PurchaseOrderProduct->id=$id;
        if($this->PurchaseOrderProduct->delete()) {
            // get all po_prod where po_id == po_id
            $count_po_prods = $this->PurchaseOrderProduct->find('all', ['conditions'=>
                ['purchase_order_id'=>$po_id]]);
            // end of get all po_prod where po_id == po_id
            
            if(count($count_po_prods)==0) {
                // DELETE PO
                $DS_PurchaseOrder->begin();
                $this->PurchaseOrder->id = $po_id;
                if($this->PurchaseOrder->delete()) {
                    $DS_PurchaseOrder->commit();
                    $DS_PurchaseOrderProduct->commit();
                    $empty = "empty";
                }
                else {
                    echo json_encode("Error in deleting PurchaseOrder");
                    $DS_PurchaseOrderProduct->rollback();
                }
                // END OF DELETE PO
            }
            else {
                $DS_PurchaseOrderProduct->commit();
            }
        }
        // end of delete po_product
        
        //get total of all poproduct
        $po_prods = $this->PurchaseOrderProduct->find('all',
            ['conditions' =>['PurchaseOrderProduct.purchase_order_id' => $po_id]]);
        
        $ntp = 0;
        $stat_count = 0;
        $count = count($po_prods);
        foreach ($po_prods as $po_prod) {
            $po_obj = $po_prod['PurchaseOrder'];
            $po_id = $po_obj['id'];
            $po_prod_id_remaining = $po_prod['PurchaseOrderProduct']['id'];
            $total_p = $po_prod['PurchaseOrderProduct']['list_price'] * $po_prod['PurchaseOrderProduct']['qty'];
            $ntp = $ntp + $total_p;
            $discount = $po_prod['PurchaseOrder']['discount'];
            $ewt_type= $po_prod['PurchaseOrder']['ewt_type'];
            $vat = $po_obj['vat_amount'];
            $ref_num = $po_prod['PurchaseOrderProduct']['reference_num'];
            
            $transactionSources = $this->TransactionSource->find("all",
                ['conditions'=>['reference_type'=>'quotation',
                            'reference_num'=>$ref_num,
                            'product_source'=>$po_prod_id_remaining,
                            'mode_num'=>$po_id]]);
        
            foreach($transactionSources as $transactionSource) {
                $ts_id = $transactionSource['TransactionSource']['id'];
                
                $this->TransactionSource->id = $ts_id;
                $this->TransactionSource->set(['status'=>'deleted']);
                $this->TransactionSource->save();
            }
            
            // QUOTATION
            $r_po_prod_stat = $po_prod['PurchaseOrderProduct']['status'];
            if($r_po_prod_stat=="processed") {
                $stat_count++;
            }
            
            $this->QuotationProduct->recursive = -1;
            $get_q_ids = $this->QuotationProduct->find('all',
                ['conditions'=>['QuotationProduct.id'=>$ref_num],
                                'fields'=>['QuotationProduct.quotation_id']]);
            
            foreach($get_q_ids as $get_q_id) {
                $q_id = $get_q_id['QuotationProduct']['quotation_id'];
                
                $this->Quotation->id = $q_id;
                if($stat_count==$count) {
                    // UPDATE STATUS TO PROCESSED
                    $this->Quotation->set(['status'=>'processed']);
                }
                else if($stat_count==($count-1)) {
                    // UPDATE STATUS TO APPROVED
                    $this->Quotation->set(['status'=>'approved']);
                }
                $this->Quotation->save();
            }
            
            if ($discount != 0) {
                $new_total_purchased = $ntp - $discount;
            } else {
                $new_total_purchased = $ntp;
            }
            if($ewt_type == 'one'){
                $new_ewt = $new_total_purchased * .01;
            } else{
                $new_ewt = $new_total_purchased * .02;
            }
            if ((int)$vat == 0) {
                //computation for vat inc
                $data['vaat'] = 'if';
                $vat = $new_total_purchased * .12;
                $data['newvat'] = $vat;
                // $new_ewt = $non_vat * 0.01;
                $new_grand_total = ($new_total_purchased + $vat) - $new_ewt;
                // $new_vat = $non_vat;
                //$new_vat = 0;
            } else {
                //computation for vat ex
                $data['vaat'] = 'else';
                $new_vat =   0;
                $vat = 0;
                // $new_ewt = $new_total_purchased * 0.01;
                $new_grand_total = $new_total_purchased - $new_ewt;
            }
            $this->PurchaseOrder->id = $po_id;
            $this->PurchaseOrder->set(array(
                'total_purchased' => $new_total_purchased,
                'vat_amount' => floatval($vat),
                'ewt_amount' => $new_ewt,
                'ewt_type' => $ewt_type,
                'grand_total' => $new_grand_total,
                'discount' => $discount
            ));
            $this->PurchaseOrder->recursive = -1;
            $data[] = $this->PurchaseOrder->findById($po_id);
            if ($this->PurchaseOrder->save()) {
                echo json_encode($data);
            }
        }
        // =====================================================
        // END RECOMPUTE vat, total_purchased, ewt, grand_total;
        // =====================================================
        
        $DS_PurchaseOrder->commit();
        
        return $empty;
    }
}
