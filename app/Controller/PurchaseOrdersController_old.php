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

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->PurchaseOrder->id = $id;
        if (!$this->PurchaseOrder->exists()) {
            throw new NotFoundException(__('Invalid purchase order'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->PurchaseOrder->delete()) {
            $this->Session->setFlash(__('The purchase order has been deleted.'), 'default', array('class' => 'alert alert-success'));
        } else {
            $this->Session->setFlash(__('The purchase order could not be deleted. Please, try again.'), 'default', array('class' => 'alert alert-danger'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function setPoProduct() {
        $this->autoRender = false;
        $data = $this->request->data;
        $quotation_product_id = $data['quotation_product_id'];
        $supplier_id = $data['supplier_id'];
        $product_supplier_id = $data['product_supplier_id'];
        $qty = $data['total_qty'];
        $price = $data['total_price'];
        $property = $data['property'];
        $value = $data['value'];
        $counter = $data['counter'];
        $per_qty = $data['qty'];
        $additional = $data['additional'];
//pr($additional);exit;
        //check if purchase order exists for the selected supplier
//        $this->loadModel('PoProduct');
        $check_po = $this->PurchaseOrder->find('first', array(
            'conditions' => array(
                'PurchaseOrder.supplier_id' => $supplier_id,
                'PurchaseOrder.status' => 'ongoing'
        )));
        $this->loadModel('User');
        $user = $this->User->findById($this->Auth->user('id'));
        $this->loadModel('PoProduct');
        $this->loadModel('PoProductProperty');
        $this->loadModel('QuotationProduct');
        $this->loadModel('Quotation');
        if ($quotation_product_id != 0) {
            $qprod = $this->QuotationProduct->findById($quotation_product_id);
            $product_id = $qprod['QuotationProduct']['product_id'];
            $quotation_product_id = $qprod['QuotationProduct']['id'];
            $quotation_id = $qprod['Quotation']['id'];
            //get processed qty in quote product  
            $processed_qty = $qprod['QuotationProduct']['processed_qty'];
            $pro_qty = $processed_qty + $qty;
        } else {
            $quotation_product_id = 0;
            $quotation_id = 0;
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
                $this->PoProduct->create();
                $this->PoProduct->set(array(
                    'product_id' => $product_supplier_id,
                    'purchase_order_id' => $po_id,
                    'qty' => $qty,
                    'price' => $price,
                    'quotation_product_id' => $quotation_product_id,
                    'user_id' => $this->Auth->user('id'),
                    'quotation_id' => $quotation_id,
                    'additional' => $additional
                ));
                if ($this->PoProduct->save()) {
                    $po_product_id = $this->PoProduct->getLastInsertID();

                    for ($i = 0; $i <= $counter; $i++) {
                        $this->PoProductProperty->create();
                        $this->PoProductProperty->set(array(
                            'property' => $property[$i],
                            'value' => $value[$i],
                            'po_product_id' => $po_product_id
                        ));
                        $this->PoProductProperty->save();
                    }

                    if ($quotation_product_id != 0) {
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


                        $this->loadModel('ProductSource');
                        $this->loadModel('ProductSourceProperty');
                        $this->ProductSource->create();
                        $this->ProductSource->set(array(
                            "quotation_product_id" => $quotation_product_id,
                            "product_id" => $product_supplier_id,
                            "source" => 'po',
                            "quotation_id" => $quotation_id,
                            "purchase_order_id" => $po_id,
                            "status" => "pending",
                            "qty" => $qty,
                            "type" => 'supply'
                        ));

                        if ($this->ProductSource->save()) {
                            $product_source_id = $this->ProductSource->getLastInsertID();

                            for ($i = 0; $i <= $counter; $i++) {
                                $this->ProductSourceProperty->create();
                                $this->ProductSourceProperty->set(array(
                                    'property' => $property[$i],
                                    'value' => $value[$i],
                                    'qty' => $per_qty[$i],
                                    'product_source_id' => $product_source_id
                                ));
                                $this->ProductSourceProperty->save();
                            }
                        }
                    }
                    echo json_encode($data);
                }
            }
        } else {
            //get purchase order number then add the po product
            $this->PoProduct->create();
            $this->PoProduct->set(array(
                'product_id' => $product_supplier_id,
                'purchase_order_id' => $check_po['PurchaseOrder']['id'],
                'qty' => $qty,
                'price' => $price,
                'quotation_product_id' => $quotation_product_id,
                'user_id' => $this->Auth->user('id'),
                'quotation_id' => $quotation_id,
                'additional' => $additional
            ));
            if ($this->PoProduct->save()) {

                $po_product_id = $this->PoProduct->getLastInsertID();

                for ($i = 0; $i <= $counter; $i++) {
                    $this->PoProductProperty->create();
                    $this->PoProductProperty->set(array(
                        'property' => $property[$i],
                        'value' => $value[$i],
                        'po_product_id' => $po_product_id,
                        'additional' => $additional
                    ));
                    $this->PoProductProperty->save();
                }

                if ($quotation_product_id != 0) {
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

                    $this->loadModel('ProductSource');
                    $this->loadModel('ProductSourceProperty');
                    $this->ProductSource->create();
                    $this->ProductSource->set(array(
                        "quotation_product_id" => $quotation_product_id,
                        "product_id" => $product_supplier_id,
                        "source" => 'po',
                        "quotation_id" => $quotation_id,
                        "purchase_order_id" => $check_po['PurchaseOrder']['id'],
                        "status" => "pending",
                        "qty" => $qty,
                        "type" => 'supply'
                    ));

                    if ($this->ProductSource->save()) {
                        $product_source_id = $this->ProductSource->getLastInsertID();

                        for ($i = 0; $i <= $counter; $i++) {
                            $this->ProductSourceProperty->create();
                            $this->ProductSourceProperty->set(array(
                                'property' => $property[$i],
                                'value' => $value[$i],
                                'qty' => $per_qty[$i],
                                'product_source_id' => $product_source_id
                            ));
                            $this->ProductSourceProperty->save();
                        }
                    }
                }

                echo json_encode($data);
            }
        }
    }

    public function updatePoProduct() {
        $this->autoRender = false;
        $data = $this->request->data;
        $po_product_id = $data['po_product_id'];
        $supplier_id = $data['supplier_id'];
        $qty = $data['qty'];


        $po = $this->PurchaseOrder->find('first', array(
            'conditions' => array(
                'PurchaseOrder.supplier_id' => $supplier_id,
                'PurchaseOrder.status' => 'pending'
        )));


        $this->loadModel('PoProduct');
        $this->PoProduct->id = $po_product_id;
        $this->PoProduct->set(array(
            'purchase_order_id' => $po['PurchaseOrder']['id'],
            'qty' => $qty
        ));
        if ($this->PoProduct->save()) {
            echo json_encode($data);
        }
    }

    public function ongoing() {
        $this->loadModel('User');
        $user = $this->User->findById($this->Auth->user('id'));
        if ($user['User']['department_id'] == 6) {
            $type = 'supply';
        } else if ($user['User']['department_id'] == 7) {
            $type = 'raw';
        }
        $pendings = $this->PurchaseOrder->find('all', array(
            'conditions' => array(
                'PurchaseOrder.status' => 'ongoing',
                'PurchaseOrder.type' => $type,
            )
        ));
        $this->set(compact('pendings'));
//        pr($pendings);
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

    public function po() {
        $status = $this->params['url']['status'];

        $this->loadModel('User');
        $user = $this->User->findById($this->Auth->user('id'));
         $type = '';
        if ($user['User']['department_id'] == 9) {
            $type = 'supply';
        } else if ($user['User']['department_id'] == 8) {
            $type = 'raw';
        }
        $pendings = $this->PurchaseOrder->find('all', array(
            'conditions' => array(
                'PurchaseOrder.status' => $status,
                'PurchaseOrder.type' => $type,
            )
        ));
        $this->set(compact('pendings', 'type'));
    }

    public function po_products() {
        $id = $this->params['url']['id'];
        $this->PurchaseOrder->recursive = 2;
        $po = $this->PurchaseOrder->findById($id);
        $this->set(compact('po'));

        $this->loadModel('User');
        $user = $this->User->findById($this->Auth->user('id'));
        if ($user['User']['department_id'] == 6) {
            $type = 'supply';
        } else if ($user['User']['department_id'] == 7) {
            $type = 'raw';
        }

        $this->loadModel('Product');
        $products = $this->Product->find('all');
        $this->set(compact('products', 'type'));
        
        
    }

    public function updatePoProductPrice() {
        $this->autoRender = false;
        $data = $this->request->data;
        $po_product_id = $data['po_product_id'];
        $price = $data['price'];

        $this->loadModel('PoProduct');

        $this->PoProduct->id = $po_product_id;
        $this->PoProduct->set(array(
            'price' => $price
        ));
        if ($this->PoProduct->save()) {
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
        $grand_total = $data['grand_total'];
        $po_id = $data['po_id'];

        //get total of all poproduct
        $this->loadModel('PoProduct');
//            $po_prods = $this->PoProduct->FindAllByPurchaseOrderId($po_id);
        $po_prods = $this->PoProduct->find('all', array(
            'conditions' => array('PoProduct.purchase_order_id' => $po_id)
        ));
        $ntp = 0;
        foreach ($po_prods as $po_prod) {
            $total_p = $po_prod['PoProduct']['price'] * $po_prod['PoProduct']['qty'];
            $ntp = $ntp + $total_p;
        }


        if ($discount != 0) {
            $new_total_purchased = $ntp - $discount;
        } else {
            $new_total_purchased = $ntp;
        }
        if ($vat == 0) {
            //computation for vat inc
            $non_vat = $new_total_purchased / 1.12;
            $new_ewt = $non_vat * 0.01;
            $new_grand_total = $new_total_purchased - $new_ewt;
//            $new_vat = 0;
        } else {
            //computation for vat ex
//           $new_vat =   $new_total_purchased *0.12;
            $new_ewt = $new_total_purchased * 0.01;
            $new_grand_total = ($new_total_purchased + $vat) - $new_ewt;
        }
        $this->PurchaseOrder->id = $po_id;
        $this->PurchaseOrder->set(array(
            'total_purchased' => $new_total_purchased,
            'vat_amount' => $vat,
            'ewt_amount' => $new_ewt,
            'grand_total' => $new_grand_total,
            'discount' => $discount
        ));
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
    
    
    public function setPoProductRaw(){
        
        $this->autoRender = false;
        $data = $this->request->data;
        $po_raw_request_id = $data['po_raw_request_id'];
        $supplier_id = $data['supplier_id'];
        $product_supplier_id = $data['product_supplier_id'];
        $qty = $data['total_qty'];
        $price = $data['total_price'];
        $property = $data['property'];
        $value = $data['value'];
        $counter = $data['counter'];
        $per_qty = $data['qty'];
        $additional = $data['additional'];
        
        $check_po = $this->PurchaseOrder->find('first', array(
            'conditions' => array(
                'PurchaseOrder.supplier_id' => $supplier_id,
                'PurchaseOrder.status' => 'ongoing'
        )));
        $this->loadModel('User');
        $user = $this->User->findById($this->Auth->user('id'));
        $this->loadModel('PoProduct');
        $this->loadModel('PoProductProperty');
        $this->loadModel('QuotationProduct');
//        $this->loadModel('Quotation');
        $this->loadModel('PoRawRequest');
        
        
        if($po_raw_request_id != 0) {
            
            $qprod = $this->PoRawRequest->findById($po_raw_request_id);
            $qprdct = $this->QuotationProduct->findById($qprod['PoRawRequest']['quotation_product_id']);
            $product_id = $qprod['PoRawRequest']['product_id'];
            $quotation_id = $qprdct['QuotationProduct']['quotation_id'];
            $quotation_product_id =  $qprdct['QuotationProduct']['id']; 
            
            
            //get processed qty in quote product  
            $processed_qty = $qprod['PoRawRequest']['processed_qty'];
            $raw_qty = $qprod['PoRawRequest']['qty'];
            $pro_qty = $processed_qty + $qty;
            
            if($pro_qty >= $raw_qty){
                $stats='processed';
            }else{
                $stats='pending';
            }
        } else {
            $po_raw_request_id = 0;
            $quotation_id = 0;
            $quotation_product_id = 0;
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
                $this->PoProduct->create();
                $this->PoProduct->set(array(
                    'product_id' => $product_supplier_id,
                    'purchase_order_id' => $check_po['PurchaseOrder']['id'],
                    'qty' => $qty,
                    'price' => $price,
                    'quotation_product_id' =>$quotation_product_id,
                    'user_id' => $this->Auth->user('id'),
                    'quotation_id' => $quotation_id,
                    'additional' => $additional
                ));
                if ($this->PoProduct->save()) {
                    $po_product_id = $this->PoProduct->getLastInsertID();

                    for ($i = 0; $i <= $counter; $i++) {
                        $this->PoProductProperty->create();
                        $this->PoProductProperty->set(array(
                            'property' => $property[$i],
                            'value' => $value[$i],
                            'po_product_id' => $po_product_id
                        ));
                        $this->PoProductProperty->save();
                    }
                    
                    

                        $this->loadModel('ProductSource');
                        $this->loadModel('ProductSourceProperty');
                        $this->ProductSource->create();
                        $this->ProductSource->set(array(
                            "quotation_product_id" => $quotation_product_id,
                            "product_id" => $product_supplier_id,
                            "source" => 'po',
                            "quotation_id" => $quotation_id,
                            "purchase_order_id" => $po_id,
                            "status" => "pending",
                            "qty" => $qty,
                            "type"=> 'raw'
                        ));

                        if($this->ProductSource->save()){
                            $product_source_id = $this->ProductSource->getLastInsertID();

                            for ($i = 0; $i <= $counter; $i++) {
                                $this->ProductSourceProperty->create();
                                $this->ProductSourceProperty->set(array(
                                    'property' => $property[$i],
                                    'value' => $value[$i],
                                    'qty' => $per_qty[$i],
                                    'product_source_id' => $product_source_id
                                ));
                                $this->ProductSourceProperty->save();
                            }
                        }
 
                        $dateToday = date("Y-m-d H:i:s");
                        $this->PoRawRequest->id = $po_raw_request_id;
                        $this->PoRawRequest->set(array(
                            'status' => $stats,
                            'date_processed' => $dateToday, 
                            'processed_qty' => $pro_qty
                        ));
                        $this->PoRawRequest->save(); 
   
                    echo json_encode($data);
                }
            }
        } else {
            //get purchase order number then add the po product
            $this->PoProduct->create();
            $this->PoProduct->set(array(
                'product_id' => $product_supplier_id,
                'purchase_order_id' => $check_po['PurchaseOrder']['id'],
                'qty' => $qty,
                'price' => $price,
                'quotation_product_id' => $quotation_product_id,
                'user_id' => $this->Auth->user('id'),
                'quotation_id' => $quotation_id,
                'additional' => $additional
            ));
            if ($this->PoProduct->save()) {

                $po_product_id = $this->PoProduct->getLastInsertID();

                for ($i = 0; $i <= $counter; $i++) {
                    $this->PoProductProperty->create();
                    $this->PoProductProperty->set(array(
                        'property' => $property[$i],
                        'value' => $value[$i],
                        'po_product_id' => $po_product_id,
                        'additional' => $additional
                    ));
                    $this->PoProductProperty->save();
                }

                        $this->loadModel('ProductSource');
                        $this->loadModel('ProductSourceProperty');
                        $this->ProductSource->create();
                        $this->ProductSource->set(array(
                            "quotation_product_id" => $quotation_product_id,
                            "product_id" => $product_supplier_id,
                            "source" => 'po',
                            "quotation_id" => $quotation_id,
                            "purchase_order_id" => $check_po['PurchaseOrder']['id'],
                            "status" => "pending",
                            "qty" => $qty,
                            "type" => 'raw'
                        ));

                        if($this->ProductSource->save()){
                            $product_source_id = $this->ProductSource->getLastInsertID();

                            for ($i = 0; $i <= $counter; $i++) {
                                $this->ProductSourceProperty->create();
                                $this->ProductSourceProperty->set(array(
                                    'property' => $property[$i],
                                    'value' => $value[$i],
                                    'qty' => $per_qty[$i],
                                    'product_source_id' => $product_source_id
                                ));
                                $this->ProductSourceProperty->save();
                            }
                        }

                        $dateToday = date("Y-m-d H:i:s");
                        $this->PoRawRequest->id = $po_raw_request_id;
                        $this->PoRawRequest->set(array(
                            'status' => $stats,
                            'date_processed' => $dateToday, 
                            'processed_qty' => $pro_qty
                        ));
                        $this->PoRawRequest->save(); 

                echo json_encode($data);
            }
        }

    }
    

}
